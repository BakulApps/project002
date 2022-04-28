@extends('graduate.layouts.master', ['title' => 'Kelulusan'])
@section('content')
    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <div class="card-img-actions d-inline-block mb-2">
                        <img src="{{asset('storage/master/images/'. $school->value('school_logo'))}}" width="100" height="100" alt="">
                    </div>
                </div>
                <div class="text-center mb-0">
                    <h6 class="font-weight-bold mb-0">PENGUMUMAN KELULUSAN</h6>
                    <span class="d-block text-muted mb-3">{{$school->name()}}</span>
                    <p>Kepala {{$school->name()}} Menerangkan bahwa peserta didik dibawah ini :</p>
                    <table class="table table-borderless table-xs" style="width: 80%;margin-left:auto;margin-right:auto;">
                        <tr>
                            <td class="text-left" style="width: 35%">Nama</td>
                            <td class="text-left" style="width: 65%">: {{$student->student_name}}</td>
                        </tr>
                        <tr>
                            <td class="text-left">NISM</td>
                            <td class="text-left">: {{$student->student_nism}}</td>
                        </tr>
                        <tr>
                            <td class="text-left">NISN</td>
                            <td class="text-left">: {{$student->student_nisn}}</td>
                        </tr>
                        <tr>
                            <td class="text-left">Nomor Ujian</td>
                            <td class="text-left">: {{$student->student_number_exam}}</td>
                        </tr>
                        <tr>
                            <td class="text-left">TTL</td>
                            <td class="text-left">: {{$student->student_place_birth}}, {{\Carbon\Carbon::createFromFormat('Y-m-d', $student->student_birthday)->translatedFormat('d F Y')}}</td>
                        </tr>
                        <tr>
                            <td class="text-left">Jenis Kelamin</td>
                            <td class="text-left">: {{$student->student_gender == "L" ? 'Laki - laki' : 'Perempuan'}}</td>
                        </tr>
                        <tr>
                            <td class="text-left">Nama Wali</td>
                            <td class="text-left">: {{$student->student_father}}</td>
                        </tr>
                    </table>
                    <p class="font-weight-semibold">
                        Telah mengikuti serangkaian Kegiatan Ujian Tahun Pelajaran {{\App\Models\Master\Year::where('year_active', 1)->value('year_name')}}
                        dan berdasarkan Kriteria Kelulusan {{$school->name()}} dinyatakan :
                    </p>
                    @if($announcement->announcement_status == 1)
                        <h2 class="bg-success font-weight-bold mb-3">LULUS</h2>
                        <p>Demikian pengumuman ini dibuat dan untuk digunakan sebagaimana mestinya</p>
                        @if($setting->value('announcement_skl') == 1)
                            <table class="table table-borderless">
                                <tr>
                                    <td>
                                        <form method="post" action="{{route('graduate.print')}}">
                                            @csrf
                                            <input type="hidden" name="student_nisn" value="{{$student->student_nisn}}">
                                            <button type="submit" class="btn bg-success btn-labeled btn-labeled-left" name="submit" value="skl"><b><i class="icon-printer"></i></b> CETAK SKL</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="{{route('graduate.print')}}">
                                            @csrf
                                            <input type="hidden" name="student_nisn" value="{{$student->student_nisn}}">
                                            <button type="submit" class="btn bg-success btn-labeled btn-labeled-left" name="submit" value="photo"><b><i class="icon-download"></i></b> UNDUH FOTO</button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        @endif
                    @else
                        <h2 class="bg-danger font-weight-bold mb-3">NILAI BERMASALAH</h2>
                        <p class="text-center font-italic font-weight-bold text-danger">SILAHKAN UNTUK MENGHUBUNGI WALIKELAS</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
