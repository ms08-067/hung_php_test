<?php $__env->startSection('javascript'); ?>
	<script type="text/javascript">
		var base_url = '<?php echo e(URL::to('/')); ?>/';
	</script>

	<?php echo e(Html::script('packages/jquery/js/jquery-1.7.2.min.js')); ?>

	<?php echo e(Html::script('packages/jquery/js/jquery-migrate-1.2.1.min.js')); ?>

	<?php echo e(Html::script('packages/thickbox/js/thickbox.js')); ?>

	<?php echo e(Html::script('packages/jquery/js/jquery.cookie.js')); ?>

	<?php echo e(Html::script('packages/jquery/js/jquery.blockUI.js')); ?>

	<?php echo e(Html::script('packages/jquery/js/jquery.common.js')); ?>


	<script type="text/javascript">
	     $.cookie.defaults.path = '/';
	</script>

	<?php echo e(Html::script('packages/bootstrap-2/bootstrap.min.js')); ?>

	
	

	<!-- combodate && momentjs -->
	<?php echo e(Html::script('packages/combodate/combodate.js')); ?>

	<?php echo e(Html::script('packages/momentjs/moment.min.1.7.2.js')); ?>

	<?php echo e(Html::script('packages/momentjs/moment.vi.js')); ?>

	
	<!--- select 2-->
	<?php echo e(Html::script('packages/select2/select2.min.js')); ?>

	<?php echo e(Html::script('packages/select2/select2_locale_vi.js')); ?>

	<!-- date picker -->
	<?php echo e(Html::script('packages/alertify/js/alertify.js')); ?>

	<!-- datatables -->

	<?php echo e(Html::script('packages/datatables/media/js/jquery.dataTables.min.js')); ?>

	<?php echo e(Html::script('packages/datatables/extensions/FixedColumns/js/dataTables.fixedColumns.min.js')); ?>

	<?php echo e(Html::script('packages/datatables/extensions/FixedHeader/js/dataTables.fixedHeader.min.js')); ?>

	<?php echo e(Html::script('packages/datatables/extensions/TableTools/js/dataTables.tableTools.min.js')); ?>

	<?php echo e(Html::script('packages/datatables/plugins/js/numeric-comma.js')); ?>

	
	<?php echo e(Html::script('packages/jquery/js/jquery-ui-1.8.20.custom.min.js')); ?>

	

	<?php echo e(Html::script('packages/dropify/dist/js/dropify.min.js')); ?>

	<?php echo e(Html::script('packages/tinymce/tinymce.min.js')); ?>

	<?php echo e(Html::script('packages/admin/js/main.js')); ?>


	<script type="text/javascript">
		$(document).ready(function(){
			<?php if(Session::has('error_message')): ?>
				Amo.alert('<?php echo e(Session::get("error_message")); ?>', 0);
		  	<?php endif; ?>
		  	
		  	<?php if(Session::has('success_message')): ?>
				Amo.success('<?php echo e(Session::get("success_message")); ?>',0);
		  	<?php endif; ?>

		  	<?php if(Session::has('flash_error_message')): ?>
				Amo.alert('<?php echo e(Session::get("flash_error_message")); ?>',8000);
		  	<?php endif; ?>

		  	<?php if(Session::has('flash_success_message')): ?>
				Amo.success('<?php echo e(Session::get("flash_success_message")); ?>',8000);
		  	<?php endif; ?>

			$('input.combodate').combodate({
			    minYear: 1950,
			    maxYear: <?php echo e(date('Y')); ?> + 1,
			    customClass: 'form-control',
			    smartDays: true,
			    firstItem: 'name'
			});

			$('#scrollToTop').click(function() {
	            $("body,Html").animate({
	                scrollTop: 0
	            }, 600);
	            return false;
	        });

			$(".select2-control").select2();

		});

		function form_submit(name)
		{

		    $("[name=\""+name+"\"]").submit();
		}
	</script>
<?php echo $__env->yieldSection(); ?>