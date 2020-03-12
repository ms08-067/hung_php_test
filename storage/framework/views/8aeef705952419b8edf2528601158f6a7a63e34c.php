<?php $__env->startSection('content'); ?>
<div class="row">

<div class="col-lg-12">
    <section class="panel m-t-small">
    <header class="panel-heading header-box">
        <i class="icon-bell"></i>
        <b><a href="<?php echo e(route('admin.listJob')); ?>">List Jobs</a></b>
    </header>

<div class="pull-out">
    <div class="container" style="padding-top: 20px;">
        <div class="col-sm-12"> 
        <?php echo e(Form::open(array('route' => 'admin.newJobsSubmit', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'role' => 'form', 'style'=>'width: 100%;', 'id' => 'frm-post-job'))); ?>

        <div class="row form-group">
            <div class="col-sm-2">
                <label style="line-height: 32px;">Job Title</label>
            </div>
            <div class="col-sm-8">
                <?php echo e(Form::text('job_title', ( !empty(old('job_title')) ? old('job_title') : (!empty($job) ? $job->job_title : '') ), array('class' => 'form-control', 'required' => "required", 'id' => 'job_title', 'placeholder' => 'Job title...'))); ?>


                <?php if($errors->has('job_title')): ?>
                    <?php echo $errors->first('job_title', '<p class="help-block error">:message</p>'); ?>

                <?php endif; ?>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-sm-2">
                <label style="line-height: 32px;">Company</label>
            </div>
            <div class="col-sm-8">

                <?php echo e(Form::text('company', ( !empty(old('company')) ? old('company') : (!empty($job) ? $job->company : '') ), array('class' => 'form-control', 'id' => 'company', 'placeholder' => 'company...'))); ?>


                <?php if($errors->has('company')): ?>
                    <?php echo $errors->first('company', '<p class="help-block error">:message</p>'); ?>

                <?php endif; ?>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-sm-2">
                <label style="line-height: 32px;">Address</label>
            </div>
            <div class="col-sm-8">
                <?php echo e(Form::text('address', ( !empty(old('address')) ? old('address') : (!empty($job) ? $job->address : '') ), array('class' => 'form-control', 'id' => 'address', 'placeholder' => 'address...'))); ?>


                <?php if($errors->has('address')): ?>
                    <?php echo $errors->first('address', '<p class="help-block error">:message</p>'); ?>

                <?php endif; ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-2">
                <label style="line-height: 32px;">Short description jobs</label>
            </div>

            <div class="col-lg-8">
                <?php echo e(Form::textarea('short_des_job', isset($job->short_des_job) ? $job->short_des_job : old('short_des_job'), array('id' => 'short_des_job', 'class' => 'form-control', 'rows' => 3,'col'=>10, 'placeholder' => 'Short description jobs'))); ?>


                <?php if($errors->has('short_des_job')): ?>
                    <?php echo $errors->first('short_des_job', '<p class="help-block error">:message</p>'); ?>

                <?php endif; ?>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-sm-2">
                <label>Job Requirement</label>
            </div>

            <div class="col-sm-8">
                <?php echo e(Form::textarea('requirement', ( !empty(old('requirement')) ? old('requirement') : (!empty($job) ? $job->requirement : '') ), array('rows' => 10, 'class' => 'tinymce form-control validate[required,maxSize[1200]]', 'id' => 'requirement', 'placeholder' => 'Requirement for project'))); ?>


                <?php if($errors->has('requirement')): ?>
                    <?php echo $errors->first('requirement', '<p class="help-block error">:message</p>'); ?>

                <?php endif; ?>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-sm-2">
                <label style="line-height: 32px;">Salary</label>
            </div>
            <div class="col-sm-8">
                <?php echo e(Form::text('benefit', ( !empty(old('benefit')) ? old('benefit') : (!empty($job) ? $job->benefit : '') ), array('class' => 'form-control', 'id' => 'benefit', 'placeholder' => 'Benefit, ex: $19.43 an hour', 'maxlength' => 400))); ?>


                <?php if($errors->has('benefit')): ?>
                    <?php echo $errors->first('benefit', '<p class="help-block error">:message</p>'); ?>

                <?php endif; ?>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-sm-2">
                <label style="margin-top: 12px;">Public This Job</label>
            </div>
            <div class="col-sm-5">
                <?php echo e(Form::select('status', [0 => 'Unpublic', 1 => 'Public'],( !empty(old('status')) ? old('status') : (!empty($job) ? $job->status : 1) ), array('class' => 'form-control','style' => 'padding-top: 8px;'))); ?>

                <?php if($errors->has('status')): ?>
                    <?php echo $errors->first('status', '<p class="help-block error">:message</p>'); ?>

                <?php endif; ?>
            </div>
        </div>

        <br/>
        <div class="row form-group">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="buttons">
                    <button type="submit" name="submit" value="1" class="btn btn-primary">Save</button>
                    
                    <button type="submit" name="submit" value="2" class="btn btn-primary">Save & Close</button>

                    <a href="<?php echo e(route('admin.listJob')); ?>" class="btn button-cancle">Cancel</a>
                </div>
            </div>
        </div>
        <br/>
        <?php echo e(Form::hidden('job_id', !empty($job) ? $job->id : 0 )); ?>  
    <?php echo e(Form::close()); ?>

    </div>
</div>
</div><!-- end div.pull-out -->
</section><!-- end .panel m-t-small-->
</div><!-- end div.col-lg-12 -->
</div><!-- end div.row -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    ##parent-placeholder-b6e13ad53d8ec41b034c49f131c64e99cf25207a##
<script type="text/javascript">
    alertify.defaults.transition = "zoom";

    tinymce.init({
        selector: "#requirement",
        height: 500,
        convert_urls : false,
        plugins: [
          "advlist autolink autosave link lists charmap  preview spellchecker",
          "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking",
          "directionality template paste textpattern"
        ],

        toolbar1: "undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment",
        convert_urls : 0,

        menubar: false,
        toolbar_items_size: 'small',

        style_formats: [{
          title: 'Bold text',
          inline: 'b'
        }],

        content_css: [
         
        ]
    });


    tinymce.init({
        selector: "#short_des_job",
        height: 160,
        convert_urls : false,
        plugins: [
          "advlist autolink autosave link  lists charmap  preview spellchecker",
          "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking",
          "directionality template paste textpattern"
        ],

        toolbar1: "bold italic bullist numlist| alignleft aligncenter alignright alignjustify",
        convert_urls : 0,

        menubar: false,
        toolbar_items_size: 'small',

        style_formats: [{
          title: 'Bold text',
          inline: 'b'
        }],

        content_css: [
         
        ]
    });

</script>   
<?php $__env->stopSection(); ?>