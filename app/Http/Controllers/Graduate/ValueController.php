<?php

namespace App\Http\Controllers\Graduate;

use App\Exports\Graduate\ValueExamExport;
use App\Exports\Graduate\ValueSemesterExport;
use App\Http\Controllers\Controller;
use App\Imports\Graduate\ValueExamImport;
use App\Imports\Graduate\ValueSemesterImport;
use App\Models\Graduate\Setting;
use App\Models\Graduate\Student;
use App\Models\Graduate\ValueExam;
use App\Models\Graduate\ValueSemester;
use App\Models\Master\School;
use App\Models\Master\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ValueController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['school'] = new School();
        $this->data['setting'] = new Setting();
    }

    public function semester(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $students = Student::with('valuesemester')->get();
                foreach ($students as $student){
                    $values = $student->valuesemester
                        ->where('value_semester_semester', $request->semester_id)
                        ->where('value_semester_year', $request->year_id);
                    $value_semester = [];
                    foreach ($values as $value){
                        $value_semester[] = $value->value_semester_point_know;
                        $value_semester[] = $value->value_semester_point_skill;
                    }
                    $data[] = array_merge([$student->student_name], $value_semester);
                }
                $msg['data'] = empty($value) ? [] : $data;
            }
            elseif ($request->_type == 'data' && $request->_data == 'upload'){
                $validator = Validator::make($request->all(), [
                    'value_semester' => 'mimes:xls,xlsx'
                ]);
                if ($validator->fails()) {
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => 'Berkas Harus Berekstensi xls/xlsx'];
                }
                else {
                    try {
                        if ($request->hasFile('value_semester')) {
                            $file = $request->file('value_semester')->store('temp');
                            $path = storage_path('app') .'/'. $file;
                            ValueSemester::where('value_semester_year', $request->year_id)
                                ->where('value_semester_semester', $request->semester_id)->delete();
                            if (Excel::import(new ValueSemesterImport(), $path)){
                                $msg = ['title' => 'Berhasil !', 'class' => 'success', 'text' => 'Nilai Semester Berhasil ditambahkan'];
                            }
                        }
                    } catch (\Exception $e){
                        $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                    }
                }
            }
            return response()->json($msg);
        }
        elseif ($request->_type == 'download' && $request->_data == 'value_semester'){
            return Excel::download(new ValueSemesterExport(), 'nilai_semester.xlsx');
        }
        else {
            return view('graduate.backend.value_semester', $this->data);
        }
    }

    public function exam(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $students = Student::with('valueexam')->get();
                foreach ($students as $student){
                    $value_exam = [];
                    foreach ($student->valueexam as $value){
                        $value_exam[] = $value->value_exam_point;
                    }
                    $data[] = array_merge([$student->student_name], $value_exam);
                }
                $msg['data'] = empty($value_exam) ? [] : $data;
            }
            elseif ($request->_type == 'data' && $request->_data == 'upload'){
                $validator = Validator::make($request->all(), [
                    'value_exam' => 'mimes:xls,xlsx'
                ]);
                if ($validator->fails()) {
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => 'Berkas Harus Berekstensi xls/xlsx'];
                }
                else {
                    try {
                        if ($request->hasFile('value_exam')) {
                            $file = $request->file('value_exam')->store('temp');
                            $path = storage_path('app') .'/'. $file;
                            ValueExam::query()->truncate();
                            if (Excel::import(new ValueExamImport(), $path)){
                                $msg = ['title' => 'Berhasil !', 'class' => 'success', 'text' => 'Nilai Ujian Berhasil ditambahkan'];
                            }
                        }
                    } catch (\Exception $e) {
                        $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                    }
                }
            }
            return response()->json($msg);
        }
        elseif ($request->_type == 'download' && $request->_data == 'value_exam'){
            return Excel::download(new ValueExamExport(), 'nilai_ujian.xlsx');
        }
        else {
            return view('graduate.backend.value_exam', $this->data);
        }
    }

    public function certificate(Request $request){
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $students = Student::with('valuesemester')->with('valueexam');
                foreach ($students->get() as $student){
                    $value = [];
                    foreach (Subject::OrderBy('subject_number')->get() as $subjects){
                        $value[] = number_format((($student->valuesemester->where('value_semester_subject', $subjects->subject_id)
                                        ->average('value_semester_point_know') * $this->data['setting']->value('value_semester')) +
                                ($student->valueexam->where('value_exam_subject', $subjects->subject_id)
                                        ->first()->value_exam_point * $this->data['setting']->value('value_exam')))/100, 2);
                        $value[] = number_format( $student->valuesemester->where('value_semester_subject', $subjects->subject_id)
                            ->average('value_semester_point_skill'),2);
                    }
                    $data[] = array_merge([$student->student_name], $value);
                }
                $msg['data'] = empty($value) ? [] : $data;
            }
            return response()->json($msg);
        }
        elseif ($request->_type == 'download' && $request->_data == 'value_exam'){
            return Excel::download(new ValueSemesterExport, 'nilai_ujian.xlsx');
        }
        else {
            return view('graduate.backend.value_certificate', $this->data);
        }
    }
}
