<?php $__env->startSection('title'); ?>
	The list of email template
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
	<li>
		<a href="<?php echo e(URL::current()); ?>">
			List email template
		</a>
	</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-lg-12">
				<section class="panel m-t-small">
					<header class="panel-heading header-box">
						<i class="icon-bell"></i>
						List of email template
						
						<div class="pull-right">
							<a class="btn btn-primary btn-small" href="<?php echo e(URL::route('admin.addEmailTemplate', array('id'=>0))); ?>">
								New Email Template
							</a>
						</div>
						
					</header>
					<div class="pull-out">
						<div class="">
								<table class="table table-hover table-striped m-b-none text-small">
									<thead>
										<tr>
											<th>ID</th>
											<th>Slug</th>
											<th>Price</th>
											<th width="280">Subject</th>
											<th width="320">Description</th>
											<th>Created at</th>
											<th>Updated at</th>
											<th width="170">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $__currentLoopData = $list_template; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $temp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
										<tr>
											<td><?php echo e($temp->id); ?></td>
											<td><?php echo e($temp->slug); ?></td>
											<td>$<?php echo e(number_format($temp->price/100)); ?></td>
											<td><?php echo e($temp->subject); ?></td>
											<td><?php echo e($temp->description); ?></td>
											<td><?php echo e(!empty($temp->created_at) ? date("M d, Y H:i",strtotime($temp->created_at)) : ""); ?></td>
											<td><?php echo e(!empty($temp->updated_at) ? date("M d, Y H:i",strtotime($temp->updated_at)) : ""); ?></td>
											<td>
												<a target="_blank" href="<?php echo e(URL::route('admin.viewEmail',array('id'=>$temp->id))); ?>">
													View
												</a>
												&nbsp;|&nbsp;

												<a href="<?php echo e(URL::route('admin.addEmailTemplate',array('id'=>$temp->id))); ?>">
													Update
												</a>
												&nbsp;|&nbsp;
												
												<a href="<?php echo e(URL::route('admin.delEmailTemplate', ['tem_id' => $temp->id ])); ?>" class="confirm-danger">
							        				Delete
							    				</a>
												
											</td>
										</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</tbody>
								</table>
								<div style="text-align: center;"><?php echo e($list_template->links()); ?> <span style="float: right;margin-top: 10px;margin-right: 20px;">Total: <?php echo e($list_template->total()); ?></span></div>
						</div>
					</div>
				</section>
		</div>
	</div>
<?php $__env->stopSection(); ?>