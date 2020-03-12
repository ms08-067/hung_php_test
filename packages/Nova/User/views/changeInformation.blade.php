@section('content')
	<div class="box-4">
		<h2>Cập nhật thông tin cá nhân</h2>
		<div class="tab">
			<ul class="pmgHTabBtn">
	            
	            <li class="pmgPSContent pmgPSSemiB">
	                <a class="pmgPSContent pmgPSSemiB" href="{{ URL::route('sa.showIndex') }}">
	                   Thông tin tài khoản
	                </a>
	            </li>

	            <li class="pmgHTabSelected">
	                <a class="pmgPSContent pmgPSSemiB" href="{{ URL::route('home.change.information') }}">
	                   Cập nhật tài khoản
	                </a>
	            </li>

	           

	            <li class="pmgPSContent pmgPSSemiB">
	                <a class="pmgPSContent pmgPSSemiB" href="{{ URL::route('user.change.password') }}">
	                   Đổi mật khẩu
	                </a>
	            </li>
	        </ul>

	        <div class="clearfix"></div>
        </div><!-- end div.tab -->

        <div class="wrap-content row">
		{{ Form::open(array('route' => 'user.update.information', 'class' => 'form-horizontal', 'role' => 'form', 'style'=>'width: 100%;', 'id' => 'userUpdateInformation')) }}

			<div class="form-group no-gutter">
			    <label class="col-xs-3 control-label">Tên Hiển Thị</label>

			    <div class="col-sm-6">

			      	{{ Form::text('display_name', !empty(Auth::user()->display_name) ? Auth::user()->display_name : Auth::user()->f_name, array('class' => 'form-control validate[required]', 'id' => 'display_name', 'placeholder' => 'Tên hiển thị')) }}

			      	@if($errors->has('display_name'))
						{!! $errors->first('display_name', '<p class="help-block error">:message</p>') !!}
					@endif
			    </div>
			</div>

			<div class="form-group no-gutter">
				{{ Form::label('TxtFullname', 'Họ và tên', array('class' => 'col-xs-3 control-label')) }}
			    <div class="">
		            	{{ Form::text('f_name', Auth::user()->f_name, array('class' => 'form-control validate[required, maxSize[200]]', 'style'=>'width: 160px; float: left;', 'id' => 'f_name', 'placeholder' => 'Họ', 'maxlength' => 100)) }}
				      	@if($errors->has('f_name'))
							{!! $errors->first('f_name', '<p class="help-block error">:message</p>') !!}
						@endif

						{{ Form::text('l_name', Auth::user()->l_name, array('class' => 'form-control validate[required, maxSize[200]]', 'style'=>'width: 140px;', 'id' => 'l_name', 'placeholder' => 'Họ', 'maxlength' => 100)) }}
				      	@if($errors->has('l_name'))
							{!! $errors->first('l_name', '<p class="help-block error">:message</p>') !!}
						@endif
		            
			    </div>
			</div>

			<div class="form-group no-gutter">
			    {{ Form::label('TxtGender', 'Giới tính', array('class' => 'col-xs-3 control-label')) }}

			    <div class="col-md-6">
		      		<div class="checkbox fleft">
				    	@if(Auth::user()->gender == 1)
				      		{{ Form::radio('TxtGender', '1', true) }}
						@else
							{{ Form::radio('TxtGender', '1') }}
						@endif

					    <label for="TxtGender" class="label-1">
				      		Nam
					    </label>
					</div>

					<div class="checkbox fleft">
			      		@if(Auth::user()->gender == 2)
				      		{{ Form::radio('TxtGender', '2', true) }}
						@else
							{{ Form::radio('TxtGender', '2') }}
						@endif

					    <label for="TxtGender" class="label-1">
				      		Nữ
					    </label>
					</div>

					<div class="checkbox fleft">
				      	@if(Auth::user()->gender == 0)
				      		{{ Form::radio('TxtGender', '0', true) }}
						@else
							{{ Form::radio('TxtGender', '0') }}
						@endif

					    <label for="TxtGender" class="label-1">
				      		Khác
					    </label>
					</div>

					<div class="clearfix"></div>

					@if($errors->has('gender'))
						{!! $errors->first('gender', '<p class="help-block error">:message</p>') !!}
					@endif
			    </div>
			</div>

			<div class="form-group no-gutter">
			    {{ Form::label('TxtBirthday', 'Ngày sinh', array('class' => 'col-xs-3 control-label')) }}

			    <div class="form-inline">
			      	{{ Form::text('TxtBirthday', Request()->old('TxtBirthday', Auth::user()->showBirthday()), array('class' => 'form-control combodate', 'id' => 'TxtBirthday', 'data-format' => 'DD-MM-YYYY', 'data-template' => 'DD MMMM YYYY')) }}

			      	@if($errors->has('birthday'))
						{!! $errors->first('birthday', '<p class="help-block error">:message</p>') !!}
					@endif

			    </div>

			</div>

			<div class="form-group no-gutter">
			    <label class="col-xs-3 control-label">Số điện thoại</label>

			    <div class="col-sm-6">

			      	{{ Form::text('TxtMobile', Auth::user()->mobile, array('class' => 'form-control', 'id' => 'TxtMobile', 'placeholder' => 'Số điện thoại')) }}

			      	@if($errors->has('mobile'))
						{!! $errors->first('mobile', '<p class="help-block error">:message</p>') !!}
					@endif
			    </div>
			</div>

			<div class="form-group no-gutter">
			    {{ Form::label('TxtAddress', 'Địa chỉ', array('class' => 'col-xs-3 control-label')) }}

			    <div class="col-xs-6">
			      	{{ Form::text('TxtAddress', Auth::user()->address, array('class' => 'form-control validate[maxSize[400]]', 'id' => 'TxtAddress', 'placeholder' => 'Nhập địa chỉ đầy đủ', 'maxlength' => 200)) }}

			      	@if($errors->has('address'))
						{!! $errors->first('address', '<p class="help-block error">:message</p>') !!}
					@endif
			    </div>
			</div>

			<div class="form-group no-gutter">
			    {{ Form::label('TxtCity', 'Thành phố', array('class' => 'col-xs-3 control-label')) }}

			    <div class="col-xs-6">
			      	<select name="TxtCity" id="TxtCity" class="form-control validate[ min[1]]">
			      		{!! \Trihtm\Option\CityOption::render(Request()->old('TxtCity', Auth::user()->city_id)) !!}
			      	</select>

			      	@if($errors->has('city'))
						{!! $errors->first('city', '<p class="help-block error">:message</p>') !!}
					@endif
			    </div>
			</div>

			@if(isset($requireCaptcha))
				<!-- captcha -->
				<div class="form-group no-gutter">
				    <label for="Captcha" class="col-xs-3 control-label">
				    	Mã xác nhận
				    	<div class="clearfix"></div>
				    </label>

				    <div class="col-xs-6">
                        <img src="{{ URL::route('captcha') }}" alt="Captcha" class="captcha" />
				    </div>
				</div>

				<div class="form-group no-gutter">
				    <label for="TxtCaptcha" class="col-xs-3 control-label">Nhập mã xác nhận</label>

				    <div class="col-xs-8">
				      	<input type="text" name="TxtCaptcha" id="TxtCaptcha" placeholder="Nhập mã xác nhận" maxlength="4" class="form-control validate[required] fleft" autocomplete="off" />
						
				      	@if($errors->has('captcha'))
							{!! $errors->first('captcha', '<p class="help-block error">:message</p>') !!}
						@endif

						<a class="fleft" href="javascript:reloadCaptcha();" title="Tải lại mã xác nhận">
							<img src="{{ asset('packages/main/img/reload.png') }}" class="fleft reload-captcha" />
						</a>
				    </div>
			    </div>
				<!-- ./ end captcha -->
			@endif

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
	<script type="text/javascript" src="{{ asset('packages/momentjs/moment.min.1.7.2.js') }}"></script>
	<script type="text/javascript" src="{{ asset('packages/momentjs/moment.vi.js') }}"></script>
	<script type="text/javascript" src="{{ asset('packages/combodate/combodate.js') }}"></script>

	<script type="text/javascript">
		$(document).ready(function(){

			@if(Auth::user()->fullname == '')
				$("#TxtFullname").focus();
			@elseif(Auth::user()->address == '')
				$("#TxtAddress").focus();
			@else
				$("#TxtCaptcha").focus();
			@endif

			$('input.combodate').combodate({
			    minYear: 1950,
			    maxYear: {{ date('Y') }},
			    customClass: 'form-control',
			    smartDays: true,
			    firstItem: 'name'
			});

			$("#userUpdateInformation").validationEngine(CustomValidationEngine.config);
		});
	</script>
@stop