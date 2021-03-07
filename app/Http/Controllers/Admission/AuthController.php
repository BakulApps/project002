<?php

namespace App\Http\Controllers\Admission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')){
            return $this->authentication($request);
        }
        else {
            return view('admission.backend.login');
        }
    }

    public function authentication(Request $request)
    {
        $credentials = ['user_name' => $request->user_name, 'password' => $request->user_pass];
        if (Auth::guard('admission')->attempt($credentials, $request->remember)){
            return redirect()->route('admission.admin.home');
        }
        else {
            return redirect()->back()->withInput()->with('msg', ['class' => 'danger', 'text' => 'Nama Pengguna dan Kata Sandi tidak tepat']);
        }
    }

    public function logout()
    {
        Auth::guard('admission')->logout();
        return redirect()->route('admission.login')->with('msg', ['class' => 'success',  'text' => 'Anda berhasil keluar']);
    }
}
