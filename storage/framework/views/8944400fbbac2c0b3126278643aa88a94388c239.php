<?php $__env->startSection('title'); ?>
	List video
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
	<li>
		<a href="<?php echo e(URL::route('admin.home')); ?>">
			Video Vimeo
		</a>
	</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-lg-12">
					
			<section class="panel">
				<header class="panel-heading header-box">
					<i class="icon-compass"></i>
					Change password
				</header>
				
				<div class="block">
					<?php echo e(Form::open(array('route' => 'admin.changePassSubmit', 'class' => 'form-horizontal'))); ?>
						<?php echo e(Form::token()); ?>
						<div class="form-group">
							<label for="EventName" class="col-lg-2 control-label">Current Password</label>
							<div class="col-lg-3">
								
								<input  value="" class="form-control" name="TxtPassword" type="password" placeholder="Your current password" minlength="6" required="required" />
								<?php if($errors->has('now_password')): ?>
									<?php echo $errors->first('now_password', '<p class="help-block error">:message</p>'); ?>
								<?php endif; ?>
							</div>
						</div>

						<div class="form-group">

							<label for="linkEvent" class="col-lg-2 control-label">New Password</label>
							<div class="col-lg-3">
								<input value="" class="form-control" name="password" id="password" type="password" placeholder="Your new password" minlength="6" required >
								<?php if($errors->has('password')): ?>
									<?php echo $errors->first('password', '<p class="help-block error">:message</p>'); ?>
								<?php endif; ?>
							</div>
						</div>

						<div class="form-group">

							<label for="linkEvent" class="col-lg-2 control-label">Confirm New Password</label>
							<div class="col-lg-3">
								<input value="" class="form-control" name="password_confirmation" id="password_confirmation" type="password" placeholder="Confirmation your new password" minlength="6" required >
								<?php if($errors->has('password_confirmation')): ?>
									<?php echo $errors->first('password_confirmation', '<p class="help-block error">:message</p>'); ?>
								<?php endif; ?>
							</div>
						</div>

						<div class="form-group">
							<div class="col-lg-2"></div>
							<div class="col-lg-3">
								<button id="TxtSubmit" type="submit" class="btn btn-xs btn-small btn-primary">Submit</button>
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

