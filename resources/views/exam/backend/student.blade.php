@extends('exam.layouts.master', ['title' => 'Peserta'])
@section('js')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/styling/uniform.min.js')}}"></script>
@endsection
@section('jspage')
    <script src="{{asset('assets/apps/exam/backend/js/student.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item active">Data Peserta</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title font-weight-semibold">DATA PESERTA</h6>
                    <div class="header-elements">
                        <button type="button" class="btn btn-primary btn-labeled btn-labeled-left font-weight-semibold" data-toggle="modal" data-target="#modal-upload"><b><i class="icon-user-plus"></i> </b>TAMBAH</button>
                    </div>
                </div>
                <table class="table datatable-student table-bordered">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>NO PESERTA</th>
                        <th>NAMA LENGKAP</th>
                        <th>KELAS</th>
                        <th>NAMA PENGGUNA</th>
                        <th>PASSWORD</th>
                        <th>AKSI</th>
                    </tr>
                    </thead>
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
                    <h5 class="modal-title font-weight-semibold title">Unggah Pesrta</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="file" id="data-student" class="form-control-uniform">
                            </div>
                        </div>
                    </div>
                    <p class="font-italic text-danger">Mengunggah berkas baru berarti menghapus data yang sebelumnya.</p>
                    <p>Silahkan unduh template Data Siswa <a href="{{route('exam.admin.student')}}/?_type=download&_data=student" class="badge badge-info">disini</a></p>
                </div>

                <div class="modal-footer">
                    <button type="button" id="upload" class="btn btn-sm bg-primary btn-labeled btn-labeled-left"><b><i class="icon-upload"></i></b>UNGGAH</button>
                    <button type="button" class="btn btn-sm bg-danger btn-labeled btn-labeled-left" data-dismiss="modal"><b><i class="icon-close2"></i> </b>KELUAR</button>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-student" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-white">
                    <h5 class="modal-title font-weight-semibold title">Ubah Data Siswa</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="student_id">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>No Peserta :</label>
                                <input type="text" id="student_number" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Nama Lengkap :</label>
                                <input type="text" id="student_name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Kelas : </label>
                                <input type="text" id="student_class" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Nama Pengguna : </label>
                                <input type="text" id="student_username" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <label>Kata Sandi :</label>
                                <input type="text" id="student_password" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" id="update" class="btn btn-sm bg-primary btn-labeled btn-labeled-left"><b><i class="icon-floppy-disk"></i></b>SIMPAN</button>
                    <button type="button" class="btn btn-sm bg-danger btn-labeled btn-labeled-left" data-dismiss="modal"><b><i class="icon-close2"></i> </b>KELUAR</button>
                </div>
            </div>
        </div>
    </div>
@endsection
