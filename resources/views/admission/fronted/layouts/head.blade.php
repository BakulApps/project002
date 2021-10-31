<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}">
    {!! isset($meta->title) ? '<meta name="title" content="'.$meta->title.'">' : null !!}
    {!! isset($meta->description) ? '<meta name="description" content="'.$meta->description.'">' : null !!}
    {!! isset($meta->keyword) ? '<meta name="keyword" content="'.$meta->keyword.'">' : null !!}
    {!! isset($meta->author) ? '<meta name="author" content="'.$meta->author.'">' : null !!}

    <title>{{isset($title) ? $title .' - '. $setting->value('app_alias') .' TP. '. $setting->value('app_year') : $setting->value('app_alias') .' TP. '. $setting->value('app_year') .' - '. $school->name(false)}}</title>

    <link rel="shortcut icon" href="{{asset('storage/master/images/'.$school->school_logo)}}">
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
