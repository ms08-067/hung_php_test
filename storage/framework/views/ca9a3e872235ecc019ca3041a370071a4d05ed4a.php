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

					Create New Form

				</header>				

					<div class="pull-out">

						<div style="margin-top: 50px;margin-bottom: 50px;" class="col-lg-11">

							

							<?php echo e(Form::open(array('route' => 'admin.newForm.Submit', 'id'=>'newForm', 'class' => 'form-horizontal'))); ?>

							

							<div class="form-group">

								<label class="col-lg-2 control-label">Note:</label>

								<div class="col-lg-10">

									<?php echo e(Form::textarea( 'note', isset($frm->note) ? $frm->note : old('note'), array('id' => 'note', 'class' => 'form-control', 'rows' => 3,'col'=>10, 'placeholder' => 'Note '))); ?>



									<?php if($errors->has('note')): ?>

										<?php echo $errors->first('note', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>

								</div>

							</div>



							<div class="form-group">

								<label class="col-lg-2 control-label">Subject:</label>

								<div class="col-lg-10">

									<?php echo e(Form::text( 'subject', isset($frm->subject) ? $frm->subject : old('subject'), array('id' => 'subject', 'class' => 'form-control', 'required' => 'required', 'placeholder' => ''))); ?>



									<?php if($errors->has('subject')): ?>

										<?php echo $errors->first('subject', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>

								</div>

							</div>



							<div class="form-group">

								<label  class="col-lg-2 control-label">Mail from</label>

								<div class="col-lg-10">

									<?php echo e(Form::text('mail_from', isset($frm->mail_from) ? $frm->mail_from : old('mail_from'), array('id' => 'mail_from','class' => 'form-control','placeholder'=>"Mail from, example: abc@gmail.com"))); ?>



									<?php if($errors->has('mail_from')): ?>

										<?php echo $errors->first('mail_from', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>

								</div>

							</div>



							<div class="form-group">

								<label  class="col-lg-2 control-label">From name</label>

								<div class="col-lg-10">

									<?php echo e(Form::text('from_name', isset($frm->from_name) ? $frm->from_name : old('from_name'), array('id' => 'from_name','class' => 'form-control','placeholder'=>"ezwebmanifesting.com"))); ?>



									<?php if($errors->has('from_name')): ?>

										<?php echo $errors->first('from_name', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>

								</div>

							</div>



							<div class="form-group">

								<label  class="col-lg-2 control-label">URL Redirect</label>

								<div class="col-lg-10">

									<?php echo e(Form::text('url_redirect', isset($frm->url_redirect) ? $frm->url_redirect : old('url_redirect'), array('id' => 'from_name','class' => 'form-control','placeholder'=>"URL redirect after send email"))); ?>



									<?php if($errors->has('url_redirect')): ?>

										<?php echo $errors->first('url_redirect', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>

								</div>

							</div>



							<div class="form-group">

								<label data-toggle="tooltip" data-placement="top" title="The message display after sent email if you don't want redirect to other page." class="col-lg-2 control-label">Message display:</label>

								<div class="col-lg-10">

									<?php echo e(Form::textarea( 'message', isset($frm->message) ? $frm->message : (!empty(old('message')) ? old('message') : 'You email has been sent successfully. Thank you for your communication.' ), array('id' => 'message', 'class' => 'form-control', 'rows' => 3,'col'=>10, 'placeholder' => "The message display after sent email if you don't want redirect to other page."))); ?>



									<?php if($errors->has('message')): ?>

										<?php echo $errors->first('message', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>

								</div>

							</div>





							<div class="form-group">

								<label data-toggle="tooltip" data-placement="top" title="URL redirect when error send email." class="col-lg-2 control-label">URL Error Redirect</label>

								<div class="col-lg-10">

									<?php echo e(Form::text('url_redirect_err', isset($frm->url_redirect_err) ? $frm->url_redirect_err : old('url_redirect_err'), array('id' => 'from_name','class' => 'form-control','placeholder'=>"URL redirect when error send email"))); ?>



									<?php if($errors->has('url_redirect_err')): ?>

										<?php echo $errors->first('url_redirect_err', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>

								</div>

							</div>



							<div class="form-group">

								<label data-toggle="tooltip" data-placement="top" title="The message display if send email problem and you don't want redirect." class="col-lg-2 control-label">Error display:</label>

								<div class="col-lg-10">

									<?php echo e(Form::textarea( 'error_msg', isset($frm->error_msg) ? $frm->error_msg : (!empty(old('error_msg')) ? old('error_msg') : 'Send email problem, please contact admin.' ), array('id' => 'error_msg', 'class' => 'form-control', 'rows' => 3,'col'=>10, 'placeholder' => "The message will be display if send email problem."))); ?>



									<?php if($errors->has('error_msg')): ?>

										<?php echo $errors->first('error_msg', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>

								</div>

							</div>



							<div class="form-group">

								<label  class="col-lg-2 control-label">Admin email</label>

								<div class="col-lg-10">

									<?php echo e(Form::text('admin_email', isset($frm->admin_email) ? $frm->admin_email : old('admin_email'), array('id' => 'admin_email','class' => 'form-control','required' => 'required','placeholder'=>"Admin email, example: abc@gmail.com,email2@gmail.com"))); ?>



									<?php if($errors->has('admin_email')): ?>

										<?php echo $errors->first('admin_email', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>

								</div>

							</div>



							<div class="form-group">

							<label  class="col-lg-2 control-label">Content email</label>



							<div class="col-lg-10">



								<?php echo e(Form::textarea('content', isset($frm) && is_object($frm) ? $frm->content : old('content'), array('class' => 'tinymce form-control', 'rows' => 8,'col'=>10, 'id'=>'content'))); ?>



								<?php if($errors->has('content')): ?>

									<?php echo $errors->first('content', '<p class="help-block error">:message</p>'); ?>

								<?php endif; ?>

							</div>

						</div>

							<div class="form-group">

								<div class="col-lg-2"></div>

								<div style="text-align: left;" class="col-lg-10">

									<!-- <button name="submit" type="submit" class="btn btn-primary" value="0">Submit</button> -->

									<button name="submit" type="submit" class="btn btn-success" value="1">Save</button>

									<button name="submit" type="submit" class="btn btn-primary" value="2">Save & Close</button>

									<a style="background: #ccc;" href="<?php echo e(route('admin.listForm')); ?>" class="btn btn-default"> Cancel </a>

								</div>

							</div>	

							<?php echo e(Form::hidden('frmID', isset($frm->id)?$frm->id:0, array("id"=> "frmID") )); ?>

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

		$("#frm_videoId").val("");

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



