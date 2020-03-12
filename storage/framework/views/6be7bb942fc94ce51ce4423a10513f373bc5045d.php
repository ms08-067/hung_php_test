<?php $__env->startSection('head'); ?>
	<title>Yopla Web App</title>
	<meta charset="utf-8">
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" /><!-- viewport bootstrap -->
	<meta http-equiv="X-UA-Compatible" content="IE=9" /> <!-- fix outline ie 9 -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="vi" />

	<meta name="description" content="" />
	
	<meta name="keywords" content=""/>
	
	<meta property="og:title" content="" />
	<meta property="og:description" content="" />
	<meta property="og:type"        content="article" />

	<meta name="robots" content="index, follow" />

	<link rel="manifest" href="./packages/main/img/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php echo e(asset('packages/main/img/favicon/ms-icon-144x144.png')); ?>">
	<meta name="theme-color" content="#ffffff">

	<?php $__env->startSection('css'); ?>
	<!-- library -->
	<link href="<?php echo e(asset('packages/font-awesome-4.7.0/css/font-awesome.css')); ?>" rel="stylesheet" type="text/css" media="all" />
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,500,700&subset=latin,vietnamese" rel="stylesheet" type="text/css" />
	
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo e(asset('packages/bootstrap-3.3.7-dist/css/bootstrap.css')); ?>" /> -->

	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/themes/landing/css/style.css')); ?>" />
	


	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('packages/main/css/login-theme.css')); ?>" />
	<link href="<?php echo e(asset('packages/main/css/reset.css')); ?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo e(asset('packages/main/css/normalize.css')); ?>" rel="stylesheet" type="text/css"/>
	
	<!-- extend library -->
	<link href="<?php echo e(asset('packages/validation/css/validationEngine.jquery.css')); ?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo e(asset('packages/main/css/office-font.css')); ?>" rel="stylesheet" type="text/css"/>
	
	<!-- <link href="<?php echo e(asset('packages/main/css/stylesheets.css')); ?>" rel="stylesheet" type="text/css"/> -->

	<link href="<?php echo e(asset('packages/thickbox/css/thickbox.css')); ?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo e(asset('packages/main/css/sidebar-menu.css')); ?>" rel="stylesheet" type="text/css"/>

	<!-- <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" /> -->

	<link rel="stylesheet" href="<?php echo e(asset('assets/themes/default/css/fresh.css')); ?>">
	
	<!-- my css -->
	<link rel="stylesheet" href="<?php echo e(Theme::asset('css/styles.css', null, true)); ?>?v=<?php echo e(Config::get('main.version')); ?>"/>
	<link href="<?php echo e(asset('packages/main/css/main.css')); ?>?v=<?php echo e(Config::get('main.version')); ?>" rel="stylesheet" type="text/css"/>

	<link href="<?php echo e(asset('assets/themes/landing/css/social-icons.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('assets/themes/landing/css/icomoon.css')); ?>" rel="stylesheet">
	
	<?php echo $__env->yieldSection(); ?>
<?php echo $__env->yieldSection(); ?>