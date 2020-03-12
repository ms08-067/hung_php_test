<?php use App\Models\Events; ?>



<?php $__env->startSection('title'); ?>



	List Form



<?php $__env->stopSection(); ?>







<?php $__env->startSection('breadcrumb'); ?>



	<li>



		<a href="<?php echo e(URL::route('admin.home')); ?>">



			List Form



		</a>



	</li>



<?php $__env->stopSection(); ?>







<?php $__env->startSection('content'); ?>



	<div class="row">



		<div class="col-lg-12">



					



			<section class="panel">



				<header class="panel-heading header-box">



					<i class="icon-bell"></i>



					Setting For Stripe button Webmaster Plan



				</header>				



					<div class="pull-out">



						<div style="margin-top: 20px;margin-bottom: 20px;" class="col-lg-11">

							<div class="form-group">
							 <div class="col-lg-2"></div>
							 <div class="col-lg-10">
							 	
							 	<p> This is setting for title, description and price for Stripe button Web master plan </p>
							 </div>
							</div>


							<?php echo e(Form::open(array('route' => 'admin.webPlanSubmit', 'id'=>'newForm', 'class' => 'form-horizontal'))); ?>

							<div class="form-group">
								<label class="col-lg-2 control-label">Description:</label>
								<div class="col-lg-5">
									<?php echo e(Form::textarea( 'des', isset($webplan->des) ? $webplan->des : old('des'), array('id' => 'des', 'class' => 'form-control', 'rows' => 3,'col'=>10, 'placeholder' => 'Description... '))); ?>

									<?php if($errors->has('des')): ?>
										<?php echo $errors->first('des', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>
								</div>
							</div>

<div class="form-group">
	<label class="col-lg-2 control-label">Title button:</label>
	<div class="col-lg-5">
		<?php echo e(Form::text( 'title', isset($webplan->title) ? $webplan->title : old('title', "$99 Webmaster Plan"), array('id' => 'title', 'class' => 'form-control', 'required' => 'required', 'placeholder' => ''))); ?>


		<?php if($errors->has('title')): ?>
			<?php echo $errors->first('title', '<p class="help-block error">:message</p>'); ?>


		<?php endif; ?>
	</div>

</div>

<div class="form-group">
	<label  class="col-lg-2 control-label">Price:</label>
	<div class="col-lg-5">
		<?php echo e(Form::text('price', isset($webplan->price) ? $webplan->price : old('price',"9900"), array('id' => 'price','class' => 'form-control','placeholder'=>"price"))); ?>


		<?php if($errors->has('price')): ?>

		<?php echo $errors->first('price', '<p class="help-block error">:message</p>'); ?>

		<?php endif; ?>
		<span style="position: absolute;right: 0px;right: -24px; top: 10px;">(Cent)</span>
	</div>
</div>

<div class="form-group">
	<label  class="col-lg-2 control-label">URL After Paymment:</label>
	<div class="col-lg-5">
		<?php echo e(Form::text('url_redirect', isset($webplan->url_redirect) ? $webplan->url_redirect : old('url_redirect',""), array('id' => 'url_redirect','class' => 'form-control','placeholder'=>"Url to Form after Payment"))); ?>


		<?php if($errors->has('url_redirect')): ?>

		<?php echo $errors->first('url_redirect', '<p class="help-block error">:message</p>'); ?>

		<?php endif; ?>
	</div>
</div>
							
<div class="form-group">
	<div class="col-lg-2"></div>
	<div style="text-align: left;" class="col-lg-10">
		
		<button name="submit" type="submit" class="btn btn-success" value="1">Save</button>

		<button name="submit" type="submit" class="btn btn-primary" value="2">Save & Close</button>
	</div>
</div>	
<?php echo e(Form::hidden('webplanID', isset($webplan->id)?$webplan->id:1, array("id"=> "webplanID") )); ?>


<?php echo e(Form::close()); ?>


					</div>
				</div>
		</section>
	</div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
##parent-placeholder-b6e13ad53d8ec41b034c49f131c64e99cf25207a##
<script type="text/javascript">
	// $(function(){



	// 	$('[data-toggle="tooltip"]').tooltip();

	// });

	function refeshCustomChannelId(){



		$.get("refest-custom-channelId.html", function(data, status){



            $("#customChannelID").val(data);



        });



		



	}	







	function resetSearchFilter(){



		//document.getElementById('search_filter').reset();



		$("#webplan_videoId").val("");



		$("#filter_channelId").val(0);



		$("#search_filter").submit();



	}



	







	$(document).ready(function(){



		



		$('[data-toggle="tooltip"]').tooltip();







		$("#channelId").change(function(){



			$("#title").val($("#channelId option:selected").text());



		});







		$(".change_channel").on("click", function(){



			



			var video_id = $(this).attr("rel");



			$("#video_id").val(video_id);







			$("#channelId").val($(this).attr("channelId"));



			$("#member_type").val($(this).attr("member_type"));







			$.get("get-video-vimeo-"+video_id, function(data, status){







				$("#channelId_origin").val(data.videoId);



				$("#origin_channelTitle").val(data.channelId);



	        });







	        $('#changeChannelWindow').openDialog({



		            autoOpen: false,



		            title: "Change Category",



		            height: 360,



		            width: 500,



		            modal: true,



		            open: function () {



		               



		            },



		            buttons: {



		                'Cancel': function () {



		                    $(this).dialog('close');



		                },



		                'Submit': function () {



		                    $("#changeChannel").submit();



		                }



		            }



	        	});



        	$('#changeChannelWindow').dialog('option', 'position', 'center');



        	$('#changeChannelWindow').dialog('open');







		});







		if( $(".checkbox_video").not(':checked').length > 0 )



		{



			$(".checkAll").attr("checked",false);	



		} else {



			$(".checkAll").attr("checked",true);	



		}







		$(".checkAll").click(function(){



			



			if($(this).is(':checked')){







				$(".checkbox_video").val(1).attr("checked",true);



				var list_id = [];



				$(".checkbox_video").each(function(){



					var rel = $(this).attr('rel');



					list_id.push(rel);



				});



				updateStatusVideo(list_id,1);







			} else{







				$(".checkbox_video").val(0).attr("checked",false);



				var list_id = [];



				$(".checkbox_video").each(function(){



					var rel = $(this).attr('rel');



					list_id.push(rel);



				});



				updateStatusVideo(list_id,0);



			}







		});







		$(".checkbox_video").change(function() {



		    



		    var rel = $(this).attr('rel');



		    if($(this).is(':checked')) {



		        $("#video_"+rel).val(1);



		        updateStatusVideo([rel],1);



		    }else{



		    	$("#channel_"+rel).val(0);



		    	updateStatusVideo([rel],0);



		    }



			



		});







	});

function updateStatusVideo(list_id, val){

		console.log("list_id:"+list_id);



		console.log("val: "+val);







		$.ajaxExec({







            url: '<?php echo e(URL::route("admin.publishVimeo")); ?>',



            data: {



                list_id: list_id,



                v: val,



                _token: '<?php echo e(csrf_token()); ?>'



            },



            success: function (data) {



                $.displayInfor(data.msg, null,  function() {



					location.reload();



				});



				//Amo.alert(data.msg);



            }



        });



        



	}







	$(".delete_video").click(function(){



		var rel = $(this).attr('rel');



		$.confirm({



            message: 'Are you sure you want to delete?',



            yes: function () {



				$.ajaxExec({



		            url: '<?php echo e(URL::route("admin.delVideoVimeo")); ?>',



		            data: {



		                id: rel,



		                _token: '<?php echo e(csrf_token()); ?>'



		            },



		            success: function (data) {



		            	location.reload();



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
