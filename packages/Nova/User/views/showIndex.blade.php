@section('content')

	<div class="box-4">
		<h2>Thông tin tài khoản</h2>

		<div class="tab">
			<ul class="pmgHTabBtn">
	            
	            <li class="pmgHTabSelected">
	                <a class="pmgPSContent pmgPSSemiB" href="{{ URL::route('sa.showIndex') }}">
	                   Thông tin tài khoản
	                </a>
	            </li>

	            <li class="pmgPSContent pmgPSSemiB">
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

		<div class="wrap-content">
			<form class="form-horizontal">
				
				@if( (time() >= strtotime(Auth::user()->expired_at)) || ( (strtotime(Auth::user()->created_at) + 86400 * config('main.freeDay')) < strtotime(Auth::user()->expired_at) ) )
				<!-- <div class="form-group no-gutter">
				    <label class="col-xs-3 control-label">
				    	Thời gian sử dụng đến:
				    </label>

				    <div class="col-md-6">
				      	<div class="fake_input readonly">
							{{ date("d-m-Y H:i:s", strtotime(Auth::user()->expired_at)) }}
						</div>
				    </div>
				</div> -->
				@endif
				

				<div class="form-group no-gutter">
				    <label class="col-xs-3 control-label">
				    	Tên Hiển Thị
				    </label>

				    <div class="col-md-6">
				      	<div class="fake_input readonly">
							<input type="text" value="{{ !empty(Auth::user()->display_name) ? Auth::user()->display_name : Auth::user()->f_name }}" readonly="readonly" />
							<a href="{{ URL::route('home.change.information') }}" class="change_btn">Sửa</a>
						</div>
				    </div>
				</div>

				<div class="form-group no-gutter">
				    <label class="col-xs-3 control-label">
				    	Họ và tên
				    </label>

				    <div class="col-md-6">
				      	<div class="fake_input readonly">
							<input type="text" value="{{ Auth::user()->f_name.' '. Auth::user()->l_name }}" readonly="readonly" />

							<a href="{{ URL::route('home.change.information') }}" class="change_btn">Sửa</a>
						</div>
				    </div>
				</div>

				<div class="form-group no-gutter">
				     <label class="col-xs-3 control-label">
				    	Giới tính
				    </label>

				    <div class="col-md-6">
			      		<div class="checkbox fleft">
					    	@if(Auth::user()->gender == 1)
					      		<input name="TxtGender" type="radio" id="TxtGender" readonly="readonly" disabled="disabled" checked="checked">

							    <label for="TxtGender" class="label-1">
						      		Nam
							    </label>
						    @else
								<input name="TxtGender" type="radio" id="TxtGender" readonly="readonly" disabled="disabled">

							    <label for="TxtGender" class="label-1">
						      		Nam
							    </label>
						    @endif
					    </div>

					    <div class="checkbox fleft">
						   @if(Auth::user()->gender == 2)
					      		<input name="TxtGender" type="radio" id="TxtGender" readonly="readonly" disabled="disabled" checked="checked">

							    <label for="TxtGender" class="label-1">
						      		Nữ
							    </label>
						    @else
								<input name="TxtGender" type="radio" id="TxtGender" readonly="readonly" disabled="disabled">

							    <label for="TxtGender" class="label-1">
						      		Nữ
							    </label>
						    @endif
					    </div>

						<div class="checkbox fleft">
						    @if(Auth::user()->gender != 1 && Auth::user()->gender != 2)
					      		<input name="TxtGender" type="radio" id="TxtGender" readonly="readonly" disabled="disabled" checked="checked">

							    <label for="TxtGender" class="label-1">
						      		Khác
							    </label>
						    @else
								<input name="TxtGender" type="radio" id="TxtGender" readonly="readonly" disabled="disabled">

							    <label for="TxtGender" class="label-1">
						      		Khác
							    </label>
						    @endif
						</div>

						<div class="clearfix"></div>
				    </div>
				</div>

				<div class="form-group no-gutter">
				    <label class="col-xs-3 control-label">
				    	Ngày sinh
				    </label>

				    <div class="col-md-6">
				      	<div class="fake_input readonly @if(!Auth::user()->hasBirthday()) input-red @endif">
							<input type="text" value="@if(!Auth::user()->hasBirthday()) Chưa cập nhật @else {{ Auth::user()->showBirthday() }} @endif" readonly="readonly">

							<a href="{{ URL::route('home.change.information') }}" class="change_btn">Sửa</a>
						</div>
				    </div>
				</div>

				<div class="form-group no-gutter">
				    <label class="col-xs-3 control-label">
				    	Địa chỉ
				    </label>

				    <div class="col-md-6">
				      	<div class="fake_input readonly @if(Auth::user()->address == '') input-red @endif">
							<input type="text" value="@if(Auth::user()->address == '') Chưa cập nhật @else {{ Auth::user()->address }} @endif" readonly="readonly">

							<a href="{{ URL::route('home.change.information') }}" class="change_btn">Sửa</a>
						</div>
				    </div>
				</div>

				<div class="form-group no-gutter">
				    <label class="col-xs-3 control-label">
				    	Thành phố
				    </label>

				    <div class="col-md-6">
				      	<div class="fake_input readonly @if(Auth::user()->city_id <= 0) input-red @endif">
							<input type="text" value="@if(Auth::user()->city_id <= 0) Chưa cập nhật @else {{ \Trihtm\Option\CityOption::getName(Auth::user()->city_id) }} @endif" readonly="readonly">

							<a href="{{ URL::route('home.change.information') }}" class="change_btn">Sửa</a>
						</div>
				    </div>
				</div>
			</form>

			<h3>Thông tin bảo mật</h3>

			<form class="form-horizontal">
			<br/>
				<div class="form-group no-gutter">
				    <label class="col-xs-3 control-label">
				    	Email
				    </label>

				    <div class="col-md-6">
				      	<div class="fake_input readonly">
							<input type="text" value="{{ Auth::user()->showEmail() }}" readonly="readonly">
						</div>
				    </div>
				</div>
				
				

				<div class="form-group no-gutter">
				    <label class="col-xs-3 control-label">
				    	Số di động
				    </label>

				    <div class="col-md-6">
				      	<div class="fake_input readonly @if(Auth::user()->canChangeMobile()) input-red @endif">
							<input type="text" value="@if(Auth::user()->canChangeMobile()) Chưa cập nhật @else {{ Auth::user()->showMobile() }} @endif" readonly="readonly">

							<a href="{{ URL::route('home.change.information') }}" class="change_btn">Sửa</a>
						</div>
				    </div>
				</div>

			</form>

		</div>
	</div>

@stop

@section('content-mobile')

	@yield('content')

@stop