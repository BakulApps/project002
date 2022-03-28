@extends('admission.fronted.layouts.master', ['title' => 'Pembayaran Tagihan'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/styling/uniform.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/pickers/daterangepicker.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/admission/fronted/js/register_payment.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Root</span>
    <span class="breadcrumb-item active">Pembayaran Tagihan</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white header-elements-sm-inline">
                    <h6 class="card-title">Data Pembayaran</h6>
                    <div class="header-elements">
                        <button type="button" class="btn bg-blue" data-toggle="modal" data-target="#modal-payment"><i class="icon-credit-card mr-2"></i> Tambah</button>
                    </div>
                </div>
                <table class="table datatable-invoice table-bordered">
                    <thead>
                    <tr>
                        <th>No Tagihan</th>
                        <th>Detail Tagihan</th>
                        <th>Tanggal Terbit</th>
                        <th>Jatuh Tempo</th>
                        <th>Jumlah Tagihan</th>
                        <th>Jumlah Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <p>Terima kasih telah melakukan pendaftaran di {{$school->name(false)}}</p>
                    @if($student->invoice->remaining() == 0)
                        <p>Saat ini siswa atas nama <span class="font-italic font-weight-bold">{{$student->student_name}} </span> Telah LUNAS</p>
                    @else
                    <p>Saat ini siswa atas nama <span class="font-italic font-weight-bold">{{$student->student_name}} </span> masih mempunyai tagihan sebesar <span class="font-italic font-weight-bold">Rp. {{number_format($student->invoice->remaining()) }}</span> </p>
                    <p>Silahkan melakukan pembayaran sebelum tanggal {{$setting->value('due_date')}}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <div id="modal-payment" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="payment_id" value="">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Total Tagihan</label>
                                <input type="text" id="payment_invoice" class="form-control" value="{{number_format($student->invoice->remaining())}}" disabled>
                            </div>

                            <div class="col-sm-6">
                                <label>Jumlah Pembayaran</label>
                                <input type="text" id="payment_amount" class="form-control" placeholder="2000000">
                            </div>
                        </div>
                    </div>
                    <div id="payment-information">
                        <p class="font-weight-semibold">Infomasi Pembayaran</p>
                        <p>Pembayaran secara transfer ke Nomor Rekening : 123456789123456789 an. Munasaroh</p>
                        <p>Setelah melakukan transfer silahkan unggah bukti transfer di laman ini.</p>
                    </div>
                    <div id="payment-account" style="display: none">
                        <p class="font-weight-semibold">Infomasi Pembayaran</p>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Jenis Bank</label>
                                    <input type="text" id="payment_account_type" placeholder="Ex. BCA, BNI, Mandiri" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Nomor Rekening</label>
                                    <input type="text" id="payment_account_number" placeholder="123456789123" class="form-control">
                                </div>

                                <div class="col-sm-6">
                                    <label>Atas Nama</label>
                                    <input type="text" id="payment_account_name" placeholder="Sunoto" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal & Jam Pembayaran</label>
                                    <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon-calendar22"></i></span>
                                            </span>
                                        <input type="text" class="form-control daterange-single"  id="payment_transaction_date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Bukti Pembayaran</label>
                                    <input type="file" id="payment_transaction_file" class="form-control-uniform-custom">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-primary" id="submit" value="store">Simpan Pembayaran</button>
                </div>
            </div>
        </div>
    </div>
@endsection
