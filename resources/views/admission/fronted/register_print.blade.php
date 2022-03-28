<!DOCTYPE html>
<html lang="id">
    <body>
        <table style="width: 100%;">
            <tr>
                <td style="width: 15%; vertical-align: top">
                    <img src="{{public_path('storage/master/images/'.$school->school_logo)}}" style="width: 90px; display: block">
                </td>
                <td style="width: 85%; vertical-align: top; text-align: center">
                    <span style="font-size: 16px; font-weight: bold; line-height: 0">
                        PENERIMAAN PESERTA DIDIK BARU (PPDB)
                    </span><br>
                    <span style="font-size: 18px; font-weight: bold; line-height: 0">{{strtoupper($school->name(false))}}</span><br>
                    <span style="font-size: 18px; font-weight: bold; line-height: 0">TAHUN PELAJARAN {{$setting->value('app_year')}}</span><br>
                    <span style="font-size: 9px; font-style: italic; line-height: 1;">
                        Sekretariat: {{$school->school_address}}, Kedung, Jepara; Kodepos : 59463<br>
                        Telp : {{$school->school_phone}}; Website : {{$school->school_website}}; Email : {{$school->school_email}}
                    </span>
                </td>
            </tr>
        </table>
        <div style="border-top: 2px solid black;"></div>
        <span style="text-align: center;">
            <span style="font-weight: bold">FORMULIR PENDAFTARAN</span><br>
            <span>NOMOR : {{$form->form_letter}}</span><br>
        </span><br>
        <span style="margin-bottom: 5px; font-weight: bold; text-align: left">A. INFORMASI PRIBADI SISWA</span><br>
        <table style="font-size: 12px; width: 100%">
                <tr>
                    <td style="width:20%">Nama Lengkap</td>
                    <td colspan="3">: {{$student->student_name}}</td>
                </tr>
                <tr>
                    <td>NISN</td>
                    <td style="width: 35%">: {{$student->student_nisn}}</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>: {{$student->student_nik}}</td>
                </tr>
                <tr>
                    <td>Tempat Lahir</td>
                    <td>: {{$student->student_birthplace}}</td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>: {{$student->birthday('d F Y')}}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin </td>
                    <td>: {{\App\Models\Master\Gender::name($student->student_gender)}}</td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>: {{\App\Models\Master\Religion::name($student->student_religion)}}</td>
                </tr>
                <tr>
                    <td>Anak Ke</td>
                    <td>: {{$student->student_siblingplace}}</td>
                    <td>Jumlah Saudara</td>
                    <td>: {{$student->student_sibling}}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>: {{$student->student_email}}</td>
                    <td>Nomor HP</td>
                    <td>: {{$student->student_phone}}</td>
                </tr>
                <tr>
                    <td>Kewarganegaraan </td>
                    <td>: {{\App\Models\Master\Civic::name($student->student_civic)}}</td>
                </tr>
                <tr>
                    <td>Hobi</td>
                    <td>: {{\App\Models\Student\Hobby::name($student->student_hobby)}}</td>
                </tr>
                <tr>
                    <td>Cita-cita</td>
                    <td>: {{\App\Models\Student\Purpose::name($student->student_purpose)}}</td>
                </tr>
                <tr>
                    <td>Imunisasi</td>
                    <td colspan="3">:
                        {{$student->student_im_hepatitis == 1 ? 'Hepatitis |' : null}}
                        {{$student->student_im_polio == 1 ? ' Polio |' : null}}
                        {{$student->student_im_bcg == 1 ? ' BCG |' : null}}
                        {{$student->student_im_campak == 1 ? ' Campak |' : null}}
                        {{$student->student_im_dpt == 1 ? ' DPT |' : null}}
                        {{$student->student_im_covid == 1 ? ' Covid-19' : null}}
                    </td>
                </tr>
            </table><br><br>
        <span style="margin-bottom: 5px; font-weight: bold; text-align: left">B. INFORMASI TEMPAT TINGGAL</span><br>
        <table style="font-size: 12px; width: 100%;">
            <tr style="vertical-align: top">
                <td style="width: 23%">Jenis Tempat Tinggal</td>
                <td style="width: 2%;">:</td>
                <td colspan="4">{{\App\Models\Student\Residence::name($student->student_residence)}}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td colspan="4">{{$student->student_address}}</td>
            </tr>
            <tr style="vertical-align: top">
                <td style="width: 23%">Propinsi</td>
                <td style="width: 2%">:</td>
                <td style="width: 28%">{{\App\Models\Master\Territory::province($student->student_province)}}</td>
                <td style="width: 22%;">Kabupaten/Kota</td>
                <td style="width: 2%;">:</td>
                <td style="width: 23%;">{{\App\Models\Master\Territory::distric($student->student_distric)}}</td>
            </tr>
            <tr style="vertical-align: top">
                <td>Kecamantan</td>
                <td>:</td>
                <td>{{\App\Models\Master\Territory::subdistric($student->student_subdistric)}}</td>
                <td>Keluranan/Desa</td>
                <td>:</td>
                <td>{{\App\Models\Master\Territory::village($student->student_subdistric, $student->student_village)}}</td>
            </tr>
            <tr>
                <td>Kodepos</td>
                <td>:</td>
                <td>{{$student->student_postal}}</td>
                <td>Jarak Tempat Tinggal</td>
                <td>:</td>
                <td>{{\App\Models\Master\Distance::name($student->student_distance)}}</td>
            </tr>
            <tr>
                <td>Transportasi</td>
                <td>:</td>
                <td>{{\App\Models\Master\Transport::name($student->student_transport)}}</td>
                <td>Waktu Tempuh</td>
                <td>:</td>
                <td>{{\App\Models\Master\Travel::name($student->student_travel)}}</td>
            </tr>
        </table><br><br>
        <span style="margin-bottom: 5px; font-weight: bold; text-align: left">C. INFORMASI PROGRAM PILIHAN</span><br>
        <table style="font-size: 12px; width: 100%;">
            <tr>
                <td>Program Pilihan</td>
                <td style="width: 40%">: {{\App\Models\Student\Program::name($student->student_program)}}</td>
                <td>Boarding</td>
                <td>: {{$student->student_boarding == 1 ? "Ya" : "Tidak"}}</td>
            </tr>
        </table><br><br>
        <span style="margin-bottom: 5px; font-weight: bold; text-align: left">D. INFORMASI ORANGTUA</span><br>
        <table style="font-size: 12px; width: 100%;">
            <tr style="vertical-align: top">
                <td style="width: 23%">Nomor Kartu Keluarga</td>
                <td style="width: 2%;">:</td>
                <td style="width: 25%">{{$student->student_no_kk}}</td>
                <td style="width: 23%;">Nama Kepala Keluarga</td>
                <td style="width: 2%">:</td>
                <td style="width: 25%;">{{$student->student_head_family}}</td>
            </tr>
            <tr style="vertical-align: top">
                <td>Nama Ayah</td>
                <td>:</td>
                <td>{{$student->student_father_name}}</td>
                <td>Nama Ibu</td>
                <td>:</td>
                <td>{{$student->student_mother_name}}</td>
            </tr>
            <tr style="vertical-align: top">
                <td>Tanggal Lahir Ayah</td>
                <td>:</td>
                <td>{{$student->fatherbirthday('d F Y')}}</td>
                <td>Tanggal Lahir Ibu</td>
                <td>:</td>
                <td>{{$student->motherbirthday('d F Y')}}</td>
            </tr>
            <tr style="vertical-align: top">
                <td>Status Ayah</td>
                <td>:</td>
                <td>{{\App\Models\Student\ParentStatus::name($student->student_father_status)}}</td>
                <td>Status Ibu</td>
                <td>:</td>
                <td>{{\App\Models\Student\ParentStatus::name($student->student_mother_status)}}</td>
            </tr>
            <tr style="vertical-align: top">
                <td>NIK Ayah</td>
                <td>:</td>
                <td>{{$student->student_father_nik}}</td>
                <td>NIK Ibu</td>
                <td>:</td>
                <td>{{$student->student_mother_nik}}</td>
            </tr>
            <tr style="vertical-align: top">
                <td>Pendidikan Ayah</td>
                <td>:</td>
                <td>{{\App\Models\Master\Study::name($student->student_father_study)}}</td>
                <td>Pendidikan Ibu</td>
                <td>:</td>
                <td>{{\App\Models\Master\Study::name($student->student_mother_study)}}</td>
            </tr>
            <tr style="vertical-align: top">
                <td>Pekerjaan Ayah</td>
                <td>:</td>
                <td>{{\App\Models\Master\Job::name($student->student_father_job)}}</td>
                <td>Pekerjaan Ibu</td>
                <td>:</td>
                <td>{{\App\Models\Master\Job::name($student->student_mother_job)}}</td>
            </tr>
            <tr style="vertical-align: top">
                <td>Penghasilan Ayah</td>
                <td>:</td>
                <td>{{\App\Models\Master\Earning::name($student->student_father_earning)}}</td>
                <td>Penghasilan Ibu</td>
                <td>:</td>
                <td>{{\App\Models\Master\Earning::name($student->student_mother_earning)}}</td>
            </tr>
            <tr style="vertical-align: top">
                <td>Nomor HP Ayah</td>
                <td>:</td>
                <td>{{$student->student_father_phone}}</td>
                <td>Nomor HP Ibu</td>
                <td>:</td>
                <td>{{$student->student_mother_phone}}</td>
            </tr>
        </table><br><br>
        <span style="margin-bottom: 5px; font-weight: bold; text-align: left">E. INFORMASI TEMPAT TINGGAL ORANGTUA</span><br>
        <table style="font-size: 12px; width: 100%;">
            <tr>
                <td style="width: 20%">Status Kepemilikan</td>
                <td style="width: 2%">:</td>
                <td colspan="4">{{\App\Models\Master\Home::name($student->student_home_owner)}}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td colspan="4">{{$student->student_home_address}}</td>
            </tr>
            <tr style="vertical-align: top">
                <td style="width: 20%;">Propinsi</td>
                <td style="width: 2%;">:</td>
                <td style="width: 30%">{{\App\Models\Master\Territory::province($student->student_home_province)}}</td>
                <td style="width: 18%;">Kabupaten/Kota</td>
                <td style="width: 2%">:</td>
                <td style="width: 28%;">{{\App\Models\Master\Territory::distric($student->student_home_distric)}}</td>
            </tr>
            <tr style="vertical-align: top">
                <td>Kecamantan</td>
                <td>:</td>
                <td>{{\App\Models\Master\Territory::subdistric($student->student_home_subdistric)}}</td>
                <td>Keluranan/Desa</td>
                <td>:</td>
                <td>{{\App\Models\Master\Territory::village($student->student_home_subdistric, $student->student_home_village)}}</td>
            </tr>
            <tr>
                <td>Kodepos</td>
                <td>:</td>
                <td colspan="4">{{$student->student_home_postal}}</td>
            </tr>
        </table>
        <br pagebreak="true"/>
        <span style="margin-bottom: 5px; margin-top: 50px; font-weight: bold; text-align: left">F. INFORMASI BANTUAN</span><br>
        <table style="font-size: 12px; width: 100%;">
            <tr>
                <td style="width: 15%">Nomor KIP</td>
                <td style="width: 2%">:</td>
                <td>{{$student->student_kip_no == null ? "Tidak Punya" : $student->student_kip_no}}</td>
                <td style="width: 15%">Nomor PKH</td>
                <td style="width: 2%">:</td>
                <td>{{$student->student_pkh_no == null ? "Tidak Punya" : $student->student_pkh_no}}</td>
                <td style="width: 15%">Nomor KKS</td>
                <td style="width: 2%">:</td>
                <td>{{$student->student_kks_no == null ? "Tidak Punya" : $student->student_kks_no}}</td>
            </tr>
            <tr>
                <td>Berkas KIP</td>
                <td>:</td>
                <td>{{$student->student_kip_file == 1 ? 'Sudah' : 'Belum'}}</td>
                <td>Berkas PKH</td>
                <td>:</td>
                <td>{{$student->student_pkh_file == 1 ? 'Sudah' : 'Belum'}}</td>
                <td>Berkas KKS</td>
                <td>:</td>
                <td>{{$student->student_kkks_file == 1 ? 'Sudah' : 'Belum'}}</td>
            </tr>
        </table><br><br>
        <span style="margin-bottom: 5px; font-weight: bold; text-align: left">G. INFORMASI SEKOLAH ASAL</span><br>
        <table style="font-size: 12px; width: 100%;">
            <tr>
                <td style="width: 22%">Jenis Sekolah Asal</td>
                <td style="width: 2%">:</td>
                <td style="width: 76%;" colspan="3">{{\App\Models\Student\SchoolFrom::name($student->student_school_from)}}</td>
            </tr>
            <tr>
                <td style="width: 22%">Nama Sekolah Asal</td>
                <td style="width: 2%">:</td>
                <td style="width: 34%">{{$student->student_school_name}}</td>
                <td style="width: 20%">NPSN Sekolah Asal</td>
                <td style="width: 2%">:</td>
                <td style="width: 20%">{{$student->student_school_npsn}}</td>
            </tr>
            <tr>
                <td style="width: 22%;">Alamat Sekolah Asal</td>
                <td style="width: 2%">:</td>
                <td style="width: 76%" colspan="3">{{$student->student_school_address}}</td>
            </tr>
        </table><br><br>
        <span style="margin-bottom: 5px; font-weight: bold; text-align: left">H. INFORMASI PERSYARATAN</span><br>
        <table style="font-size: 12px; width: 100%;">
            <tr>
                <td style="width: 30%">Unggah Swafoto</td>
                <td>: {{$student->student_swaphoto == 1 ? 'Sudah' : 'Belum'}}</td>
            </tr>
            <tr>
                <td>Unggah KTP Orangtua</td>
                <td>: {{$student->student_ktp_photo == 1 ? 'Sudah' : 'Belum'}}</td>
            </tr>
            <tr>
                <td>Unggah Akte Kelahiran</td>
                <td>: {{$student->student_akta_photo == 1 ? 'Sudah' : 'Belum'}}</td>
            </tr>
            <tr>
                <td>Unggah Kartu Keluarga</td>
                <td>: {{$student->student_kk_photo == 1 ? 'Sudah' : 'Belum'}}</td>
            </tr>
            <tr>
                <td>Unggah Ijazah</td>
                <td>: {{$student->student_ijazah_photo == 1 ? 'Sudah' : 'Belum'}}</td>
            </tr>
            <tr>
                <td>Unggah SKHUN/SKL</td>
                <td>: {{$student->student_skhun_photo == 1 ? 'Sudah' : 'Belum'}}</td>
            </tr>
        </table><br><br><br>
        <table style="width: 95%">
            <tr>
                <td style="width: 140px; text-align: center">
                    <img src="{{public_path('storage/admission/fronted/images/student/'.$student->student_nik.'_qrcode.png')}}" style="width: 110px; padding: 3px;">
                </td>
                <td style="text-align: right">
                    <img src="{{public_path('storage/admission/fronted/images/student/'.$student->student_nik.'_swaphoto.jpg')}}" style="height: 110px;">
                </td>
                <td style="text-align: right; width: auto">
                    Jepara, {{\Carbon\Carbon::now()->translatedFormat('d F Y')}}<br>
                    Pendaftar, <br><br><br><br><br>
                    {{$student->student_name}}
                </td>
            </tr>
            <tr>
                <td style="text-align: center; font-style: italic; font-size: 9px">
                    Scan untuk cek keaslian
                </td>
            </tr>
        </table><br><br>
        <h3 style="text-align: center">KARTU KENDALI PENDAFTARAN</h3>
        <table style="margin-top: 20px; width: 80%; border: 1px solid black; border-collapse: collapse">
            <tr>
                <td colspan="2" style="text-align: center; border: 1px solid black; width: 50%">Berkas Pendaftaran</td>
                <td style="text-align: center; border: 1px solid black; width: 50%">Biaya Daftar Ulang</td>
            </tr>
            <tr>
                <td style="border: 1px solid black; text-align: center; width: 40%">Berkas</td>
                <td style="border: 1px solid black; width: 10%; text-align: center">Paraf</td>
                @if($student->invoice->remaining() == 0)
                    <td rowspan="4" style="border: 1px solid black; font-style: italic">LUNAS TERBAYAR secara Online</td>
                @elseif(isset($student->payment->payment_status))
                    @if(in_array($student->payment->payment_status, [3, 4]))
                    <td rowspan="4" style="border: 1px solid black; font-style: italic">Terbayar Sebesar : Rp. {{number_format($student->payment->payment_amount)}} pada tanggal
                        {{\Carbon\Carbon::create($student->payment->payment_transaction_date)->format('d/m/Y H:i:s')}}</td>
                    @endif
                @else
                <td rowspan="4" style="border: 1px solid black; font-style: italic">Pembayaran Minimal : {{number_format($student->invoice->invoice_amount/2)}} </td>
                @endif
            </tr>
            <tr>
                <td style="border: 1px solid black;">1. Foto Berwarna 3x4</td>
                <td style="border: 1px solid black;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">2. Fotokopi KTP Orangtua</td>
                <td style="border: 1px solid black;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">3. Fotokopi Akta Kelahiran</td>
                <td style="border: 1px solid black;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">4. Fotokopi Kartu Keluarga</td>
                <td style="border: 1px solid black;"></td>
                <td rowspan="4" style="border: 1px solid black;">Tahap II</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">5. Fotokopi Ijazah</td>
                <td style="border: 1px solid black;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">6. Fotokopi SKHUN/SKL</td>
                <td style="border: 1px solid black;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">7. Fotokopi Kartu Bantuan</td>
                <td style="border: 1px solid black;"></td>
            </tr>
        </table><br/>
        <h3 style="text-align: left">KARTU KENDALI PENERIMAAN</h3>
        <table style="margin-top: 50px; width: 50%; border: 1px solid black; border-collapse: collapse">
            <tr>
                <td style="text-align: center; border: 1px solid black; width: 50%">Uraian</td>
                <td style="text-align: center; border: 1px solid black; width: 50%">Paraf</td>
            </tr>
            @foreach($register as $item)
                <tr>
                    <td style="border: 1px solid black;">{{$item->register_name}}</td>
                    <td style="border: 1px solid black;"></td>
                </tr>
            @endforeach
        </table>
        <br><br><br>
        <p style="position: fixed; bottom: -0px; left: 0; right: 0; height: 10px; text-align: left; line-height: 1; font-size: 9px; font-style: italic">
            Sistem Informasi Akademik Terpadu (SIMADU) - {{$setting->value('app_alias')}} {{$school->name(false)}} Tahun Pelajaran
            {{$setting->value('app_year')}}<br>
            Dicetak dari {{route('admission.register')}} | Tanggal Pendaftaran : {{\Carbon\Carbon::parse($student->created_at)->translatedFormat('d F Y H:i:s')}}
        </p>
    </body>
</html>
