<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Portal\Event;
use App\Models\Portal\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['setting'] = new Setting();
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'create'){
                try {
                    $validator = Validator::make($request->all(), [
                        'event_title' => 'required',
                        'event_content' => 'required',
                        'event_date_start' => 'required',
                        'event_date_end' => 'required',
                        'event_place' => 'required',
                        'event_image' => 'required|mimes:jpg,jpeg,png|max:512'
                    ],  [
                        'event_title.required' => 'Kolom Judul Acara/KegiatanTidak boleh kosong.',
                        'event_content.required' => 'Kolom Konten Acara/KegiatanTidak boleh kosong.',
                        'event_date_start.required' => 'Kolom Tanggal Mulai Acara/KegiatanTidak boleh kosong.',
                        'event_date_end.required' => 'Kolom Tanggal Selesai Acara/KegiatanTidak boleh kosong.',
                        'event_place.required' => 'Kolom Tempat Acara/KegiatanTidak boleh kosong.',
                        'event_image.required' => 'Kolom gambar tidak boleh kosong.',
                        'event_image.mimes' => 'Gambar harus berformat jpg/jpeg/png',
                        'event_image.max' => 'Ukuran maksimal gambar 512Kb.'
                    ]);
                    if ($validator->fails()) {
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $event = new Event();
                        if ($request->hasFile('event_image')){
                            $file = $request->file('event_image');
                            $file->store('public/portal/images/event');
                        }
                        $event->event_image       = $file->hashName();
                        $event->event_title       = $request->event_title;
                        $event->event_content     = $request->event_content;
                        $event->event_date_start     = Carbon::createFromFormat('d/m/Y', $request->event_date_start)->format('Y-m-d');
                        $event->event_date_end      = Carbon::createFromFormat('d/m/Y', $request->event_date_end)->format('Y-m-d');
                        $event->event_place      = $request->event_place;
                        if ($event->save()){
                            $msg = ['status' => 'success', 'title' => 'Berhasil !', 'class' => 'success', 'text' => 'Acara/Kegiatan Berhasil ditambahkan, anda akan dialihkan kehalaman Acara/Kegiatan'];
                        }
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('portal.backend.event_create', $this->data);
        }
    }

    public function edit($id, Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'update'){
                $validator = Validator::make($request->all(), [
                    'event_image' => 'mimes:jpg,jpeg,png|max:512|nullable'
                ]);
                if ($validator->fails()) {
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => 'Berkas Harus Berekstensi jpg, jpeg, png dan Ukuran maksimal 512 Kb'];
                }
                else {
                    try {
                        $event = Event::find($id);
                        if ($request->hasFile('event_image')){
                            $file = $request->file('event_image');
                            Storage::delete('public/portal/fronted/images/event/'. $event->event_image);
                            $file->store('public/portal/fronted/images/event');
                        }
                        $event->event_image       = isset($file) ? $file->hashName() : null;
                        $event->event_title       = $request->event_title;
                        $event->event_content     = $request->event_content;
                        $event->event_date_start     = Carbon::createFromFormat('d/m/Y', $request->event_date_start)->format('Y-m-d');
                        $event->event_date_end      = Carbon::createFromFormat('d/m/Y', $request->event_date_end)->format('Y-m-d');
                        $event->event_place      = $request->event_place;
                        if ($event->save()){
                            $msg = ['title' => 'Berhasil !', 'class' => 'success', 'text' => 'Postingan Berhasil diperbarui, anda akan dialihkan kehalaman Postingan'];
                        }
                    }
                    catch (\Exception $e){
                        $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                    }
                }
            }
            return response()->json($msg);
        }
        else {
            $this->data['event'] = $event = Event::find($id);
            $this->data['page'] = "Ubah Acara/Kegiatan";
            return view('portal.backend.event_edit', $this->data);
        }
    }

    public function all(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Event::OrderBy('event_date_start', 'DESC')->get() as $event){
                    $data[] = [
                        $no++,
                        $event->event_title,
                        $event->date_start(),
                        $event->date_end(),
                        '<div class="btn-group">
                            <a class="btn btn-outline-primary bt-sm btn-show" target="_blank" href="'.route('portal.event.read', $event->event_id).'"><i class="icon-eye"></i></a>
                            <a class="btn btn-outline-primary bt-sm btn-edit" href="'.route('portal.admin.event.edit', $event->event_id).'"><i class="icon-pencil"></i></a>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$event->event_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'delete'){
                try {
                    $event = Event::find($request->event_id);
                    if ($event->delete()){
                        Storage::delete('public/portal/fronted/images/event/'. $event->event_image);
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Acara/Kegiatan berhasil dihapus.'];
                    }
                }catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'route' && $request->_data == 'create'){
                $msg = ['route' => route('portal.admin.event.create')];
            }
            return response()->json($msg);
        }
        else {
            return view('portal.backend.event_all', $this->data);
        }
    }
}
