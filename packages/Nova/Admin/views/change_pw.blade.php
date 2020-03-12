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
					<i class="icon-compass"></i>
					Change password
				</header>
				
				<div class="block">
					{{ Form::open(array('route' => 'admin.changePassSubmit', 'class' => 'form-horizontal')) }}
						{{ Form::token() }}
						<div class="form-group">
							<label for="EventName" class="col-lg-2 control-label">Current Password</label>
							<div class="col-lg-3">
								
								<input  value="" class="form-control" name="TxtPassword" type="password" placeholder="Your current password" minlength="6" required="required" />
								@if($errors->has('now_password'))
									{!! $errors->first('now_password', '<p class="help-block error">:message</p>') !!}
								@endif
							</div>
						</div>

						<div class="form-group">

							<label for="linkEvent" class="col-lg-2 control-label">New Password</label>
							<div class="col-lg-3">
								<input value="" class="form-control" name="password" id="password" type="password" placeholder="Your new password" minlength="6" required >
								@if($errors->has('password'))
									{!! $errors->first('password', '<p class="help-block error">:message</p>') !!}
								@endif
							</div>
						</div>

						<div class="form-group">

							<label for="linkEvent" class="col-lg-2 control-label">Confirm New Password</label>
							<div class="col-lg-3">
								<input value="" class="form-control" name="password_confirmation" id="password_confirmation" type="password" placeholder="Confirmation your new password" minlength="6" required >
								@if($errors->has('password_confirmation'))
									{!! $errors->first('password_confirmation', '<p class="help-block error">:message</p>') !!}
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-lg-2"></div>
							<div class="col-lg-3">
								<button id="TxtSubmit" type="submit" class="btn btn-xs btn-small btn-primary">Submit</button>
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

