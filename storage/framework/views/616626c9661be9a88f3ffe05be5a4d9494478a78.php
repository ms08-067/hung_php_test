<?php $__env->startSection('title'); ?>Job Apply <?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li>
	<a href="<?php echo e(URL::route('admin.home')); ?>">
		Position Apply
	</a>
	</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading header-box">
					<i class="icon-bell"></i>
					Position Apply
					<!-- <span style="float: right;"><a class="btn btn-default" href="<?php echo e(route('admin.exContactFormSubmited')); ?>">Export Exel</a></span> -->
				</header>				
					<div class="pull-out">
						<table class="table table-hover table-striped m-b-none text-small">
							<thead>
								<tr>
									<th width="5">No</th>
									<th>ID</th>
									<th>Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Position</th>
									<th>Resume</th>
									<th>Date submited</th>
									<th>Action </th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1;?>
								<?php if(!empty($listApplyJob)): ?>
								<?php foreach ($listApplyJob as $k => $apply): ?>
									<tr>
										<td><?php echo e($i++); ?></td>
										<td> <?php echo e($apply->id); ?></td>
										<td> <?php echo e($apply->name); ?></td>	
										<td> <?php echo e($apply->email); ?></td>
										<td> <?php echo e($apply->phone); ?></td>
										<td><?php  
										
										$job = \Nova\Admin\Models\Jobs::where("id",$apply->job_id)->first();

										echo isset($job->job_title) ? $job->job_title : ""; 

										?></td>
										<td><?php 
											if(!empty($apply->resume))
											echo '<a class="btn btn-small btn-default" href="'.(asset("uploads")."/".$apply->resume).'" target="_blank">'.$apply->resume.'</a>';

										?></td>
										<td> <?php echo e(date('M d, Y H:i', strtotime($apply->created_at))); ?></td>
										<td>
											<a class="del_apply btn btn-small btn-default" id="del_apply_<?php echo e($apply->id); ?>" rel="<?php echo e($apply->id); ?>" href="javascript:void()" class="confirm-danger">
						        				Delete
						    				</a>
										</td>
									</tr>
								<?php endforeach;
									  endif;
								 ?>
							</tbody>
						</table>
						<div style="text-align: center;"><?php echo e($listApplyJob->links()); ?> <span style="float: right;margin-top: 10px;margin-right: 20px;">Total: <?php echo e($listApplyJob->total()); ?></span></div>
					</div>
			</section>
		</div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
##parent-placeholder-b6e13ad53d8ec41b034c49f131c64e99cf25207a##
<script type="text/javascript">
alertify.defaults.transition = "zoom";
$(".del_apply").click(function(){
	var rel = $(this).attr('rel');
	$.confirm({
        message: 'Are you sure you want to delete ID:  '+rel+' ?',
        yes: function () {
			$.ajaxExec({
	            url: '<?php echo e(URL::route("admin.delApplySubmited")); ?>',
	            data: {
	                id: rel,
	                _token: '<?php echo e(csrf_token()); ?>'
	            },
	            success: function (data) {
	            	//amo.alert("Delete success.");
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
</script>
<?php $__env->stopSection(); ?>
