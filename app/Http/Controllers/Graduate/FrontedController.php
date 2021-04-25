<?php

namespace App\Http\Controllers\Graduate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontedController extends Controller
{
    public function home(Request $request)
    {
        if (Setting::value('setting_announcement_date') <= Carbon::now()){
            if ($request->submit == 'search'){
                $student = Student::with('announcement')->where('student_nisn', $request->student_nisn)->first();
                if ($student != null){
                    $student->announcement->announcement_see = $student->announcement->announcement_see + 1;
                    $student->announcement->save();
                    $msg = ['student' => $student, 'announcement' => $student->announcement];
                    return view('graduate.result', $msg);
                }
                else {

                    return redirect()->back()->with('msg', ['title' => 'Kesalahan!', 'class' => 'danger', 'text' => 'NISN tidak ditemukan, silahkan periksa kembali']);
                }
            }
            elseif ($request->submit == 'print'){
                return $this->print($request);
            }
            return view('graduate.home');
        }
        else {
            $data = ['noticeDate' => Carbon::parse(Setting::value('setting_announcement_date'))->format('Y-m-d H:i:s')];
            return view('graduate.coutdown', $data);
        }
    }
}
