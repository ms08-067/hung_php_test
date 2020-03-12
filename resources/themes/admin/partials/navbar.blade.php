<nav id="nav" class="nav-primary visible-lg nav-vertical bg-dark" @if(isset($_COOKIE['HiddenNavbar']) && $_COOKIE['HiddenNavbar'] == 1){{ 'style="left: -100px"' }} @endif>

	<ul class="nav">

		

		<li @if(!isset($module) || $module == 'auth') class="active" @endif>

			<a href="{{ URL::route('admin.home') }}">

				<i class="icon-home icon-xlarge"></i>



				<span>Home</span>

			</a>

		</li>

		<li class="dropdown-submenu @if($module == 'admin' || $module == 'logAdmin') active @endif">

			<a href="{{ URL::route('admin.blogList') }}">
				<i style="font-size: 24px;" class="fas fa-newspaper"></i>
				<span>BLog List</span>
			</a>
		</li>

	</ul>

</nav>