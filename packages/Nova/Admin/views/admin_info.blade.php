@section('title')
	Admin Info
@stop

@section('breadcrumb')
	<li>
		<a href="{{ URL::route('admin.home') }}">
			PDF List
		</a>
	</li>
@stop

@section('content')
	<div class="row">
		<div class="col-lg-12">
					
			<section class="panel">
				<header class="panel-heading header-box">
					<i class="icon-compass"></i>
					Admin Info
				</header>
				
				<div class="block">
					{{ Form::open(array('route' => 'admin.adminInfoSubmit', 'class' => 'form-horizontal')) }}
						{{ Form::token() }}
						<div class="form-group">
							<label for="EventName" class="col-lg-2 control-label">Admin name</label>
							<div class="col-lg-6">
								
								<input value="{{ !empty($admin->admin_name) ? $admin->admin_name : 'Ez Web Company' }}" class="form-control" name="admin_name" required="required" minlength="3" type="text" placeholder="Admin name"/>
								@if($errors->has('admin_name'))
									{!! $errors->first('admin_name', '<p class="help-block error">:message</p>') !!}
								@endif
							</div>
						</div>

						<div class="form-group">

							<label for="linkEvent" class="col-lg-2 control-label">Admin email</label>
							<div class="col-lg-6">
								<input value="{{ !empty($admin->admin_email) ? $admin->admin_email : 'ezweb.company@protonmail.com,ezwebtools@gmail.com' }}" class="form-control" name="admin_email" required="required" id="admin_email" type="text" placeholder="Receiver email of notify_admin_remain_one_book" >
								@if($errors->has('admin_email'))
									{!! $errors->first('admin_email', '<p class="help-block error">:message</p>') !!}
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-lg-2"></div>
							<div class="col-lg-3">
								<button id="TxtSubmit" type="submit" class="btn btn-xs btn-small btn-primary">Submit</button>

								<a style="background: #ccc;" href="{{ route('admin.home') }}" class="btn btn-default btn-small"> Cancel </a>
							</div>
						</div>
						
					{{ Form::close() }}

				</div>
				
			</section>
		</div>
	</div>
@stop

@section('javascript')
@parent
<script type="text/javascript">
		
</script>
	
@stop

