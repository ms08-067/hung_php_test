@section('content')
<div style="min-height: 470px;">
<div class="row">
<div class="col-md-4"></div>

<div class="col-md-4 box" style="min-height: 450px;">    
    <div class="col-sm-push-2">
            <div style="width: 360px;" class="">
                <h1 class="text-center">Đăng ký mật khẩu mới</h1>
                <br/>
                    
                <fieldset class="push-top-xs">

                    {{ Form::open(array('route' => 'user.reset.password', 'id' => 'userLogin','class'=>'form-horizontal')) }}

                    <div class="form-group no-gutter">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <input disabled="disabled" style="width: 276px;" tabindex="1" type="email" id="TxtEmail" name="TxtEmail" placeholder="Email ..." class="form-control" required="required" value="{{ $user->email }}" />
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="form-group no-gutter">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <input style="width: 276px;" type="password" id="TxtPasswordNew" name="TxtPasswordNew" placeholder="Mật khẩu mới" tabindex="2" class="form-control" required="required" />
                            @if($errors->has('password'))
                                {!! $errors->first('password', '<p class="help-block error">:message</p>') !!}
                            @endif
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="form-group no-gutter">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <input style="width: 276px;" type="password" id="TxtPasswordNew2" name="TxtPasswordNew2" placeholder="Nhập lại mật khẩu mới" tabindex="2" class="form-control" required="required" />
                            @if($errors->has('password_confirmation'))
                                {!! $errors->first('password_confirmation', '<p class="help-block error">:message</p>') !!}
                            @endif
                        </div>
                        <div class="col-md-1"></div>
                    </div>


                    <div class="form-group no-gutter">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <img style="margin-top: -12px;" src="{{ URL::route('captcha') }}" alt="Captcha" class="captcha" />
                        </div>
                    </div>
                    <div class="form-group no-gutter">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <input style="width: 276px;" type="text" name="TxtCaptcha" placeholder="Nhập mã xác nhận" maxlength="4" class="form-control fleft" tabindex="3" required="required" />
                            <div class="clearfix"></div>
                            @if($errors->has('captcha'))
                                {!! $errors->first('captcha', '<p class="help-block error">:message</p>') !!}
                            @endif
                        </div>
                        <div class="col-md-1">
                            <a href="javascript:reloadCaptcha();" title="Tải lại mã xác nhận">
                                <img src="{{ asset('packages/main/img/reload.png') }}" class="fleft reload-captcha" />
                            </a>
                        </div>
                    </div>
                 

                    <div class="form-group no-gutter">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <button type="submit" id="sign_in" tabindex="4" class="btn btn-theme btn-block">Đặt lại khẩu</button>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <input type="hidden" name="forget_key" value="{{ $user->forget_key }}" />
                    {{ Form::close() }}

                    <hr/><br/>
                    <p class="text-center">
                        <a tabindex="4" style="float: left;margin-left: 42px;margin-top: -12px;" class="register" href="{{ URL::route('user.create') }}">Đăng ký thành viên</a> 
                        <a tabindex="5" style="float: right;margin-right: 40px;margin-top: -14px;" href="{{ URL::route('home.guest') }}">Đăng nhập</a></p>
                </fieldset>
            </div>
        </div>
</div><!-- end div.col-md-4-->

<div class="col-md-4"></div>

</div><!-- end div.row -->
</div>
@stop

