<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee\Setting;
use App\Models\Master\School;
use Illuminate\Http\Request;

class MainController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['school'] = School::first();
        $this->data['setting'] = new Setting();
    }

    public function home()
    {
        return view('employee.home', $this->data);
    }

    public function present()
    {
        return view('employee.present', $this->data);
    }
}
