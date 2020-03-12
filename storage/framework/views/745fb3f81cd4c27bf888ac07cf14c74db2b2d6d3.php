<!DOCTYPE Html>

<Html>

	<head>

		<?php echo $__env->make('partials.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	</head>

	<body>



        <?php if(Auth::guard('admin')->check()): ?>



            <?php echo $__env->make('partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>



            <?php echo $__env->make('partials.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php endif; ?>



        <section id="content" <?php if(isset($_COOKIE['HiddenNavbar']) && $_COOKIE['HiddenNavbar'] == 1): ?><?php echo e('style="padding-left: 0;"'); ?><?php endif; ?>>

            <div class="main padder">



                <?php if(Auth::guard('admin')->check()): ?>

                    <div class="row" style="margin-top: 20px;">

                        <!-- .breadcrumb -->

                        <div class="col-lg-12">

                            <ul class="admin_breadcrumb">

                                <li>

                                    <a href="<?php echo e(URL::route('admin.home')); ?>">

                                        <i class="icon-home m-r-mini"></i>Home

                                    </a>

                                </li>



                                <?php echo $__env->yieldContent('breadcrumb'); ?>

                            </ul>

                        </div>

                        <!-- / .breadcrumb -->

                    </div>



                    

                <?php endif; ?>



                <?php echo $__env->yieldContent('content'); ?>



            </div>

        </section>

        <!-- /#content-->



        <footer id="footer">

            <div class="text-center padder clearfix">

                <div id="footer-content">

                    <div class="row">

                        <div class="col-lg-10 padding-top-3px">

                            <small>

                                 <br /> Copyright 2018. www.ezweb.company

                            </small>

                        </div>



                        <div class="col-lg-2 m-t-mini">

                            <a href="javascript:void()" class="btn btn-mini btn-circle btn-gplus" id="scrollToTop" title="Lên đầu trang">

                                <i class="icon-collapse-top"></i>

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </footer>



		<!-- check for flash notification message -->

	    <?php if(Session::has('flash_error_message')): ?>

            <div class="alert alert-danger fade-in">

                <button type="button" class="close" data-dismiss="alert">

                    <i class="icon-remove"></i>

                </button>



                <i class="icon-ban-circle icon-large"></i>



                <strong>Error!</strong>



                <div><?php echo e(Session::get('flash_error_message')); ?></div>

            </div>

     	<?php endif; ?>



     	<?php if(Session::has('flash_success_message')): ?>

            <div class="alert alert-success fade-in">

                <button type="button" class="close" data-dismiss="alert">

                    <i class="icon-remove"></i>

                </button>



                <i class="icon-ok-sign icon-large"></i>



                <strong>Successful!</strong>



                <div><?php echo e(Session::get('flash_success_message')); ?></div>

            </div>

	    <?php endif; ?>

        <?php $__env->startSection('modal'); ?>



        <?php echo $__env->yieldSection(); ?>



		<?php echo $__env->make('partials.javascript', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	</body>

</Html>