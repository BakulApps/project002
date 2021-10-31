<?php

namespace App\Http\Controllers\Admission;

use App\Http\Controllers\Controller;
use App\Models\Admission\Setting;
use App\Models\Master\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->data['school'] = School::first();
        $this->data['setting'] = new Setting();
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')){
            return $this->authentication($request);
        }
        else {
            return view('admission.backend.login', $this->data);
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
