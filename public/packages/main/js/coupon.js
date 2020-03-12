$("document").ready(function($){
	
	//Enable Datetime
	$(".datetime").datepicker({
		dateFormat: 'yy-mm-dd',
		showOn: "both",
		buttonImageOnly: true,
		buttonImage: "img/cp_calendar.png"
	});
	//Enable Confirm
	$("a.confirm").click(function(e){
		if( $(e.target).is('a') )
		{
			if( !confirm($(this).data('message')) )
			{
				e.preventDefault();
			}
		}

	});
	
	$(".lightbox").click(function(e){		
		e.preventDefault();
		var socialDialog        = Common.getDialog();
		var img_src		= $(this).data('orginal');
		socialDialog.create({
			title: 'Preview',
			minWidth: 520,
			content: "<div class='lightbox-container'><img src='"+img_src+"' /></div>",
			buttons: {
				'Cancel': function(){
					$(this).dialog("close");
				}
			}
		});
	});

	$(".cp_print").click(function(e){
		//Optimize
		e.preventDefault();
		e.stopImmediatePropagation();//Why if not use this function => it will call 2 times.
		var socialDialog        = Common.getDialog();
		var message = '';
		//
		message     += '<p class="title">'+decodeURIComponent($(this).attr('data-title'))+'</p>';
		message     += '<img src="'+$(this).data('image')+'" />';
		if( $(this).data('code') )
		{
			message     += '<div class="cp_code">Code: <span class="code">'+$(this).attr('data-code')+'</span></div>';
		}
		//
		var content = ['<div class="cp_print_preview">',
							'<div class="cp_print_frame body">',
								message,
							'</div>',
						'</div>'];
		FB.getLoginStatus(function(response){
			socialDialog.create({
				title:'Print preview',
				content: content.join(''),
				minWidth: 520,
				buttons:{
					'Print'	 : function(){
						$(this).find(".body").printElement();
						$(this).dialog("close");
					},
					'Cancel' : function() {				
						$(this).dialog("close");
					}
				},
				modal: false
			});
		});
	});

	$(".cp_claim").click(function(e){
		e.preventDefault();
		e.stopImmediatePropagation();//Why if not use this function => it will call 2 times.
		if( $(this).hasClass('confirm_like') )
		{
			alert("You need to Like this page in order to claim the coupon");
			return false;
		}
		if( $(this).hasClass('go_page') )
		{
			ARR_HELPER_PAGES        = ARR_HELPER_PAGES || {};
			var idCoupon            = $(this).data('id');
			var listPageInstaled    = ARR_HELPER_PAGES[idCoupon];
			var arrStrs             = [];

			var count               = 0;
			var lastIdPage          = null;
			for (var k in listPageInstaled) {
				if (listPageInstaled.hasOwnProperty(k)) {
					lastIdPage       = k;
					++count;
				}
			}
			if( count > 1)
			{
				arrStrs.push('<div class="sm_sponsors_list">');
				arrStrs.push('<h1>You need to Like one of the pages below in order to claim the coupon.</h1>');
				arrStrs.push('<p>Please choose one page to proceed</p>');
				arrStrs.push('<ul class="list_choose_pages">');
				for( idPage in listPageInstaled)
				{
					arrStrs.push('<li>');
					arrStrs.push('<a href="'+Common.getFanpageUrl(idPage,listPageInstaled[idPage],{
						id:idCoupon
					})+'" target="_blank">'+listPageInstaled[idPage]+'</a>');
					arrStrs.push('</li>');
				}
				arrStrs.push('</ul>');
				arrStrs.push('</div>');
				var socialDialog      = Common.getDialog();
				socialDialog.create({
					title: 'Confirm this action',
					content: arrStrs.join(''),
					minWidth: 520,
					buttons:{
						'Cancel' :function() {				
							$(this).dialog("close");
						}
					}
				});
				$('.sm_sponsors_list').click(function(e){
					var target = e.target;
					if( $(target).is('a') )
					{
						socialDialog.remove(dialog);
					}
				});
			}
			else if( count === 1 )
			{
				var urlFanpage          = Common.getFanpageUrl(lastIdPage,listPageInstaled[lastIdPage],{
					id:idCoupon
				});
				//parent.location.href    = urlFanpage;
				window.open(urlFanpage);
			}
			return false;
		}
		if( $(this).attr('href') != '#' || $(this).attr('href') != '')
		{
			if( $(this).attr('target') === '_parent')
			{
				parent.location.href = $(this).attr('href');
			}
			else
			{
				document.location.href = $(this).attr('href');
			}
		}
		return false;
	});

	$('[placeholder]').focus(function() {
		var input = $(this);
		if (input.val() == input.attr('placeholder')) {
			input.val('');
			input.removeClass('placeholder');
		}
	}).blur(function() {
		var input = $(this);
		if (input.val() == '' || input.val() == input.attr('placeholder')) {
			input.addClass('placeholder');
			input.val(input.attr('placeholder'));
		}
	}).blur();

	window.LOG_STATUS_NONE 		= 0;
	window.LOG_STATUS_START 	= 1;
	window.log_status 			= LOG_STATUS_NONE;
	window.log_length			= 0;
	$('#log').bind('showNotify', function(e,data){
		log_status = LOG_STATUS_START;
		$(this).addClass('ajax_start');
		$(this).text(data.message);
		$(this).show();
		$(this).fadeIn();
		if(data.inLoop)
		{
			setTimeout(log_update,500);
		}
	});
	$('#log').bind('hideNotify', function(e,data){
		log_status = LOG_STATUS_NONE;
		$(this).addClass('ajax_stop');
		$(this).text(data.message);
		setTimeout(function(){
			$('#log').fadeOut(3000);
		},3000)
	});
	$("#log").ajaxStart(function() {
		$('#log').trigger('showNotify',[{
			message :'Browser is working!',
			inLoop  : true
		}])
	});

	$("#log").ajaxStop(function() {
		$('#log').trigger('hideNotify',[{
			message:'Action is completed!'
		}])
	});
	window.log_update = function()
	{
		if( log_status === LOG_STATUS_NONE)
		{
			return;
		}
		//http://stackoverflow.com/questions/1877475/repeat-character-n-times
		log_length 		= (log_length % 4) + 1;//log_length is max: 4
		window.dot		= Array(log_length).join('.');//dot max: '...'
		$('#log').text('Browser is working!' + window.dot);
		setTimeout(log_update,500);
	}
});

function in_array (needle, haystack, argStrict) {
	// http://kevin.vanzonneveld.net
	var key = '',
	strict = !! argStrict;

	if (strict) {
		for (key in haystack) {
			if (haystack[key] === needle) {
				return true;
			}
		}
	} else {
		for (key in haystack) {
			if (haystack[key] == needle) {
				return true;
			}
		}
	}

	return false;
}