@extends('employee.layouts.master', ['title' => 'Beranda'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item active">Beranda</span>
@endsection
@section('content')
    <div class="row">

    </div>
@endsection
