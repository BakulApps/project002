<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Models\Exam\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public $data;

    public function __construct()
    {
        $this->data['setting'] = new Setting();
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')){
            return $this->authentication($request);
        }
        else {
            return view('exam.fronted.login', $this->data);
        }
    }

    public function authentication(Request $request)
    {
        $credentials = ['user_name' => $request->user_name, 'password' => $request->user_pass];
        if (Auth::guard('portal')->attempt($credentials, $request->remember)){
            return redirect()->route('portal.admin.home');
        }
        else {
            return redirect()->back()->withInput()->with('msg', ['class' => 'danger', 'text' => 'Nama Pengguna dan Kata Sandi tidak tepat']);
        }
    }

    public function logout()
    {
        Auth::guard('portal')->logout();
        return redirect()->route('portal.admin.login')->with('msg', ['class' => 'success',  'text' => 'Anda berhasil keluar']);
    }
}
