@extends('graduate.layouts.master', ['title' => 'Kelulusan'])
@section('jspage')
    <script src="{{asset('assets/apps/graduate/frontend/js/countdown.js')}}"></script>
@endsection
@section('content')
    <script type="text/javascript">
        var noticeDate = "{{$noticeDate}}";
    </script>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <div class="card-img-actions d-inline-block mb-3">
                        <img src="{{asset('storage/graduate/images/'.$setting->value('school_logo'))}}" width="160" height="150" alt="">
                    </div>
                </div>
                <div class="text-center mb-5">
                    <h3 class="font-weight-bold mb-0">PENGUMUMAN KELULUSAN</h3>
                    <h4 class="d-block text-muted">{{$school->name()}}</h4>
                </div>
                <div class="text-center mb-3">
                    <h5 class="font-weight-semibold mb-0">TERBIT DALAM :</h5>
                    <h4 class="font-weight-bold mb-0 text-info" id="countdown">5 Hari : 2 Jam : 23 Menit : 53 Detik</h4>
                </div>
            </div>
        </div>
    </div>
@endsection
