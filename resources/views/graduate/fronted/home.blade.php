@extends('graduate.layouts.master', ['title' => 'Dashboard'])
@section('content')
    <form class="login-form" action="{{route('graduate.home')}}" method="post">
        {{csrf_field()}}
        <div class="card mb-0">
            <div class="card-body">
                <div class="text-center">
                    <div class="card-img-actions d-inline-block mb-2">
                        <img src="{{asset('storage/master/images/'. $school->value('school_logo'))}}" width="105" height="100" alt="">
                    </div>
                </div>
                <div class="text-center mb-4">
                    <h6 class="font-weight-bold mb-0">PENGUMUMAN KELULUSAN</h6>
                    <span class="d-block text-muted">{{$school->name()}}</span>
                </div>
                @if(Session::has('msg'))
                    @php($msg = Session::get('msg'))
                    <div class="alert alert-danger alert-dismissible">
                        <span class="font-weight-semibold">{{$msg['title']}}</span> {{$msg['text']}}
                    </div>
                @endif
                <div class="form-group form-group-feedback form-group-feedback-right">
                    <input type="text" name="student_nisn" class="form-control" placeholder="Masukkan NISN">
                    <div class="form-control-feedback">
                        <i class="icon-user-lock text-muted"></i>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="submit" value="search">LIHAT PENGUMUMAN</button>
            </div>
        </div>
    </form>
@endsection
