
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>{!! Theme::get('title') !!}</title>
        <meta charset="utf-8">
        <meta name="keywords" content="{!! Theme::get('keywords') !!}">
        <meta name="description" content="{!! Theme::get('description') !!}">
		@if(Theme::get('noindex'))<meta name="robots" content="noindex">@else<meta name="robots" content="index,follow,noodp" />@endif
		@if(!empty(Theme::get('canonical')))<link rel="canonical" href="{!! Theme::get('canonical') !!}" />@endif 
		@if(!empty(Theme::get('amp')))<link rel="amphtml" href="{!! Theme::get('amp') !!}" />@endif
		<meta name="author" content="{{$channel['domainPrimary']}}" />
		<meta name="root" content="{{route('channel.home',$channel['domainPrimary'])}}" />
		<link rel="icon" href="{!!Theme::asset()->url('img/favicon.png')!!}?v=3" />
		<meta name="_token" content="{{ csrf_token() }}">
		<meta name="copyright" content="Copyright &copy {{date('Y')}} {{$channel['domainPrimary']}}.　All Right Reserved." />
		<meta http-equiv="Content-Language" content="{{Lang::locale()}}" />
		<meta name="robots" content="notranslate"/>
		<meta name="distribution" content="Global" />
		<meta name="RATING" content="GENERAL" />
		<meta property="fb:pages" content="1531540343840372" />
		<meta property="og:locale" content="{{Lang::locale()}}">
		<meta property="og:title" content="{!! Theme::get('title') !!}">
		<meta property="og:description" content="{!! Theme::get('description') !!}">
		<meta property="og:type" content="{!! Theme::get('type') !!}">
		<meta property="og:url" content="{!! Theme::get('url') !!}">
		<meta property="og:image" content="{!! Theme::get('image') !!}" />
		<meta property="og:image:width" content="720" />
		<meta property="og:image:height" content="480" />
		@if(Theme::get('video'))<meta property="og:video" content="{!! Theme::get('video') !!}" />@endif 
		<link rel="alternate" type="application/rss+xml" title="Cung Cấp RSS" href="https://{{config('app.url')}}/rss/" />
        {!! Theme::asset()->styles() !!}
		<link media="all" type="text/css" rel="stylesheet" href="{!!Theme::asset()->url('css/style.default.css')!!}?v=89">
    </head>
    <body class="">
	<!-- Preloader -->