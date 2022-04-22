@extends('graduate.layouts.master', ['title' => 'Master Data'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset("assets/js/plugins/selects/select2.min.js")}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/pickers/daterangepicker.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset("assets/apps/graduate/backend/js/master_school.js")}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Master Data</span>
    <span class="breadcrumb-item active">Data Madrasah</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h5 class="card-title font-weight-semibold">DATA MADRASAH</h5>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a href="#" class="list-icons-item"><i class="icon-office"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor Pokok Sekolah Nasional</label>
                                <input type="text" id="school_npsn" value="{{$school->value('school_npsn')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor Statistik Madrasah</label>
                                <input type="text" id="school_nsm" value="{{$school->value('school_nsm')}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Lembaga</label>
                                <input type="text" id="school_name" value="{{$school->value('school_name')}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Singkatan</label>
                                <input type="text" id="school_nickname" value="{{$school->value('school_nickname')}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status Madrasah</label>
                                <select id="school_status" data-placeholder="Pilih Jenis Status" class="form-control select2">
                                    <option value="{{$school->value('school_status')}}">{{$school->value('school_status') == 1 ? '1. Negeri' : '2. Swasta'}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis Lembaga</label>
                                <select id="school_ladder" data-placeholder="Pilih Jenis Lembaga" class="form-control select2">
                                    <option value="{{$school->value('school_ladder')}}">{{$school->value('school_ladder')}}. {{\App\Models\Master\Ladder::where('ladder_id', $school->value('school_ladder'))->value('ladder_name')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor Pokok Wajib Pajak</label>
                                <input type="text" id="school_npwp" value="{{$school->value('school_npwp')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor Telepon</label>
                                <input type="text" id="school_phone" value="{{$school->value('school_phone')}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Alamat Website</label>
                                <input type="text" id="school_website" value="{{$school->value('school_website')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>E-Mail</label>
                                <input type="text" id="school_email" value="{{$school->value('school_email')}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tahun Berdiri</label>
                                <input type="text" id="school_since_year" value="{{$school->value('school_since_year')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Akta Pendirian Yayasan</label>
                                <input type="text" id="school_since_deed" value="{{$school->value('school_since_deed')}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor SK Izin Operasional</label>
                                <input type="text" id="school_lisence_number" value="{{$school->value('school_lisence_number')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal SK Izin Operasional</label>
                                <input type="text" id="school_lisence_date" class="form-control daterange" value="{{$school->school_lisence_date}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor SK Kemenkumham</label>
                                <input type="text" id="school_kemenkumham_number" value="{{$school->value('school_kemenkumham_number')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal SK Kemenkumham</label>
                                <input type="text" id="school_kemenkumham_date" class="form-control daterange" value="{{$school->school_kemenkumham_date}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Penyelenggara Lembaga</label>
                                <input type="text" id="school_organizer" value="{{$school->value('school_organizer')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Penyelenggara Lembaga</label>
                                <input type="text" id="school_fundation" class="form-control" value="{{$school->value('school_fundation')}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn bg-info btn-labeled btn-labeled-left" id="school" value="store"><b><i class="icon-floppy-disk"></i></b> Simpan Perubahan</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <a href="#">
                        <img class="card-img-top img-fluid" src="{{asset('storage/master/images/' . $school->value('school_logo'))}}" alt="">
                    </a>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="file" id="school_logo" class="form-control-uniform-custom" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h5 class="card-title font-weight-semibold">LOKASI MADRASAH</h5>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a href="#" class="list-icons-item"><i class="icon-office"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" id="school_address" value="{{$school->value('school_address')}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Propinsi</label>
                                <select id="school_province" data-placeholder="Pilih Propinsi" class="form-control select2">
                                    <option value="{{$school->value('school_province')}}">{{\App\Models\Master\Territory::province($school->value('school_province'))}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kabupaten</label>
                                <select id="school_distric" data-placeholder="Pilih Kabupaten" class="form-control select2">
                                    <option value="{{$school->value('school_distric')}}">{{\App\Models\Master\Territory::distric($school->value('school_distric'))}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <select id="school_subdistric" data-placeholder="Pilih Propinsi" class="form-control select2">
                                    <option value="{{$school->value('school_subdistric')}}">{{\App\Models\Master\Territory::subdistric($school->value('school_subdistric'))}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Desa/Kelurahan</label>
                                <select id="school_village" data-placeholder="Pilih Propinsi" class="form-control select2">
                                    <option value="{{$school->value('school_village')}}">{{\App\Models\Master\Territory::village($school->value('school_subdistric'), $school->value('school_village'))}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Kodepos</label>
                                <input type="text" id="school_postal" value="{{$school->value('school_postal')}}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn bg-info btn-labeled btn-labeled-left" id="address" value="update"><b><i class="icon-floppy-disk"></i></b> Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
