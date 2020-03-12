@section('title')
Update Email Template
@stop
@section('breadcrumb')
	<li>
		<a href="{{ URL::route('admin.home') }}">
			Update Email Template
		</a>
	</li>
@stop
@section('content')
	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading header-box">
					<i class="icon-bell"></i>
					{{ isset($frm) && !empty($frm) ? "Update Email Template" : "Create New Email Template" }}
				</header>				
					<div class="pull-out">
						<div style="margin-top: 50px;margin-bottom: 50px;" class="col-lg-11">
							{{ Form::open(array('route' => 'admin.newForm.Submit', 'id'=>'newForm', 'class' => 'form-horizontal')) }}
							<div class="form-group">
								<label class="col-lg-2 control-label">Note:</label>
								<div class="col-lg-10">
									{{ Form::textarea( 'note', isset($frm->note) ? $frm->note : old('note'), array('id' => 'note', 'class' => 'form-control', 'rows' => 3,'col'=>10, 'placeholder' => 'Note ')) }}
									@if($errors->has('note'))
										{!! $errors->first('note', '<p class="help-block error">:message</p>') !!}
									@endif
								</div>
							</div>

							<div class="form-group">



								<label class="col-lg-2 control-label">Subject:</label>



								<div class="col-lg-10">



									{{ Form::text( 'subject', isset($frm->subject) ? $frm->subject : old('subject'), array('id' => 'subject', 'class' => 'form-control', 'required' => 'required', 'placeholder' => '')) }}







									@if($errors->has('subject'))



										{!! $errors->first('subject', '<p class="help-block error">:message</p>') !!}



									@endif



								</div>



							</div>







							<div class="form-group">



								<label  class="col-lg-2 control-label">Mail From</label>



								<div class="col-lg-10">



									{{ Form::text('mail_from', isset($frm->mail_from) ? $frm->mail_from : old('mail_from'), array('id' => 'mail_from','class' => 'form-control','placeholder'=>"Mail from, example: abc@gmail.com")) }}







									@if($errors->has('mail_from'))



										{!! $errors->first('mail_from', '<p class="help-block error">:message</p>') !!}



									@endif



								</div>



							</div>







							<div class="form-group">



								<label  class="col-lg-2 control-label">From Name</label>



								<div class="col-lg-10">



									{{ Form::text('from_name', isset($frm->from_name) ? $frm->from_name : old('from_name'), array('id' => 'from_name','class' => 'form-control','placeholder'=>"ezwebmanifesting.com")) }}







									@if($errors->has('from_name'))



										{!! $errors->first('from_name', '<p class="help-block error">:message</p>') !!}



									@endif



								</div>



							</div>
							<div class="form-group">



								<label  class="col-lg-2 control-label">URL Redirect</label>



								<div class="col-lg-10">



									{{ Form::text('url_redirect', isset($frm->url_redirect) ? $frm->url_redirect : old('url_redirect'), array('id' => 'from_name','class' => 'form-control','placeholder'=>"URL redirect after send email")) }}
									@if($errors->has('url_redirect'))
										{!! $errors->first('url_redirect', '<p class="help-block error">:message</p>') !!}
									@endif
								</div>
							</div>

							<div class="form-group">
								<label data-toggle="tooltip" data-placement="top" title="URL redirect when error send email." class="col-lg-2 control-label">URL Error Redirect</label>

								<div class="col-lg-10">
									{{ Form::text('url_redirect_err', isset($frm->url_redirect_err) ? $frm->url_redirect_err : old('url_redirect_err'), array('id' => 'from_name','class' => 'form-control','placeholder'=>"URL redirect when error send email")) }}

									@if($errors->has('url_redirect_err'))
										{!! $errors->first('url_redirect_err', '<p class="help-block error">:message</p>') !!}

									@endif
								</div>
							</div>

							<div class="form-group">
								<label  class="col-lg-2 control-label">Admin Email</label>
								<div class="col-lg-10">
									{{ Form::text('admin_email', isset($frm->admin_email) ? $frm->admin_email : old('admin_email'), array('id' => 'admin_email','class' => 'form-control','required' => 'required','placeholder'=>"Admin email, example: abc@gmail.com,email2@gmail.com")) }}

									@if($errors->has('admin_email'))
										{!! $errors->first('admin_email', '<p class="help-block error">:message</p>') !!}

									@endif

								</div>
							</div>

							<div class="form-group">
							<label  class="col-lg-2 control-label">Content Of Email</label>

							<div class="col-lg-10">
								{{ Form::textarea('content', isset($frm) && is_object($frm) ? $frm->content : old('content'), array('class' => 'tinymce form-control', 'rows' => 8,'col'=>10, 'id'=>'content')) }}

								@if($errors->has('content'))
									{!! $errors->first('content', '<p class="help-block error">:message</p>') !!}
								@endif
							</div>
						</div>
							<div class="form-group">
								<div class="col-lg-2"></div>
								<div style="text-align: left;" class="col-lg-10">
									<button name="submit" type="submit" class="btn btn-success" value="1">Save</button>
									<button name="submit" type="submit" class="btn btn-primary" value="2">Save & Close</button>

									<a style="background: #ccc;" href="{{ route('admin.listForm') }}" class="btn btn-default"> Cancel </a>
								</div>
							</div>	
							{{ Form::hidden('frmID', isset($frm->id)?$frm->id:0, array("id"=> "frmID") ) }}
							{{ Form::close() }}
						</div>
					</div>
			</section>
		</div>
	</div>
@stop
@section('javascript')
@parent
<script type="text/javascript">
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();


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
	});

</script>
@stop







