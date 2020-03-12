@section('content')
<?php //dd($); ?>
<div style="min-height: 470px;">
<div class="row">
<div class="col-md-4"></div>
<div class="col-md-4 box" style="min-height: 450px;">
    
<div class="col-sm-push-2">
            <div style="width: 360px;" class="">
                <h1 class="text-center">Lấy lại mật khẩu</h1>
                <br/>
                    <p class="text-center">Nhập email bạn đã đăng ký</p><br/>
                <fieldset class="push-top-xs">

                    {{ Form::open(array('route' => 'user.forgetSubmit', 'id' => 'userLogin','class'=>'form-horizontal')) }}

                    <div class="form-group no-gutter">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <input style="width: 276px;" tabindex="1" type="email" id="TxtEmail" name="TxtEmail" placeholder="Email ..." class="form-control" required="required" value="{{ Request()->old('TxtEmail') }}" />
                            @if($errors->has('emailE'))
                                {!! $errors->first('emailE', '<p class="help-block error">:message</p>') !!}
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
                            <button type="submit" id="sign_in" tabindex="4" class="btn btn-theme btn-block">Reset Password</button>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    {{ Form::close() }}
                    <br/>
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

@section('css')
@parent
<style type="text/css">
    div#footer {
        min-height: 50px;
    }
</style>
@stop

