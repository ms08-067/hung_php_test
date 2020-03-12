<div id="header-links" class="fright">
	<nav class="main-menu">
	<ul>
		<li>
			<a href="{{ route('home') }}" class="btn btn-theme2">
				Home
			</a>
		</li>
		
		@if(Auth::check())
		<li>
			<a href="{{ route('user.myAccount') }}" class="btn btn-theme2">
				My Account
			</a>
		</li>
		<li>
			<a href="{{ URL::route('user.logout') }}" class="btn btn-theme2">
				Sign Out
			</a>
		</li>
		@else

			<li>

				<a href="{{ route('user.login') }}" class="btn btn-theme2">

					Sigin

				</a>

			</li>

			<li>

				<a href="{{ route('user.create') }}" class="btn btn-theme2">

					Register

				</a>

			</li>

		@endif
		<li class="clearfix"></li>

	</ul>

	</nav>

</div>

<div class="clearfix"></div>