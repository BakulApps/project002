<?php

namespace App\Http\Controllers\Graduate;

use App\Exports\Master\SubjectExport;
use App\Http\Controllers\Controller;
use App\Imports\Master\SubjectImport;
use App\Models\Graduate\Setting;
use App\Models\Master\School;
use App\Models\Master\Subject;
use App\Models\Master\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class MasterController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['school'] = new School();
        $this->data['setting'] = new Setting();
    }

    public function year(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                foreach (Year::OrderBy('year_number')->get() as $year){
                    $data[] = [
                        $year->year_number,
                        $year->year_name,
                        $year->year_desc,
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'.$year->year_id.'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$year->year_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'year'){
                $year = Year::where('year_id', $request->year_id)->first();
                $msg = $year;
            }
            elseif ($request->_type == 'delete'){
                try {
                    $year = Year::find($request->year_id);
                    if ($year->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Tahun Pelajaran berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                try {
                    $year = Year::find($request->year_id);
                    if ($year->update([
                        'year_number' => $request->year_number,
                        'year_name' => $request->year_name,
                        'year_desc' => $request->year_desc])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Tahun Pelajaran berhasil diperbarui.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'store'){
                try {
                    if (Year::create([
                        'year_number' => $request->year_number,
                        'year_name' => $request->year_name,
                        'year_desc' => $request->year_desc,

                    ])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Tahun Pelajaran berhasil di simpan.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('graduate.backend.master_year', $this->data);
        }
    }

    public function subject(Request $request)
    {
        if ($request->isMethod('post')) {
            if ($request->_type == 'data' && $request->_data == 'all'){
                foreach (Subject::OrderBy('subject_number')->get() as $subject){
                    $data[] = [
                        $subject->subject_number,
                        $subject->subject_code,
                        $subject->subject_name,
                        $subject->subject_desc,
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'.$subject->subject_id.'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$subject->subject_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'subject'){
                $subject = Subject::where('subject_id', $request->subject_id)->get();
                $msg = $subject[0];
            }
            elseif ($request->_type == 'data' && $request->_data == 'upload'){
                $validator = Validator::make($request->all(), [
                    'data_subject' => 'mimes:xls,xlsx'
                ]);
                if ($validator->fails()) {
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => 'Berkas Harus Berekstensi xls/xlsx'];
                }
                else {
                    try {
                        if ($request->hasFile('data_subject')) {
                            $file = $request->file('data_subject')->store('temp');
                            $path = storage_path('app') .'/'. $file;
                            Subject::query()->truncate();
                            if (Excel::import(new SubjectImport(), $path)) {
                                $msg = ['class' => 'success', 'text' => 'Data pelajaran berhasil ditambahkan.'];
                            }
                        }
                    } catch (\Exception $e){
                        $msg = ['class' => 'danger', 'text' => $e->getMessage()];
                    }
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $subject = Subject::find($request->subject_id);
                    if ($subject->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Mata Pelajaran berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                try {
                    $subject = Subject::find($request->subject_id);
                    if ($subject->update([
                        'subject_number' => $request->subject_number,
                        'subject_code' => $request->subject_code,
                        'subject_name' => $request->subject_name,
                        'subject_desc' => $request->subject_desc,
                        'subject_exam' => $request->subject_exam])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Mata Pelajaran berhasil diperbarui.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'store'){
                try {
                    if (Subject::create([
                        'subject_number' => $request->subject_number,
                        'subject_code' => $request->subject_code,
                        'subject_name' => $request->subject_name,
                        'subject_desc' => $request->subject_desc,
                        'subject_exam' => $request->subject_exam,
                    ])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Mata Pelajaran berhasil di simpan.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        elseif ($request->_type == 'download' && $request->_data == 'subject'){
            return Excel::download(new SubjectExport(), 'data_pelajaran.xlsx');
        }
        else {
            return view('graduate.backend.master_subject', $this->data);
        }
    }
}
