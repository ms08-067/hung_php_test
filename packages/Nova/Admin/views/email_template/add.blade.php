@section('title')
	Add new video
@stop

@section('breadcrumb')
	<li>
		<a href="{{ URL::route('admin.emailtemplate') }}">
			List template
		</a>
	</li>
	
	<li>
		<a href="javascript:void()">
			{{ !empty($template) ? 'Update template' : 'Add New Email Template' }}
		</a>
	</li>

@stop

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading header-box">
					<i class="icon-bell"></i>
					 Add new email template
				</header>

				<div class="block">
					{{ Form::open(array('route' => 'admin.storemailTemplate', 'class' => 'form-horizontal')) }}
						
						<div class="form-group">
							<label class="col-lg-2 control-label">Slug</label>
							<div class="col-lg-8">
								{{ Form::text( 'slug', !empty($template) && is_object($template) ? $template->slug : Request()->old('slug'), array('class' => 'form-control','required' => 'required',!empty($template) ? 'disabled' : '' )) }}

								@if($errors->has('slug'))
									{!! $errors->first('slug', '<p class="help-block error">:message</p>') !!}
								@endif
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Price Button(Cent)</label>
							<div class="col-lg-8">
								{{ Form::number( 'price', !empty($template) && is_object($template) ? $template->price : old('price'), array('id' => 'price', 'class' => 'form-control', 'placeholder' => 'Cent', 'required' => 'required')) }}

								@if($errors->has('price'))
									{!! $errors->first('price', '<p class="help-block error">:message</p>') !!}
								@endif
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Title Stripe Popup</label>
							<div class="col-lg-8">
								{{ Form::text( 'name_popup', !empty($template) && is_object($template) ? $template->name_popup : old('name_popup'), array('id' => 'name_popup', 'class' => 'form-control', 'placeholder' => 'Title Stripe Popup')) }}

								@if($errors->has('name_popup'))
									{!! $errors->first('name_popup', '<p class="help-block error">:message</p>') !!}
								@endif
							</div>
						</div>

						<div class="form-group">
							<label for="desc_popup" class="col-lg-2 control-label">Short Description Stripe Popup</label>

							<div class="col-lg-8">
								{{ Form::textarea('desc_popup', !empty($template) && is_object($template) ? $template->desc_popup : old('desc_popup'), array('class' => 'form-control', 'rows' => 2)) }}

								@if($errors->has('desc_popup'))
									{!! $errors->first('desc_popup', '<p class="help-block error">:message</p>') !!}
								@endif
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Subject</label>
							<div class="col-lg-8">
								{{ Form::text( 'subject', !empty($template) && is_object($template) ? $template->subject : Request()->old('subject'), array('id' => 'subject', 'class' => 'form-control', 'required' => 'required')) }}

								@if($errors->has('subject'))
									{!! $errors->first('subject', '<p class="help-block error">:message</p>') !!}
								@endif
							</div>
						</div>

						<div class="form-group">
							<label for="description" class="col-lg-2 control-label">Description</label>

							<div class="col-lg-8">
								{{ Form::textarea('description', !empty($template) && is_object($template) ? $template->description : Request()->old('description'), array('class' => 'form-control', 'rows' => 2, 'required' => 'required')) }}

								@if($errors->has('description'))
									{!! $errors->first('description', '<p class="help-block error">:message</p>') !!}
								@endif
							</div>
						</div>

						<div class="form-group">
							<label for="description" class="col-lg-2 control-label">Email Content</label>

							<div class="col-lg-8">
								{{ Form::textarea('content', !empty($template) && is_object($template) ? $template->content : Request()->old('content'), array('class' => 'tinymce form-control', 'rows' => 5, 'id'=>'content_email_template')) }}

								@if($errors->has('content'))
									{!! $errors->first('content', '<p class="help-block error">:message</p>') !!}
								@endif
							</div>
						</div>

						<div class="form-group">
							<label  class="col-lg-2 control-label">URL Redirect</label>
							<div class="col-lg-10">
								{{ Form::text('url_redirect', isset($template->url_redirect) ? $template->url_redirect : old('url_redirect'), array('id' => 'from_name','class' => 'form-control','placeholder'=>"URL redirect after send email")) }}

								@if($errors->has('url_redirect'))
									{!! $errors->first('url_redirect', '<p class="help-block error">:message</p>') !!}
								@endif
							</div>
						</div>

						<div class="form-group">
							<label data-toggle="tooltip" data-placement="top" title="The message display after sent email if you don't want redirect to other page." class="col-lg-2 control-label">Message display:</label>
							<div class="col-lg-10">
								{{ Form::textarea( 'message', (isset($template->message) ? $template->message : (!empty(old('message')) ? old('message') : '' )), array('id' => 'note', 'class' => 'form-control', 'rows' => 3,'col'=>10, 'placeholder' => "The message display after sent email if you don't want redirect to other page.")) }}

								@if($errors->has('note'))
									{!! $errors->first('note', '<p class="help-block error">:message</p>') !!}
								@endif
							</div>
						</div>

						<div class="form-group">
							<label data-toggle="tooltip" data-placement="top" title="URL redirect when error send email." class="col-lg-2 control-label">URL Error Redirect</label>
							<div class="col-lg-10">
								{{ Form::text('url_redirect_err', isset($template->url_redirect_err) ? $template->url_redirect_err : old('url_redirect_err'), array('id' => 'from_name','class' => 'form-control','placeholder'=>"URL redirect when error send email")) }}

								@if($errors->has('url_redirect_err'))
									{!! $errors->first('url_redirect_err', '<p class="help-block error">:message</p>') !!}
								@endif
							</div>
						</div>

						<div class="form-group">
							<label data-toggle="tooltip" data-placement="top" title="The message display if send email problem and you don't want redirect." class="col-lg-2 control-label">Error display:</label>
							<div class="col-lg-10">
								{{ Form::textarea( 'error_msg', isset($template->error_msg) ? $template->error_msg : (!empty(old('error_msg')) ? old('error_msg') : 'Send email problem, please contact admin.' ), array('id' => 'error_msg', 'class' => 'form-control', 'rows' => 3,'col'=>10, 'placeholder' => "The message will be display if send email problem.")) }}

								@if($errors->has('error_msg'))
									{!! $errors->first('error_msg', '<p class="help-block error">:message</p>') !!}
								@endif
							</div>
						</div>

						<div class="form-group">
							<label data-toggle="tooltip" data-placement="top" title="URL redirect when error send email." class="col-lg-2 control-label">Test Send Email</label>
							<div class="col-lg-8">
								{{ Form::text('email_test', '', array('id' => 'email_test','autocomplete' => 'on','class' => 'form-control','placeholder'=>"Email test")) }}
							</div>
							<div class="col-lg-2">
								<input type="button" id="send_test_email" class="btn btn-primary" value="SEND TEST">
							</div>
						</div>

						<div class="form-group">
							<div class="col-lg-2"></div>
							<div class="col-lg-8">
								{{ Form::hidden('template_id', !empty($template) && is_object($template) ? $template->id : 0 ) }}
								<button id="TxtSubmit" name="submit" value="1" type="submit" class="btn btn-xs btn-small btn-primary">Save & Close</button>&nbsp;
								<button id="TxtSubmit" name="submit" value="0" type="submit" class="btn btn-xs btn-small btn-primary">Save</button>

								<a style="background: #ccc;" href="{{ route('admin.emailtemplate') }}" class="btn btn-default btn-small"> Cancel </a>
								
							</div>
						</div>
						
					{{ Form::close() }}

				</div>
			</section>
		</div>
	</div>
@stop

@section('javascript')
    @parent
<script>
$(function(){
    //alertify.defaults.transition = "zoom";
    $("#send_test_email").click(function(){   
        var email = $("#email_test").val();
        var subject = $("#subject").val();
        var content = $("#content_email_template").val();
        if(email == '') {
    
            $("#email_test").addClass("error").focus();
            Amo.alert("Please enter email that you want send to.",0);
            return;   
        }
        
        $.post('{{route("admin.sendEmailTest")}}',{
            'email' : email,
            'subject' : subject,
            'content' : content,
            '_token': '{{ csrf_token() }}'
        },function (data) {
            var data = JSON.parse(data);
            if(data.status){
              Amo.success("Send email have been successful.",0);  
            }else{
                Amo.alert("Send email failed.",0);
            } 
        });
    
    });

});
  
</script>
@stop