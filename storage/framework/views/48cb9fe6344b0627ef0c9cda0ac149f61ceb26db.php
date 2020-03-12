<?php $__env->startSection('title'); ?>
	Admin Info
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
	<li>
		<a href="<?php echo e(URL::route('admin.home')); ?>">
			PDF List
		</a>
	</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-lg-12">
					
			<section class="panel">
				<header class="panel-heading header-box">
					<i class="icon-compass"></i>
					Admin Info
				</header>
				
				<div class="block">
					<?php echo e(Form::open(array('route' => 'admin.adminInfoSubmit', 'class' => 'form-horizontal'))); ?>

						<?php echo e(Form::token()); ?>

						<div class="form-group">
							<label for="EventName" class="col-lg-2 control-label">Admin name</label>
							<div class="col-lg-6">
								
								<input value="<?php echo e(!empty($admin->admin_name) ? $admin->admin_name : 'Ez Web Company'); ?>" class="form-control" name="admin_name" required="required" minlength="3" type="text" placeholder="Admin name"/>
								<?php if($errors->has('admin_name')): ?>
									<?php echo $errors->first('admin_name', '<p class="help-block error">:message</p>'); ?>

								<?php endif; ?>
							</div>
						</div>

						<div class="form-group">

							<label for="linkEvent" class="col-lg-2 control-label">Admin email</label>
							<div class="col-lg-6">
								<input value="<?php echo e(!empty($admin->admin_email) ? $admin->admin_email : 'ezweb.company@protonmail.com,ezwebtools@gmail.com'); ?>" class="form-control" name="admin_email" required="required" id="admin_email" type="text" placeholder="Receiver email of notify_admin_remain_one_book" >
								<?php if($errors->has('admin_email')): ?>
									<?php echo $errors->first('admin_email', '<p class="help-block error">:message</p>'); ?>

								<?php endif; ?>
							</div>
						</div>

						<div class="form-group">
							<div class="col-lg-2"></div>
							<div class="col-lg-3">
								<button id="TxtSubmit" type="submit" class="btn btn-xs btn-small btn-primary">Submit</button>

								<a style="background: #ccc;" href="<?php echo e(route('admin.home')); ?>" class="btn btn-default btn-small"> Cancel </a>
							</div>
						</div>
						
					<?php echo e(Form::close()); ?>


				</div>
				
			</section>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
##parent-placeholder-b6e13ad53d8ec41b034c49f131c64e99cf25207a##
<script type="text/javascript">
		
</script>
	
<?php $__env->stopSection(); ?>

