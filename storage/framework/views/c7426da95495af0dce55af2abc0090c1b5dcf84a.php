<nav id="nav" class="nav-primary visible-lg nav-vertical bg-dark" <?php if(isset($_COOKIE['HiddenNavbar']) && $_COOKIE['HiddenNavbar'] == 1): ?><?php echo e('style="left: -100px"'); ?> <?php endif; ?>>

	<ul class="nav">

		

		<li <?php if(!isset($module) || $module == 'auth'): ?> class="active" <?php endif; ?>>

			<a href="<?php echo e(URL::route('admin.home')); ?>">

				<i class="icon-home icon-xlarge"></i>



				<span>Home</span>

			</a>

		</li>

		<li class="dropdown-submenu <?php if($module == 'admin' || $module == 'logAdmin'): ?> active <?php endif; ?>">

			<a href="<?php echo e(URL::route('admin.blogList')); ?>">
				<i style="font-size: 24px;" class="fas fa-newspaper"></i>
				<span>BLog List</span>
			</a>
		</li>

	</ul>

</nav>