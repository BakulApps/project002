@extends('portal.backend.layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="icon-newspaper2 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
                    <h5 class="card-title font-weight-semibold">{{$posts->count()}} Artikel</h5>
                    <p class="mb-3">Jumlah Total Artikel</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="icon-snowflake icon-2x text-danger border-danger border-3 rounded-round p-3 mb-3 mt-1"></i>
                    <h5 class="card-title font-weight-semibold">{{$events->count()}} Acara</h5>
                    <p class="mb-3">Jumlah Total Acara</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="icon-comment icon-2x text-warning border-warning border-3 rounded-round p-3 mb-3 mt-1"></i>
                    <h5 class="card-title font-weight-semibold">{{$comments->count()}} Komentar</h5>
                    <p class="mb-3">Jumlah Total Komentar</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="icon-mailbox icon-2x text-info border-info border-3 rounded-round p-3 mb-3 mt-1"></i>
                    <h5 class="card-title font-weight-semibold">{{$comments->count()}} Pesan</h5>
                    <p class="mb-3">Jumlah Pesan Masuk</p>
                </div>
            </div>
        </div>
    </div>
@endsection
