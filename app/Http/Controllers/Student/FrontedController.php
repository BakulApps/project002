<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Finance\Item;
use App\Models\Finance\Payment;
use App\Models\Master\School;
use App\Models\Master\Student;
use App\Models\Master\Year;
use App\Models\Student\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
        if ($request->isMethod('post')){
            if ($request->_type == 'submit' && $request->_data == 'lack'){
                $student = Student::where('student_nisn', $request->student_nisn);
                try {
                    if ($student->count() == 1){
                        $student = Student::find($student->value('student_id'));
                        $class = $student->classes()->where('class_year', Year::active())->value('class_alias');
                        $lacks = $student->lack()->get();
                        $lack = 0;
                        foreach ($lacks as $item){
                            $lack = $lack + $item->lack_cost;
                        }
                        $lack = $lack == 0 ? "LUNAS" : "Rp. ". number_format($lack);
                        $msg = ['status' => 1, 'data' => ['student_name' => $student->student_name, 'student_class' => $class, 'student_lack' => $lack]];
                    }
                }catch (\Exception $e){
                    $msg = ['status' => 0, 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else{
            return view('student.fronted.home', $this->data);
        }
    }

    public function data(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $students = Student::with('classes')->whereHas('classes', function ($q){
                    $q->where('class_year', Year::active());
                })->get();
                $no = 1;
                foreach ($students as $student){
                    $data[] = [
                        $no++,
                        $student->student_name,
                        $student->student_nisn,
                        $student->student_nism,
                        $student->classes[0]->class_alias,
                        $student->student_gender == 1 ? 'Laki-laki' : 'Perempuan',
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            return response()->json($msg);
        }
        else {
            return view('student.fronted.data', $this->data);
        }
    }

    public function profile(Request $request)
    {
        if ($request->isMethod('post')){

        }
        else {
            $this->data['student'] = Student::find(Session::get('student.auth')->student_id);
            return view('student.fronted.profile', $this->data);
        }
    }

    public function schedule(Request $request){
        if ($request->isMethod('post')){

        }
        else {
            return view('student.fronted.academic_schedule', $this->data);
        }
    }

    public function presence(Request $request){
        if ($request->isMethod('post')){

        }
        else {
            return view('student.fronted.academic_presence', $this->data);
        }
    }

    public function report(Request $request){
        if ($request->isMethod('post')){

        }
        else {
            return view('student.fronted.academic_report', $this->data);
        }
    }

    public function invoice()
    {
        $this->data['lack'] = Student::find(Session::get('student.auth')->student_id)->lack()->get();
        return view('student.fronted.finance_invoice', $this->data);
    }

    public function payment(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                $payment_item = '';
                foreach (Payment::where('payment_student', Session::get('student.auth')
                    ->student_id)->OrderBy('payment_date', 'DESC')->get() as $payment){
                    $payment_items = json_decode($payment->payment_item, true);
                    for ($i=0;$i<count($payment_items);$i++){
                        $payment_item .= Item::where('item_id', $payment_items[$i])->value('item_code') .', ';
                    }
                    $payment_item = Str::substr($payment_item, 0, -2);
                    $data[] = [
                        $no++,
                        $payment->payment_number,
                        $payment_item,
                        $payment->created_at('d/m/Y H:i:s'),
                        $payment->payment_cost,
                        $payment->payment_status == 1 ? '<span class="badge badge-danger badge-pill">Menunggu Pembayaran</span>' : ($payment->payment_status == 2 ? '<span class="badge badge badge-pill">Menunggu Verifikasi</span>' : '<span class="badge badge-success badge-pill">Pembayaran Diterima</span>'),
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-info" data-num="'.$payment->payment_id.'"><i class="icon-info3"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$payment->payment_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'payment'){
                $payment = Payment::find($request->payment_id);
                $payment->created_at_convert = $payment->created_at('d M Y');
                $msg = $payment;
            }
            elseif ($request->_type == 'update' && $request->_data == 'payment'){
                try {
                    $payment = Payment::find($request->payment_id);
                    if ($request->hasFile('payment_file')) {
                        $file = $request->file('payment_file');
                        Storage::delete('/public/payment/images/transfer'. $payment->payment_file);
                        $file->store('public/payment/images/transfer');
                        $payment_file = $file->hashName();
                    }
                    else {
                        $payment_file = $payment->payment_file;
                    }
                    $payment->payment_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->payment_date)->format('Y-m-d H:i:s');
                    $payment->payment_file = $payment_file;
                    $payment->payment_status = 2;
                    if ($payment->save()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Pembayaran berhasil disimpan, silahkan silahkan menunggu verifikasi pembayaran.'];
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'store'){
                try {
                    if (Payment::create([
                        'payment_number' => Str::upper(Str::random(7)),
                        'payment_student' => Session::get('student.auth')->student_id,
                        'payment_item' => json_encode($request->payment_item),
                        'payment_cost' => $request->payment_cost,
                        'payment_type_account' => $request->payment_type_account,
                        'payment_number_account' => $request->payment_number_account,
                        'payment_name_account' => $request->payment_name_account,
                        'payment_status' => 1,
                    ])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Tagihan berhasil dibuat, silahkan melakukan pembayaran'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            $this->data['lack'] = Student::find(Session::get('student.auth')->student_id)->lack()->get();
            return view('student.fronted.finance_payment', $this->data);
        }
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->submit == 'logged'){
                $student = Student::where('student_nisn', $request->student_nisn)->first();
                if ($student != null){
                    if ($student->birthday() == $request->student_birthday){
                        Session::put('student.auth', $student);
                        return response()->redirectTo(route('student.home'));
                    }
                    else {
                        return redirect()->back()->withInput()->with('msg', ['class' => 'danger', 'text' => 'NISN dan Tanggal Lahir tidak Tepat']);
                    }
                }
                else {
                    return redirect()->back()->withInput()->with('msg', ['class' => 'danger', 'text' => 'NISN tidak ditemukan']);
                }
            }
        }
        else{
            return view('student.fronted.login', $this->data);
        }
    }

    public function logout()
    {
        Session::forget('student.auth');
        return redirect(route('student.login'))->withInput()->with('msg', ['class' => 'success', 'text' => 'Anda behasil keluar.']);
    }

    public function test()
    {
        $payment_item = Payment::find(2);

        return response()->json($payment_item->payment_number);

    }
}
