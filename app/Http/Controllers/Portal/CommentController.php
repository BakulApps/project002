<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Portal\Comment;
use App\Models\Portal\Setting;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['setting'] = new Setting();
    }

    public function all(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Comment::with('post')
                             ->where('comment_parent', null)->OrderBy('created_at', 'DESC')->get() as $comment){
                    $data[] = [
                        $no++,
                        $comment->comment_read == 1 ? $comment->post[0]->post_title .' <span class="badge badge-danger badge-pill">unread</span>' : $comment->post[0]->post_title,
                        $comment->comment_name,
                        $comment->comment_email,
                        '<div class="btn-group">
                            <a class="btn btn-outline-primary bt-sm btn-view" href="'.route('portal.admin.comment.detail', $comment->comment_id).'"><i class="icon-eye"></i></a>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$comment->comment_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'delete'){
                try {
                    $comment = Comment::find($request->comment_id);
                    $parent = Comment::parent($request->comment_id);
                    $comment->post()->detach();
                    if ($comment->delete() && $parent->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Pesan berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('portal.backend.comment_all', $this->data);
        }
    }

    public function detail(Request $request, $id)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'store'){
                $comment = new Comment();
                $comment->comment_parent    = $request->comment_parent;
                $comment->comment_name      = $request->comment_name;
                $comment->comment_email     = '-';
                $comment->comment_content   = $request->comment_content;
                $comment->comment_read      = 0;
                try {
                    if ($comment->save()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Komentar berhasil disimpan.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            if ($request->_type == 'update'){
                $comment = Comment::find($request->comment_id);
                $comment->comment_parent    = $request->comment_parent;
                $comment->comment_name      = $request->comment_name;
                $comment->comment_email     = '-';
                $comment->comment_content   = $request->comment_content;
                $comment->comment_read      = 0;
                try {
                    if ($comment->save()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Komentar berhasil diperbarui.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'edit'){
                $msg = Comment::find($request->comment_id);
            }
            elseif ($request->_type == 'delete'){
                $comment = Comment::find($request->comment_id);
                try {
                    if ($comment->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Komentar berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            Comment::find($id)->update(['comment_read' => 0]);
            $comment = Comment::with('post')
                ->where('comment_id', $id)
                ->where('comment_parent', null)->get();
            $this->data['comment'] = $comment[0];
            $this->data['parent'] = Comment::parent($id)->count() < 1 ? null : Comment::parent($id)->get();
            return view('portal.backend.comment_detail', $this->data);
        }
    }
}
