<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>{{isset($title) ? $title : null}}{{ ' - ' . $setting->value('app_name')}}</title>

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
    @yield('js')

    <script src="{{asset('assets/js/cores/app.js')}}"></script>
    @yield('jspage')
</head>
