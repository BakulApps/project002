@extends('finance.layouts.master', ['title' => 'Pembayaran'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/media/fancybox.min.js')}}"></script>
@endsection
@section('jsscript')
    <script src="{{asset('assets/apps/finance/backend/js/payment_verify.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Tagihan</span>
    <span class="breadcrumb-item active">Verifikasi</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title font-weight-semibold">VERIFIKASI PEMBAYARAN SISWA</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <tbody>
                                <tr>
                                    <td style="width: 20%">NO. TAGIHAN</td>
                                    <td style="width: 1%">:</td>
                                    <td>#{{$payment->payment_number}}</td>
                                    <td style="width: 20%">JML PEMBAYARAN</td>
                                    <td style="width: 1%">:</td>
                                    <td class="text-right">Rp. {{number_format(str_replace(',', '', $payment->payment_cost))}}</td>
                                </tr>
                                <tr>
                                    <td>NAMA</td>
                                    <td>:</td>
                                    <td>{{\App\Models\Master\Student::find($payment->payment_student)->student_name}}</td>
                                    <td>NO REK.</td>
                                    <td>:</td>
                                    <td class="text-right">{{\App\Models\Master\Bank::value($payment->payment_type_account, 'bank_code')}} - {{$payment->payment_number_account}}</td>
                                </tr>
                                <tr>
                                    <td>NISN</td>
                                    <td>: </td>
                                    <td>{{\App\Models\Master\Student::find($payment->payment_student)->student_nisn}}</td>
                                    <td>NAMA REK.</td>
                                    <td>:</td>
                                    <td class="text-right">{{$payment->payment_name_account}}</td>
                                </tr>
                                <tr>
                                    <td>KELAS</td>
                                    <td>:</td>
                                    <td>{{\App\Models\Master\Student::find($payment->payment_student)->classes()->where('class_year', \App\Models\Master\Year::active())->value('class_alias')}}</td>
                                    <td>TGL TRANSFER</td>
                                    <td>:</td>
                                    <td class="text-right">{{\Carbon\Carbon::parse($payment->payment_date)->translatedFormat('d/m/Y H:i:s')}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                <tr class="text-center">
                                    <th style="width: 2%">NO</th>
                                    <th>KODE</th>
                                    <th>JENIS BIAYA</th>
                                    <th>TAGIHAN</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($no = 1)
                                @php($item = json_decode($payment->payment_item, false))
                                @for($i=0;$i<count($item);$i++)
                                    <tr>
                                        <td class="text-center">{{$no++}}</td>
                                        <td class="text-center">{{\App\Models\Finance\Item::find($item[$i])->item_code}}</td>
                                        <td>{{\App\Models\Finance\Item::find($item[$i])->item_name}}</td>
                                        <td class="text-right">Rp. {{number_format(\App\Models\Finance\Lack::where('lack_student', $payment->payment_student)->where('lack_item', $item[$i])->value('lack_cost'))}}</td>
                                    </tr>
                                @endfor
                                <tr>
                                    <td colspan="3" class="text-center font-weight-semibold">JUMLAH TAGIHAN</td>
                                    <td class="text-right font-italic font-weight-semibold">Rp. {{number_format(str_replace(',', '', $payment->payment_cost))}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn bg-info btn-labeled btn-labeled-left" id="submit" value="{{$payment->payment_id}}"><b><i class="icon-check"></i></b> Verifikasi</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Bukti Transfer</h5>
                </div>
                <div class="card-img-actions">
                    <img class="img-fluid" src="{{asset('storage/finance/images/transfer/'. $payment->payment_file)}}" alt="">
                    <div class="card-img-actions-overlay">
                        <a href="{{route('portal.home') . '/storage/finance/images/transfer/' . $payment->payment_file}}" class="btn btn-outline bg-white text-white border-white border-2" data-popup="lightbox">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
