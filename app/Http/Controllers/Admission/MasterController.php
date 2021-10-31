<?php

namespace App\Http\Controllers\Admission;

use App\Http\Controllers\Controller;
use App\Models\Admission\Setting;
use App\Models\Master\Religion;
use App\Models\Master\School;
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

    public function religion(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Religion::get() as $religion){
                    $data[] = [
                        $no++,
                        $religion->religion_id,
                        $religion->religion_name,
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'.$religion->religion_id.'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$religion->religion_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'store'){
                try {
                    $validator = Validator::make($request->all(),[
                        'religion_name' => 'required',
                    ], [
                        'religion_name.required' => 'Kolom nama agama tidak boleh kosong',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $religion = new Religion();
                        $religion->religion_name = $request->religion_name;
                        if ($religion->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Agama berhasil di simpan.'];
                        }
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'data' && $request->_data == 'religion'){
                $msg = Religion::where('religion_id', $request->religion_id)->first();
            }
            elseif ($request->_type == 'update'){
                try {
                    $validator = Validator::make($request->all(),[
                        'religion_name' => 'required',
                    ], [
                        'religion_name.required' => 'Kolom nama agama tidak boleh kosong',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else{
                        $religion = Religion::find($request->religion_id);
                        $religion->religion_name = $request->religion_name;
                        if ($religion->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Agama berhasil diperbarui.'];
                        }
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $religion = Religion::find($request->religion_id);
                    if ($religion->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Agama berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('admission.backend.master_religion', $this->data);
        }
    }
}
