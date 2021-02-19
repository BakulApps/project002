<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Portal\Setting;
use App\Models\Portal\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['setting'] = new Setting();
    }

    public function all(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all') {
                $no = 1;
                foreach (User::with('role')->orderBy('user_fullname')->get() as $user) {
                    $data[] = [
                        $no++,
                        $user->user_fullname,
                        $user->user_name,
                        '',
                        $user->user_email,
                        $user->role->role_name,
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'. $user->user_id .'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="' . $user->user_id . '"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'user'){
                $msg = User::find($request->user_id);
            }
            elseif ($request->_type == 'store'){
                $user = new User();
                $user->user_fullname = $request->user_fullname;
                $user->user_name = $request->user_name;
                $user->user_pass = Hash::make($request->user_pass);
                $user->user_email = $request->user_email;
                $user->user_role = $request->user_role;
                $user->user_facebook = $request->user_facebook;
                $user->user_instagram = $request->user_instagram;
                $user->user_twitter = $request->user_twitter;
                $user->user_desc = $request->user_desc;
                try {
                    if ($user->save()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Pengguna berhasil diperbarui.'];
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                $validator = Validator::make($request->all(), [
                    'user_image' => 'mimes:jpg,jpeg,png|max:512|nullable'
                ]);
                if ($validator->fails()) {
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => 'Berkas Harus Berekstensi jpg, jpeg, png dan Ukuran maksimal 512 Kb'];
                }
                try {
                    if ($request->hasFile('user_image')){
                        $file = $request->file('user_image')->store('public/user');
                    }
                    $user = User::find($request->user_id);
                    $user->user_image       = isset($file) ? asset('storage' . preg_replace("/public/", "", $file)) : null;
                    $user->user_fullname    = $request->user_fullname;
                    $user->user_name        = $request->user_name;
                    $user->user_email       = $request->user_email;
                    $user->user_role        = $request->user_role;
                    $user->user_facebook    = $request->user_facebook;
                    $user->user_instagram   = $request->user_instagram;
                    $user->user_twitter     = $request->user_twitter;
                    $user->user_desc        = $request->user_desc;
                    $request->user_pass == '' ? null : $user->user_pass = Hash::make($request->user_pass);
                    if ( $user->save()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Pengguna berhasil diperbarui.'];
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                $user = User::find($request->user_id);
                try {
                    if ($user->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Pengguna berhasil dihapus.'];
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('portal.backend.user', $this->data);
        }
    }
}
