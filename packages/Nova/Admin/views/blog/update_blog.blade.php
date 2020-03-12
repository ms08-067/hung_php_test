@section('content')
<div class="row">

<div class="col-lg-12">

    <section class="panel m-t-small">
    <header class="panel-heading header-box">
        <i class="icon-bell"></i>
        <b><a href="{{ route('admin.blogList') }}">List Blogs</a></b>
    </header>

<div class="pull-out">
    <div class="container" style="padding-top: 20px;">
        <div class="col-sm-12"> 
        {{ Form::open(array('route' => 'admin.updateBlogSubmit', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'role' => 'form', 'style'=>'width: 100%;', 'id' => 'frm-post-job')) }}
        <div class="row form-group">
            <div class="col-sm-2">
                <label style="line-height: 32px;">Blog Title</label>
            </div>
            <div class="col-sm-8">
                {{ Form::text('title', ( !empty(old('title')) ? old('title') : (!empty($blog) ? $blog->title : '') ), array('class' => 'form-control', 'required' => "required", 'id' => 'title', 'placeholder' => 'Blog title...')) }}

                @if($errors->has('title'))
                    {!! $errors->first('title', '<p class="help-block error">:message</p>') !!}
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-2">
                <label style="line-height: 32px;">Intro this article</label>
            </div>

            <div class="col-lg-8">
                {{ Form::textarea('intro_txt', isset($blog->intro_txt) ? $blog->intro_txt : old('intro_txt'), array('id' => 'intro_txt', 'class' => 'form-control', 'rows' => 3,'col'=>10, 'placeholder' => 'Intro text for this article')) }}

                @if($errors->has('intro_txt'))
                    {!! $errors->first('intro_txt', '<p class="help-block error">:message</p>') !!}
                @endif
            </div>
        </div>

        <div class="row form-group">
            <div class="col-sm-2">
                <label>Full Article</label>
            </div>

            <div class="col-sm-8">
                {{ Form::textarea('content', ( !empty(old('content')) ? old('content') : (!empty($blog) ? $blog->content : '') ), array('rows' => 10, 'class' => 'tinymce form-control validate[required,maxSize[1200]]', 'id' => 'content', 'placeholder' => 'write your article')) }}

                @if($errors->has('content'))
                    {!! $errors->first('content', '<p class="help-block error">:message</p>') !!}
                @endif
            </div>
        </div>

        <div class="row form-group">
            <div class="col-sm-2">
                <label style="margin-top: 12px;">Publish Blog</label>
            </div>
            <div class="col-sm-5">
                {{ Form::select('status', [0 => 'Unpublished', 1 => 'Published'],( !empty(old('status')) ? old('status') : (!empty($blog) ? $blog->status : 1) ), array('id' => 'status', 'class' => 'form-control','style' => 'padding-top: 8px;')) }}
                @if($errors->has('status'))
                    {!! $errors->first('status', '<p class="help-block error">:message</p>') !!}
                @endif
            </div>
        </div>

        <div id="box-publish" class="row form-group">
            <div class="col-sm-2">
                <label style="margin-top: 12px;">Publish Blog</label>
            </div>
            <div class="col-sm-5">
               {{ Form::text('published_at', ( !empty(old('published_at')) ? old('published_at') : (!empty($blog) && !empty($blog->published_at) && ($blog->published_at != "0000-00-00 00:00:00") ? $blog->published_at : '') ), array('class' => 'form-control', 'id' => 'published_at', 'placeholder' => 'Publish Date')) }}

                @if($errors->has('published_at'))
                    {!! $errors->first('published_at', '<p class="help-block error">:message</p>') !!}
                @endif
            </div>
        </div>

        <br/>
        <div class="row form-group">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="buttons">
                    <button type="submit" name="submit" value="1" class="btn btn-primary">Save</button>
                    
                    <button type="submit" name="submit" value="2" class="btn btn-primary">Save & Close</button>

                    <a href="{{ route('admin.blogList') }}" class="btn button-cancle">Cancel</a>
                </div>
            </div>
        </div>
        <br/>
        {{ Form::hidden('blog_id', !empty($blog) ? $blog->id : 0 ) }}  
    {{ Form::close() }}
    </div>
</div>
</div><!-- end div.pull-out -->
</section><!-- end .panel m-t-small-->
</div><!-- end div.col-lg-12 -->
</div><!-- end div.row -->

@stop

@section('css')
@parent
<link href="{{ asset('packages/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" media="screen">

@stop

@section('javascript')
    @parent
<script type="text/javascript" src="{{ asset('packages/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"  charset="UTF-8"></script>

<script type="text/javascript">
    alertify.defaults.transition = "zoom";

    $(function(){
        $("#published_at").datetimepicker({
            startDate: new Date(),
            minDate: new Date(), 
            format: 'yyyy-mm-dd hh:ii' 
        });       
    });

    // $("#published_at").datepicker({
    //     dateFormat: 'yy-mm-dd',
    //     minDate: new Date()
       
    // });

    $("#status").on("change",function(){
        if($(this).val() == 1){
            $("#box-publish").fadeIn(2000);
        }else{
            $("#box-publish").fadeOut(2000);
        }
    });

    

    tinymce.init({
        selector: "#content",
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
        selector: "#intro_txt",
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
@stop