<!DOCTYPE html>
<html lang="{{config('app.locale')}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>{{$setting->value('app_name')}} | {{$setting->value('school_name')}}</title>

    <link rel="shortcut icon" href="{{asset('storage/admission/fronted/images/logo.png')}}">
    <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css"> -->
    <link href="{{asset('assets/fonts/icomoon/styles.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/layout.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">

    <script src="{{asset('assets/js/cores/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/cores/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/cores/blockui.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/styling/uniform.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/input/inputmask.js')}}"></script>

    <script src="{{asset('assets/js/cores/app.js')}}"></script>
    <script src="{{asset('assets/apps/student/fronted/js/login.js')}}"></script>
</head>
<body class="bg-green-800">
<div class="page-content">
    <div class="content-wrapper">
        <div class="content d-flex justify-content-center align-items-center">
            <form class="login-form" action="{{route('simadu.login')}}" method="post">
                {{csrf_field()}}
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="text-center">
                            <div class="card-img-actions d-inline-block mb-2">
                                <img src="{{asset('storage/master/images/'.$school->school_logo)}}" width="120" height="115" alt="">
                            </div>
                        </div>
                        <div class="text-center mb-4">
                            <h6 class="font-weight-semibold mb-0">{{$school->name()}}</h6>
                            <span class="d-block text-muted">{{$setting->value('app_name')}}</span>
                        </div>
                        @if(session('msg'))
                            @php($msg = session('msg'))
                            <div class="alert alert-{{$msg['class']}} alert-dismissible">
                                <span class="font-weight-semibold">{{$msg['text']}}</span>
                            </div>
                        @endif
                        <div class="form-group form-group-feedback form-group-feedback-right">
                            <input type="text" name="student_nisn" class="form-control" placeholder="Nomor Induk Siswa Nasional">
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                        </div>
                        <div class="form-group form-group-feedback form-group-feedback-right">
                            <input type="text" name="student_birthday" class="form-control" placeholder="Tanggal Lahir" data-mask="99/99/9999">
                            <div class="form-control-feedback">
                                <i class="icon-calendar3 text-muted"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="submit" value="logged">MASUK</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
