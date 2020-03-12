@section('content')
<div class="row">

<div class="col-lg-12">
    <section class="panel m-t-small">
    <header class="panel-heading header-box">
        <i class="icon-bell"></i>
        <b><a href="{{ route('admin.listJob') }}">List Jobs</a></b>
    </header>

<div class="pull-out">
    <div class="container" style="padding-top: 20px;">
        <div class="col-sm-12"> 
        {{ Form::open(array('route' => 'admin.introTxtSubmit', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'role' => 'form', 'style'=>'width: 100%;', 'id' => 'frm-post-job')) }}
    

        <div class="row form-group">
            <div class="col-sm-2">
                <label>Welcome Page Text</label>
            </div>

            <div class="col-sm-8">
                {{ Form::textarea('intro_txt', ( !empty(old('intro_txt')) ? old('intro_txt') : (!empty($introTxt) ? $introTxt->intro_txt : '') ), array('rows' => 10, 'class' => 'tinymce form-control', 'id' => 'intro_txt', 'placeholder' => 'Requirement for project')) }}

                @if($errors->has('intro_txt'))
                    {!! $errors->first('intro_txt', '<p class="help-block error">:message</p>') !!}
                @endif
            </div>
        </div>

        <br/>
        <div class="row form-group">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="buttons">
                    <button type="submit" name="submit" value="1" class="btn btn-primary">Save</button>

                    <a href="{{ route('admin.listJob') }}" class="btn button-cancle">Cancel</a>
                </div>
            </div>
        </div>
        
    {{ Form::close() }}
    </div>
</div>
</div><!-- end div.pull-out -->
</section><!-- end .panel m-t-small-->
</div><!-- end div.col-lg-12 -->
</div><!-- end div.row -->

@stop

@section('javascript')
    @parent
<script type="text/javascript">
    alertify.defaults.transition = "zoom";

    tinymce.init({
        selector: "#intro_txt",
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
</script>   
@stop