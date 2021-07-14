<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Imports\Finance\invoiceImport;
use App\Imports\Finance\LackImport;
use App\Models\Finance\Account;
use App\Models\Finance\Item;
use App\Models\Finance\Lack;
use App\Models\Finance\Payment;
use App\Models\Finance\Setting;
use App\Models\Master\School;
use App\Models\Master\Student;
use App\Models\Master\Year;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class BackendController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['school'] = School::first();
        $this->data['setting'] = new Setting();
    }

    public function home()
    {
        return view('finance.home', $this->data);
    }

    public function item(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Item::OrderBy('item_id')->get() as $item){
                    $data[] = [
                        $no++,
                        $item->item_code,
                        $item->item_name,
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'.$item->item_id.'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$item->item_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'item'){
                $msg = Item::where('item_id', $request->item_id)->first();
            }
            elseif ($request->_type == 'delete'){
                try {
                    $item = Item::find($request->item_id);
                    if ($item->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Item Pembayaran berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                try {
                    $validator = Validator::make($request->all(),[
                        'item_code' => 'required',
                        'item_name' => 'required',
                    ], [
                        'item_code.required' => 'Kolom Kode Item tidak boleh kosong.',
                        'item_name.required' => 'Kolom Nama Item tidak boleh kosong.',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else{
                        $item = Item::find($request->item_id);
                        $item->item_code = $request->item_code;
                        $item->item_name = $request->item_name;
                        if ($item->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Item Pembayaran berhasil di simpan.'];
                        }
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'store'){
                try {
                    $validator = Validator::make($request->all(),[
                        'item_code' => 'required',
                        'item_name' => 'required',
                    ], [
                        'item_code.required' => 'Kolom Kode Item tidak boleh kosong.',
                        'item_name.required' => 'Kolom Nama Item tidak boleh kosong.',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $item = new Item();
                        $item->item_code = $request->item_code;
                        $item->item_name = $request->item_name;
                        if ($item->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Item Pembayaran berhasil di simpan.'];
                        }
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('finance.master_item', $this->data);
        }
    }

    public function account(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Account::OrderBy('account_bank')->get() as $account){
                    $data[] = [
                        $no++,
                        $account->bank->bank_code,
                        $account->account_number,
                        $account->account_name,
                        $account->account_active == 1 ? '<span class="badge badge-success badge-pill">Aktif</span>' : '<span class="badge badge-danger badge-pill">Tidak Aktif</span>',
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'.$account->account_id.'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$account->account_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'item'){
                $msg = Account::where('account_id', $request->account_id)->first();
            }
            elseif ($request->_type == 'delete'){
                try {
                    $account = Account::find($request->account_id);
                    if ($account->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Akun Rekening berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                try {
                    $validator = Validator::make($request->all(),[
                        'account_bank' => 'required',
                        'account_number' => 'required',
                        'account_name' => 'required',
                        'account_active' => 'required',
                    ], [
                        'account_bank.required' => 'Silahkan pilih Bank terlebih dahulu.',
                        'account_number.required' => 'Kolom Nomor Rekening tidak boleh kosong.',
                        'account_name.required' => 'Kolom Nama Rekening tidak boleh kosong.',
                        'account_active.required' => 'Silahkan pilih status rekening.',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else{
                        $account = Account::find($request->account_id);
                        $account->account_bank = $request->account_bank;
                        $account->account_number = $request->account_number;
                        $account->account_name = $request->account_name;
                        $account->account_active = $request->account_active;
                        if ($account->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Akun Rekening berhasil di perbarui.'];
                        }
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'store'){
                try {
                    $validator = Validator::make($request->all(),[
                        'account_bank' => 'required',
                        'account_number' => 'required',
                        'account_name' => 'required',
                        'account_active' => 'required',
                    ], [
                        'account_bank.required' => 'Silahkan pilih Bank terlebih dahulu.',
                        'account_number.required' => 'Kolom Nomor Rekening tidak boleh kosong.',
                        'account_name.required' => 'Kolom Nama Rekening tidak boleh kosong.',
                        'account_active.required' => 'Silahkan pilih status rekening.',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $account = new Account();
                        $account->account_bank = $request->account_bank;
                        $account->account_number = $request->account_number;
                        $account->account_name = $request->account_name;
                        $account->account_active = $request->account_active;
                        if ($account->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Akun Rekening berhasil di simpan.'];
                        }
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('finance.master_account', $this->data);
        }
    }

    public function student(Request $request)
    {
        return view('finance.student_all', $this->data);
    }

    public function invoice(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Student::orderBy('student_name', 'ASC')->get() as $student){
                    $data[] = [
                        $no++,
                        $student->student_name,
                        $student->student_nisn,
                        $student->classes()->where('class_year', Year::active())->value('class_alias'),
                        'Rp. '. number_format(array_sum($student->lack()->pluck('lack_cost')->toArray())),
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'.$student->student_id.'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$student->student_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'class'){
                $msg = Classes::where('class_id', $request->class_id)->first();
            }
            elseif ($request->_type == 'delete'){
                try {
                    $class = Classes::find($request->class_id);
                    if ($class->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Kelas berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                try {
                    $validator = Validator::make($request->all(),[
                        'class_level' => 'required',
                        'class_major' => 'required',
                        'class_name' => 'required',
                        'class_alias' => 'required',
                    ], [
                        'class_level.required' => 'Kolom Tingkat Tidak boleh kosong, silahkah pilih Tingkat',
                        'class_major.required' => 'Kolom Jurusan Tidak boleh kosong, silahkah pilih Jurusan',
                        'class_name.required' => 'Kolom Rombel Tidak boleh kosong',
                        'class_alias.required' => 'Kolom Nama Kelas Tidak boleh kosong',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else{
                        $class = Classes::find($request->class_id);
                        $class->class_year = Year::active();
                        $class->class_level = $request->class_level;
                        $class->class_major = $request->class_major;
                        $class->class_name = $request->class_name;
                        $class->class_alias = $request->class_alias;
                        if ($class->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Kelas berhasil diperbarui.'];
                        }
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'data' && $request->_data == 'upload'){
                try {
                    $validator = Validator::make($request->all(), [
                        'data_invoice' => 'required|mimes:xls,xlsx'
                    ], [
                        'data_invoice.required' => 'Silahkan pilih berkas terlebih dahulu.',
                        'data_invoice.mimes' => 'Berkas harus berformat xls/xlsx'
                    ]);
                    if ($validator->fails()) {
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $file = $request->file('data_invoice');
                        $file->store('public/payment/file');
                        $path = storage_path('app') .'/public/payment/file/'. $file->hashName();
                        Lack::truncate();
                        if (Excel::import(new LackImport(), $path)) {
                            $msg = ['title' => 'Berhasil !', 'class' => 'success', 'text' => 'Data tagihan Berhasil ditambahkan'];
                        }
                    }

                }
                catch (\Exception $e) {
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('finance.invoice', $this->data);
        }
    }

    public function payment(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                $payment_item = '';
                foreach (Payment::orderBy('created_at', 'DESC')->get() as $payment){
                    $payment_items = json_decode($payment->payment_item, true);
                    for ($i=0;$i<count($payment_items);$i++){
                        $payment_item .= Item::where('item_id', $payment_items[$i])->value('item_code') .', ';
                    }
                    $payment_item = Str::substr($payment_item, 0, -2);
                    $data[] = [
                        $no++,
                        $payment->student->student_name,
                        $payment->student->classes()->where('class_year', Year::active())->value('class_alias'),
                        $payment_item,
                        number_format(str_replace(',', '', $payment->payment_cost)),
                        Carbon::parse($payment->payment_date)->formatLocalized('d/m/Y H:i:s'),
                        $payment->payment_status == 1 ? '<span class="badge badge-pill badge-danger">Menunggu Pembayaran</span>' : ($payment->payment_status == 2 ? '<span class="badge badge-pill badge-warning">Menunggu Verifikasi</span>' : '<span class="badge badge-pill badge-success">Pembayaran Diterima</span>'),
                        '<div class="btn-group">
                            <a href="'.route('finance.payment.verify', $payment->payment_id).'" class="btn btn-outline-primary bt-sm"><i class="icon-info3"></i></a>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$payment->payment_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'class'){
                $msg = Classes::where('class_id', $request->class_id)->first();
            }
            elseif ($request->_type == 'delete'){
                try {
                    $class = Classes::find($request->class_id);
                    if ($class->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Kelas berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                try {
                    $validator = Validator::make($request->all(),[
                        'class_level' => 'required',
                        'class_major' => 'required',
                        'class_name' => 'required',
                        'class_alias' => 'required',
                    ], [
                        'class_level.required' => 'Kolom Tingkat Tidak boleh kosong, silahkah pilih Tingkat',
                        'class_major.required' => 'Kolom Jurusan Tidak boleh kosong, silahkah pilih Jurusan',
                        'class_name.required' => 'Kolom Rombel Tidak boleh kosong',
                        'class_alias.required' => 'Kolom Nama Kelas Tidak boleh kosong',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else{
                        $class = Classes::find($request->class_id);
                        $class->class_year = Year::active();
                        $class->class_level = $request->class_level;
                        $class->class_major = $request->class_major;
                        $class->class_name = $request->class_name;
                        $class->class_alias = $request->class_alias;
                        if ($class->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Kelas berhasil diperbarui.'];
                        }
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'data' && $request->_data == 'upload'){
                try {
                    $validator = Validator::make($request->all(), [
                        'class_id' => 'required',
                        'data_student' => 'required|mimes:xls,xlsx'
                    ], [
                        'class_id.required' => 'Silahkan pilih kelas/Rombel terlebih dahulu.',
                        'data_student.required' => 'Silahkan pilih berkas terlebih dahulu.',
                        'data_student.mimes' => 'Berkas harus berformat xls/xlsx'
                    ]);
                    if ($validator->fails()) {
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $file = $request->file('data_student')->store('temp');
                        $path = storage_path('app') .'/'. $file;
                        if (Excel::import(new StudentImport(), $path)) {
                            $msg = ['title' => 'Berhasil !', 'class' => 'success', 'text' => 'Data Siswa Berhasil ditambahkan'];
                        }
                    }

                }
                catch (\Exception $e) {
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('finance.payment', $this->data);
        }
    }

    public function verify($id, Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'update'){
                $payment = Payment::find($request->payment_id);
                $payment->payment_status = 3;
                $payment->payment_view = 1;
                if ($payment->save()){
                    $msg = ['status' => 'success', 'title' => 'Sukses !', 'class' => 'success', 'text' => 'Pembayaran berhasil di Verifikasi, anda akan dialikah dalam 2 detik.'];
                }
            }
            return response()->json($msg);
        }
        else {
            $this->data['payment'] = Payment::find($id);
            return view('finance.payment_verify', $this->data);
        }
    }

    public function test()
    {
        $array = [1, 2, 3, 4, 5];
        array_push($array, 7);
        return response()->json($array);
    }
}
