<!DOCTYPE html>

<html lang="vi">

<head>

	@include('partials.head')

</head>
<body>
@include('partials.header')
<div class="main-content">

	<div class="container">			
		@if(View::hasSection('sidebar'))

			<div class="sidebar col-md-3">

				@yield('sidebar')

			</div><!-- end div.left-sidebar -->



			<div class="col-md-9 box">

				@yield('content')

			</div>

		@else 

			@yield('content')

		@endif

	</div><!-- end div.wrap -->



	<div class="clear"> </div>



</div> <!-- end div.main-content -->			


<div id="error-container">
	<div class="alert alert-success fade" style="display: none;">
	    <button type="button" class="close" aria-hidden="true">×</button>
	    <div class="title-alert"><strong>Success!</strong></div>
	    <p class="body-msg"></p>
	</div>
	<div class="alert alert-danger fade" style="display: none;">
	    <button type="button" class="close" aria-hidden="true">×</button>
	    <div class="title-alert"><strong>Whoops! Error occur</strong></div>
	    <p class="body-msg"></p>
	</div>
</div>

@include('partials.javascript')
</body>
</html>