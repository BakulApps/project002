<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Models\Exam\Schedule;
use App\Models\Exam\Setting;
use App\Models\Exam\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontedController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['setting'] = new Setting();
    }

    public function home()
    {
        if (Session::has('exam.auth')){
            return view('exam.fronted.home', $this->data);
        }
        else {
            return redirect()->route('exam.login');
        }
    }

    public function schedule(Request $request)
    {
        if (Session::has('exam.auth')){
            if ($request->isMethod('post')){
                if ($request->_type == 'data' && $request->_data == 'all'){
                    $student    = Student::find(Session::get('exam.auth'));
                    $schedules   = Schedule::where('schedule_level', $student->classes->class_level)->orderBy('schedule_start', 'ASC')->get();
                    $no         = 1;
                    foreach ($schedules as $schedule){
                        if (Carbon::now()->format('Y-m-d H:i:s') > $schedule->schedule_end){
                            $button = '<a class="btn btn-danger bt-sm" href="#">Selesai</a>';
                        }
                        elseif (Carbon::now()->format('Y-m-d H:i:s') < $schedule->schedule_start){
                            $button = '<a class="btn btn-success bt-sm" href="#">Belum Mulai</a>';
                        }
                        else {
                            $button = '<a class="btn btn-primary bt-sm" target="_blank" href="'.$schedule->schedule_link.'">Mulai Ujian</a>';
                        }
                        $data[] = [
                            $no++,
                            $schedule->subject->subject_name,
                            Carbon::parse($schedule->schedule_start)->format('d/m/Y'),
                            Carbon::parse($schedule->schedule_start)->format('H:m'),
                            Carbon::parse($schedule->schedule_end)->format('H:m'),
                            $schedule->schedule_token,
                            $button
                        ];
                    };
                    $msg = ['data' => empty($data) ? [] : $data];
                }
                return response()->json($msg);
            }
            else {
                return view('exam.fronted.schedule', $this->data);
            }
        }
        else {
            return redirect()->route('exam.login');
        }
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')){
            $student = Student::where('student_username', $request->student_username);
            if ($student->count() > 0){
                if ($student->value('student_password') == $request->student_password){
                    Session::put('exam.auth', $student->value('student_id'));
                    return redirect()->route('exam.home');
                }
                else {
                    return redirect()->back()->with('msg', ['class' => 'danger', 'text' => 'Kata Sandi tidak tepat, periksa kembali!']);
                }
            }
            else {
                return redirect()->back()->with('msg', ['class' => 'danger', 'text' => 'Nama Pengguna tidak ditemukan!']);
            }
        }
        else {
            return view('exam.fronted.login', $this->data);
        }
    }

    public function logout()
    {
        Session::forget('exam.auth');
        return redirect()->route('exam.login');
    }

    public function test()
    {
        $student    = Student::find(Session::get('exam.auth'));
        $schedules   = Schedule::where('schedule_level', $student->classes->class_level)->orderBy('schedule_start', 'ASC')->get();

        foreach ($schedules as $schedule){
            if (Carbon::now()->format('Y-m-d H:i:s') > $schedule->schedule_end){
                $button = 'Selesai';
            }
            elseif (Carbon::now()->format('Y-m-d H:i:s') < $schedule->schedule_start){
                $button = 'Belum Mulai';
            }
            else {
                $button = 'Mulai Ujian';
            }
            $data[] = [
                Carbon::parse($schedule->schedule_start)->format('d/m/Y'),
                Carbon::parse($schedule->schedule_start)->format('H:i'),
                Carbon::parse($schedule->schedule_end)->format('H:m'),
                $button
            ];
        };
        return response()->json($data);
    }
}
