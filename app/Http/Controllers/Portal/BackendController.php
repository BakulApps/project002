<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Portal\Comment;
use App\Models\Portal\Event;
use App\Models\Portal\Post;
use App\Models\Portal\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Exception;

class BackendController extends Controller
{
    public $data;

    public function __construct()
    {
        $this->data['setting'] = new Setting();
    }

    public function home()
    {
        $this->data['posts'] = Post::all();
        $this->data['events'] = Event::all();
        $this->data['comments'] = Comment::all();
        return view('portal.backend.home', $this->data);
    }

    public function setting(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'app' && $request->_data == 'setting'){
                $validator = Validator::make($request->all(), [
                    'app_logo' => 'mimes:jpg,jpeg,png|max:512|nullable',
                    'app_name' => 'required',
                    'app_desc' => 'required'
                ]);
                if ($validator->fails()) {

                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $validator->errors()->first()];
                }
                else {
                    try {
                        $setting = $this->data['setting'];
                        if ($request->hasFile('app_logo')){
                            $file = $request->file('app_logo');
                            Storage::delete('/public/portal/images/'. $setting->value('app_logo'));
                            $file->store('public/portal/images');
                            $app_logo = $file->hashName();
                        }
                        else {
                            $app_logo = $setting->value('school_logo');
                        }
                        $setting->where('setting_name', 'app_name')->update(['setting_value' => $request->app_name]);
                        $setting->where('setting_name', 'app_logo')->update(['setting_value' => $app_logo]);
                        $setting->where('setting_name', 'app_desc')->update(['setting_value' => $request->app_desc]);
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Pengaturan berhasil disimpan.'];
                    }catch (\Exception $e){
                        $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                    }
                }
            }
            return response()->json($msg);
        }
        return view('portal.backend.setting', $this->data);
    }
}
