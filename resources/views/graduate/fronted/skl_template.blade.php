<!DOCTYPE html>
<html lang="id">
<body>
<table style="width: 100%;">
    <tr>
        <td style="width: 20%; border-bottom: 2px solid black">
            <img src="{{public_path('/storage/graduate/images/'.$setting->value('school_logo'))}}" style="width: 95px; display: block;">
        </td>
        <td style="width: 80%; text-align: center; border-bottom: 2px solid black">
            <div style="line-height: 1">
                <span style="font-size: 18px; font-weight: bold;">{{strtoupper($school->first()->school_fundation)}}</span><br>
                <span style="font-size: 18px; font-weight: bold;">{{strtoupper($school->name(true))}}</span><br>
                <span style="font-size: 12px; font-weight: bold;">NSM : {{$school->first()->school_nsm}} NPSN : {{$school->first()->school_npsn}}</span><br>
                <span style="font-size: 12px; font-weight: bold;">MENGANTI - KEDUNG - JEPARA</span><br>
                <span style="font-size: 10px; font-style: italic; line-height: 0.1">Sekretariat: Jl. Bugel - Jepara KM 7 Menganti, Kedung, Jepara; Kodepos : 59463</span><br>
                <span style="font-size: 10px; font-style: italic; line-height: 0.1">Telp : 082229366506; Website : https://mts.darul-hikmah.sch.id; Email : mts@darul-hikmah.sch.id</span>
            </div>
        </td>
    </tr>
</table>
<br><br>
<span style="font-weight: bold; text-align: center; font-size: 12px">SURAT KETERANGAN LULUS</span><br>
<span style="font-weight: bold; text-align: center; font-size: 12px">NOMOR : {{$announcement->announcement_number . $setting->value('announcement_letter')}}</span><br><br>
<span style="font-weight: bold; text-align: center; font-size: 12px">{{strtoupper($school->name())}}</span><br>
<span style="font-weight: bold; text-align: center; font-size: 12px">TAHUN PELAJARAN 2010/2021</span><br><br>
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
        <td>NPSN Madrasah</td>
        <td>: {{$school->first()->school_npsn}}</td>
    </tr>
</table>
<br><br>
<span style="text-align: justify; font-size: 12px;">
    Yang bersangkutan dinyatakan <span style="font-weight: bold"> LULUS </span>berdasarkan hasil keputusan Rapat Pleno Kelulusan Dewan Guru
    {{$school->name(true)}}
    pada hari Kamis, tanggal 4 Juli 2020, dengan nilai sebagai berikut :
</span>
<br><br>
<table>
    <tr>
        <td rowspan="2" style="border: 1px solid black; border-collapse: collapse; text-align: center; width: 5%">NO</td>
        <td rowspan="2" style="border: 1px solid black; border-collapse: collapse; text-align: center; width: 65%">MATA PELAJARAN</td>
        <td colspan="2" style="border: 1px solid black; border-collapse: collapse; text-align: center; width: 30%">NILAI</td>
    </tr>
    <tr>
        <td style="border: 1px solid black; border-collapse: collapse; text-align: center">Pengetahuan</td>
        <td style="border: 1px solid black; border-collapse: collapse; text-align: center">Keterampilan</td>
    </tr>
    @php($no = 1)
    @foreach($subjects  as $subject)
        <tr>
            <td style="border: 1px solid black; border-collapse: collapse; text-align: center;">{{$no++}}</td>
            <td style="border: 1px solid black; border-collapse: collapse;"> {{$subject->subject_name}}</td>
            <td style="border: 1px solid black; border-collapse: collapse; text-align: center;">{{number_format($value_know[$subject->subject_id - 1])}}</td>
            <td style="border: 1px solid black; border-collapse: collapse; text-align: center;">{{number_format($value_know[$subject->subject_id - 1])}}</td>
        </tr>
    @endforeach
    <tr>
        <td style="border: 1px solid black; border-collapse: collapse; text-align: center; font-weight: bold" colspan="2">TOTAL NILAI</td>
        <td style="border: 1px solid black; border-collapse: collapse; text-align: center; font-weight: bold">{{array_sum($value_know)}}</td>
        <td style="border: 1px solid black; border-collapse: collapse; text-align: center; font-weight: bold">{{array_sum($value_skill)}}</td>
    </tr>
</table>
<br><br>
<span style="text-align: justify; font-size: 12px; text-indent: 1.5cm">
    Surat Keterangan Lulus ini berlaku sementara sampai
    dengan diterbitkannya ijazah kepada yang bersangkutan,
    untuk menjadikan maklum bagi yang berkepentingan.
</span>
<br><br>
<table>
    <tr>
        <td style="width: 20%;"><p style="font-size: 11px; text-align: center">
                <img src="{{public_path('/storage/graduate/images/qr/'. $announcement->announcement_uuid .'.png')}}" width='130px' style='padding-bottom: -2px; padding-left: -5px'><br><i>Scan untuk cek keaslian</i></p><
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
