<!DOCTYPE html>

<html lang="vi">

<head>

	<?php echo $__env->make('partials.mobile.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</head>



<body>

					

<div id="header">

	<div class="header wrap">

		<?php echo $__env->make('partials.mobile.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	</div>

</div>



<div class="main-content">

	<div class="container">			

		<?php if(View::hasSection('sidebar')): ?>

			<div class="row">

				<div class="col-md-3">

					<?php echo $__env->yieldContent('sidebar'); ?>

				</div><!-- end div.left-sidebar -->



				<div class="col-md-9">

					<?php echo $__env->yieldContent('content'); ?>

				</div>

			</div>

		<?php else: ?> 

			<?php echo $__env->yieldContent('content'); ?>

		<?php endif; ?>

	</div><!-- end div.wrap -->



	<div class="clear"> </div>



</div> <!-- end div.main-content -->			





<?php echo $__env->yieldContent('modal'); ?>



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

<?php echo $__env->make('partials.mobile.javascript', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</body>

</html>