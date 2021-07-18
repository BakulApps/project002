<?php

namespace App\Http\Controllers\Simadu;

use App\Http\Controllers\Controller;
use App\Models\Finance\Item;
use App\Models\Finance\Payment;
use App\Models\Master\School;
use App\Models\Master\Student;
use App\Models\Student\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FinanceController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['school'] = School::first();
        $this->data['setting'] = new Setting();
    }

    public function invoice()
    {
        $this->data['lack'] = Student::find(Session::get('simadu.auth')->student_id)->lack()->get();
        return view('simadu.finance_invoice', $this->data);
    }

    public function payment(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                $payment_item = '';
                foreach (Payment::where('payment_student', Session::get('simadu.auth')
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
                        number_format(str_replace(',', '', $payment->payment_cost)),
                        $payment->payment_status == 1 ? '<span class="badge badge-danger badge-pill">Menunggu Pembayaran</span>' : ($payment->payment_status == 2 ? '<span class="badge badge-warning badge-pill">Menunggu Verifikasi</span>' : '<span class="badge badge-success badge-pill">Pembayaran Diterima</span>'),
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
            elseif ($request->_type == 'delete'){
                try {
                    $payment = Payment::find($request->payment_id);
                    if ($payment->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Pembayaran berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update' && $request->_data == 'payment'){
                try {
                    $payment = Payment::find($request->payment_id);
                    if ($request->hasFile('payment_file')) {
                        $file = $request->file('payment_file');
                        Storage::delete('/public/finance/images/transfer'. $payment->payment_file);
                        $file->store('public/finance/images/transfer');
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
                        'payment_student' => Session::get('simadu.auth')->student_id,
                        'payment_item' => json_encode($request->payment_item),
                        'payment_cost' => Str::of($request->payment_cost)->replace('.', ''),
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
            $this->data['lack'] = Student::find(Session::get('simadu.auth')->student_id)->lack()->get();
            return view('simadu.finance_payment', $this->data);
        }
    }
}
