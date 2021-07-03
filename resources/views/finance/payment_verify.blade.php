@extends('finance.layouts.master', ['title' => 'Pembayaran'])
@section('content')
    <div class="row">
        <div class="col-md-8">
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
                                    <td style="width: 10%">NAMA</td>
                                    <td style="width: 2%">:</td>
                                    <td>{{\App\Models\Master\Student::find($payment->payment_student)->student_name}}</td>
                                </tr>
                                <tr>
                                    <td>NISN</td>
                                    <td>: </td>
                                    <td>{{\App\Models\Master\Student::find($payment->payment_student)->student_nisn}}</td>
                                </tr>
                                <tr>
                                    <td>NISM</td>
                                    <td>:</td>
                                    <td>{{\App\Models\Master\Student::find($payment->payment_student)->student_nism}}</td>
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
                                    <td class="text-right font-italic font-weight-semibold">Rp. {{number_format($payment->payment_cost)}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title font-weight-semibold">Informasi </h5>
                </div>
                <div class="card-body">
                    <p class="font-italic text-justify">Tagihan tersebut merupakan hasil tutup kas terakhir.</p>
                    <p class="font-italic text-justify mt-1">Jika terdapat kesalahan pada tagihan tersebut, segera hubungi Bendahara Madrasah.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
