<?php

namespace App\Http\Controllers\Admission;

use App\Http\Controllers\Controller;
use App\Models\Admission\Bank;
use App\Models\Admission\Cost;
use App\Models\Admission\Register;
use App\Models\Admission\Setting;
use App\Models\Master\Religion;
use App\Models\Master\School;
use App\Models\Student\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class MasterController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['school'] = School::first();
        $this->data['setting'] = new Setting();
    }

    public function program(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Program::get() as $program){
                    $data[] = [
                        $no++,
                        $program->program_id,
                        $program->program_name,
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'.$program->program_id.'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$program->program_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'store'){
                try {
                    $validator = Validator::make($request->all(),[
                        'program_name' => 'required',
                    ], [
                        'program_name.required' => 'Kolom nama program tidak boleh kosong',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $program = new Program();
                        $program->program_name = $request->program_name;
                        if ($program->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data program berhasil di simpan.'];
                        }
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'data' && $request->_data == 'program'){
                $msg = Program::where('program_id', $request->program_id)->first();
            }
            elseif ($request->_type == 'update'){
                try {
                    $validator = Validator::make($request->all(),[
                        'program_name' => 'required',
                    ], [
                        'program_name.required' => 'Kolom nama program tidak boleh kosong',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else{
                        $program = Program::find($request->program_id);
                        $program->program_name = $request->program_name;
                        if ($program->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Program berhasil diperbarui.'];
                        }
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $program = Program::find($request->program_id);
                    if ($program->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Program berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('admission.backend.master_program', $this->data);
        }
    }

    public function cost(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Cost::get() as $cost){
                    $data[] = [
                        $no++,
                        $cost->program->program_name,
                        $cost->cost_boarding == 1 ? "Ya" : "Tidak",
                        $cost->gender->gender_name,
                        number_format($cost->cost_amount),
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'.$cost->cost_id.'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$cost->cost_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'store'){
                try {
                    $validator = Validator::make($request->all(),[
                        'cost_program' => 'required',
                        'cost_boarding' => 'required',
                        'cost_gender' => 'required',
                        'cost_amount' => 'required',
                    ], [
                        'cost_program.required' => 'Kolom nama program tidak boleh kosong, silahkan pilih.',
                        'cost_boarding.required' => 'Kolom Boarding tidak boleh kosong, silahkan pilih.',
                        'cost_gender.required' => 'Kolom jenis kelamin tidak boleh kosong, silahkan pilih.',
                        'cost_amount.required' => 'Kolom Biaya pendaftaran tidak boleh kosong.',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $cost = new Cost();
                        $cost->cost_program = $request->cost_program;
                        $cost->cost_boarding = $request->cost_boarding;
                        $cost->cost_gender = $request->cost_gender;
                        $cost->cost_amount = $request->cost_amount;
                        if ($cost->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data biaya pendaftaran berhasil di simpan.'];
                        }
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'data' && $request->_data == 'cost'){
                $msg = Cost::with('program')->with('gender')->where('cost_id', $request->cost_id)->first();
            }
            elseif ($request->_type == 'update'){
                try {
                    $validator = Validator::make($request->all(),[
                        'cost_program' => 'required',
                        'cost_boarding' => 'required',
                        'cost_gender' => 'required',
                        'cost_amount' => 'required',
                    ], [
                        'cost_program.required' => 'Kolom nama program tidak boleh kosong, silahkan pilih.',
                        'cost_boarding.required' => 'Kolom boarding tidak boleh kosong, silahkan pilih.',
                        'cost_gender.required' => 'Kolom jenis kelamin tidak boleh kosong, silahkan pilih.',
                        'cost_amount.required' => 'Kolom biaya pendaftaran tidak boleh kosong',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else{
                        $cost = Cost::find($request->cost_id);
                        $cost->cost_program = $request->cost_program;
                        $cost->cost_boarding = $request->cost_boarding;
                        $cost->cost_gender = $request->cost_gender;
                        $cost->cost_amount = $request->cost_amount;
                        if ($cost->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data biaya pendaftaran berhasil diperbarui.'];
                        }
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $cost = Cost::find($request->cost_id);
                    if ($cost->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data biaya pendaftaran berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('admission.backend.master_cost', $this->data);
        }
    }

    public function register(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Register::get() as $register){
                    $data[] = [
                        $no++,
                        $register->register_id,
                        $register->register_name,
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'.$register->register_id.'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$register->register_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'store'){
                try {
                    $validator = Validator::make($request->all(),[
                        'register_name' => 'required',
                    ], [
                        'register_name.required' => 'Kolom nama komponen tidak boleh kosong',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $register = new Register();
                        $register->register_name = $request->register_name;
                        if ($register->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data komponen berhasil di simpan.'];
                        }
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'data' && $request->_data == 'register'){
                $msg = Register::where('register_id', $request->register_id)->first();
            }
            elseif ($request->_type == 'update'){
                try {
                    $validator = Validator::make($request->all(),[
                        'register_name' => 'required',
                    ], [
                        'register_name.required' => 'Kolom nama komponen tidak boleh kosong',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else{
                        $register = Register::find($request->register_id);
                        $register->register_name = $request->register_name;
                        if ($register->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data komponen berhasil diperbarui.'];
                        }
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $register = Register::find($request->register_id);
                    if ($register->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data komponen berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('admission.backend.master_register', $this->data);
        }
    }

    public function bank(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Bank::get() as $bank){
                    $data[] = [
                        $no++,
                        $bank->bank_type,
                        $bank->bank_number,
                        $bank->bank_name,
                        $bank->status(),
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'.$bank->bank_id.'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$bank->bank_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'store'){
                try {
                    $validator = Validator::make($request->all(),[
                        'bank_type' => 'required',
                        'bank_number' => 'required',
                        'bank_name' => 'required',
                        'bank_status' => 'required',
                    ], [
                        'bank_type.required' => 'Kolom Tipe Bank tidak boleh kosong.',
                        'bank_number.required' => 'Kolom Nomor Rekening tidak boleh kosong.',
                        'bank_name.required' => 'Kolom Nama Rekening tidak boleh kosong.',
                        'bank_status.required' => 'Status Rekening tidak boleh kosong, silahkan memilih.',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $bank = new Bank();
                        $bank->bank_type = $request->bank_type;
                        $bank->bank_number = $request->bank_number;
                        $bank->bank_name = $request->bank_name;
                        $bank->bank_status = $request->bank_status;
                        if ($bank->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Rekening Bank berhasil di simpan.'];
                        }
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'data' && $request->_data == 'program'){
                $msg = Program::where('program_id', $request->program_id)->first();
            }
            elseif ($request->_type == 'update'){
                try {
                    $validator = Validator::make($request->all(),[
                        'program_name' => 'required',
                    ], [
                        'program_name.required' => 'Kolom nama program tidak boleh kosong',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else{
                        $program = Program::find($request->program_id);
                        $program->program_name = $request->program_name;
                        if ($program->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Program berhasil diperbarui.'];
                        }
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $program = Program::find($request->program_id);
                    if ($program->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Program berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('admission.backend.master_bank', $this->data);
        }
    }
}
