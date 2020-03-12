@section('title')Form Payment Config@stop

@section('breadcrumb')
<li>
	<a href="{{ URL::route('admin.home') }}">Email template</a>
</li>
@stop
@section('content')



	<div class="row">



		<div class="col-lg-12">



					



			<section class="panel">



				<header class="panel-heading header-box">
					<i class="icon-bell"></i>
					Email template
					<!-- <span style="float: right;"><a class="btn btn-primary" href="{{ route('admin.newForm') }}">New Form</a></span> -->
				</header>				
					<div class="pull-out">
						<table class="table table-hover table-striped m-b-none text-small">
							<thead>
								<tr>
									<th>ID</th>
									<th>Note</th>
									<th>Subject</th>
									<th>Mail from</th>
									<th>From name</th>
									<th width="100">Admin Email</th>
									<th>Create at</th>
									<th>Updated at</th>
									<th style="text-align: center;width: 180px;">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1;?>
								<?php if(!empty($listForm)): ?>
								<?php foreach ($listForm as $k => $frm): ?>
									<tr>
										<td> {{ $frm->id }}</td>
										<td> {{ $frm->note }}</td>
										<td> {{ $frm->subject }}</td>
										<td> {{ $frm->mail_from }}</td>
										<td> {{ $frm->from_name }}</td>
										<td> {{ $frm->admin_email }}</td>
										<td> {{ date('M d, Y H:i', strtotime($frm->created_at)) }} </td>
										<td> {{ date('M d, Y H:i', strtotime($frm->updated_at)) }} </td>
										<td width="240">
						    				<a class="btn btn-small btn-default" id="update_frm_{{ $frm->id }}" rel="{{ $frm->id }}" href="{{ route('admin.newForm',['id'=>$frm->id]) }}">



						        				update



						    				</a>

						    				<a class="btn btn-small btn-default" target="_blank" href="{{ route('admin.viewEmail',['id' => $frm->id]) }}">View content email </a>







										</td>



									</tr>



								<?php endforeach;



									  endif;



								 ?>



							</tbody>



						</table>



						<div style="text-align: center;">{{ $listForm->links() }} <span style="float: right;margin-top: 10px;margin-right: 20px;">Total: {{ $listForm->total() }}</span></div>



					</div>



				



			</section>



		</div>



	</div>







	<div style="display: none;">



		<div id="changeChannelWindow" title="Change channel" class="input-form dialog-form">



			



			{{-- Form::open(array('route' => 'admin.ChangeCategory', 'id'=>'changeChannel', 'class' => 'form-horizontal')) --}}



				<div class="form-group">



					<label class="col-lg-4 control-label">Video ID:</label>



					<div class="col-lg-8">



						{{-- Form::text( 'channelId_origin', "", array('id' => 'channelId_origin', 'class' => 'form-control', 'required' => 'required',"disabled" => "disabled")) --}}



					</div>



				</div>







				<div class="form-group">



					<label class="col-lg-4 control-label">Origin Category:</label>



					<div class="col-lg-8">



						{{-- Form::select('origin_channelTitle', $arr_customChannel, 0, array('id' => 'origin_channelTitle','class' => 'form-control', "disabled" => "disabled")) --}}



					</div>



				</div>







				<div class="form-group">



					<label class="col-lg-4 control-label">Change Category To:</label>



					<div class="col-lg-8">



						{{-- Form::select('channelId', $arr_customChannel, 0, array('id' => 'channelId','class' => 'form-control')) --}}



					</div>



				</div>







				<div class="form-group">



					<label class="col-lg-4 control-label">Show for Customer:</label>



					<div class="col-lg-8">



						{{-- Form::select('member_type', [0 => "Show for all customer", 1 => "Series Subscription", 2 => "All Content Subscription"], 0, array('id' => 'member_type','class' => 'form-control')) --}}



					</div>



				</div>







				{{-- Form::hidden('video_id', "", array("id"=> "video_id") ) }}	



			{{ Form::close() --}}			



		</div>



	</div>











	<div style="display: none;">



		<div id="AddCustomChannelWindow" title="Add Category" class="input-form dialog-form">



			



			{{-- Form::open(array('route' => 'admin.storeVimeoChanel', 'id'=>'addCustomChannel', 'class' => 'form-horizontal')) --}}







				<div class="form-group">



					<label class="col-lg-4 control-label">Name:</label>



					<div class="col-lg-6">



						{{-- Form::text( 'title', "", array('id' => 'title', 'class' => 'form-control', 'required' => 'required')) --}}



					</div>



				</div>







				<div class="form-group">



					<label style="margin-top: 4px;" class="col-lg-4 control-label">Category ID:</label>



					<div style="margin-top: 4px;" class="col-lg-6">



						



						{{-- Form::text( 'channelId', $customChannelID, array('id' => 'customChannelID', 'class' => 'form-control', 'required' => 'required', 'readonly' => 'readonly')) --}}



					</div>



					<div style="margin-top: 6px; padding-left: 0px;" class="col-lg-2">



				    	<a href="javascript:refeshCustomChannelId();" title="Reload Category ID">



							<img src="{{-- asset('packages/main/img/reload.png') --}}" class="fleft reload-captcha" />



						</a>



				    </div>



			    </div>







			    <div class="form-group">



					<label style="margin-top: 2px;" class="col-lg-4 control-label">Show for Customer:</label>



					<div class="col-lg-6">



						{{-- Form::select('member_type', ["-1" => "Default Setting", 0 => "Show for all customer", 1 => "Series Subscription", 2 => "All Content Subscription"], -1, array('id' => 'member_type','class' => 'form-control')) --}}



					</div>



				</div>







				<div class="form-group">



					<label class="col-lg-4 control-label">Public:</label>



					<div class="col-lg-6">



						{{ Form::checkbox( 'public_flag', 1, true, array("class"=>"public_flag",'id' => 'public_flag')) }}



					</div>



				</div>



				



			{{-- Form::close() --}}			



		</div>



		



	



		<div id="AddVimeoVideoWindow" title="Add Vimeo Video" class="input-form dialog-form">



			



			{{ Form::open(array('route' => 'AdminVideo.addSingleVimeoSubmit', 'id'=>'addSingleVimeoSubmit', 'class' => 'form-horizontal')) }}







				<div class="form-group">



					<label class="col-lg-4 control-label">Video ID:</label>



					<div class="col-lg-6">



						{{-- Form::text( 'videoId', "", array('id' => 'add_vimeo_videoId', 'class' => 'form-control', 'placeholder'=>'Input Video Id of Vimeo', 'required' => 'required')) --}}



					</div>



				</div>







				<div class="form-group">



					<label style="margin-top: 4px;" class="col-lg-4 control-label">Category:</label>



					<div style="margin-top: 4px;" class="col-lg-6">



						{{-- Form::select('channelId', $arr_customChannel, 0 , array('id' => 'add_vimeo_ChannelId','class' => 'form-control')) --}}



					</div>



			    </div>







			    <div class="form-group">



					<label style="margin-top: 2px;" class="col-lg-4 control-label">Show for Customer:</label>



					<div class="col-lg-6">



						{{ Form::select('member_type', [0 => "Show for all customer", 1 => "Series Subscription", 2 => "All Content Subscription"], 0, array('id' => 'member_type','class' => 'form-control')) }}



					</div>



				</div>







				<div class="form-group">



					<label class="col-lg-4 control-label">Public:</label>



					<div class="col-lg-6">



						{{ Form::checkbox( 'public_flag', 1, true, array("class"=>"public_flag",'id' => 'public_flag')) }}



					</div>



				</div>



				



			{{ Form::close() }}			



		</div>



	</div>







@stop







@section('javascript')



@parent



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



	







	$(document).ready(function(){







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















	});







	



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



            message: 'Are you sure you want to delete?',



            yes: function () {







				$.ajaxExec({



		            url: '{{ URL::route("admin.delForm") }}',



		            data: {



		                id: rel,



		                _token: '{{ csrf_token() }}'



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



	



@stop







