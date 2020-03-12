<?php $__env->startSection('title'); ?>



	List Form



<?php $__env->stopSection(); ?>







<?php $__env->startSection('breadcrumb'); ?>
<li>
	<a href="<?php echo e(URL::route('admin.home')); ?>">
		List Form Submited
	</a>
	</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading header-box">
					<i class="icon-bell"></i>
					List Form Submited 
					<span style="float: right;"><a class="btn btn-primary" href="<?php echo e(route('admin.exContactFormSubmited')); ?>">Export Exel</a></span>
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
									<th>Message</th>
									<th>Date submited</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1;?>
								<?php if(!empty($formSubmited)): ?>
								<?php foreach ($formSubmited as $k => $frm): ?>
									<tr>
										<td><?php echo e($i++); ?></td>
										<td> <?php echo e($frm->id); ?></td>
										<td> <?php echo e($frm->name); ?></td>
										<td> <?php echo e($frm->email); ?></td>
										<td> <?php echo e($frm->phone); ?></td>
										<td> <?php echo e($frm->msg); ?></td>
										<td> <?php echo e(date('M d, Y H:i', strtotime($frm->created_at))); ?></td>
										<td>
											<a class="del_frm" id="del_frm_<?php echo e($frm->id); ?>" rel="<?php echo e($frm->id); ?>" href="javascript:void()" class="confirm-danger">
						        				Delete
						    				</a><!--  |
						    				<a target="_blank" href="<?php echo e(route('admin.viewfrmSubmit',['id' => $frm->id])); ?>">View </a> -->
						    			</td>
									</tr>
								<?php endforeach;
									  endif;
								 ?>
							</tbody>
						</table>
						<div style="text-align: center;"><?php echo e($formSubmited->links()); ?> <span style="float: right;margin-top: 10px;margin-right: 20px;">Total: <?php echo e($formSubmited->total()); ?></span></div>
					</div>
			</section>
		</div>



	</div>







	<div style="display: none;">



		<div id="changeChannelWindow" title="Change channel" class="input-form dialog-form">



			



			



				<div class="form-group">



					<label class="col-lg-4 control-label">Video ID:</label>



					<div class="col-lg-8">



						



					</div>



				</div>







				<div class="form-group">



					<label class="col-lg-4 control-label">Origin Category:</label>



					<div class="col-lg-8">



						



					</div>



				</div>







				<div class="form-group">



					<label class="col-lg-4 control-label">Change Category To:</label>



					<div class="col-lg-8">



						



					</div>



				</div>







				<div class="form-group">



					<label class="col-lg-4 control-label">Show for Customer:</label>



					<div class="col-lg-8">



						



					</div>



				</div>







							



		</div>



	</div>











	<div style="display: none;">



		<div id="AddCustomChannelWindow" title="Add Category" class="input-form dialog-form">



			



			







				<div class="form-group">



					<label class="col-lg-4 control-label">Name:</label>



					<div class="col-lg-6">



						



					</div>



				</div>







				<div class="form-group">



					<label style="margin-top: 4px;" class="col-lg-4 control-label">Category ID:</label>



					<div style="margin-top: 4px;" class="col-lg-6">



						



						



					</div>



					<div style="margin-top: 6px; padding-left: 0px;" class="col-lg-2">



				    	<a href="javascript:refeshCustomChannelId();" title="Reload Category ID">



							<img src="" class="fleft reload-captcha" />



						</a>



				    </div>



			    </div>







			    <div class="form-group">



					<label style="margin-top: 2px;" class="col-lg-4 control-label">Show for Customer:</label>



					<div class="col-lg-6">



						



					</div>



				</div>







				<div class="form-group">



					<label class="col-lg-4 control-label">Public:</label>



					<div class="col-lg-6">



						<?php echo e(Form::checkbox( 'public_flag', 1, true, array("class"=>"public_flag",'id' => 'public_flag'))); ?>




					</div>



				</div>



				



						



		</div>



		



	



		<div id="AddVimeoVideoWindow" title="Add Vimeo Video" class="input-form dialog-form">



			



			<?php echo e(Form::open(array('route' => 'AdminVideo.addSingleVimeoSubmit', 'id'=>'addSingleVimeoSubmit', 'class' => 'form-horizontal'))); ?>








				<div class="form-group">



					<label class="col-lg-4 control-label">Video ID:</label>



					<div class="col-lg-6">



						



					</div>



				</div>







				<div class="form-group">



					<label style="margin-top: 4px;" class="col-lg-4 control-label">Category:</label>



					<div style="margin-top: 4px;" class="col-lg-6">



						



					</div>



			    </div>







			    <div class="form-group">



					<label style="margin-top: 2px;" class="col-lg-4 control-label">Show for Customer:</label>



					<div class="col-lg-6">



						<?php echo e(Form::select('member_type', [0 => "Show for all customer", 1 => "Series Subscription", 2 => "All Content Subscription"], 0, array('id' => 'member_type','class' => 'form-control'))); ?>




					</div>



				</div>







				<div class="form-group">



					<label class="col-lg-4 control-label">Public:</label>



					<div class="col-lg-6">



						<?php echo e(Form::checkbox( 'public_flag', 1, true, array("class"=>"public_flag",'id' => 'public_flag'))); ?>




					</div>



				</div>



				



			<?php echo e(Form::close()); ?>			



		</div>



	</div>







<?php $__env->stopSection(); ?>







<?php $__env->startSection('javascript'); ?>



##parent-placeholder-b6e13ad53d8ec41b034c49f131c64e99cf25207a##



<script type="text/javascript">



alertify.defaults.transition = "zoom";







	// function refeshCustomChannelId(){



	// 	$.get("refest-custom-channelId.html", function(data, status){



 //            $("#customChannelID").val(data);



 //        });



		



	// }	







	// function resetSearchFilter(){



	// 	$("#frm_videoId").val("");



	// 	$("#filter_channelId").val(0);



	// 	$("#search_filter").submit();



	// }


	/*



	$(".del_frm").click(function(){



		alertify.confirm('', 



        '<h4 style="color: #d9534f;font-size: 14px;line-height: 24px;"><span style="text-decoration: underline;">Chú ý</span>: Xóa giải đấu sẽ xóa luôn danh sách người chơi đã nhập cho giải đấu</h4>',



      function(){ 



            $.post("admin/contest/delContest",{



                contest_id: contest_id



            }, function(data, status){



                if(data.status){



                    location.reload();



                    alertify.success('Xóa thành công.')



                }else{



                    alertify.success('Xóa thất bại.')



                }



            });



        }, 



        function(){ 



          //alertify.error('Cancel')



      }).set('labels', {ok:'Đồng ý', cancel:'Hủy'});



	});



	*/



	



	$(".del_frm").click(function(){



		var rel = $(this).attr('rel');



		$.confirm({



            message: 'Are you sure you want to delete contact submited ID:  '+rel+' ?',



            yes: function () {







				$.ajaxExec({



		            url: '<?php echo e(URL::route("admin.delFormSubmited")); ?>',



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



	



	



$("#add_custom_channel").on("click", function(){







	if( $("#customChannelID").val().length != 24){



		refeshCustomChannelId();



	}







	$('#AddCustomChannelWindow').openDialog({



        autoOpen: false,



        title: "Add Category",



        height: 330,



        width: 500,



        modal: true,



        open: function () {



           



        },



        buttons: {



            'Cancel': function () {



                $(this).dialog('close');



            },



            'Submit': function () {



                $("#addCustomChannel").submit();



            }



        }



	});







	$('#AddCustomChannelWindow').dialog('option', 'position', 'center');



	$('#AddCustomChannelWindow').dialog('open');







});	







$("#add_vimeo_video").on("click", function(){







	$('#AddVimeoVideoWindow').openDialog({



        autoOpen: false,



        title: "Add Vimeo Video",



        height: 340,



        width: 500,



        modal: true,



        open: function () {



           



        },



        buttons: {



            'Cancel': function () {



                $(this).dialog('close');



            },



            'Submit': function () {



                $("#addSingleVimeoSubmit").submit();



            }



        }



	});







	$('#AddVimeoVideoWindow').dialog('option', 'position', 'center');



	$('#AddVimeoVideoWindow').dialog('open');







});











</script>



	



<?php $__env->stopSection(); ?>







