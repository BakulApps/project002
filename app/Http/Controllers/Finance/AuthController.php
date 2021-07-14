<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\Finance\Setting;
use App\Models\Master\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->data['school'] = School::first();
        $this->data['setting'] = new Setting();
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            return $this->authentication($request);
        } else {
            return view('finance.login', $this->data);
        }
    }

    public function authentication(Request $request)
    {
        $credentials = ['user_name' => $request->user_name, 'password' => $request->user_pass];
        if (Auth::guard('finance')->attempt($credentials, $request->remember)) {
            return redirect()->route('finance.home');
        } else {
            return redirect()->back()->withInput()->with('msg', ['class' => 'danger', 'text' => 'Nama Pengguna dan Kata Sandi tidak tepat']);
        }
    }

    public function logout()
    {
        Auth::guard('finance')->logout();
        return redirect()->route('finance.login')->with('msg', ['class' => 'success', 'text' => 'Anda berhasil keluar']);
    }
}
