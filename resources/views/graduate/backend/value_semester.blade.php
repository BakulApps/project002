@extends('graduate.layouts.master', ['title' => "Penilaian"])
@section('js')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/styling/uniform.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jspage')
    <script src="{{asset('assets/apps/graduate/backend/js/value_semester.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Penilaian</span>
    <span class="breadcrumb-item active">Nilai Semester</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h5 class="card-title">NILAI SEMESTER</h5>
                    <div class="header-elements">
                        <span class="mr-1">Tahun Pelajaran :</span>
                        <select id="year_id" class="form-control select year_id">
                            @foreach(\App\Models\Master\Year::OrderBy('year_number')->get() as $year)
                                <option value="{{$year->year_id}}">TP. {{$year->year_name}}</option>
                            @endforeach
                        </select>
                        <span class="mr-1 ml-3">Semester :</span>
                        <select id="semester_id" class="form-control select semester_id">
                            <option value="1">Semester Gasal</option>
                            <option value="2">Semester Genap</option>
                        </select>
                        <button type="button" class="btn btn-primary btn-labeled btn-labeled-left ml-3" data-toggle="modal" data-target="#modal-upload"><b><i class="icon-upload4"></i></b>UNGGAH</button>
                    </div>
                </div>
                <table class="table table-sm table-bordered datatable-semester">
                    <thead>
                    <tr class="text-center">
                        <td>NAMA SISWA</td>
                        @foreach(\App\Models\Master\Subject::OrderBy('subject_number')->get() as $subject)
                            <td>{{$subject->subject_code}}_KD3</td>
                            <td>{{$subject->subject_code}}_KD4</td>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <div id="modal-upload" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-white">
                    <h5 class="modal-title">Unggah Nilai Semester</h5>
                </div>
                <div class="modal-body">
                    <p class="text-danger font-italic">Menggungah berkas berarti menghapus data sebelumnya.</p>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="file" id="value_semester" class="form-control-uniform-custom">
                            </div>
                        </div>
                    </div>
                    <p>Silahkan unduh template Nilai Semester <a href="{{route('graduate.admin.value.semester')}}/?_type=download&_data=value_semester" class="badge badge-info">disini</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
