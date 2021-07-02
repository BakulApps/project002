<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Master\School;
use App\Models\Student\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MasterController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['school'] = School::first();
        $this->data['setting'] = new Setting();
    }

    public function school(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'update' && $request->_data == 'logo'){
                try {
                    $validator = Validator::make($request->all(), [
                        'school_logo' => 'mimes:jpg,jpeg,png|max:512'
                    ], [
                        'school_logo.required' => 'Gambar logo harus berekstensi jpg/jpeg/png',
                        'school_logo.max' => 'Ukuran gambar maksimal 512Kb',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $school = School::first();
                        $request->hasFile('school_logo');
                        $file = $request->file('school_logo');
                        Storage::delete('/public/master/images/'. $school->school_logo);
                        $file->store('public/master/images');
                        $school->schooL_logo = $file->hashName();
                        if ($school->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Logo Madrasah berhasil disimpan.'];
                        }
                    }
                }
                catch (\Exception $e){
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update' && $request->_data == 'school'){
                try {
                    $validator = Validator::make($request->all(), [
                        'school_npsn' => 'required',
                        'school_nsm' => 'required',
                        'school_name' => 'required',
                        'school_nickname' => 'required',
                        'school_ladder' => 'required',
                        'school_npwp' => 'required',
                        'school_phone' => 'required',
                        'school_website' => 'required',
                        'school_email' => 'required',
                        'school_since_year' => 'required',
                        'school_since_deed' => 'required',
                        'school_lisence_number' => 'required',
                        'school_lisence_date' => 'required',
                        'school_kemenkumham_number' => 'required',
                        'school_kemenkumham_date' => 'required',
                        'school_organizer' => 'required',
                        'school_fundation' => 'required',
                    ], [
                        'school_npsn.required' => 'Kolom NPSN tidak boleh kosong.',
                        'school_nsm.required' => 'Kolom NSM tidak boleh kosong.',
                        'school_name.required' => 'Kolom Nama Madrasah tidak boleh kosong.',
                        'school_nickname.required' => 'Kolom Nama Singkatan Madrasah tidak boleh kosong.',
                        'school_ladder.required' => 'Kolom Jenjang Madrasah tidak boleh kosong, silahkan memilih salah satu.',
                        'school_npwp.required' => 'Kolom NPWP Madrasah tidak boleh kosong.',
                        'school_phone.required' => 'Kolom Nomor Telepon Madrasah tidak boleh kosong.',
                        'school_website.required' => 'Kolom Website Madrasah tidak boleh kosong.',
                        'school_email.required' => 'Kolom Email Madrasah tidak boleh kosong.',
                        'school_since_year.required' => 'Kolom Tahun Berdiri Madrasah tidak boleh kosong.',
                        'school_since_deed.required' => 'Kolom Akta Pendirian Madrasah tidak boleh kosong.',
                        'school_lisence_number.required' => 'Kolom SK Operasional Madrasah tidak boleh kosong.',
                        'school_lisence_date.required' => 'Kolom Tanggal SK Operasional Madrasah tidak boleh kosong.',
                        'school_kemenkumham_number.required' => 'Kolom SK Kemenkumham Madrasah tidak boleh kosong.',
                        'school_kemenkumham_date.required' => 'Kolom Tanggal SK Kemenkumham Madrasah tidak boleh kosong.',
                        'school_organizer.required' => 'Kolom Penyelenggara Madrasah tidak boleh kosong,  silahkan memilih salah satu.',
                        'school_fundation.required' => 'Kolom Nama Penyelenggara Madrasah tidak boleh kosong.',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $school = School::first();
                        $school->school_npsn = $request->school_npsn;
                        $school->school_nsm = $request->school_nsm;
                        $school->school_name = $request->school_name;
                        $school->school_nickname = $request->school_nickname;
                        $school->school_ladder = $request->school_ladder;
                        $school->school_npwp = $request->school_npwp;
                        $school->school_phone = $request->school_phone;
                        $school->school_website = $request->school_website;
                        $school->school_email = $request->school_email;
                        $school->school_since_year = $request->school_since_year;
                        $school->school_since_deed = $request->school_since_deed;
                        $school->school_lisence_number = $request->school_lisence_number;
                        $school->school_lisence_date = Carbon::createFromFormat('d/m/Y', $request->school_lisence_date)->format('Y-m-d');
                        $school->school_kemenkumham_number = $request->school_kemenkumham_number;
                        $school->school_kemenkumham_date = Carbon::createFromFormat('d/m/Y', $request->school_kemenkumham_date)->format('Y-m-d');
                        $school->school_organizer = $request->school_organizer;
                        $school->school_fundation = $request->school_fundation;
                        if ($school->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Madrasah berhasil disimpan.'];
                        }
                    }
                }
                catch (\Exception $e){
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update' && $request->_data == 'address'){
                try {
                    $validator = Validator::make($request->all(), [
                        'school_address' => 'required',
                        'school_province' => 'required',
                        'school_distric' => 'required',
                        'school_subdistric' => 'required',
                        'school_village' => 'required',
                        'school_postal' => 'required'
                    ], [
                        'school_address.required' => 'Kolom alamat madrasah tidak boleh kosong.',
                        'school_province.required' => 'Silahkan pilih Provinsi terlebih dahulu.',
                        'school_distric.required' => 'Silahkan pilih Kabupaten terlebih dahulu.',
                        'school_subdistric.required' => 'Silahkan pilih Kecamatan terlebih dahulu.',
                        'school_village.required' => 'Silahkan pilih Desa/Kelurahan terlebih dahulu.',
                        'school_postal.required' => 'Kolom Kodepos madrasah tidak boleh kosong.'
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else{
                        $school = School::first();
                        $school->school_address = $request->school_address;
                        $school->school_province = $request->school_province;
                        $school->school_distric = $request->school_distric;
                        $school->school_subdistric = $request->school_subdistric;
                        $school->school_village = $request->school_village;
                        $school->school_postal = $request->school_postal;
                        if ($school->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Alamat Madrasah berhasil disimpan.'];
                        }
                    }
                }
                catch (\Exception $e){
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }

            return response()->json($msg);
        }
        else {
            $this->data['school']->school_lisence_date = Carbon::parse($this->data['school']->school_lisence_date)->format('d/m/Y');
            $this->data['school']->school_kemenkumham_date = Carbon::parse($this->data['school']->school_kemenkumham_date)->format('d/m/Y');
            return view('student.backend.master_school', $this->data);
        }
    }

    public function test()
    {
        $school = School::first();

        $school->school_logo = 'testing.jpg';
        $school->save();

        return $school;
    }
}
