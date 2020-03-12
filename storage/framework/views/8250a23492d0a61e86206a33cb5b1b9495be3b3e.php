<?php $__env->startSection('javascript'); ?>
	<script type="text/javascript">
		var base_url = '<?php echo e(asset('')); ?>';
	</script>
	<!-- library jquery -->
	<script type="text/javascript" src="<?php echo e(asset('packages/jquery/js/jquery-3.1.1.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('packages/bootstrap-3.3.7-dist/js/bootstrap.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('packages/jquery/js/jquery-migrate-1.2.1.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('packages/jquery/js/jquery.cookie.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('packages/jquery/js/jquery.mousewheel.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('packages/jquery/js/jquery.placeholder.js')); ?>"></script>
	<!-- jquery Validation engine -->
	<script type="text/javascript" src="<?php echo e(asset('packages/validation/js/languages/jquery.validationEngine-vi.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('packages/validation/js/jquery.validationEngine.js')); ?>"></script>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      	<script src="<?php echo e(asset('packages/html5/js/html5shiv.js')); ?>" type="text/javascript"></script>
      	<script src="<?php echo e(asset('packages/html5/js/respond.min.js')); ?>" type="text/javascript"></script>
	<![endif]-->
	<script type="text/javascript" src="<?php echo e(asset('packages/thickbox/js/thickbox.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('packages/main/js/sidebar-menu.js')); ?>"></script>

	<!-- <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> -->
	<!-- <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script> -->
	
	<script
	  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
	  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
	  crossorigin="anonymous"></script>
	  
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<script type="text/javascript" src="<?php echo e(asset('packages/main/js/main.js')); ?>?v=<?php echo e(Config::get('main.version')); ?>"></script>

	<script type="text/javascript">
		<?php if(Auth::check()): ?>
			var userID = "<?php echo e(Auth::user()->id); ?>";
		<?php else: ?>
			var userID = 0;
		<?php endif; ?>

		var Amo = {};
		Amo.alert = function(text, t = 6000)
		{
		    $(".alert-danger").stop(true, true).find('p').html(text);
		    $(".alert-danger").stop(true, true).css('display', 'none').css('display', 'block').fadeOut(t);
		}

		Amo.success = function(text, t = 6000)
		{
		    $(".alert-success").stop(true, true).find('p').html(text);
		    $(".alert-success").stop(true, true).css('display', 'none').css('display', 'block').fadeOut(t);
		}

		$(document).ready(function(){

			<?php if(Session::has('flash_error_message')): ?>
				Amo.alert('<?php echo e(Session::get("flash_error_message")); ?>', 10000);
	      	<?php endif; ?>
	      	
	      	<?php if(Session::has('flash_success_message')): ?>
				Amo.success('<?php echo e(Session::get("flash_success_message")); ?>',10000)
	      	<?php endif; ?>
			
			// Amo.checkLogin();
			$('input, textarea').placeholder();
			$("#error-container").on('click', '.close', function(){
				$(".alert").stop(true, true).css('display', 'none');
			});

			$(".captcha").on('click', function(){
				$(this).attr('src', $(this).attr('src'));
				return false;
			});

			$(".menu .control").on('click', function(){
				$(this).siblings().slideToggle();
				return false;
			});

			$(".confirm").live('click', function(event)
			{
		        var text = ($(this).data('confirm-title')) ? $(this).data('confirm-title') : 'Bạn có chắc chắn không ? ';
		        if (confirm(text)) {
		            var func = $(this).data('func');
		            if (func != undefined) {

		                eval(func);
		            }

		        } else {
		            event.preventDefault();
		            return false;
		        }
		    });

			$(".confirm-danger").live('click', function(event) {
	            var a = Math.floor((Math.random() * 30) + 1);
	            var b = Math.floor((Math.random() * 30) + 1);
	            var answer = prompt(a + ' + ' + b + ' = ?');
	            var right_answer = Math.floor(a + b);
	            if (answer == right_answer) {
	                var func = $(this).data('func');
	                if (func != undefined) {
	                    eval(func);
	                }

	            } else {
	                if (answer != null) {
	                    alert('Bạn đã trả lời sai.');
	                }
	                event.preventDefault();
	                return false;
	            }
	        });
	        /*
	        $("button[type='submit']").on('click', function(){

	        	disableButton(this);
	        });
	        $("input[type='submit']").on('click', function(){
	        	disableButton(this);
	        });
	        */
		});

		function reloadCaptcha()
		{
			$("img.captcha").attr('src', $("img.captcha").attr('src')+'?t=1');
		}

		function disableButton(button)
		{
			button.disabled = true;
			var result = $(button.form).validationEngine('validate');
			if(result)
			{
				var form = $(button.form);
				if(form.data('func') != undefined)
				{
					form.find("[type='submit']").attr('disabled', 'disabled');
					var func = form.data('func');
					eval(func);
					form.find("[type='submit']").removeAttr('disabled');

				}else{

					button.form.submit();
				}
			}else{
				button.disabled = false;
			}
		}
		
		function form_submit(name)
		{
		    $("[name=\""+name+"\"]").submit();
		}

		$.sidebarMenu($('.sidebar-menu'));

$(document).ready(function () {
        	
	$('a').bind("click", function(e) {
        var target = $(this).attr("href"); // Get the target element
        if( target  && target.indexOf("#") != "-1"){
        	var scrollToPosition = $(target).offset().top; // Position to scroll to
	        $('html /* For FF & IE */,body /* For Chrome */').animate({
	            'scrollTop': scrollToPosition 
	        }, 500, function(target){
	            window.location.hash = target;
	        });
	        e.preventDefault();
        }
        
    });
}); 

</script>
<?php echo $__env->yieldSection(); ?>

<script type="text/javascript">
	 /*
	 google analytics here 
	 */
	 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-98652027-1', 'auto');
	  ga('send', 'pageview');
</script>