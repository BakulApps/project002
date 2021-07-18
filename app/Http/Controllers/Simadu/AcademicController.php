<?php

namespace App\Http\Controllers\Simadu;

use App\Http\Controllers\Controller;
use App\Models\Master\School;
use App\Models\Student\Setting;
use Illuminate\Http\Request;

class AcademicController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['school'] = School::first();
        $this->data['setting'] = new Setting();
    }

    public function schedule(){
        return view('simadu.schedule', $this->data);
    }

    public function presence(Request $request){
        return view('simadu.presence', $this->data);
    }

    public function report(Request $request){
        return view('simadu.report', $this->data);
    }
}
