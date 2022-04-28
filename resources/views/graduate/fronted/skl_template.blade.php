<!DOCTYPE html>
<html lang="id">
<body>
<table style="width: 100%;">
    <tr>
        <td style="width: 20%; border-bottom: 2px solid black">
            <img src="{{public_path('/storage/master/images/'.$school->value('school_logo'))}}" style="width: 95px; display: block;">
        </td>
        <td style="width: 80%; text-align: center; border-bottom: 2px solid black">
            <div style="line-height: 1">
                <span style="font-size: 18px; font-weight: bold;">{{strtoupper($school->school_fundation)}}</span><br>
                <span style="font-size: 18px; font-weight: bold;">{{strtoupper($school->name(true))}}</span><br>
                <span style="font-size: 12px; font-weight: bold;">NSM : {{$school->school_nsm}} NPSN : {{$school->school_npsn}}</span><br>
                <span style="font-size: 12px; font-weight: bold;">
                    {{\App\Models\Master\Territory::village($school->school_subdistric, $school->school_village, false)}} -
                    {{\App\Models\Master\Territory::subdistric($school->school_subdistric, false)}} -
                    {{\App\Models\Master\Territory::distric($school->school_distric, false)}}</span><br>
                <span style="font-size: 10px; font-style: italic; line-height: 0.1">Sekretariat: {{$school->school_address}}; Kodepos : {{$school->school_postal}}</span><br>
                <span style="font-size: 10px; font-style: italic; line-height: 0.1">Telp : {{$school->school_phone}}; Website : {{$school->school_website}}; Email : {{$school->school_email}}</span>
            </div>
        </td>
    </tr>
</table>
<br><br>
<span style="font-weight: bold; text-align: center; font-size: 12px">SURAT KETERANGAN LULUS</span><br>
<span style="font-weight: bold; text-align: center; font-size: 12px">NOMOR : {{$announcement->announcement_number . $setting->value('announcement_letter')}}</span><br><br>
<span style="font-weight: bold; text-align: center; font-size: 12px">{{strtoupper($school->name())}}</span><br>
<span style="font-weight: bold; text-align: center; font-size: 12px">TAHUN PELAJARAN {{$year}}</span><br><br>
<span style="text-align: justify; font-size: 12px; text-indent: 1.5cm">
    Yang bertanda tangan dibawah ini, Kepala {{$school->name()}}, menerangkan dengan sesungguhnya bahwa :
</span><br>
<table style="font-size: 12px; text-indent: 1cm; width: 100%;">
    <tr>
        <td style="width: 40%">Nama Lengkap</td>
        <td>: {{$student->student_name}}</td>
    </tr>
    <tr>
        <td>Tempat, Tanggal Lahir</td>
        <td>: {{$student->student_place_birth}}, {{\Carbon\Carbon::parse($student->student_birthday)->translatedFormat('d F Y')}}</td>
    </tr>
    <tr>
        <td>Nama Orangtua</td>
        <td>: {{$student->student_father}}</td>
    </tr>
    <tr>
        <td>Nomor Induk Siswa Madrasah</td>
        <td>: {{$student->student_nism}}</td>
    </tr>
    <tr>
        <td>Nomor Induk Siswa Nasional</td>
        <td>: {{$student->student_nisn}}</td>
    </tr>
    <tr>
        <td>Nomor Ujian</td>
        <td>: {{$student->student_number_exam}}</td>
    </tr>
</table>
<br><br>
<span style="text-align: justify; font-size: 12px;">
    Berdasarkan hasil keputusan Rapat Pleno Kelulusan Dewan Guru
    {{$school->name(true)}} Yang bersangkutan dinyatakan
    <span style="font-weight: bold"> LULUS </span>
    @php($meeting = \Carbon\Carbon::createFromFormat('d/m/Y', $setting->value('announcement_meeting')))
    pada hari {{$meeting->translatedFormat('l')}}, tanggal {{$meeting->translatedFormat('d F Y')}}, Dengan nilai sebagai berikut :
</span>

<br/><br/>
<table style="border: 1px solid black; border-collapse: collapse; margin-left: auto; margin-right: auto">
    <tr>
        <td style="border: 1px solid black;text-align: center; width: 10%; font-weight: bold">NO</td>
        <td style="border: 1px solid black; text-align: center; font-weight: bold">MATA PELAJARAN</td>
        <td style="border: 1px solid black; text-align: center; width: 30%; font-weight: bold">NILAI</td>
    </tr>
    @php($num = 1)
    @foreach($subjects as $subject)
        <tr>
            <td style="border: 1px solid black; text-align: center">{{$num++}}</td>
            <td style="border: 1px solid black; text-align: left">{{$subject->subject_name}}</td>
            <td style="border: 1px solid black; text-align: center">{{$value->where('value_subject', $subject->subject_id)->first()->value_point}}</td>
        </tr>
    @endforeach
</table>
<br/><br/>
<span style="text-align: justify; font-size: 12px; text-indent: 1.5cm">
    Surat Keterangan Lulus ini berlaku sementara sampai
    dengan diterbitkannya ijazah kepada yang bersangkutan,
    untuk menjadikan maklum bagi yang berkepentingan.
</span>
<br><br>
<table>
    <tr>
        <td style="width: 20%;"><p style="font-size: 11px; text-align: center">
                <img src="{{public_path('/storage/graduate/images/qr/'. $announcement->announcement_uuid .'.png')}}" width='90px' style='padding-bottom: -2px; padding-left: -5px'><br><i>Scan untuk cek keaslian</i></p><
            </td>
        <td style="width: 45%">&nbsp;</td>
        <td style="vertical-align: text-top">
            <p>
                Jepara, 5 Juli 2020<br>
                Kepala {{$school->name(false)}}<br><br><br><br>
                {{$school->first()->school_headmaster_name}}
            </p>
        </td>
    </tr>
</table>
</body>
</html>
