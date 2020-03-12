@section('content')<section id="section-home-list-blogs">	<div class="container">		<div class="row">			<div class="col-xs-12 col-md-1"></div>			<div class="col-xs-12 col-md-10" style="padding-top: 32px;">				@if(!empty($listBlog))					@for($i = 0; $i < count($listBlog); $i+=2)						@if($listBlog[$i])						<div class="col-xs-12 col-md-6 des-left">							<h2><strong>{{ trim(strip_tags($listBlog[$i]->title))  }}</strong></h2>							<div class="short-desc-blog">								<em>User: {{ user($listBlog[$i]->user_id)->name() }}</em>								<?php $intro_txt = trim(strip_tags($listBlog[$i]->intro_txt)); ?> 								<div class="short-des-blog"><p>{{ (strlen($intro_txt) > 220) ? substr($intro_txt,0,220)."..." : $intro_txt }}</p></div>							</div>														<div class="">								<a data-item="{{json_encode($listBlog[$i])}}" rel="{{$listBlog[$i]->id}}" href="javascript:void(0)" class="btn btn-small btn-default viewMore">View More</a>							</div>							<hr/>						</div>						@endif						@if(isset($listBlog[$i+1]))						<div class="col-xs-12 col-md-6 des-right">							<h2><strong>{{ trim(strip_tags($listBlog[$i+1]->title))  }}</strong></h2>														<div class="short-desc-blog">								<em>User: {{ user($listBlog[$i+1]->user_id)->name() }}</em>								<?php $intro_txt = trim(strip_tags($listBlog[$i+1]->intro_txt)); ?> 								<div class="short-des-blog"><p>{{ (strlen($intro_txt) > 220) ? substr($intro_txt,0,220)."..." : $intro_txt }}</p></div>							</div>														<div class="">								<a data-item="{{json_encode($listBlog[$i+1])}}" rel="{{$listBlog[$i+1]->id}}" href="javascript:void(0)" class="btn btn-small btn-default viewMore">View More</a>							</div>							<hr/>						</div>						@endif					@endfor					@if($listBlog->total() > 6)					<div class="col-xs-12 col-md-12 center">						<br/><br/><span style="font-size: 18px;color: #37a000 !important;"> View next page: </span> 						<div style="text-align: center;">{{ $listBlog->links() }}</div>					</div>					<hr/>					@else					@endif				@endif			</div>			<div class="col-xs-12 col-md-1"></div>		</div><!--- end div.row -->		@if(Auth::check())		<div  class="row">				<!----------------------------- Start Form -------------------->			<div class="col-xs-12 col-md-2"></div>			<div style="border: solid 2px #ccc;padding-bottom: 30px;border-radius: 4px;" class="col-xs-12 col-md-8">						{{ Form::open(array('route' => 'user.postArticle', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'role' => 'form', 'style'=>'width: 100%;', 'id' => 'frmApplyblog')) }}													<h2 class="center" style="margin-top: 20px;font-weight: bold;">Post An Article </h2>								<div class="form-group">				<label>Title Blog <span class="require">*</span></label>				<div class="">					<input required="required" maxlength="300" class="form-control" type="text" name="title" value="{{ old('title') }}" />					@if($errors->has('title'))						{!! $errors->first('title', '<p class="help-block error">:message</p>') !!}					@endif				</div>			</div>				<div class="form-group">				<label>Intro article <span class="require">*</span></label>				<div class="">					<textarea id="intro_txt" name="intro_txt" rows="10" class="form-control"><?php echo isset($_POST['intro_txt']) && isset($err) && $err ? $_POST['intro_txt'] : '' ?>{{old('intro_txt')}}</textarea>					@if($errors->has('intro_txt'))						{!! $errors->first('intro_txt', '<p class="help-block error">:message</p>') !!}					@endif				</div>			</div>			<div class="form-group">				<label>Full Content <span class="require">*</span></label>				<div class="">					<textarea id="content" name="content" rows="10" class="form-control"><?php echo isset($_POST['content']) && isset($err) && $err ? $_POST['content'] : '' ?>{{old('content')}}</textarea>					@if($errors->has('content'))						{!! $errors->first('content', '<p class="help-block error">:message</p>') !!}					@endif				</div>			</div>			<div class="form-group">				<div class="">					<div class="g-recaptcha" data-sitekey="6LeqcRkTAAAAAIQUNG83jsnA2zd9nhAyApkSbRqF"></div>				</div>				@if($errors->has('googleCapchar'))					{!! $errors->first('googleCapchar', '<p class="help-block error">:message</p>') !!}				@endif			</div>			<div class="form-group">				<label><span class="require">*</span> Required</label>			</div>			<div class="form-group">				<div class="">					<input type="submit" name="submit" value="POST BLOG" class="btn btn-primary">				</div>			</div>		{{ Form::close() }}		</div>	<div class="col-xs-12 col-md-2"></div>	@else	<div  class="row">		<div class="col-xs-12 col-md-2"></div>			<div style="margin-bottom: 50px;" class="col-xs-12 col-md-8">				<div class="form-group">				<div class="center">					<a href="{{ route('user.login') }}" class="btn btn-theme2">Sigin In To Post Your Article</a>				</div>			</div>			</div>			<div class="col-xs-12 col-md-2"></div>		</div>		@endif</div><!-- end div.row -->	</div><!-- /container --></section><!-- Modal --><div class="modal fade desc_blog_model" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">  <div class="modal-dialog modal-lg" role="document">    <div class="modal-content">      <div class="modal-header">        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>        <h2 style="margin-bottom: 0px;" id="blog_title_modal" class="modal-title-popup"></h2>      </div>      <div class="modal-body">        	<p id="blog-content"></p>      </div>    </div>  </div></div>@stop@section('css')@parent<style type="text/css">span.require {	color: red;}	</style>@stop@section('javascript')	@parent<script src='https://www.google.com/recaptcha/api.js'></script><script type="text/javascript">$(document).ready(function(){		$(".viewMore").on("click",function(){		var blog_id = $(this).attr("rel");		var item = JSON.parse($(this).attr("data-item"));		$("#blog_title_modal").html(item.title);    	$("#blog-content").html(item.content);    	$(".btnApplyblog").attr("rel",blog_id);    	$('.desc_blog_model').modal({			'show' : true		});    });    		tinymce.init({        selector: "#intro_txt",        height: 160,        plugins: [          "advlist autolink autosave link  lists charmap  preview spellchecker",          "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking",          "directionality template paste textpattern"        ],        toolbar1: "bold italic bullist numlist| alignleft aligncenter alignright alignjustify",        convert_urls : 0,        menubar: false,        toolbar_items_size: 'small',        style_formats: [{          title: 'Bold text',          inline: 'b'        }],        content_css: [                 ]    });    tinymce.init({        selector: "#content",        height: 300,        plugins: [          "advlist autolink autosave link  lists charmap  preview spellchecker",          "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking",          "directionality template paste textpattern"        ],        toolbar1: "bold italic bullist numlist| alignleft aligncenter alignright alignjustify",        convert_urls : 0,        menubar: false,        toolbar_items_size: 'small',        style_formats: [{          title: 'Bold text',          inline: 'b'        }],        content_css: [                 ]    });});	</script>@stop