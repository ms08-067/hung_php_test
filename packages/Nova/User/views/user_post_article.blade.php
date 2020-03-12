@section('content')
<div class="content-grids">
<div class="air-card m-0-top-bottom p-0-top-bottom">
<div  class="row" style="padding-bottom: 60px;">  
            
            {{ Form::open(array('route' => 'user.postArticle', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'role' => 'form', 'style'=>'width: 100%;', 'id' => 'frmApplyblog')) }}
            
            
                
            <h2 class="center" style="margin-top: 20px;font-weight: bold;">Post An Article </h2>    
                
            <div class="form-group">
                <label>Title Blog <span class="require">*</span></label>
                <div class="">
                    <input required="required" maxlength="300" class="form-control" type="text" name="title" value="{{ !empty($blog) ? $blog->title : old('title') }}" />
                    @if($errors->has('title'))
                        {!! $errors->first('title', '<p class="help-block error">:message</p>') !!}
                    @endif
                </div>
            </div>  

            <div class="form-group">
                <label>Intro article <span class="require">*</span></label>
                <div class="">
                    <textarea id="intro_txt" name="intro_txt" rows="10" class="form-control">{{ !empty($blog) ? $blog->intro_txt : old('intro_txt') }}</textarea>
                    @if($errors->has('intro_txt'))
                        {!! $errors->first('intro_txt', '<p class="help-block error">:message</p>') !!}
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label>Full Content <span class="require">*</span></label>
                <div class="">
                    <textarea id="content" name="content" rows="10" class="form-control">{{ !empty($blog) ? $blog->content : old('content') }}</textarea>
                    @if($errors->has('content'))
                        {!! $errors->first('content', '<p class="help-block error">:message</p>') !!}
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="">
                    <div class="g-recaptcha" data-sitekey="6LeqcRkTAAAAAIQUNG83jsnA2zd9nhAyApkSbRqF"></div>
                </div>

                @if($errors->has('googleCapchar'))
                    {!! $errors->first('googleCapchar', '<p class="help-block error">:message</p>') !!}
                @endif

            </div>

            <div class="form-group">
                <label><span class="require">*</span> Required</label>
            </div>

            {{ Form::hidden('post_id', !empty($blog) ? $blog->id : 0 ) }}
            
            <div class="form-group">
                <div class="">
                    <input type="submit" name="submit" value="POST BLOG" class="btn btn-primary">
                </div>
            </div>

        {{ Form::close() }}

             
</div>
</div>
@stop

@section('css')
@parent
<style type="text/css">
.box {
    padding-top:0px;
    padding-bottom: 0px;
}
span.require {
    color: red;
}  
</style>
@stop

@section('javascript')
    @parent
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
@stop
