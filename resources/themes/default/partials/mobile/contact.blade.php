<!-- Footer Wrap -->
<section id="contact">
	<div class="footerwrap">
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<h3>Liên Hệ</h3>
					<br /><br /><br />
					<p>
					<!--<span class="icon-location"></span> Tầng 8, tòa nhà Licogi13 - 164 Khuất Duy Tiến, Nhân Chính, Thanh Xuân, Hà Nội<br/>
						<span class="icon-phone"></span> (+84) 0982043592 <br/>-->
						<span class="icon-envelope"></span> <a href="mailto:contact@luyentienganhonline.com">contact@luyentienganhonline.com</a>
					</p>
					<p>m.me/luyentienganhonline24h</p>
					
				</div>

				<div class="col-lg-3">
					<h3>Follow On Facebook</h3>
					<br>
					<a href="https://www.facebook.com/luyentienganhonline24h/?ref=bookmarks" target="_blank"><div id="social">
							&nbsp;
					</div></a>
				</div>

				<div class="col-lg-5 news-letter">
					<h3>Newsletter</h3>
					<br>
					<p>Đăng ký thông tin của bạn để là những người đầu tiên nhận thông báo về những thay đổi, nội dung mới trên website.</p>
					<div class="form-inline">
						{{ Form::open(array('route' => 'home', 'id' => 'userSubscribe','class'=>'form-horizontal frm')) }}
						<div class="">
						<input style="width: 148px !important" minlength="3" required="required" placeholder="First name" type="text" class="@if($errors->has('f_name')) error @endif form-control form-subscrible" name="f_name" value="">
						
						<input style="width: 148px !important" minlength="3" required="required" placeholder="Last name" type="text" class="@if($errors->has('l_name')) error @endif form-control form-subscrible" name="l_name" value=""><br/>
						</div>
						<div style="margin-top: 8px;" class="">
						<input style="width: 300px !important;" minlength="3"  name="txtEmail" type="email" class="@if($errors->has('txtEmail')) error @endif form-subscrible" placeholder="Your email" required>
						</div>
						
						<div style="margin-top: 8px;" class="">
							<img src="{{ URL::route('captcha') }}" alt="Captcha" class="captcha" />
						</div>

						<div style="margin-top: 8px; width: 100%;clear: both; min-height: 30px;" class="">
							<input style="width: 264px !important;margin-right: 4px;" type="text" name="TxtCaptcha" id="TxtCaptcha" placeholder="Nhập mã xác nhận" maxlength="4" minlength="4" required="required" class="form-subscrible form-control fleft @if($errors->has('captcha')) error @endif" autocomplete="off" />
						
						<a style="background: #FFF;border-radius: 2px;" class="fleft" href="javascript:reloadCaptcha();" title="Tải lại mã xác nhận">
							<img src="{{ asset('packages/main/img/reload.png') }}" class="fleft reload-captcha" />
						</a>
						
						</div>

						<div style="margin-top: 12px; width: 100%;" class="">
						
						<button class="btn btn-theme" type="submit">Subscribe</button>
						</div>
						
						{{ Form::close() }}
					</div>
				</div>
			</div><!-- /row -->
		</div><!-- /container -->
	</div><!-- /footerwrap -->
</section>