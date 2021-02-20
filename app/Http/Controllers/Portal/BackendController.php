<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Portal\Comment;
use App\Models\Portal\Event;
use App\Models\Portal\Post;
use App\Models\Portal\Setting;
use Illuminate\Http\Request;

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
        if ($request->isMethod('put')){
            if ($request->set_name == 'app'){
                $setting = Setting::where('setting_name', 'app_name');
                try {
                    if ($setting->update(['setting_value' => $request->app_name])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Pengaturan berhasil diperbarui.'];
                    }
                }
                catch (\Exception $e){
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        return view('portal.backend.setting', $this->data);
    }
}
