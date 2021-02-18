<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {!! isset($meta->title) ? '<meta name="title" content="'. $meta->title .'">': null !!}
    {!! isset($meta->description) ? '<meta name="description" content="'. $meta->description .'">': null !!}
    {!! isset($meta->keyword) ? '<meta name="keyword" content="'. $meta->keyword .'">': null !!}
    {!! isset($meta->author) ? '<meta name="author" content="'. $meta->author .'">': null !!}

    <title>{{$title}}</title>

    <link rel="shortcut icon" href="{{asset('storage/portal/fronted/images/logo.png')}}" type="image/png">
    <link rel="stylesheet" href="{{asset('assets/portal/fronted/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/portal/fronted/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('assets/portal/fronted/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/portal/fronted/css/jquery.nice-number.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/portal/fronted/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets/portal/fronted/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/portal/fronted/fonts/awesome/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/portal/fronted/css/default.css')}}">
    <link rel="stylesheet" href="{{asset('assets/portal/fronted/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/portal/fronted/css/responsive.css')}}">
</head>
