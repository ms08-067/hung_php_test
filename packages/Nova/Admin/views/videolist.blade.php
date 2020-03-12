<?php use App\Models\Events; ?>
@section('title')
	List video
@stop

@section('breadcrumb')
	<li>
		<a href="{{ URL::route('admin.home') }}">
			Video Vimeo
		</a>
	</li>
@stop

@section('content')
	<div class="row">
		<div class="col-lg-12">
			
			<section class="panel">
				<header class="panel-heading header-box">
					<i class="icon-bell"></i>
					Search filter
					<span id="add_custom_channel" style="float: right;cursor: pointer;"><i class="icon-plus" aria-hidden="true"></i> Add Category</span>

					<span id="add_vimeo_video" style="float: right;cursor: pointer;"><i class="icon-plus" aria-hidden="true"></i> Add Vimeo Video |</span>
				</header>
				<div class="pull-out">
					<div style="margin-top: 28px;" class="form-group">
						{{ Form::open(array('route' => Route::currentRouteName(), 'method' => 'GET', 'id' => 'search_filter', 'class' => 'form-horizontal')) }}
						<div class="col-lg-2">
							{{ Form::text( 'videoId', isset($arr_condition["videoId"]) ? $arr_condition["videoId"] : "", array('class' => 'form-control', "id" => "frm_videoId","placeholder" => "Input videoId")) }}
						</div>
						<div class="col-lg-4">
							{{ Form::select('channelId', $arr_customChannel, isset($arr_condition["channelId"]) ? $arr_condition["channelId"] : 0 , array('id' => 'filter_channelId','class' => 'form-control')) }}
						</div>
						<div style="padding-top: 6px;" class="col-lg-2">
							<button id="TxtSubmit" type="submit" class="btn btn-xs btn-small btn-info">Submit</button>
							<button id="TxtReset" onClick="return resetSearchFilter()" type="button" class="btn btn-xs btn-small btn-info">Reset</button>
						</div>
						{{ Form::close() }}
					</div>
				</div>
			</section>
					
			<section class="panel">
				<header class="panel-heading header-box">
					<i class="icon-bell"></i>
					Vimeo video list
				</header>

				@if(count($list_video) > 0)
					<div class="pull-out">
						<table class="table table-hover table-striped m-b-none text-small">
							<thead>
								<tr>
									<th width="5">No</th>
									<th width="5">{{ Form::checkbox('checkAll', 'value', false, ['class'=>'checkAll']) }}
									</th>
									<th>ID</th>
									<th>Video ID</th>
									<th>Title</th>
									<th>Show On Member</th>
									<th>Category</th>
									<th>Create Date</th>
									<th>Vimeo Upload Date</th>
									<th>Action</th>
								</tr>
							</thead>

							<tbody>
								<?php $i=1;?>
								@foreach ($list_video as $video) 
									@if(is_object($video))
									<tr>
										<td>{{$i++}}</td>
										<td title="Click to publish or unpublish Video"> {{ Form::checkbox('video_'.$video->id, $video->public_flag, ($video->public_flag ? true : false) , ['rel'=>$video->id, 'class'=>'checkbox_video', 'id' => 'video_'.$video->id] ) }}	
										</td>
										<td> {{ $video->id }}</td>

										<td>{!! "<a href='https://vimeo.com/".$video->videoId."' target='_blank'>".$video->videoId."</a>" !!}</td>

										<td> <span title="{{ $video->title }}">{{ (strlen($video->title) > 22) ? substr($video->title,0,22)."..." : $video->title }}</span></td>
										<td>{{ ($video->member_type == 0) ? "Show for all customer" : ($video->member_type == 1 ? "Series Subscription" : "All Content Subscription") }}</td>
										<td>{{ $video->channel->title }}</td>

										<td> {{ date('M d, Y H:i', strtotime($video->created_at)) }} </td>
										<td> {{ date('M d, Y H:i', strtotime($video->upload_date)) }} </td>
										<td>
						    				<a class="delete_video" id="delete_video_{{ $video->id }}" rel="{{ $video->id }}" href="javascript:void()" class="confirm-danger">
						        				Delete
						    				</a> | 

						    				<a member_type="{{$video->member_type}}" channelId="{{$video->channelId}}" class="change_channel" id="change_channel_{{ $video->id }}" rel="{{ $video->id }}" href="javascript:void()">
						        				Change Category
						    				</a>

										</td>
									</tr>
									@endif
								@endforeach
							</tbody>
						</table>
						<div style="text-align: center;">{{ $list_video->appends($arr_condition)->links() }} <span style="float: right;margin-top: 10px;margin-right: 20px;">Total: {{ $list_video->total() }}</span></div>
					</div>
				@endif
			</section>
		</div>
	</div>

	<div style="display: none;">
		<div id="changeChannelWindow" title="Change channel" class="input-form dialog-form">
			
			{{ Form::open(array('route' => 'admin.ChangeCategory', 'id'=>'changeChannel', 'class' => 'form-horizontal')) }}
				<div class="form-group">
					<label class="col-lg-4 control-label">Video ID:</label>
					<div class="col-lg-8">
						{{ Form::text( 'channelId_origin', "", array('id' => 'channelId_origin', 'class' => 'form-control', 'required' => 'required',"disabled" => "disabled")) }}
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-4 control-label">Origin Category:</label>
					<div class="col-lg-8">
						{{ Form::select('origin_channelTitle', $arr_customChannel, 0, array('id' => 'origin_channelTitle','class' => 'form-control', "disabled" => "disabled")) }}
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-4 control-label">Change Category To:</label>
					<div class="col-lg-8">
						{{ Form::select('channelId', $arr_customChannel, 0, array('id' => 'channelId','class' => 'form-control')) }}
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-4 control-label">Show for Customer:</label>
					<div class="col-lg-8">
						{{ Form::select('member_type', [0 => "Show for all customer", 1 => "Series Subscription", 2 => "All Content Subscription"], 0, array('id' => 'member_type','class' => 'form-control')) }}
					</div>
				</div>

				{{ Form::hidden('video_id', "", array("id"=> "video_id") ) }}	
			{{ Form::close() }}			
		</div>
	</div>


	<div style="display: none;">
		<div id="AddCustomChannelWindow" title="Add Category" class="input-form dialog-form">
			
			{{ Form::open(array('route' => 'admin.storeVimeoChanel', 'id'=>'addCustomChannel', 'class' => 'form-horizontal')) }}

				<div class="form-group">
					<label class="col-lg-4 control-label">Name:</label>
					<div class="col-lg-6">
						{{ Form::text( 'title', "", array('id' => 'title', 'class' => 'form-control', 'required' => 'required')) }}
					</div>
				</div>

				<div class="form-group">
					<label style="margin-top: 4px;" class="col-lg-4 control-label">Category ID:</label>
					<div style="margin-top: 4px;" class="col-lg-6">
						
						{{ Form::text( 'channelId', $customChannelID, array('id' => 'customChannelID', 'class' => 'form-control', 'required' => 'required', 'readonly' => 'readonly')) }}
					</div>
					<div style="margin-top: 6px; padding-left: 0px;" class="col-lg-2">
				    	<a href="javascript:refeshCustomChannelId();" title="Reload Category ID">
							<img src="{{ asset('packages/main/img/reload.png') }}" class="fleft reload-captcha" />
						</a>
				    </div>
			    </div>

			    <div class="form-group">
					<label style="margin-top: 2px;" class="col-lg-4 control-label">Show for Customer:</label>
					<div class="col-lg-6">
						{{ Form::select('member_type', ["-1" => "Default Setting", 0 => "Show for all customer", 1 => "Series Subscription", 2 => "All Content Subscription"], -1, array('id' => 'member_type','class' => 'form-control')) }}
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
		
	
		<div id="AddVimeoVideoWindow" title="Add Vimeo Video" class="input-form dialog-form">
			
			{{ Form::open(array('route' => 'AdminVideo.addSingleVimeoSubmit', 'id'=>'addSingleVimeoSubmit', 'class' => 'form-horizontal')) }}

				<div class="form-group">
					<label class="col-lg-4 control-label">Video ID:</label>
					<div class="col-lg-6">
						{{ Form::text( 'videoId', "", array('id' => 'add_vimeo_videoId', 'class' => 'form-control', 'placeholder'=>'Input Video Id of Vimeo', 'required' => 'required')) }}
					</div>
				</div>

				<div class="form-group">
					<label style="margin-top: 4px;" class="col-lg-4 control-label">Category:</label>
					<div style="margin-top: 4px;" class="col-lg-6">
						{{ Form::select('channelId', $arr_customChannel, 0 , array('id' => 'add_vimeo_ChannelId','class' => 'form-control')) }}
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

            url: '{{ URL::route("admin.publishVimeo") }}',
            data: {
                list_id: list_id,
                v: val,
                _token: '{{ csrf_token() }}'
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
		            url: '{{ URL::route("admin.delVideoVimeo") }}',
		            data: {
		                id: rel,
		                _token: '{{ csrf_token() }}'
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
	
@stop

