<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Portal\Category;
use App\Models\Portal\Post;
use App\Models\Portal\Setting;
use App\Models\Portal\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['setting'] = new Setting();
    }
    public function create(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'store'){
                try {
                    $validator = Validator::make($request->all(), [
                        'post_title' => 'required',
                        'post_category' => 'required',
                        'post_tag' => 'required',
                        'post_image' => 'mimes:jpg,jpeg,png|max:512'
                    ], [
                        'post_title.required' => 'Kolom Judul tidak boleh kosong.',
                        'post_category.required' => 'Kolom Kategori tidak boleh kosong.',
                        'post_tag.required' => 'Kolom Tagar tidak boleh kosong.',
                        'post_image.mimes' => 'Gambar harus berformat jpg/jpeg/png',
                        'post_image' => 'Ukuran maksimal gambar 512Kb',
                    ]);
                    if ($validator->fails()) {
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $post = new Post();
                        if ($request->hasFile('post_image')){
                            $file = $request->file('post_image');
                            $file->store('public/portal/images/post/');
                            $post->post_image       = $file->hashName();
                        }
                        $post->post_author      = auth('portal')->user()->user_id;
                        $post->post_category    = $request->post_category;
                        $post->post_title       = $request->post_title;
                        $post->post_content     = $request->post_content;
                        $post->post_comment     = $request->post_comment;
                        $post->post_status      = $request->post_status;
                        if ($post->save()){
                            $tags = explode(',', $request->post_tag);
                            $post->tag()->attach($tags);
                            $msg = ['status' => 'success', 'title' => 'Berhasil !', 'class' => 'success', 'text' => 'Postingan Berhasil ditambahkan, anda akan dialihkan kehalaman Postingan'];
                        }
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('portal.backend.post_create', $this->data);
        }
    }

    public function edit(Request $request, $id){
        if ($request->isMethod('post')){
            if ($request->_type == 'update'){
                try {
                    $validator = Validator::make($request->all(), [
                        'post_title' => 'required',
                        'post_category' => 'required',
                        'post_tag' => 'required',
                        'post_image' => 'mimes:jpg,jpeg,png|max:512'
                    ], [
                        'post_title.required' => 'Kolom Judul tidak boleh kosong.',
                        'post_category.required' => 'Kolom Kategori tidak boleh kosong.',
                        'post_tag.required' => 'Kolom Tagar tidak boleh kosong.',
                        'post_image.mimes' => 'Gambar harus berformat jpg/jpeg/png',
                        'post_image' => 'Ukuran maksimal gambar 512Kb',
                    ]);
                    if ($validator->fails()) {
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $post = Post::find($id);
                        $post->tag()->detach();
                        if ($request->hasFile('post_image')){
                            $file = $request->file('post_image');
                            $file->store('public/portal/images/post/');
                            $post->post_image       = $file->hashName();
                        }
                        $post->post_author      = auth('portal')->user()->user_id;
                        $post->post_category    = $request->post_category;
                        $post->post_title       = $request->post_title;
                        $post->post_content     = $request->post_content;
                        $post->post_comment     = $request->post_comment;
                        $post->post_status      = $request->post_status;
                        if ($post->save()){
                            $tags = explode(',', $request->post_tag);
                            $post->tag()->attach($tags);
                            $msg = ['status' => 'success', 'title' => 'Berhasil !', 'class' => 'success', 'text' => 'Postingan Berhasil diperbarui, anda akan dialihkan kehalaman Postingan'];
                        }
                    }
                }
                catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            $this->data['post'] = $post = Post::with('tag')
                ->with('user')
                ->find($id);
            $this->data['tags'] = $post->tag->pluck('tag_id');
            return view('portal.backend.post_edit', $this->data);
        }
    }

    public function all(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Post::with('user')->OrderBy('created_at', 'DESC')->get() as $post){
                    $data[] = [
                        $no++,
                        $post->post_title,
                        $post->user->user_name,
                        Carbon::parse($post->created_at)->format('d/m/Y'),
                        $post->post_status == 1 ? '<span class="badge badge-success">Terbit</span>' : '<span class="badge badge-danger">Arsip</span>',
                        '<div class="btn-group">
                            <a class="btn btn-outline-primary bt-sm btn-show" target="_blank" href="'.route('potral.article.read', $post->post_id).'"><i class="icon-eye"></i></a>
                            <a class="btn btn-outline-primary bt-sm btn-edit" href="'.route('portal.admin.post.edit', $post->post_id).'"><i class="icon-pencil"></i></a>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$post->post_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'delete'){
                try {
                    $post = Post::find($request->post_id);
                    $post->tag()->detach();
                    if ($post->delete()){
                        Storage::delete('public/portal/fronted/images/event/'. $post->post_id);
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Postingan berhasil dihapus.'];
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'route' && $request->_data == 'create'){
                $msg = ['route' => route('portal.admin.post.create')];
            }
            return response()->json($msg);
        }
        else {
            return view('portal.backend.post_all', $this->data);
        }
    }

    public function category(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Category::OrderBy('category_name')->get() as $category){
                    $data[] = [
                        $no++,
                        $category->category_name,
                        $category->category_desc,
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'.$category->category_id.'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$category->category_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'category'){
                $msg = Category::where('category_id', $request->category_id)->first();
            }
            elseif ($request->_type == 'store'){
                try {
                    if (Category::create([
                        'category_name' => $request->category_name,
                        'category_desc' => $request->category_desc,

                    ])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Kategori berhasil di simpan.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                try {
                    if (Category::where('category_id', $request->category_id)->update([
                        'category_name' => $request->category_name,
                        'category_desc' => $request->category_desc,
                    ])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Kategori berhasil diperbarui.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $category = Category::find($request->category_id);
                    if ($category->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Kategori berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type = 'data' && $request->_data == 'json'){
                foreach (Category::OrderBy('category_name')->get() as $category){
                    $data[] = [
                        'id' => $category->category_id,
                        'text' => $category->category_name,
                    ];
                };
                $msg = empty($data) ? [] : $data;
            }
            return response()->json($msg);
        }
        else {
            return view('portal.backend.post_category', $this->data);
        }
    }

    public function tag(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Tag::OrderBy('tag_name')->get() as $tag){
                    $data[] = [
                        $no++,
                        $tag->tag_name,
                        $tag->tag_desc,
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'.$tag->tag_id.'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$tag->tag_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'tag'){
                $msg = Tag::where('tag_id', $request->tag_id)->first();
            }
            elseif ($request->_type == 'store'){
                try {
                    if (Tag::create([
                        'tag_name' => $request->tag_name,
                        'tag_desc' => $request->tag_desc,

                    ])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Taggar berhasil di simpan.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update'){
                try {
                    if (Tag::where('tag_id', $request->tag_id)->update([
                        'tag_name' => $request->tag_name,
                        'tag_desc' => $request->tag_desc,
                    ])){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Taggar berhasil diperbarui.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $tag = Tag::find($request->tag_id);
                    if ($tag->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Taggar berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type = 'data' && $request->_data == 'json'){
                foreach (Tag::OrderBy('tag_name')->get() as $tag){
                    $data[] = [
                        'id' => $tag->tag_id,
                        'text' => $tag->tag_name,
                    ];
                };
                $msg = empty($data) ? [] : $data;
            }
            return response()->json($msg);
        }
        else {
            return view('portal.backend.post_tags', $this->data);
        }
    }
}
