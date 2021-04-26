<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>KELULUSAN - {{$school->name(true)}}</title>

    <link rel="shortcut icon" href="{{'storage/graduate/fronted/images/'.asset($school->value('school_logo'))}}">
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

    <script src="{{asset('assets/js/cores/app.js')}}"></script>
    <script src="{{asset('assets/apps/graduate/backend/js/login.js')}}"></script>
</head>
<body class="bg-green-800">
<div class="page-content">
    <div class="content-wrapper">
        <div class="content d-flex justify-content-center align-items-center">
            <form class="login-form" action="{{route('graduate.admin.login')}}" method="post">
                {{csrf_field()}}
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="text-center">
                            <div class="card-img-actions d-inline-block mb-2">
                                <img src="{{asset('storage/graduate/images/'.$setting->value('school_logo'))}}" width="120" height="115" alt="">
                            </div>
                        </div>
                        <div class="text-center mb-4">
                            <h6 class="font-weight-semibold mb-0">Halaman Administrator</h6>
                            <span class="d-block text-muted">{{$school->name()}}</span>
                        </div>
                        @if(session('msg'))
                            @php($msg = session('msg'))
                            <div class="alert alert-{{$msg['class']}} alert-dismissible">
                                <span class="font-weight-semibold">{{$msg['text']}}</span>
                            </div>
                        @endif
                        <div class="form-group form-group-feedback form-group-feedback-right">
                            <input type="text" name="user_name" class="form-control" placeholder="Nama Pengguna">
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                        </div>
                        <div class="form-group form-group-feedback form-group-feedback-right">
                            <input type="password" name="user_pass" class="form-control" placeholder="Kata Sandi">
                            <div class="form-control-feedback">
                                <i class="icon-key text-muted"></i>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-1">
                                <input type="checkbox" name="remember" class="form-check-input-styled-primary" checked data-fouc>
                            </div>
                            <div class="col-md-8">
                                <label>Ingat Saya ?</label>
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
