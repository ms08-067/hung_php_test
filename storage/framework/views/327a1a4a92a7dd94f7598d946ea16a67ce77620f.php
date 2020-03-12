<nav id="nav" class="nav-primary visible-lg nav-vertical bg-dark" <?php if(isset($_COOKIE['HiddenNavbar']) && $_COOKIE['HiddenNavbar'] == 1): ?><?php echo e('style="left: -100px"'); ?> <?php endif; ?>>

	<ul class="nav">

		

		<li <?php if(!isset($module) || $module == 'auth'): ?> class="active" <?php endif; ?>>

			<a href="<?php echo e(URL::route('admin.listForm')); ?>">

				<i class="icon-home icon-xlarge"></i>



				<span>Home</span>

			</a>

		</li>

		<!-- <li class="dropdown-submenu <?php if($module == 'admin' || $module == 'logAdmin'): ?> active <?php endif; ?>">

			<a href="<?php echo e(URL::route('admin.listForm')); ?>">

				

				<i style="font-size: 24px;" class="fa fa-cog" aria-hidden="true"></i>

				

				<span>Settings</span>

			</a>
			<ul class="dropdown-menu">
				<li>

					<a href="<?php echo e(URL::route('admin.listForm')); ?>">

						<span>List Form</span>

					</a>

				</li>

				<li>

					<a href="<?php echo e(route('admin.newForm')); ?>">

						<span>New Form</span>

					</a>

				</li>
			</ul>

		</li> -->


		<!-- <li class="dropdown-submenu <?php if($module == 'admin' || $module == 'logAdmin'): ?> active <?php endif; ?>">

			<a href="<?php echo e(URL::route('admin.emailtemplate')); ?>">
				<i style="font-size: 24px;" class="fab fa-cc-stripe" aria-hidden="true"></i>
				<span>ONE CLICK BUY BUTTONS</span>
			</a>
		</li> -->


		<li class="dropdown-submenu <?php if($module == 'admin' || $module == 'logAdmin'): ?> active <?php endif; ?>">

			<a href="<?php echo e(URL::route('admin.formSubmited')); ?>">
				<i style="font-size: 24px;" class="fas fa-comment" aria-hidden="true"></i>
				<span>Form Submited</span>
			</a>
		</li>
	
	</ul>

</nav>