<?php $__env->startSection('title'); ?>
	List Blog
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li>
	<a href="<?php echo e(URL::route('admin.home')); ?>">
		List Blog
	</a>
	</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
<div class="col-lg-12">

	<section class="panel">
	    <header class="panel-heading header-box">
	        <i class="icon-bell"></i>
	        Search filter
	    </header>
    	<div class="pull-out">
        	<div style="margin-top: 28px;" class="form-group">
            <?php echo e(Form::open(array('route' => 'admin.blogList', 'method' => 'POST', 'id' => 'search_filter', 'class' => 'form-horizontal'))); ?>

            
            <div class="col-lg-2">
                <input autocomplete="off" id="date_from" name="date_from" placeholder="Date From" class="form-control" value="<?php echo e($date_from); ?>" />
            
            </div>

            <div class="col-lg-2">
                <input autocomplete="off" id="date_to" name="date_to" placeholder="Date To" class="form-control" value="<?php echo e($date_to); ?>" />
            </div>

            <div class="col-lg-2">
                <select name="search_by" class="form-control">
                    <option <?php echo e(( ($search_by == "") || ($search_by === null) ) ? 'selected="selected"' : ""); ?> value="">Search By</option>
                    <option <?php echo e($search_by == 1 ? 'selected="selected"' : ""); ?> value="1">Publish Date</option>
                    <option <?php echo e($search_by == 2 ? 'selected="selected"' : ""); ?> value="2">Create Date</option>
                    <option <?php echo e($search_by == 3 ? 'selected="selected"' : ""); ?> value="3">Update Date</option>
                </select>
            </div>

            <div class="col-lg-2">
                <select name="status" class="form-control">
                    <option <?php echo e(( ($status == '') || ($status === null) ) ? 'selected="selected"' : ""); ?> value="">Seclect Status</option>
                    <option <?php echo e($status == 1 ? 'selected="selected"' : ""); ?> value="1">Published</option>
                    <option <?php echo e($status === "0" ? 'selected="selected"' : ""); ?> value="0">Unpublished</option>
                </select>
            </div>

            <div style="padding-top: 6px;" class="col-lg-2">
                <input name="submit" id="TxtSubmit" type="submit" class="btn btn-xs btn-small btn-info" value="Submit">
                
                <?php if($search): ?>
                <button id="TxtReset" onClick="return resetSearchFilter()" type="button" class="btn btn-xs btn-small btn-info">Reset</button>
                <?php endif; ?>
            </div>
            <?php echo e(Form::close()); ?>

        </div>
    </div>

</section>	
			<section class="panel">
				<header class="panel-heading header-box">
					<i class="icon-bell"></i>
					Blog List
				</header>				
					<div class="pull-out">
						<table class="table table-hover table-striped m-b-none text-small">
							<thead>
								<tr>
									<th width="5">No</th>
									<th width="10">ID</th>
									<th width="90">Title</th>
									<th width="90">Intro Text</th>
									<th width="90">Author</th>
									<th width="40">Status</th>
									<th width="120">Publish at</th>
									<th width="120">Created at</th>
									<th width="120">Update at</th>
									<th style="width: 160px; text-align: center;">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1;?>
								<?php if(!empty($listPost)): ?>
								<?php foreach ($listPost as $k => $post): ?>
									<tr>
										<td><?php echo e($i++); ?></td>
										<td> <?php echo e($post->id); ?></td>
										<td> <?php echo e($post->title); ?></td>	
										<td> 
											<?php $intro_txt = trim(strip_tags($post->intro_txt));?>
											<?php echo e((strlen($intro_txt) > 200) ? substr($intro_txt,0,200)."..." : $intro_txt); ?>

										</td>
										<td><?php echo e(user($post->user_id)->name()); ?></td>
										<td style="padding-top: 14px;"> <?php echo $post->status == 1 ? '<a rel="'.$post->id.'" data-status="0" style="text-decoration: none;cursor: pointer;" class="statusItem btn-small btn-success">&nbsp;Public&nbsp;</a>' : '<a rel="'.$post->id.'" data-status="1" style="text-decoration: none;cursor: pointer;" class="statusItem btn-small btn-danger">UnPublic</a>'; ?></td>
										
										<td><?php echo e(!empty($post->published_at) && ($post->published_at != "0000-00-00 00:00:00") ? date('M d, Y H:i', strtotime($post->published_at)) : ""); ?></td>
										<td><?php echo e(date('M d, Y H:i', strtotime($post->created_at))); ?></td>
										<td><?php echo e(date('M d, Y H:i', strtotime($post->updated_at))); ?></td>

										<td width="80">
											<a class="btn btn-small btn-default" href="<?php echo e(route('admin.updateBlog',[$post->id])); ?>">Edit</a>

											<a class="del_blog btn btn-small btn-default" id="del_blog_<?php echo e($post->id); ?>" rel="<?php echo e($post->id); ?>" href="javascript:void()" class="confirm-danger">
						        				Delete
						    				</a>
						    			</td>
									</tr>
								<?php endforeach;
									  endif;
								 ?>
							</tbody>
						</table>
						<div style="text-align: center;"><?php echo e($listPost->links()); ?> <span style="float: right;margin-top: 10px;margin-right: 20px;">Total: <?php echo e($listPost->total()); ?></span></div>
					</div>
			</section>
		</div>

	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
##parent-placeholder-b6e13ad53d8ec41b034c49f131c64e99cf25207a##
<script type="text/javascript">
alertify.defaults.transition = "zoom";

function resetSearchFilter(){
    window.location.href = "<?php echo e(route('admin.blogList')); ?>";
}

$("#date_from").datepicker({
    dateFormat: 'dd-mm-yy',
      //showOn: "both",
      onSelect: function( selectedDate ) {hh:ii
          $("#date_to").datepicker( "option", "minDate", selectedDate);
      }
  });

  $("#date_to").datepicker({
    dateFormat: 'dd-mm-yy',
     // showOn: "both",
      onSelect: function( selectedDate ) {
          $("#date_from").datepicker( "option", "maxDate", selectedDate);
      }
  });

	$(".del_blog").click(function(){
		var rel = $(this).attr('rel');
		$.confirm({
            message: 'Are you sure you want to delete Blog ID:  '+rel+' ?',
            yes: function () {
				$.ajaxExec({
		            url: '<?php echo e(URL::route("admin.delBlogSubmited")); ?>',
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
            url: '<?php echo e(URL::route("admin.publishBlog")); ?>',
            data: {
                itemId: itemId,
                statusItem: statusItem,
                _token: '<?php echo e(csrf_token()); ?>'
            },
            success: function (data) {
            	alertify.alert('', data.msg,
            		function(){ 
            			location.reload();
            	});
            }
        });
	});

</script>
<?php $__env->stopSection(); ?>







