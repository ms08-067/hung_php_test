@section('head')
	<meta charset="utf-8">
	<title>
		@yield('title') - Admin Post BLOG
	</title>

	<meta name="description" content="Admin systems">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- <meta http-equiv="refresh" content="3600; url={{ URL::full() }}" /> -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	@section('css')
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

		{{ Html::style('packages/thickbox/css/thickbox.css') }}
		
		{{ Html::style('assets/themes/admin/css/app.v3.css') }}
		{{-- Html::style('assets/themes/landing/css/icomoon.css') --}}

		{{ Html::style('packages/bootstrap-2/bootstrap-dialog/css/bootstrap-dialog.min.css') }}

		{{ Html::style('packages/jquery/jquery-ui-1.12.1.custom/jquery-ui.css') }}
		{{ Html::style('packages/jquery/css/Aristo.css') }}		

		{{ Html::style('packages/admin/css/main.css') }}

		{{ Html::style('packages/select2/select2.css') }}

		{{ Html::style('packages/dropify/dist/css/dropify.min.css') }}
		{{ Html::style('packages/alertify/css/alertify.css') }}

		{{ Html::style('packages/datatables/media/css/jquery.dataTables.min.css') }}

		{{ Html::style('packages/datatables/extensions/TableTools/css/dataTables.tableTools.min.css') }}

		{{ Html::style('packages/datatables/extensions/FixedColumns/css/dataTables.fixedColumns.min.css') }}

	@show
	<!--[if lt IE 9]>

	    <script src="packages/ie/respond.min.js"></script>

	    <script src="packages/ie/html5.js"></script>

	<![endif]-->

@show