<?php

namespace App\Http\Controllers\Graduate;

use App\Http\Controllers\Controller;
use App\Models\Master\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public $data;

    public function __construct()
    {
        $this->data['school'] = new School();
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')){
            return $this->authentication($request);
        }
        else {
            return view('graduate.backend.login', $this->data);
        }
    }

    public function authentication(Request $request)
    {
        $credentials = ['user_name' => $request->user_name, 'password' => $request->user_pass];
        if (Auth::guard('graduate')->attempt($credentials, $request->remember)){
            return redirect()->route('graduate.admin.home');
        }
        else {
            return redirect()->back()->withInput()->with('msg', ['class' => 'danger', 'text' => 'Nama Pengguna dan Kata Sandi tidak tepat']);
        }
    }

    public function logout()
    {
        Auth::guard('graduate')->logout();
        return redirect()->route('graduate.admin.login')->with('msg', ['class' => 'success',  'text' => 'Anda berhasil keluar']);
    }
}
