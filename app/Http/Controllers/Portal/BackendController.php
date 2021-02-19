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

    public function setting()
    {
        return view('portal.backend.setting', $this->data);
    }
}
