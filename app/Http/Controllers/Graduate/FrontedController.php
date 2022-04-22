<?php

namespace App\Http\Controllers\Graduate;

use App\Http\Controllers\Controller;
use App\Models\Graduate\Setting;
use App\Models\Graduate\Student;
use App\Models\Master\School;
use App\Models\Master\Subject;
use Carbon\Carbon;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Http\Request;

class FrontedController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['school'] = new School();
        $this->data['setting'] = new Setting();
    }
    public function home(Request $request)
    {
        if (Carbon::createFromFormat('d/m/Y H:i', $this->data['setting']->value('announcement_date'))->toDateTimeString() <= Carbon::now()->toDateTimeString()){
            if ($request->submit == 'search'){
                $student = Student::with('announcement')->where('student_nisn', $request->student_nisn)->first();
                if ($student != null){
                    if ($student->announcement->announcement_finance == 2){
                        return redirect()->back()->with('msg', ['title' => 'Kesalahan!', 'class' => 'danger', 'text' => 'Anda belum menyelesaikan administrasi, silahkan menghubungi bendahara madrasah']);
                    }
                    else {
                        $student->announcement->announcement_view = $student->announcement->announcement_view + 1;
                        $student->announcement->save();
                        $this->data['student'] = $student;
                        $this->data['announcement'] = $student->announcement;
                        return view('graduate.fronted.result', $this->data);
                    }
                }
                else {

                    return redirect()->back()->with('msg', ['title' => 'Kesalahan!', 'class' => 'danger', 'text' => 'NISN tidak ditemukan, silahkan periksa kembali']);
                }
            }
            elseif ($request->submit == 'print'){
                return $this->print($request);
            }
            return view('graduate.fronted.home', $this->data);
        }
        else {
            $this->data['noticeDate'] = Carbon::createFromFormat('d/m/Y H:i', $this->data['setting']->value('announcement_date'))->format('m/d/Y H:i:s');
            return view('graduate.fronted.countdown', $this->data);
        }
    }

    public function print(Request $request)
    {
        if ($request->submit == 'skl'){
            $student = Student::with('announcement')->where('student_nisn', $request->student_nisn)->first();
            if ($student->announcement->announcement_finance == 1){
                $this->data['subjects'] = Subject::OrderBy('subject_number', 'ASC')->get();
                $this->data['student'] = $student;
                $this->data['announcement'] = $student->announcement;
                $this->data['value_know'] = json_decode($student->announcement->announcement_value_know);
                $this->data['value_skill'] = json_decode($student->announcement->announcement_value_skill);
                $student->announcement->update([
                    'announcement_print' => $student->announcement->announcement_print + 1
                ]);
                $student->announcement->save();

                $cert = 'file://'. realpath(storage_path('app/cert/selfcert.pem'));
                $key = 'file://'. realpath(storage_path('app/cert/enc_key.pem'));
                $info = array(
                    'Name' => 'Kepala MTs. Darul Hikmah Menganti',
                    'Reason' => 'Surat Keterangan Lulus TP. 2021/2022',
                    'Location' => 'MTs. Darul Hikmah Menganti',
                    'ContactInfo' => 'mts@darul-hikmah.sch.id',
                );

                $view = view('graduate.fronted.skl_template', $this->data)->render();
                TCPDF::setSignature($cert, $key, 'myu2nnmd', '', 2, $info);
                TCPDF::SetFont('times', '', 12);
                TCPDF::SetMargins(1, 1, 1);
                TCPDF::SetAutoPageBreak(true, 0);
                TCPDF::AddPage();
                TCPDF::writeHTML($view, true, 0, true, 0, '');
                TCPDF::setSignatureAppearance(1, 8.3, 5.1, 4.1);
                TCPDF::Output('skl-'. $student->student_nisn .'.pdf');
                TCPDF::reset();
            }
            else {
                return view('graduate.finance');
            }
        }
        elseif ($request->submit == 'skl_un'){
            $student = Student::with('announcement')->with('valuesemester')->where('student_nisn',$request->student_nisn)->first();
            if ($student->announcement->announcement_finance == 1){
                $subjects = Subject::where('subject_exam', 1)->get();
                foreach ($subjects as $subject){
                    $vs = $student->valuesemester()->where('value_semester_subject', $subject->subject_id)
                        ->OrderBy('value_semester_year')->OrderBy('value_semester_semester')->get();
                    $point = [];
                    foreach ($vs as $value_semester){
                        $point[] = number_format(($value_semester->value_semester_point_know / 10), 2);
                        $point[] = number_format(($value_semester->value_semester_point_skill / 10), 2);
                    }
                    $value[] = array_merge([strtoupper($subject->subject_name)], array_slice($point,0,10));
                }
                $data = [
                    'student' => $student,
                    'announcement' => $student->announcement,
                    'values' => $value
                ];
                return \PDF::loadView('graduate.skl_un_template', $data)->download('SKL-UN-'.$student->student_nisn.'.pdf');
            }
            else {
                return view('graduate.finance');
            }

        }
        elseif ($request->submit == 'photo'){
            $student = Student::with('announcement')->where('student_nisn', $request->student_nisn)->first();
            if ($student->announcement->announcement_finance == 1){
                return response()->download(storage_path('/app/public/sites/graduate/images/student/' . $request->student_nisn . '.JPG'));
            }
            else {
                return view('graduate.finance');
            }
        }
    }
}
