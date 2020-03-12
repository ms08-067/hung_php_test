<!DOCTYPE html>

<html lang="vi">

<head>

	@include('partials.mobile.head')

</head>



<body>

					

<div id="header">

	<div class="header wrap">

		@include('partials.mobile.header')

	</div>

</div>



<div class="main-content">

	<div class="container">			

		@if(View::hasSection('sidebar'))

			<div class="row">

				<div class="col-md-3">

					@yield('sidebar')

				</div><!-- end div.left-sidebar -->



				<div class="col-md-9">

					@yield('content')

				</div>

			</div>

		@else 

			@yield('content')

		@endif

	</div><!-- end div.wrap -->



	<div class="clear"> </div>



</div> <!-- end div.main-content -->			





@yield('modal')



<div id="error-container">

	<div class="alert alert-success fade" style="display: none;">

		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

		<div>

        	<strong>Successful !</strong>

    	</div>

        <p></p>

  	</div>

	<div class="alert alert-danger fade" style="display: none;">

		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

		<div>

        	<strong>Error !</strong>

    	</div>

        <p></p>

  	</div>

</div>

@include('partials.mobile.javascript')

</body>

</html>