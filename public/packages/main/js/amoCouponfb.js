var GraphFB = 
{
    init:function(){
 
        if($('#fb-root').length == 0)
        {
            setTimeout(function(){
                GraphFB.init();
            }, 500);
        }
        else
        {            
            this.checkAllow();
            FB.Canvas.setSize();
        	FB.Canvas.setAutoGrow();	
        }
        
    },
    
    checkAllow: function()
    {
    	
    	$('#element_to_pop_up').bPopup({
			//easing: 'easeOutBack', //uses jQuery easing plugin
			speed: 450,
			transition: 'slideDown',
			modalClose: false
		});
    	
    	FB.getLoginStatus(function(response) {
    		
    		if (response.status === 'connected') {
    			  GraphFB.loadProfile();
    		  }
    		  else {
    			  
    			  FB.login(function(resp) {
    				  GraphFB.loadProfile();
    			  }, {scope: 'email'});
    		  }
    		});
    },
    loadProfile : function(){
    	
	    FB.api('/me?fields=id,name,picture,email,gender,birthday', {}, function(response) {
	    	response.game_id = 20;
	    	$.get('https://id.amo.vn/amoCouponCreateUser.html', response , function( result ){
	    		$.cookie('user_id',result.user_id);
	    		$.cookie('username',result.username);
	    		if(result.gotGC != ''){
	    			
	    			$('.checkLike').hide();
        			$('#likeFB_bottom').hide();
        			
	    			$('.list_share').hide();
	    			$('.detail_privacy').show();
	    			$('.giftcode').val(result.gotGC);
	    		}
	    		else {
	    			$('.checkLike').show();
        			$('#likeFB_bottom').show();
	    			$('.detail_privacy').hide();
	    			$('.list_share').show();
	    		}
	    		
	    		$('#element_to_pop_up').bPopup().close();
	    	});
	        
	     });
    },
    getGiftCode : function() {
    	
    	FB.getLoginStatus(function(response) {
    		console.log("COOKIE: "+$.cookie('checkFistClick'));
			if (response.status === 'connected') {
				
				
				if( $.cookie('checkFistClick') == undefined ){
		    		
		    		$.cookie('checkFistClick',1);
		    		Amo.alert("Bạn cần like trang này để lấy Giftcode");
		    	}
				else {
					
					response.game_id = 20;
					response.user_id = $.cookie('user_id');
					response.username = $.cookie('username');
					
					$.get('https://id.amo.vn/amoCouponGetGC.html' , response , function( result ){
		        		
		        		if(result == 'het_gc')
		        		{
		        			
		        			Amo.alert("Đã hết Giftcode, vui lòng liên hệ với CSKH để được hỗ trợ");
		        		}
		        		else if(result == 'got_gc')
		        		{
		        			
		        			Amo.alert("Bạn đã nhận Giftcode  này rồi, liên hệ CSKH để được hỗ trợ");
		        		}
		        		else {
		        			
		        			$('.checkLike').hide();
		        			$('#likeFB_bottom').hide();
		        			$('.list_share').fadeOut(2000);
			    			$('.detail_privacy').show();
		        			$('.giftcode').val(result);
		        		}
		        		console.log("Data GET GC: " + JSON.stringify(result));
		        	});
					
					$.removeCookie('checkFistClick');
					
		    	}

			}
			else {
				
				  FB.login(function(resp) {
					  GraphFB.loadProfile();
				  }, {scope: 'email'});
			}
		});
    	
    	
    }
};

$(document).ready(function(){
	
	GraphFB.init();
    $(".cp_claim").click(function(){
		GraphFB.getGiftCode();
    });
    
});







