@extends('simadu.layouts.master', ['title' => 'Keuangan'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/input/inputmask.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset("assets/apps/simadu/js/finance_payment.js")}}"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Keuangan</span>
    <span class="breadcrumb-item active">Pembayaran</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h5 class="card-title font-weight-semibold">DATA PEMBAYARAN ONLINE SISWA</h5>
                    <div class="header-elements">
                        <button type="button" class="btn btn-sm btn-primary btn-labeled btn-labeled-left" data-toggle="modal" data-target="#modal-payment"><b><i class="icon-plus2"></i></b>TAMBAH</button>
                    </div>
                </div>
                <table class="table datatable-payment table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>PEMBAYARAN</th>
                        <th>METODE</th>
                        <th>RILIS</th>
                        <th>JATUH TEMPO</th>
                        <th>STATUS</th>
                        <th>JUMLAH</th>
                        <th>AKSI</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <div id="modal-payment" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-semibold">BUAT TAGIHAN</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <label>PILIH TAGIHAN YANG DIBAYAR</label>
                    <div class="col-md-12">
                        <div class="row">
                            @php($total =0)
                            @foreach($lack as $item)
                                <div class="form-check col-md-6">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="checkbox payment_item" id="payment_item{{$item->lack_item}}" value="{{$item->lack_item}}" data-info="{{$item->lack_cost}}" data-fouc>
                                        {{\App\Models\Finance\Item::find($item->lack_item)->item_name}} - {{number_format($item->lack_cost)}}
                                    </label>
                                </div>
                                @php($total = $total + $item->lack_cost)
                            @endforeach
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>JUMLAH PEMBAYARAN</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </span>
                                    <input type="text" id="payment_cost" class="form-control" data-mask="999,999,9999" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>TOTAL TAGIHAN</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </span>
                                    <input type="text" class="form-control" value="{{number_format($total)}}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="submit" value="store" class="btn bg-primary btn-labeled btn-labeled-left"><b><i class="icon-credit-card pay"></i></b> Bayar Tagihan</button>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-invoice" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-semibold">DETAIL TAGIHAN</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="payment_id">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-4">
                                <ul class="list list-unstyled mb-0">
                                    <li>{{$school->name(false)}}</li>
                                    <li>{{$school->school_address}}</li>
                                    <li>{{$school->school_phone}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-4">
                                <div class="text-sm-right">
                                    <h4 class="text-primary mb-2 mt-md-2" id="payment_number">Tagihan #49029</h4>
                                    <ul class="list list-unstyled mb-0">
                                        <li>Tanggal: <span class="font-weight-semibold" id="payment_created_at">January 12, 2015</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-md-flex flex-md-wrap">
                        <div class="mb-4 mb-md-4">
                            <span class="text-muted">Tagihan Ke:</span>
                            <ul class="list list-unstyled mb-0">
                                <li><h5 class="my-2">{{session()->get('simadu.auth')->student_name}}</h5></li>
                                <li><span class="font-weight-semibold">{{session()->get('simadu.auth')->student_address}}</span></li>
                                <li>
                                    {{\App\Models\Master\Territory::subdistric(session()->get('simadu.auth')->student_subdistric, false)}} -
                                    {{\App\Models\Master\Territory::distric(session()->get('simadu.auth')->student_distric, false)}} -
                                    {{\App\Models\Master\Territory::province(session()->get('simadu.auth')->student_province, false)}}
                                </li>
                                <li>{{session()->get('simadu.auth')->student_phone}}</li>
                            </ul>
                        </div>
                        <div class="mb-2 ml-auto">
                            <span class="text-muted">Detail Tagihan:</span>
                            <div class="d-flex flex-wrap wmin-md-400">
                                <ul class="list list-unstyled mb-0">
                                    <li><h5 class="my-2">Jumlah Tagihan:</h5></li>
                                    <li>Nama Bank:</li>
                                    <li>Nomor Rekening:</li>
                                    <li>Nama Rekening:</li>
                                </ul>

                                <ul class="list list-unstyled text-right mb-0 ml-auto">
                                    <li><h5 class="font-weight-semibold my-2" id="payment_price">$8,750</h5></li>
                                    <li><span class="font-weight-semibold">{{\App\Models\Master\Bank::value(\App\Models\Finance\Account::active('account_bank'), 'bank_name')}}</span></li>
                                    <li>{{\App\Models\Finance\Account::active('account_number')}}</li>
                                    <li>{{\App\Models\Finance\Account::active('account_name')}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>TANGGAL TRANSFER</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-calendar"></i></span>
                                    </span>
                                    <input type="text" id="payment_date" class="form-control" data-mask="99/99/9999 99:99:99">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>UNGGAH BUKTI TRANSFER</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="file" id="payment_file" class="form-control-uniform-custom">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="pay-button" value="payment" class="btn bg-primary">SIMPAN</button>
                </div>
            </div>
        </div>
    </div>
@endsection
