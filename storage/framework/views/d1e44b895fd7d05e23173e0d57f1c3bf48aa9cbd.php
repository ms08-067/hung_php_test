<?php $__env->startSection('title'); ?>
Configuration template
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
	<li><a href="<?php echo e(URL::route('admin.configTemplate')); ?>">List Website</a></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading header-box">
					<i class="icon-bell"></i>
					<?php echo e(isset($frmPay) && !empty($frmPay) ? "Configuration for Website ".$frmPay->domain : "Configuration Website"); ?>

				</header>				
					<div class="pull-out">
						<div style="margin-top: 50px;margin-bottom: 50px;" class="col-lg-11">
							<?php echo e(Form::open(array('route' => 'admin.updateTemp.Submit', 'id'=>'updateTemp', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data'))); ?>

							
							<div class="form-group">
								<label data-toggle="tooltip" data-placement="top" title="Noted for this configuration" class="col-lg-2 control-label">Note:</label>
								<div class="col-lg-10">
									<?php echo e(Form::textarea( 'note', isset($frmPay->domain) ? 'This is setting for website: '.$frmPay->domain : old('note'), array('id' => 'note', 'class' => 'form-control', 'rows' => 3,'col'=>10, 'placeholder' => 'Noted for this configuration '))); ?>


									<?php if($errors->has('note')): ?>
										<?php echo $errors->first('note', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>
								</div>
							</div>
							<h2>Information for Website</h2><hr/>

							<div class="form-group">
								<label data-toggle="tooltip" data-placement="top" title="Customer name"  class="col-lg-2 control-label">Name:</label>
								<div class="col-lg-10">
									<?php echo e(Form::text('name', isset($frmPay->name) ? $frmPay->name : old('name'), array('id' => 'name', 'class' => 'form-control', 'placeholder' => 'Customer name'))); ?>


									<?php if($errors->has('name')): ?>
										<?php echo $errors->first('name', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>
								</div>
							</div>

							<div class="form-group">
								<label data-toggle="tooltip" data-placement="top" title="Country and State"  class="col-lg-2 control-label">Country and State:</label>
								<div class="col-lg-10">
									<?php echo e(Form::text('country', isset($frmPay->country) ? $frmPay->country : old('country'), array('id' => 'country', 'class' => 'form-control', 'placeholder' => 'Country and State'))); ?>


									<?php if($errors->has('country')): ?>
										<?php echo $errors->first('country', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>
								</div>
							</div>

							<div class="form-group">
								<label data-toggle="tooltip" data-placement="top" title=""  class="col-lg-2 control-label">Phone:</label>
								<div class="col-lg-10">
									<?php echo e(Form::text('phone', isset($frmPay->phone) ? $frmPay->phone : old('phone'), array('id' => 'phone', 'class' => 'form-control', 'placeholder' => 'Customer phone'))); ?>


									<?php if($errors->has('phone')): ?>
										<?php echo $errors->first('phone', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>
								</div>
							</div>

							<div class="form-group">
								<label data-toggle="tooltip" data-placement="top" title=""  class="col-lg-2 control-label">Email:</label>
								<div class="col-lg-10">
									<?php echo e(Form::text('email', isset($frmPay->email) ? $frmPay->email : old('email'), array('id' => 'email', 'class' => 'form-control', 'placeholder' => 'Customer email'))); ?>


									<?php if($errors->has('email')): ?>
										<?php echo $errors->first('email', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>
								</div>
							</div>

							<div class="form-group">
								<label data-toggle="tooltip" data-placement="top" title="Domain for website"  class="col-lg-2 control-label">Domain:</label>
								<div class="col-lg-10">
									<?php echo e(Form::text('domain', isset($frmPay->domain) ? $frmPay->domain : old('domain'), array('id' => 'domain', 'class' => 'form-control', 'placeholder' => 'domain website'))); ?>


									<?php if($errors->has('domain')): ?>
										<?php echo $errors->first('domain', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>
								</div>
							</div>

							<h2>Intro Page</h2><hr/>
							<div class="form-group">
								<label class="col-lg-2 control-label">Business Name:</label>
								<div class="col-lg-10">
									<?php echo e(Form::text('business_name', isset($frmPay->business_name) ? $frmPay->business_name : old('business_name'), array('id' => 'business_name', 'class' => 'form-control', 'placeholder' => 'Your business name'))); ?>


									<?php if($errors->has('business_name')): ?>
										<?php echo $errors->first('business_name', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>
								</div>
							</div>

							<div class="form-group">
								<label  class="col-lg-2 control-label">Intro Text</label>
								<div class="col-lg-10">
									<?php echo e(Form::text('intro_text', isset($frmPay->intro_text) ? $frmPay->intro_text : old('intro_text'), array('id' => 'intro_text','class' => 'form-control','placeholder'=>"A New Paradigm In Health Bioenergetics"))); ?>


									<?php if($errors->has('intro_text')): ?>
										<?php echo $errors->first('intro_text', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>
								</div>
							</div>

							<div class="form-group">
								<label  class="col-lg-2 control-label">Color</label>
								<div class="col-lg-10">
									<?php echo e(Form::text('color_code', isset($frmPay->color_code) ? $frmPay->color_code : old('color_code','#ffff72'), array('id' => 'color_code','class' => 'form-control','placeholder'=>"Color code for intro page"))); ?>


									<?php if($errors->has('color_code')): ?>
										<?php echo $errors->first('color_code', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>
								</div>
							</div>

							<h2>Home Page</h2><hr/>
							<div class="form-group">
								<label  class="col-lg-2 control-label">Logo Top Navbar</label>
								<div class="col-lg-3" style="width: 250px;height: 175px;">
	                                <input data-id="<?php echo e(isset($frmPay) ? $frmPay->id : 0); ?>" name="logo_top_navbar" type="file" id="input-file" class="dropify" data-width="250" data-height="175" data-allowed-file-extensions="jpg png gif bmp" data-default-file="<?php echo e(isset($frmPay) && !empty($frmPay->logo_top_navbar) ? asset('images/'.$frmPay->logo_top_navbar) : asset('packages/main/images/your-biz-name.jpg')); ?>" /> 
								</div>


								<label  class="col-lg-3 control-label">Contact Your Name Today</label>
								<div class="col-lg-3" style="width: 200px;height: 300px;">
	                                <input data-id="<?php echo e(isset($frmPay) ? $frmPay->id : 0); ?>" name="photo_contact" type="file" id="input-file" class="dropify_photo_contact" data-width="200" data-height="300" data-allowed-file-extensions="jpg png gif bmp" data-default-file="<?php echo e(isset($frmPay) && !empty($frmPay->photo_contact) ? asset('images/'.$frmPay->photo_contact) : asset('packages/main/images/photo_contact_detault.jpg')); ?>" /> 
								</div>
							</div>

							<div class="form-group">

								<label  class="col-lg-2 control-label">Membership Link</label>

								<div class="col-lg-10">
									<?php echo e(Form::text('member_link', isset($frmPay->member_link) ? $frmPay->member_link : old('member_link'), array('id' => 'member_link','class' => 'form-control','placeholder'=>"The link will be used for “membership” button"))); ?>


									<?php if($errors->has('member_link')): ?>
										<?php echo $errors->first('member_link', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>
								</div>
							</div>

							<!-- <div class="form-group">
								<label  class="col-lg-2 control-label">Phone Number</label>

								<div class="col-lg-10">
									<?php echo e(Form::text('phone', isset($frmPay->phone) ? $frmPay->phone : old('phone'), array('id' => 'phone','class' => 'form-control','placeholder'=>"Phone number"))); ?>

									<?php if($errors->has('phone')): ?>
										<?php echo $errors->first('phone', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>

								</div>

							</div> -->

							<div class="form-group">
								<label data-toggle="tooltip" data-placement="top" title="Facebook link for messenger app in bottom right corner" class="col-lg-2 control-label">Facebook Link:</label>
								<div class="col-lg-10">
									<?php echo e(Form::text('fb_link', isset($frmPay->fb_link) ? $frmPay->fb_link : (!empty(old('fb_link')) ? old('fb_link') : '' ), array('id' => 'fb_link', 'class' => 'form-control', 'rows' => 3,'col'=>10, 'placeholder' => "Facebook link for messenger app in bottom right corner"))); ?>

									
									<?php if($errors->has('fb_link')): ?>
										<?php echo $errors->first('fb_link', '<p class="help-block error">:message</p>'); ?>


									<?php endif; ?>
								</div>
							</div>

							<div class="form-group">
								<label data-toggle="tooltip" data-placement="top" title="Youtube show on home page" class="col-lg-2 control-label">Youtube Link:</label>
								<div class="col-lg-10">
									<?php echo e(Form::text('youtube_link', isset($frmPay->youtube_link) ? $frmPay->youtube_link : (!empty(old('youtube_link')) ? old('youtube_link') : '' ), array('id' => 'youtube_link', 'class' => 'form-control', 'rows' => 3,'col'=>10, 'placeholder' => "Youtube show on home page"))); ?>

									
									<?php if($errors->has('youtube_link')): ?>
										<?php echo $errors->first('youtube_link', '<p class="help-block error">:message</p>'); ?>


									<?php endif; ?>
								</div>
							</div>

							<div class="form-group">
								<label data-toggle="tooltip" data-placement="top" title="" class="col-lg-2 control-label">Printerest Link:</label>
								<div class="col-lg-10">
									<?php echo e(Form::text('pinterest_link', isset($frmPay->pinterest_link) ? $frmPay->pinterest_link : (!empty(old('pinterest_link')) ? old('pinterest_link') : '' ), array('id' => 'pinterest_link', 'class' => 'form-control', 'rows' => 3,'col'=>10, 'placeholder' => "Printerest link"))); ?>

									
									<?php if($errors->has('pinterest_link')): ?>
										<?php echo $errors->first('pinterest_link', '<p class="help-block error">:message</p>'); ?>


									<?php endif; ?>
								</div>
							</div>

							<div class="form-group">
								<label data-toggle="tooltip" data-placement="top" title="" class="col-lg-2 control-label">Twitter Link:</label>
								<div class="col-lg-10">
									<?php echo e(Form::text('twitter_link', isset($frmPay->twitter_link) ? $frmPay->twitter_link : (!empty(old('twitter_link')) ? old('twitter_link') : '' ), array('id' => 'twitter_link', 'class' => 'form-control', 'rows' => 3,'col'=>10, 'placeholder' => "Twitter link"))); ?>

									
									<?php if($errors->has('twitter_link')): ?>
										<?php echo $errors->first('twitter_link', '<p class="help-block error">:message</p>'); ?>


									<?php endif; ?>
								</div>
							</div>

							<div class="form-group">
								<label data-toggle="tooltip" data-placement="top" title="" class="col-lg-2 control-label">Whatapp Link:</label>
								<div class="col-lg-10">
									<?php echo e(Form::text('whatapp_link', isset($frmPay->whatapp_link) ? $frmPay->whatapp_link : (!empty(old('whatapp_link')) ? old('whatapp_link') : '' ), array('id' => 'whatapp_link', 'class' => 'form-control', 'rows' => 3,'col'=>10, 'placeholder' => "Whatapp link"))); ?>

									
									<?php if($errors->has('whatapp_link')): ?>
										<?php echo $errors->first('whatapp_link', '<p class="help-block error">:message</p>'); ?>


									<?php endif; ?>
								</div>
							</div>

							<div class="form-group">
								<label data-toggle="tooltip" data-placement="top" title="" class="col-lg-2 control-label">Vimeo Link:</label>
								<div class="col-lg-10">
									<?php echo e(Form::text('vimeo_link', isset($frmPay->vimeo_link) ? $frmPay->vimeo_link : (!empty(old('vimeo_link')) ? old('vimeo_link') : '' ), array('id' => 'vimeo_link', 'class' => 'form-control', 'placeholder' => "Vimeo Link, ex: https://player.vimeo.com/video/391567371"))); ?>

									
									<?php if($errors->has('vimeo_link')): ?>
										<?php echo $errors->first('vimeo_link', '<p class="help-block error">:message</p>'); ?>


									<?php endif; ?>
								</div>
							</div>


							<div class="form-group">
								<label data-toggle="tooltip" data-placement="top" title="Phone number show on site" class="col-lg-2 control-label">Phone Number:</label>
								<div class="col-lg-10">
									<?php echo e(Form::text('phone_show_on_site', isset($frmPay->phone_show_on_site) ? $frmPay->phone_show_on_site : (!empty(old('phone_show_on_site')) ? old('phone_show_on_site') : '' ), array('id' => 'phone_show_on_site', 'class' => 'form-control', 'rows' => 3,'col'=>10, 'placeholder' => "Phone show on site"))); ?>

									
									<?php if($errors->has('phone_show_on_site')): ?>
										<?php echo $errors->first('phone_show_on_site', '<p class="help-block error">:message</p>'); ?>


									<?php endif; ?>
								</div>
							</div>

							<div class="form-group">
								<label data-toggle="tooltip" data-placement="top" title="Description Meta Tag For Home Page" class="col-lg-2 control-label">Description Meta Tag</label>
								<div class="col-lg-10">
									<?php echo e(Form::textarea('des_metatag_home_page', isset($frmPay->des_metatag_home_page) ? $frmPay->des_metatag_home_page : (!empty(old('des_metatag_home_page')) ? old('des_metatag_home_page') : '' ), array('id' => 'des_metatag_home_page', 'class' => 'form-control', 'rows' => 3,'col'=>10, 'placeholder' => "Description meta tag for home page"))); ?>

									<?php if($errors->has('des_metatag_home_page')): ?>
										<?php echo $errors->first('des_metatag_home_page', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>
								</div>
							</div>

							<h2>FAQ Page</h2><hr/>

							<div class="form-group">
								<label data-toggle="tooltip" data-placement="top" title="Youtube show on FAQ page" class="col-lg-2 control-label">Youtube Link 1:</label>
								<div class="col-lg-10">
									<?php echo e(Form::text('faq_youtube_link1', isset($frmPay->faq_youtube_link1) ? $frmPay->faq_youtube_link1 : (!empty(old('faq_youtube_link1')) ? old('faq_youtube_link1') : '' ), array('id' => 'faq_youtube_link1', 'class' => 'form-control', 'rows' => 3,'col'=>10, 'placeholder' => "First Video Youtube show on FAQ page"))); ?>

									
									<?php if($errors->has('faq_youtube_link1')): ?>
										<?php echo $errors->first('faq_youtube_link1', '<p class="help-block error">:message</p>'); ?>


									<?php endif; ?>
								</div>
							</div>

							<div class="form-group">
								<label data-toggle="tooltip" data-placement="top" title="Youtube show on FAQ page" class="col-lg-2 control-label">Youtube Link 2:</label>
								<div class="col-lg-10">
									<?php echo e(Form::text('faq_youtube_link2', isset($frmPay->faq_youtube_link2) ? $frmPay->faq_youtube_link2 : (!empty(old('faq_youtube_link2')) ? old('faq_youtube_link2') : '' ), array('id' => 'faq_youtube_link2', 'class' => 'form-control', 'placeholder' => "Second Video Youtube show on FAQ page"))); ?>

									
									<?php if($errors->has('faq_youtube_link2')): ?>
										<?php echo $errors->first('faq_youtube_link2', '<p class="help-block error">:message</p>'); ?>


									<?php endif; ?>
								</div>
							</div>

							<div class="form-group">
								<label data-toggle="tooltip" data-placement="top" title="Youtube show on FAQ page" class="col-lg-2 control-label">Youtube Link 3:</label>
								<div class="col-lg-10">
									<?php echo e(Form::text('faq_youtube_link3', isset($frmPay->faq_youtube_link3) ? $frmPay->faq_youtube_link3 : (!empty(old('faq_youtube_link3')) ? old('faq_youtube_link3') : '' ), array('id' => 'faq_youtube_link3', 'class' => 'form-control', 'placeholder' => "Third Video Youtube show on FAQ page"))); ?>

									
									<?php if($errors->has('faq_youtube_link3')): ?>
										<?php echo $errors->first('faq_youtube_link3', '<p class="help-block error">:message</p>'); ?>


									<?php endif; ?>
								</div>
							</div>


							<div class="form-group">
								<label data-toggle="tooltip" data-placement="top" title="Youtube show on FAQ page" class="col-lg-2 control-label">Youtube Link 4:</label>
								<div class="col-lg-10">
									<?php echo e(Form::text('faq_youtube_link4', isset($frmPay->faq_youtube_link4) ? $frmPay->faq_youtube_link4 : (!empty(old('faq_youtube_link4')) ? old('faq_youtube_link4') : '' ), array('id' => 'faq_youtube_link4', 'class' => 'form-control', 'placeholder' => "Fourth Video Youtube show on FAQ page"))); ?>

									
									<?php if($errors->has('faq_youtube_link4')): ?>
										<?php echo $errors->first('faq_youtube_link4', '<p class="help-block error">:message</p>'); ?>


									<?php endif; ?>
								</div>
							</div>

							<div class="form-group">
								<label data-toggle="tooltip" data-placement="top" title="Youtube show on FAQ page" class="col-lg-2 control-label">Youtube Link 5:</label>
								<div class="col-lg-10">
									<?php echo e(Form::text('faq_youtube_link5', isset($frmPay->faq_youtube_link5) ? $frmPay->faq_youtube_link5 : (!empty(old('faq_youtube_link5')) ? old('faq_youtube_link5') : '' ), array('id' => 'faq_youtube_link5', 'class' => 'form-control', 'placeholder' => "Fifth Video Youtube show on FAQ page"))); ?>

									
									<?php if($errors->has('faq_youtube_link5')): ?>
										<?php echo $errors->first('faq_youtube_link5', '<p class="help-block error">:message</p>'); ?>


									<?php endif; ?>
								</div>
							</div>

							<div class="form-group">
								<label data-toggle="tooltip" data-placement="top" title="Description Meta Tag For FAQ Page" class="col-lg-2 control-label">Description Meta Tag</label>
								<div class="col-lg-10">
									<?php echo e(Form::textarea('des_metatag_faq_page', isset($frmPay->des_metatag_faq_page) ? $frmPay->des_metatag_faq_page : (!empty(old('des_metatag_faq_page')) ? old('des_metatag_faq_page') : '' ), array('id' => 'des_metatag_faq_page', 'class' => 'form-control', 'rows' => 3,'col'=>10, 'placeholder' => "Description meta tag for faq page"))); ?>

									<?php if($errors->has('des_metatag_faq_page')): ?>
										<?php echo $errors->first('des_metatag_faq_page', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>
								</div>
							</div>

							<h2>Contact Page</h2><hr/>

							<div class="form-group">
								<label data-toggle="tooltip" data-placement="top" title="Subject of email will be send to sender and admin in contact page" class="col-lg-2 control-label">Subject: <span class="require">*</span></label>
								<div class="col-lg-10">
									<?php 
									$subject = isset($frmPay->subject) ? $frmPay->subject : old('subject','Website Purchase Form Submitted: {{txtName}}');
									?>
									<?php echo e(Form::text('subject', $subject, array('id' => 'subject', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Subject email for contact form'))); ?>

									<?php if($errors->has('subject')): ?>
										<?php echo $errors->first('subject', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>
								</div>
							</div>

							<div class="form-group">
								<label  class="col-lg-2 control-label">Mail from <span class="require">*</span></label>
								<div class="col-lg-10">
									
									<?php 
									$mail_from = isset($frmPay->mail_from) ? $frmPay->mail_from : old('mail_from','no-reply@ezweb.company');
									?>	

									<?php echo e(Form::text('mail_from', $mail_from, array('id' => 'mail_from','class' => 'form-control','placeholder'=>"Mail from, example: abc@gmail.com"))); ?>


									<?php if($errors->has('mail_from')): ?>
										<?php echo $errors->first('mail_from', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>
								</div>
							</div>

							<div class="form-group">
								<label  class="col-lg-2 control-label">From name <span class="require">*</span></label>
								<div class="col-lg-10">
									<?php echo e(Form::text('from_name', isset($frmPay->from_name) ? $frmPay->from_name : old('from_name','Ez Web Company'), array('id' => 'from_name','class' => 'form-control','placeholder'=>"ezwebmanifesting.com"))); ?>


									<?php if($errors->has('from_name')): ?>
										<?php echo $errors->first('from_name', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>
								</div>
							</div>

							<div class="form-group">
								<label  class="col-lg-2 control-label">URL Redirect <span class="require">*</span></label>

								<div class="col-lg-10">
									<?php echo e(Form::text('url_redirect', isset($frmPay->url_redirect) ? $frmPay->url_redirect : old('url_redirect','https://ezweb.company/website-purchase-success.php'), array('id' => 'from_name','class' => 'form-control','placeholder'=>"URL redirect after send email"))); ?>


									<?php if($errors->has('url_redirect')): ?>
										<?php echo $errors->first('url_redirect', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>
								</div>
							</div>

							<div class="form-group">
								
								<label data-toggle="tooltip" data-placement="top" title="URL redirect when error send email." class="col-lg-2 control-label">URL Error Redirect <span class="require">*</span></label>

								<div class="col-lg-10">

									<?php echo e(Form::text('url_redirect_err', isset($frmPay->url_redirect_err) ? $frmPay->url_redirect_err : old('url_redirect_err','https://ezweb.company/website-purchase-mistake.php'), array('id' => 'from_name','class' => 'form-control','placeholder'=>"URL redirect when error send email"))); ?>


									<?php if($errors->has('url_redirect_err')): ?>
										<?php echo $errors->first('url_redirect_err', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>

								</div>

							</div>


							<div class="form-group">
								<label  class="col-lg-2 control-label">Admin email <span class="require">*</span></label>
								<div class="col-lg-10">
									<?php echo e(Form::text('admin_email', isset($frmPay->admin_email) ? $frmPay->admin_email : old('admin_email','hunguit@yahoo.com, services@ezweb.company'), array('id' => 'admin_email','class' => 'form-control','required' => 'required','placeholder'=>"Admin email, example: abc@gmail.com,email2@gmail.com"))); ?>


									<?php if($errors->has('admin_email')): ?>
										<?php echo $errors->first('admin_email', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>
								</div>
							</div>

							<div class="form-group">
							<label data-toggle="tooltip" data-placement="top" title="Content of email will be send to sender and admin at contact page." class="col-lg-2 control-label">Content email <span class="require">*</span></label>
							<div class="col-lg-10">
								<?php 
									$default_content = '<p><span style="font-size: 12pt; font-family: tahoma, arial, helvetica, sans-serif;">Thank you for your payment to receive our quality website development services.</span></p>
<p><span style="font-size: 12pt; font-family: tahoma, arial, helvetica, sans-serif;">If you have any questions, call&nbsp;our office at (509) 820-0351.</span></p>
<p><span style="font-size: 12pt; font-family: tahoma, arial, helvetica, sans-serif;">We will be contacting you in the next two business days to&nbsp;begin these services with you.</span></p>
<p><span style="font-size: 12pt;"><em><span style="font-family: tahoma, arial, helvetica, sans-serif;">Staff at Ez Web&nbsp;Company</span></em></span></p>
<p>&nbsp;</p>
<p><span style="font-family: tahoma, arial, helvetica, sans-serif; font-size: 14pt; background-color: #ffff99;">Website&nbsp;Development Customer Information:</span></p>
<table style="min-width: 320px;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#eaeced">
<tbody>
<tr><!-- module 2 --></tr>
<tr>
<td class="holder" style="padding: 0px;" bgcolor="#f9f9f9" data-bgcolor="bg-block">
<table border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="border-bottom: solid 1px #eee; padding: 10px 20px;">Hi <strong>{{txtName}}</strong></td>
</tr>
<tr>
<td style="border-bottom: solid 1px #eee; padding: 10px 20px;">Your payment has been received.</td>
</tr>
<tr>
<td style="border-bottom: solid 1px #eee; padding: 10px 20px;"><strong>Name:</strong> {{txtName}}</td>
</tr>
<tr>
<td style="border-bottom: solid 1px #eee; padding: 10px 20px;"><strong>Company:</strong> {{company}}</td>
</tr>
<tr>
<td style="border-bottom: solid 1px #eee; padding: 10px 20px;"><strong>Email:</strong> {{txtEmail}}</td>
</tr>
<tr>
<td style="border-bottom: solid 1px #eee; padding: 10px 20px;"><strong>Confirm Email:</strong> {{confirm_txtEmail}}</td>
</tr>
<tr>
<td style="border-bottom: solid 1px #eee; padding: 10px 20px;"><strong>Phone:</strong> {{phone}}</td>
</tr>
<tr>
<td style="border-bottom: solid 1px #eee; padding: 10px 20px;"><strong>Address:</strong> {{address}}</td>
</tr>
<tr>
<td style="border-bottom: solid 1px #eee; padding: 10px 20px;"><strong>Message:</strong> {{msg}}</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div style="display: none; white-space: nowrap; font: 15px/1px courier;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>';
								?>	
								<?php echo e(Form::textarea('content', isset($frmPay) && is_object($frmPay) ? $frmPay->content : old('content',$default_content), array('class' => 'tinymce form-control', 'rows' => 8,'col'=>10, 'id'=>'content'))); ?>

								<?php if($errors->has('content')): ?>
									<?php echo $errors->first('content', '<p class="help-block error">:message</p>'); ?>

								<?php endif; ?>
							</div>

						</div>

							<h2>Terms Page</h2><hr/>
							<div class="form-group">
								<label  class="col-lg-2 control-label">Content</label>
									<div class="col-lg-10">

									<?php echo e(Form::textarea('term', isset($frmPay) && is_object($frmPay) ? $frmPay->term : old('term'), array('class' => 'tinymce form-control', 'rows' => 8,'col'=>10, 'id'=>'term'))); ?>

									<?php if($errors->has('term')): ?>
										<?php echo $errors->first('term', '<p class="help-block error">:message</p>'); ?>

									<?php endif; ?>
								</div>
							</div>


							<div class="form-group">
								<div class="col-lg-2"></div>
								<div style="text-align: left;" class="col-lg-10">
									<!-- <button name="submit" type="submit" class="btn btn-primary" value="0">Submit</button> -->
									<button name="submit" type="submit" class="btn btn-success" value="1">Save</button>
									<button name="submit" type="submit" class="btn btn-primary" value="2">Save & Close</button>
									<a style="background: #ccc;" href="<?php echo e(route('admin.configTemplate')); ?>" class="btn btn-default"> Cancel </a>
								</div>
							</div>

							<?php echo e(Form::hidden('frmpay_id', isset($frmPay->id) ? $frmPay->id : 0, array("id" => "frmpay_id") )); ?>

							<?php echo e(Form::close()); ?>

						</div>
					</div>
			</section>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
##parent-placeholder-2f84417a9e73cead4d5c99e05daff2a534b30132##
<style type="text/css">
	.require {
		color: red;
	}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
##parent-placeholder-b6e13ad53d8ec41b034c49f131c64e99cf25207a##
<script type="text/javascript">
	alertify.defaults.transition = "zoom";
	$(function(){
		$('[data-toggle="tooltip"]').tooltip();

		$('.dropify').dropify({
            messages: {
		        'default': 'Drag and drop a file here or click',
		        'replace': 'Drag and drop or click to replace',
		        'remove':  'Remove',
		        'error':   'Ooops, something wrong happended.'
		    }
        });

        var drEvent = $('.dropify').dropify();
		drEvent.on('dropify.beforeClear', function(event, element){
			var itemId = $(this).attr("data-id");
			$.ajaxExec({
	            url: '<?php echo e(URL::route("admin.removeLogoTopBar")); ?>',
	            data: {
	                itemId: itemId,
	                _token: '<?php echo e(csrf_token()); ?>'
	            },
	            success: function (data) {
	            	Amo.success("remove success.",0);
	            	// alertify.alert('', data.msg,
	            	// 	function(){ 
	            	// 	 location.reload();
	            	// });
	            }
		    });
		});

		/************* Photo Contact 200x300px **************/

		$('.dropify_photo_contact').dropify({
            messages: {
		        'default': 'Drag and drop a file here or click',
		        'replace': 'Drag and drop or click to replace',
		        'remove':  'Remove',
		        'error':   'Ooops, something wrong happended.'
		    }
        });

        var drEvent = $('.dropify_photo_contact').dropify();
		drEvent.on('dropify.beforeClear', function(event, element){
			var photo_contact_id = $(this).attr("data-id");
			$.ajaxExec({
	            url: '<?php echo e(URL::route("admin.removePhotoContact")); ?>',
	            data: {
	                photo_contact_id: photo_contact_id,
	                _token: '<?php echo e(csrf_token()); ?>'
	            },
	            success: function (data) {
	            	Amo.success("remove success.",0);
	            }
		    });
		});


	});
</script>
<?php $__env->stopSection(); ?>