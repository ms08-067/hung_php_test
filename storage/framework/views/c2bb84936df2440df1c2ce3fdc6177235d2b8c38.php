<?php $__env->startSection('title'); ?>
	List jobs
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li>
	<a href="<?php echo e(URL::route('admin.home')); ?>">
		List jobs
	</a>
	</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading header-box">
					<i class="icon-bell"></i>
					List jobs
					
					<!-- <span style="float: right;"><a class="btn btn-default" href="<?php echo e(route('admin.exContactFormSubmited')); ?>">Export Exel</a></span> -->
					<span style="float: right;"><a class="btn btn-default" href="<?php echo e(route('admin.newJobs',[0])); ?>">New Job</a></span>

				</header>				
					<div class="pull-out">
						<table class="table table-hover table-striped m-b-none text-small">
							<thead>
								<tr>
									<th width="5">No</th>
									<th>ID</th>
									<th>Job Title</th>
									<th>Short description jobs</th>
									<th>Job Requirement</th>
									<th>Benefit</th>							
									<th>Status</th>
									<th style="width: 160px; text-align: center;">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1;?>
								<?php if(!empty($jobs)): ?>
								<?php foreach ($jobs as $k => $job): ?>
									<tr>
										<td><?php echo e($i++); ?></td>
										<td> <?php echo e($job->id); ?></td>
										<td> <?php echo e($job->job_title); ?></td>	
										<td> 
											<?php $short_des_job = trim(strip_tags($job->short_des_job));?>
											<?php echo e((strlen($short_des_job) > 200) ? substr($short_des_job,0,200)."..." : $short_des_job); ?>

										</td>
										<td> <?php $requirement = trim(strip_tags($job->requirement));?>
											<?php echo e((strlen($requirement) > 200) ? substr($requirement,0,200)."..." : $requirement); ?>

										</td>
										<td> <?php echo e($job->benefit); ?></td>
										<td style="padding-top: 14px;"> <?php echo $job->status == 1 ? '<a rel="'.$job->id.'" data-status="0" style="text-decoration: none;cursor: pointer;" class="statusItem btn-small btn-success">&nbsp;Public&nbsp;</a>' : '<a rel="'.$job->id.'" data-status="1" style="text-decoration: none;cursor: pointer;" class="statusItem btn-small btn-danger">UnPublic</a>'; ?></td>
										<td width="240">
											<a class="btn btn-small btn-default" href="<?php echo e(route('admin.newJobs',[$job->id])); ?>">Config</a>

											<a target="_blank" class="btn btn-small btn-default" href="<?php echo e(route('admin.viewJobs',[$job->id])); ?>">View</a>

											<a class="del_job btn btn-small btn-default" id="del_job_<?php echo e($job->id); ?>" rel="<?php echo e($job->id); ?>" href="javascript:void()" class="confirm-danger">
						        				Delete
						    				</a>
						    			</td>
									</tr>
								<?php endforeach;
									  endif;
								 ?>
							</tbody>
						</table>
						<div style="text-align: center;"><?php echo e($jobs->links()); ?> <span style="float: right;margin-top: 10px;margin-right: 20px;">Total: <?php echo e($jobs->total()); ?></span></div>
					</div>
			</section>
		</div>

	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
##parent-placeholder-b6e13ad53d8ec41b034c49f131c64e99cf25207a##
<script type="text/javascript">
alertify.defaults.transition = "zoom";
	$(".del_job").click(function(){
		var rel = $(this).attr('rel');
		$.confirm({
            message: 'Are you sure you want to delete Job ID:  '+rel+' ?',
            yes: function () {
				$.ajaxExec({
		            url: '<?php echo e(URL::route("admin.delJobSubmited")); ?>',
		            data: {
		                id: rel,
		                _token: '<?php echo e(csrf_token()); ?>'
		            },
		            success: function (data) {
		            	//Amo.alert("Delete success.");
		            	alertify.alert('', data.msg,
		            		function(){ 
		            			location.reload();
		            	});
		            }
		        });
            }
        });
        return false;
	});

	$(".statusItem").click(function(){
		var itemId = $(this).attr("rel");
		var statusItem = $(this).attr("data-status");
		$.ajaxExec({
            url: '<?php echo e(URL::route("admin.updateStatusJob")); ?>',
            data: {
                itemId: itemId,
                statusItem: statusItem,
                _token: '<?php echo e(csrf_token()); ?>'
            },
            success: function (data) {
            	//Amo.alert("Delete success.");
            	alertify.alert('', data.msg,
            		function(){ 
            			location.reload();
            	});
            }
        });
	});

</script>
<?php $__env->stopSection(); ?>







