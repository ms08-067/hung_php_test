@section('content')
	<div class="box-4">
		<h2>Thay đổi mật khẩu</h2>
		<div class="tab">
			<ul class="pmgHTabBtn">
	            
	            <li class="pmgPSContent pmgPSSemiB">
	                <a href="{{ URL::route('sa.showIndex') }}">
	                   Thông tin tài khoản
	                </a>
	            </li>

	            <li class="pmgPSContent pmgPSSemiB">
	                <a href="{{ URL::route('home.change.information') }}">
	                   Cập nhật tài khoản
	                </a>
	            </li>
	            <li class="pmgHTabSelected">
	                <a href="{{ URL::route('user.change.password') }}">
	                   Đổi mật khẩu
	                </a>
	            </li>
	        </ul>

	        <div class="clearfix"></div>
        </div><!-- end div.tab -->	

		<div class="wrap-content">
		{{ Form::open(array('route' => 'user.update.password', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'UserUpdatePassword')) }}

			<div class="form-group no-gutter">
				{{ Form::label('lblPassword', 'Mật khẩu cũ', array('class' => 'col-xs-3 control-label')) }}

			    <div class="col-xs-6">
			      	{{ Form::password('TxtPassword', array('class' => 'form-control validate[required, minSize[6]]', 'placeholder' => 'Mật khẩu cũ', 'id' => 'TxtPassword')) }}

			      	@if($errors->has('now_password'))
						{!! $errors->first('now_password', '<p class="help-block error">:message</p>') !!}
					@endif
			    </div>
			</div>

			<div class="form-group no-gutter">
				{{ Form::label('lblPasswordNew', 'Mật khẩu mới', array('class' => 'col-xs-3 control-label')) }}

			    <div class="col-xs-6">
			      	{{ Form::password('TxtPasswordNew', array('class' => 'form-control validate[required, minSize[6]]', 'placeholder' => 'Mật khẩu mới tối thiểu 6 kí tự', 'id' => 'TxtPasswordNew')) }}

			      	@if($errors->has('password'))
						{!! $errors->first('password', '<p class="help-block error">:message</p>') !!}
					@endif
			    </div>
			</div>
			<div class="form-group no-gutter">
				{{ Form::label('lblPasswordNew2', 'Nhập lại mật khẩu mới', array('class' => 'col-xs-3 control-label')) }}
			    <div class="col-xs-6">
			      	{{ Form::password('TxtPasswordNew2', array('class' => 'form-control validate[required, minSize[6], equals[TxtPasswordNew]]', 'placeholder' => 'Nhập lại mật khẩu mới', 'id' => 'TxtPasswordNew2')) }}
			    </div>
			</div>

			<div class="form-group no-gutter">
			    <label for="Captcha" class="col-xs-3 control-label"> Mã xác nhận
			    	<div class="clearfix"></div>
			    </label>

			    <div class="col-xs-6">
                    <img src="{{ URL::route('captcha') }}" alt="Captcha" class="captcha" />
			    </div>
			</div>

			<div class="form-group no-gutter">
			    <label for="TxtCaptcha" class="col-xs-3 control-label">Nhập mã xác nhận</label>

			    <div class="col-xs-6">
			      	<input type="text" name="TxtCaptcha" id="TxtCaptcha" placeholder="Nhập mã xác nhận" maxlength="4" class="form-control validate[required] fleft" autocomplete="off" />
			      	@if($errors->has('captcha'))
						{!! $errors->first('captcha', '<p class="help-block error">:message</p>') !!}
					@endif
					
					<a class="fleft" href="javascript:reloadCaptcha();" title="Tải lại mã xác nhận">
						<img src="{{ asset('packages/main/img/reload.png') }}" class="fleft reload-captcha" />
					</a>
			    </div>
		    </div>
			
			<div class="form-group no-gutter">
			    <div class="col-xs-3"></div>
			    <div class="col-xs-6">
			      	<button type="submit" class="btn btn-theme2">
			      		Đồng ý
			      	</button>
			    </div>
			</div>
		{{ Form::close() }}
		</div> <!-- end div.wrap-content -->
	</div>
@stop

@section('javascript')
	@parent

	<script type="text/javascript">
		$(document).ready(function(){
			$("#TxtCaptcha").focus();
			$("#UserUpdatePassword").validationEngine(CustomValidationEngine.config);
		});
	</script>
@stop