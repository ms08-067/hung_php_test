@section('title')
	List Form
@stop

@section('breadcrumb')
<li>
	<a href="{{ URL::route('admin.home') }}">
		List Purchase Website 
	</a>
	</li>
@stop

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading header-box">
					<i class="icon-bell"></i>
					List Purchase Website
					
					<!-- <span style="float: right;"><a class="btn btn-default" href="{{ route('admin.exContactFormSubmited') }}">Export Exel</a></span> -->
					<span style="float: right;"><a class="btn btn-default" href="{{ route('admin.updateTemplate',[0]) }}">New Website</a></span>

				</header>				
					<div class="pull-out">
						<table class="table table-hover table-striped m-b-none text-small">
							<thead>
								<tr>
									<th width="5">No</th>
									<th>ID</th>
									<th>Name</th>
									<th>Country</th>
									<th>Phone</th>
									<th>Email</th>									
									<th>Member Link</th>
									<th>Domain</th>
									<td>Type</td>
									<!-- <th>Date submited</th>
									<th>Price</th> -->
									<th style="width: 160px; text-align: center;">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1;?>
								<?php if(!empty($formpayment)): ?>
								<?php foreach ($formpayment as $k => $frm): ?>
									<tr>
										<td>{{$i++}}</td>
										<td> {{ $frm->id }}</td>
										<td> {{ $frm->name }}</td>	
										<td> {{ $frm->country }}</td>
										<td> {{ $frm->phone }}</td>
										<td> {{ $frm->email }}</td>
										<td> {{ $frm->member_link }}</td>
										<?php //$notify = ($frm->notify == 1) ? "Yes" : ($frm->notify == 0 ? "No" : ''); ?>
										<td>{{ $frm->domain }}</td>
										<td>
											{{ $frm->come_from == 1 ? "Form Purchase Website" : "New Config in Admin page" }}

										</td>
										<!-- <td> {{ date('M d, Y H:i', strtotime($frm->created_at)) }}</td>
										<td>$247</td> -->
										<td>
											
											<a class="btn btn-small btn-default" href="{{ route('admin.updateTemplate',['id' => $frm->id]) }}">Config</a>

											<a class="del_frmPay btn btn-small btn-default" id="del_frm_{{ $frm->id }}" rel="{{ $frm->id }}" href="javascript:void()" class="confirm-danger">
						        				Delete
						    				</a>
						    				<!--  |
						    				<a target="_blank" href="{{ route('admin.viewfrmSubmit',['id' => $frm->id]) }}">View </a> -->
						    			</td>
									</tr>
								<?php endforeach;
									  endif;
								 ?>
							</tbody>
						</table>
						<div style="text-align: center;">{{ $formpayment->links() }} <span style="float: right;margin-top: 10px;margin-right: 20px;">Total: {{ $formpayment->total() }}</span></div>
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
	$(".del_frmPay").click(function(){
		var rel = $(this).attr('rel');
		$.confirm({
            message: 'Are you sure you want to delete ID:  '+rel+' ?',
            yes: function () {
				$.ajaxExec({
		            url: '{{ URL::route("admin.delFormSubmited") }}',
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
</script>
@stop







