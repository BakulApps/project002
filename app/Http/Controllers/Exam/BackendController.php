<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Models\Exam\Level;
use App\Models\Exam\Setting;
use App\Models\Exam\Subject;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['setting'] = new Setting();
    }

    public function home()
    {
        return view('exam.backend.home', $this->data);
    }

    public function subject(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Subject::OrderBy('subject_name')->get() as $subject){
                    $data[] = [
                        $no++,
                        $subject->subject_code,
                        $subject->subject_name,
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
                $msg = Subject::where('subject_id', $request->subject_id)->first();
            }
            elseif ($request->_type == 'store'){
                try {
                    if (Subject::create([
                        'subject_code' => $request->subject_code,
                        'subject_name' => $request->subject_name,

                    ])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Mata Pelajaran berhasil di simpan.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                try {
                    if (Subject::where('subject_id', $request->subject_id)->update([
                        'subject_code' => $request->subject_code,
                        'subject_name' => $request->subject_name,
                    ])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Mata Pelajaran berhasil diperbarui.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
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
            return response()->json($msg);
        }
        else {
            return view('exam.backend.subject', $this->data);
        }
    }

    public function level(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Level::OrderBy('level_name')->get() as $level){
                    $data[] = [
                        $no++,
                        $level->level_name,
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'.$level->level_id.'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$level->level_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'level'){
                $msg = Level::where('level_id', $request->level_id)->first();
            }
            elseif ($request->_type == 'store'){
                try {
                    if (Level::create([
                        'level_code' => $request->level_code,
                        'level_name' => $request->level_name,

                    ])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Tingkat berhasil di simpan.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                try {
                    if (Level::where('level_id', $request->level_id)->update([
                        'level_name' => $request->level_name,
                    ])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Tingkat berhasil diperbarui.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $level = Level::find($request->level_id);
                    if ($level->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Mata Pelajaran berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('exam.backend.level', $this->data);
        }
    }

    public function major()
    {

    }

    public function classes()
    {

    }

    public function student()
    {

    }

    public function schedule()
    {

    }

    public function user()
    {

    }

    public function setting()
    {

    }


}
