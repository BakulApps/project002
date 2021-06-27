<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {!! isset($meta->title) ? '<meta name="title" content="'. $meta->title .'">': null !!}
    {!! isset($meta->description) ? '<meta name="description" content="'. $meta->description .'">': null !!}
    {!! isset($meta->keyword) ? '<meta name="keyword" content="'. $meta->keyword .'">': null !!}
    {!! isset($meta->author) ? '<meta name="author" content="'. $meta->author .'">': null !!}

    <title>{{!isset($title) ? $setting->value('app_name') .' - '. $setting->value_school_name : $title .' - '. $setting->value('app_name')}}</title>

    <link rel="shortcut icon"
          href="{{asset($setting->value('school_logo') == null ? 'assets/apps/portal/fronted/images/placeholder.jpg' : 'storage/portal/images/' . $setting->value('school_logo'))}}" type="image/png">

    <link rel="stylesheet" href="{{asset('assets/apps/portal/fronted/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/apps/portal/fronted/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('assets/apps/portal/fronted/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/apps/portal/fronted/css/jquery.nice-number.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/apps/portal/fronted/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets/apps/portal/fronted/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/apps/portal/fronted/fonts/awesome/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/apps/portal/fronted/css/default.css')}}">
    <link rel="stylesheet" href="{{asset('assets/apps/portal/fronted/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/apps/portal/fronted/css/responsive.css')}}">
</head>
