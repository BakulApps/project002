<?php

namespace App\Http\Controllers\Graduate;

use App\Http\Controllers\Controller;
use App\Models\Graduate\Setting;
use App\Models\Graduate\Student;
use App\Models\Master\School;
use App\Models\Master\Subject;
use App\Models\Master\Year;
use Carbon\Carbon;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Http\Request;

class FrontedController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['school'] = School::first();
        $this->data['setting'] = new Setting();
    }
    public function home(Request $request)
    {
        if (Carbon::createFromFormat('d/m/Y H:i', $this->data['setting']->value('announcement_date'))->toDateTimeString() <= Carbon::now()->toDateTimeString()){
            if ($request->submit == 'search'){
                $student = Student::with('announcement')->where('student_nisn', $request->student_nisn)->first();
                if ($student != null){
                    if ($student->announcement->announcement_finance == 2){
                        return redirect()->back()->with('msg', ['title' => 'Kesalahan!', 'class' => 'danger', 'text' => 'Anda belum menyelesaikan administrasi, silahkan menghubungi bendahara madrasah']);
                    }
                    else {
                        $student->announcement->announcement_view = $student->announcement->announcement_view + 1;
                        $student->announcement->save();
                        $this->data['student'] = $student;
                        $this->data['announcement'] = $student->announcement;
                        return view('graduate.fronted.result', $this->data);
                    }
                }
                else {

                    return redirect()->back()->with('msg', ['title' => 'Kesalahan!', 'class' => 'danger', 'text' => 'NISN tidak ditemukan, silahkan periksa kembali']);
                }
            }
            elseif ($request->submit == 'print'){
                return $this->print($request);
            }
            return view('graduate.fronted.home', $this->data);
        }
        else {
            $this->data['noticeDate'] = Carbon::createFromFormat('d/m/Y H:i', $this->data['setting']->value('announcement_date'))->format('m/d/Y H:i:s');
            return view('graduate.fronted.countdown', $this->data);
        }
    }

    public function print(Request $request)
    {
        if ($request->submit == 'skl'){
            $student = Student::with('announcement')->where('student_nisn', $request->student_nisn)->first();
            $school = $this->data['school'];
            $this->data['year'] = $year = Year::active('year_name');
            $this->data['subjects'] = Subject::OrderBy('subject_number', 'ASC')->get();
            $this->data['student'] = $student;
            $this->data['announcement'] = $student->announcement;
            $this->data['value'] = $student->value;
            $student->announcement->update([
                'announcement_print' => $student->announcement->announcement_print + 1
            ]);
            $student->announcement->save();

            $cert = 'file://'. realpath(storage_path('app/cert/selfcert.pem'));
            $key = 'file://'. realpath(storage_path('app/cert/enc_key.pem'));
            $info = array(
                'Name' => 'Kepala ' . $school->name(),
                'Reason' => 'Surat Keterangan Lulus TP. '. $year,
                'Location' => $school->name(),
                'ContactInfo' => $school->school_email,
            );

            $view = view('graduate.fronted.skl_template', $this->data)->render();
            TCPDF::setSignature($cert, $key, 'myu2nnmd', '', 2, $info);
            TCPDF::SetFont('times', '', 12);
            TCPDF::SetMargins(1, 1, 1);
            TCPDF::SetAutoPageBreak(true, 0);
            TCPDF::AddPage();
            TCPDF::writeHTML($view, true, 0, true, 0, '');
            TCPDF::setSignatureAppearance(1, 8.3, 5.1, 4.1);
            TCPDF::Output('skl-'. $student->student_nisn .'.pdf', 'D');
            TCPDF::reset();
        }
        elseif ($request->submit == 'photo'){
            return response()->download(storage_path('/app/public/sites/graduate/images/student/' . $request->student_nisn . '.JPG'));
        }
    }
}
