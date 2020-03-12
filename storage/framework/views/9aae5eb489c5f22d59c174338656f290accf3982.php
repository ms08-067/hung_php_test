<!DOCTYPE HTML>



<html>



<head>



    <title>Medical Jobs In Medford</title>

    <meta charset="utf-8">



    <link href="<?php echo e(asset('packages/admin/css/style.css')); ?>" rel='stylesheet' type='text/css' />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>



    <link href="<?php echo e(asset('packages/admin/css/app.css')); ?>" rel='stylesheet' type='text/css' />







    <link href="<?php echo e(asset('packages/admin/css/main.css')); ?>" rel='stylesheet' type='text/css' />



    



        <!--//webfonts-->



</head>



<body id="bodyLogin" style="margin-top: -20px;">



     <div class="main">



        <div class="login-form">



            <h1><!--Member Login--></h1>



                    <div class="head">



                         <?php if(Session::has('flash_error_message')): ?>



                        <img style="border:6px solid #000;" src="<?php echo e(asset('packages/admin/images/user.png')); ?>" alt=""/>



                        <?php else: ?>



                        <img src="<?php echo e(asset('packages/admin/images/user2.png')); ?>" alt=""/>



                        <?php endif; ?>



                    </div>



                <?php echo e(Form::open(array('route' => 'admin.logged'))); ?>




                    <input type="hidden" name="LoginHash" id="LoginHash" />







                    <div class="block">



                        <label class="control-label">Email</label>



                        <input type="email" placeholder="email" class="form-control" id="LoginEmail" name="LoginEmail" value="<?php echo e(Request()->old('LoginEmail')); ?>" required>



                    </div>







                    <div class="block">



                        <label class="control-label">Password</label>



                        <input type="password" id="inputPassword" placeholder="password" class="form-control" name="LoginPassword" required>



                    </div>







                    <div style="margin-bottom: 10px;" class="checkbox">



                        <label>



                            <input name="LoginRememberMe" type="checkbox" /> Remember login</a>



                        </label>



                    </div>







                    <button type="submit" class="btn btn-info">Sign in</button>







                    <div class="line line-dashed"></div>



                <?php echo e(Form::close()); ?>




            </div>



            <!--//End-login-form-->



             <!-----start-copyright---->



                    <div class="copy-right">



                        



                    </div>



                <!-----//end-copyright---->



        </div>







        <div class="alert alert-danger fade" style="display: none;">



            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>



            <div>



                <strong>Errors !</strong>



            </div>



            <p></p>



        </div>



    </div>



      







    <?php echo e(Html::script('packages/admin/jquery/js/jquery-1.7.2.min.js')); ?>




    <?php echo e(Html::script('packages/admin/jquery/js/jquery-migrate-1.2.1.min.js')); ?>




    <?php echo e(Html::script('packages/tinymce/tinymce.min.js')); ?>




    <!-- combodate && momentjs -->



    <?php echo e(Html::script('packages/admin/js/main.js')); ?>




    



    <?php if(Session::has('flash_error_message')): ?>



        <script type="text/javascript">



            Amo.alert("Sign in failure", 4000);



        </script>



    <?php endif; ?>







<script type="text/javascript">



    $("document").ready(function(){



        $("#LoginEmail").focus();



    });







</script>







</body>



</html>