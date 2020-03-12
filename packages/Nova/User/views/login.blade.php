@section('content')
<div style="min-height: 470px;">
<div class="row">

<div class="col-md-3"></div>

<div class="col-md-6 box" style="min-height: 470px;">  
<div class="col-sm-push-2">
            <div>
                <br/>
                <h1 style="margin-bottom: 50px;" class="text-center">Sigin To Post Your Aricle</h1>
                    
                  
                    {{ Form::open(array('route' => 'user.loginSubmit', 'id' => 'userLogin','class'=>'form-horizontal')) }}
                    
                    <div class="form-group">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <input tabindex="1" type="email" id="TxtEmail" name="TxtEmail" placeholder="Email ..." class="form-control" required="required" value="{{ Request()->old('TxtEmail') }}" />
                            @if($errors->has('email'))
                                {!! $errors->first('email', '<p class="help-block error">:message</p>') !!}
                            @endif
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <input type="password" id="TxtPassword" name="TxtPassword" placeholder="Mật khẩu" tabindex="2" class="form-control" required="required" />
                            @if($errors->has('TxtPassword'))
                                {!! $errors->first('TxtPassword', '<p class="help-block error">:message</p>') !!}
                            @endif
                        </div>
                        <div class="col-md-1"></div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <button type="submit" id="sign_in" tabindex="4" class="btn btn-theme2 btn-block">Sigin</button>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    {{ Form::close() }}
                    <br/>
                    <hr/><br/>
                    <p class="text-center">
                        <a tabindex="4" style="float: left;margin-left: 60px;margin-top: -12px;" class="register" href="{{ URL::route('user.create') }}">Sign up</a> 
                        <a tabindex="5" style="float: right; margin-right: 52px; margin-top: -14px;" href="{{ URL::route('user.create') }}">Forget password?</a></p>
                
            </div>
        </div>
</div><!-- end div.col-md-4-->

<div class="col-md-3"></div>

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

