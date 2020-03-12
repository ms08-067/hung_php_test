<!DOCTYPE html>

<html lang="vi">

<head>

	<?php echo $__env->make('partials.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</head>
<body>
<?php echo $__env->make('partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-content">

	<div class="container">			
		<?php if(View::hasSection('sidebar')): ?>

			<div class="col-md-3">

				<?php echo $__env->yieldContent('sidebar'); ?>

			</div><!-- end div.left-sidebar -->



			<div class="col-md-9 box">

				<?php echo $__env->yieldContent('content'); ?>

			</div>

		<?php else: ?> 

			<?php echo $__env->yieldContent('content'); ?>

		<?php endif; ?>

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

<?php echo $__env->make('partials.javascript', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>
</html>