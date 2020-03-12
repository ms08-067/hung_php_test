@section('content')
<div style="min-height: 470px;">
<div class="row">

<div class="col-md-3"></div>

<div class="col-md-6 box">
    <div class="col-sm-push-2">
            <div>
                <h1 class="text-center">Sign up</h1>
                {{ Form::open(array('route' => 'user.store', 'onsubmit' => "return frmSignUp()", 'id' => 'userStore', 'class' => 'form-horizontal')) }}
                    <fieldset style="border: none;padding: 40px 20px;" class="push-top-xs">
                            <p class="text-center"></p>
                            <div class="form-group">
                                <div  class="no-gutter">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <input style="width: 100%;" type="text" class="form-control" name="display_name" id="display_name" value="<?php echo isset($f_name) ? $f_name : old('display_name') ?>" required="required" placeholder="Display name" tabindex="1">
                                    @if($errors->has('display_name'))
                                        {!! $errors->first('display_name', '<p class="help-block error">:message</p>') !!}
                                    @endif
                                </div>
                                <div class="col-md-1"></div>
                                </div>
                            </div>
                            
                            <div class="form-group no-gutter">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <input style="width: 100%;" type="email" class="form-control" name="txtEmail" id="txtEmail" value="<?php echo isset($email) ? $email : Request()->old('txtEmail') ?>" required="required" placeholder="Email" tabindex="3">
                                    
                                    @if($errors->has('txtEmail'))
                                        {!! $errors->first('txtEmail', '<p class="help-block error">:message</p>') !!}
                                    @endif
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="form-group no-gutter">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <input style="width: 100%;" pattern=".{6,}" title="at least six character"  type="password" class="form-control" name="txtPassword" id="txtPassword" maxlength="255" required="required" value="" placeholder="password" tabindex="4">

                                    @if($errors->has('txtPassword'))
                                        {!! $errors->first('txtPassword', '<p class="help-block error">:message</p>') !!}
                                    @endif
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            
                            <div class="form-group awe-check no-gutter">
                                 <div class="col-md-1"></div>
                                <div class="col-md-11">
                                        <input name="TxtRulesOK" id="TxtRulesOK" type="checkbox" tabindex="6" />
                                        <label for="agree">I have read and agree <a href="javascript:void(0)">term and conditions</a> of website</label>
                                </div>
                            </div>
                            <!-- Buttons-->
                            <div class="form-group no-gutter">
                                 <div class="col-md-1"></div>
                                 <div class="col-md-10">
                                    <button type="submit" id="signupSubmit" class="btn btn-theme btn-block" tabindex="7">
                                        <span>Sign Up</span>
                                    </button>
                                    
                                 </div>
                            </div>
                            <p class="text-center">Are you already an account?
                                <a tabindex="7" href="{{ URL::route('user.login') }}"> <strong>Sigin In</strong> </a>
                            </p>
                        </fieldset>

                        <input type="hidden" class="form-control" name="txtFirstname" id="txtFirstname" value="<?php echo isset($f_name) ? $f_name : Request()->old('txtFirstname') ?>" >

                        <input type="hidden" class="form-control" name="txtLastname" id="txtLastname" value="<?php echo isset($l_name) ? $l_name : Request()->old('txtLastname') ?>" >

                    {{ Form::close() }}
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

@section('javascript')
@parent
<script type="text/javascript">
    function frmSignUp(){
        if(!$("#TxtRulesOK").is(":checked")) {
            Amo.alert("Please agree terms and condition of website.",6000);
            return false;
        }
        return true;
    }
</script>
@stop

