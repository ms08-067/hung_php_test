<?php $__env->startSection('content'); ?>
<div class="content-grids">
<div ui-view="">
    <div class="air-card m-0-top-bottom p-0-top-bottom">
        <div class="ats-tile-list" style="">
<section class="air-card-hover air-card-hover-escape">
                <div class="highlight-search-result tile-air-card">

                    <div class="" style="">
                        <article class="row  m-sm-top">
                            <div class="col-md-12">
                         
                                <div class="row m-0-bottom">
                                    <div class="col-md-9">
                                       
                                        <a class="freelancer-tile-name" href=""><span><?php echo e($blog->title); ?></span></a>
                                    </div>
                            <div class="col-md-3 p-0-right">
                                <div style="margin-top: -8px;" class="no-wrap freelancer-tile-location ellipsis">
                                    <a href="<?php echo e(route('user.postArticle',[$blog->id])); ?>" style="font-size: 20px;"><i class="fa fa-pencil-square-o freelancer-tile-name" aria-hidden="true"></i></a>
                                </div>
                            </div>
                    </div>

                    <div class="indetailb">
                        <span><strong class="js-type">Author: <?php echo e(user($blog->user_id)->name()); ?>.</strong>
                        </span>

                        <span>
                            <span class="js-contractor-tier"> - <?php echo e(!empty($blog->published_at) && ($blog->published_at != "0000-00-00 00:00:00") ? "Published: ".date("M d Y, H:i",strtotime($blog->published_at)) : ""); ?></br>
                            </span>
                        </span>
                    </div>
                    

                    <div class="row m-sm-top m-0-bottom">
                        <div class="col-md-12">
                            <p class="p-0-left m-0">
                                
                                <?php echo $blog->content; ?>

                            </p>                                                
                        </div>
                    </div>

                    
                </div>
                </article>
                </div>
                
                </div>
            </section>
  </div>
</div>

</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
##parent-placeholder-2f84417a9e73cead4d5c99e05daff2a534b30132##
<style type="text/css">
.box {
    padding-top:0px;
    padding-bottom: 0px;
}
span.require {
    color: red;
}  
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    ##parent-placeholder-b6e13ad53d8ec41b034c49f131c64e99cf25207a##
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">
$(document).ready(function(){

    
    $(".viewMore").on("click",function(){

        var blog_id = $(this).attr("rel");
        var item = JSON.parse($(this).attr("data-item"));
        $("#blog_title_modal").html(item.title);
        $("#blog-content").html(item.content);
        $(".btnApplyblog").attr("rel",blog_id);

        $('.desc_blog_model').modal({
            'show' : true
        });
    });
        
    tinymce.init({
        selector: "#intro_txt",
        height: 160,
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



    tinymce.init({
        selector: "#content",
        height: 300,
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



}); 




</script>
<?php $__env->stopSection(); ?>
