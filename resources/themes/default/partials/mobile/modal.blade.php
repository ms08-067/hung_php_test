<!-- Sign In / Sign Up Modal -->
<div class="modal fade bs-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<br>
			<div class="bs-example bs-example-tabs">
				<ul id="myTab" class="nav nav-tabs nav-justified">
					<li class="a_singin tab_signin"><a href="#signin" data-toggle="tab">Sign In</a></li>
				</ul>
			</div>
			<div class="modal-body">
				<div id="myTabContent" class="tab-content">
					
					<!-- Sign In Form -->
					<div class="tab-pane fade active in" id="tab_pane_signin">
						{{ Form::open(array('route' => 'user.login', 'id' => 'userLogin','class'=>'form-horizontal')) }}
							<fieldset>
								<!-- Text input-->
								<div class="control-group">
									<label class="control-label" for="Email">Email:</label>
									<div class="controls">
										<input style="width: 100%" id="TxtEmail" name="TxtEmail" class="form-control input-large" type="text" placeholder="Your email address" required>
									</div>
								</div>

								<!-- Password input-->
								<div class="control-group">
									<label class="control-label" for="passwordinput">Password:</label>
									<div class="controls">
										<input style="width: 100%" minlength="6" required id="TxtPassword" name="TxtPassword" class="form-control input-medium" type="password" placeholder="********">
									</div>
								</div>

								<div class="controls">
									<label class="control-label" for="signin"></label>
									<button type="submit" id="sign_in" class="btn btn-theme btn-block">Sign In</button>
								</div>

								<div class="controls" style="text-align: center;">
									<br/>
									<a href="">Forgot Password ?</a>
								</div>

							</fieldset>
						{{ Form::close() }}
					</div><!-- /signin -->

				</div><!-- /tab-content -->
			</div><!-- /modal-body -->

			<div class="modal-footer">
				<div class="text-center">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div><!-- /modal-content -->
	</div><!-- /modal-dialog -->
</div><!-- /modal -->


