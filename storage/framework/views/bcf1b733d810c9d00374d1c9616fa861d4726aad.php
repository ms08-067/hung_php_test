<div id="header-links" class="fright">
	<nav class="main-menu">
	<ul>
		<li>
			<a href="<?php echo e(route('home')); ?>" class="btn btn-theme2">
				Home
			</a>
		</li>
		<?php if(Auth::check()): ?>
		<li>
			<a href="" class="btn btn-theme2">
				Account
			</a>
		</li>
		<li>
			<a href="<?php echo e(URL::route('user.logout')); ?>" class="btn btn-theme2">

				Sign Out

			</a>

		</li>

		<?php else: ?>

			<li>

				<a href="<?php echo e(route('user.login')); ?>" class="btn btn-theme2">

					Sigin

				</a>

			</li>

			<li>

				<a href="<?php echo e(route('user.create')); ?>" class="btn btn-theme2">

					Register

				</a>

			</li>

		<?php endif; ?>
		<li class="clearfix"></li>

	</ul>

	</nav>

</div>

<div class="clearfix"></div>