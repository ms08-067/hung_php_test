@section('head')
	<title>POST BLlog</title>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" /><!-- viewport bootstrap -->
	<meta http-equiv="X-UA-Compatible" content="IE=9" /> <!-- fix outline ie 9 -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="vi" />
	<meta name="description" content="" />
	<meta name="robots" content="index, follow" />
	@section('css')

	<!-- library -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="{{ asset('packages/font-awesome-4.7.0/css/font-awesome.css')}}" rel="stylesheet" type="text/css" media="all" />
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,500,700&subset=latin,vietnamese" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="{{ asset('packages/bootstrap-3.3.7-dist/css/bootstrap.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/themes/landing/css/style.css') }}" />
	

	<link href="{{ asset('packages/main/css/reset.css') }}" rel="stylesheet" type="text/css"/>

	<link href="{{ asset('packages/main/css/normalize.css') }}" rel="stylesheet" type="text/css"/>

	<!-- extend library -->
	<link href="{{ asset('packages/validation/css/validationEngine.jquery.css') }}" rel="stylesheet" type="text/css"/>

	<link href="{{ asset('packages/main/css/office-font.css') }}" rel="stylesheet" type="text/css"/>

	

	<link href="{{ asset('packages/thickbox/css/thickbox.css') }}" rel="stylesheet" type="text/css"/>

	<link href="{{ asset('packages/main/css/sidebar-menu.css') }}" rel="stylesheet" type="text/css"/>

	<!-- my css -->

	<link rel="stylesheet" href="{{ Theme::asset('css/styles.css', null, true) }}?v={{ Config::get('main.version') }}"/>

	<link href="{{ asset('packages/main/css/main.css') }}?v={{ Config::get('main.version') }}" rel="stylesheet" type="text/css"/>
	
	<link href="{{ asset('assets/themes/landing/css/social-icons.css') }}" rel="stylesheet">

	<link href="{{ asset('assets/themes/landing/css/icomoon.css') }}" rel="stylesheet">
	@show

@show