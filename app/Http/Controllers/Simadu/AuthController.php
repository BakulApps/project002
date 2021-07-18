<?php

namespace App\Http\Controllers\Simadu;

use App\Http\Controllers\Controller;
use App\Models\Master\School;
use App\Models\Master\Student;
use App\Models\Student\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['school'] = School::first();
        $this->data['setting'] = new Setting();
    }
    public function login(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->submit == 'logged'){
                $student = Student::where('student_nisn', $request->student_nisn)->first();
                if ($student != null){
                    if ($student->birthday() == $request->student_birthday){
                        Session::put('simadu.auth', $student);
                        return response()->redirectTo(route('simadu.home'));
                    }
                    else {
                        return redirect()->back()->withInput()->with('msg', ['class' => 'danger', 'text' => 'NISN dan Tanggal Lahir tidak Tepat']);
                    }
                }
                else {
                    return redirect()->back()->withInput()->with('msg', ['class' => 'danger', 'text' => 'NISN tidak ditemukan']);
                }
            }
        }
        else{
            return view('simadu.login', $this->data);
        }
    }

    public function logout()
    {
        Session::forget('simadu.auth');
        return redirect(route('simadu.login'))->withInput()->with('msg', ['class' => 'success', 'text' => 'Anda behasil keluar.']);
    }
}
