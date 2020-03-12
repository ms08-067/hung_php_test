<?php $__env->startSection('content'); ?>
<div style="min-height: 470px;">
<div class="row">

<div class="col-md-3"></div>

<div class="col-md-6 box" style="min-height: 470px;">  
<div class="col-sm-push-2">
            <div>
                <br/>
                <h1 style="margin-bottom: 50px;" class="text-center">Sigin To Post Your Aricle</h1>
                    
                  
                    <?php echo e(Form::open(array('route' => 'user.loginSubmit', 'id' => 'userLogin','class'=>'form-horizontal'))); ?>

                    
                    <div class="form-group">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <input tabindex="1" type="email" id="TxtEmail" name="TxtEmail" placeholder="Email ..." class="form-control" required="required" value="<?php echo e(Request()->old('TxtEmail')); ?>" />
                            <?php if($errors->has('email')): ?>
                                <?php echo $errors->first('email', '<p class="help-block error">:message</p>'); ?>

                            <?php endif; ?>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <input type="password" id="TxtPassword" name="TxtPassword" placeholder="Mật khẩu" tabindex="2" class="form-control" required="required" />
                            <?php if($errors->has('TxtPassword')): ?>
                                <?php echo $errors->first('TxtPassword', '<p class="help-block error">:message</p>'); ?>

                            <?php endif; ?>
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
                    <?php echo e(Form::close()); ?>

                    <br/>
                    <hr/><br/>
                    <p class="text-center">
                        <a tabindex="4" style="float: left;margin-left: 60px;margin-top: -12px;" class="register" href="<?php echo e(URL::route('user.create')); ?>">Sign up</a> 
                        <a tabindex="5" style="float: right; margin-right: 52px; margin-top: -14px;" href="<?php echo e(URL::route('user.create')); ?>">Forget password?</a></p>
                
            </div>
        </div>
</div><!-- end div.col-md-4-->

<div class="col-md-3"></div>

</div><!-- end div.row -->
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
##parent-placeholder-2f84417a9e73cead4d5c99e05daff2a534b30132##
<style type="text/css">
    div#footer {
        min-height: 50px;
    }
</style>
<?php $__env->stopSection(); ?>

