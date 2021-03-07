<?php

namespace App\Http\Controllers\Admission;

use App\Http\Controllers\Controller;
use App\Models\Admission\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    public function home()
    {
        return view('admission.backend.home');
    }

    public function student(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all') {
                $no = 1;
                foreach (Student::orderBy('student_name')->get() as $student) {
                    $data[] = [
                        $no++,
                        $student->student_name,
                        $student->student_nisn,
                        $student->student_birthplace .", ". Carbon::parse($student->student_birthday)->translatedFormat('d F Y'),
                        $student->student_father_name,
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'. $student->student_id .'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="' . $student->student_id . '"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            return response()->json($msg);
        }
        else {
            return view('admission.backend.student');
        }
    }

    public function studentadd(Request $request)
    {
        return view('admission.backend.studentadd');
    }

    public function setting(Request $request)
    {
        return view('admission.backend.setting');
    }
}
