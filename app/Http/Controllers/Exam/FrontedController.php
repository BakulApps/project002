<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Models\Exam\Schedule;
use App\Models\Exam\Setting;
use App\Models\Exam\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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
                $student    = Student::find(Session::get('exam.auth'));
                if ($request->_type == 'data' && $request->_data == 'all'){
                    $schedules   = Schedule::where('schedule_level', $student->classes->class_level)
                        ->where('schedule_major', $student->classes->class_major)
                        ->orWhere('schedule_major', 1)
                        ->orderBy('schedule_start', 'ASC')->get();
                    $no         = 1;
                    foreach ($schedules as $schedule){
                        if (Carbon::now()->format('Y-m-d H:i:s') > $schedule->schedule_end){
                            $button = '<a class="btn btn-danger bt-sm" href="#">Selesai</a>';
                        }
                        elseif (Carbon::now()->format('Y-m-d H:i:s') < $schedule->schedule_start){
                            $button = '<a class="btn btn-success bt-sm" href="#">Belum Mulai</a>';
                        }
                        else {
                            $button = '<button class="btn btn-primary bt-sm btn-submit" data-num="'.$schedule->schedule_id.'">Mulai Tes</i></button>';
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
                elseif ($request->_type == 'update'){
                    if (is_array($student->student_schedule)){
                        $student_schedule = Arr::add(json_decode($student->student_schedule, true), $request->schedule_id, [$request->schedule_id, Carbon::now()->format('d/m/Y H:i:s')]);
                    }
                    else{
                        $student_schedule = [$request->schedule_id => [$request->schedule_id, Carbon::now()->format('d/m/Y H:i:s')]];
                    }
                    $student->update(['student_schedule' => $student_schedule]);
                    $schedule = Schedule::find($request->schedule_id);
                    $msg = $schedule->schedule_link;
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
