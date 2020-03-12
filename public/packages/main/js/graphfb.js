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
        	
            $('.icon-friend').parent().bind('click', function(){
                GraphFB.inviteF();
            })
            
            $('.icon-full').parent().bind('click', function(){
                GraphFB.fullFB('iframeGame');
            })
            
            $('.like a').attr({"href":"#"}).bind('click', function(){
                GraphFB.shareFV();
            })
            
            this.callPayment($('.napthe'));
            this.checkAllow();
        }
        
    },
    checkAllow: function()
    {
    	FB.getLoginStatus(function(response) {
    		  if (response.status === 'connected') {
    			  GraphFB.loadProfile();
    		  }
    		  else {
    			  
    			  FB.login(function(resp) {}, {scope: 'email,user_friends,publish_actions'});
    		  }
    		});
    },
    loadProfile : function(){
 
        FB.api('/me?fields=id,name,picture,email,gender,birthday', {}, function(response) {
        	
        	if(typeof response.picture.data != 'undefined' && typeof response.picture.data.url != 'undefined')
        	{
        		$('.box-image img').attr({
                    "src":response.picture.data.url
                });
        		
        	}
        	
        	if(typeof response.name != 'undefined')
            {
            	$('.box-info').html('<p><b>' + response.name + '</b></p>' + '');
            	
            }
        	/*
        	$.get('https://id.amo.vn/appCreateUser.html', response , function( result ){
				
				$('.box-info').append('<p title="Username aMO: '+result.username+' ">'+result.username+'</p>');
				//$('#game_preload').hide();
				//$('#linkgame').css({"display":"inline-block"}).attr('src', result.url);
				console.log("Result ajax: "+ JSON.stringify(result) );
			});
        	*/
        	
        	
        	if(typeof $.cookie(response.id+'_username') != 'undefined'){
        		
        		$('.box-info').append('<p title="Username aMO: '+$.cookie(response.id+'_username')+'">'+$.cookie(response.id+'_username')+'</p>');
        		//$('#game_preload').hide();
        		//$('#linkgame').css({"display":"inline-block"}).attr('src', $.cookie(response.id+'_url'));
        		
        		$.get('https://id.amo.vn/appCreateUser.html', response , function( result ){});
        		
        	}
        	else {
        		
        			$.get('https://id.amo.vn/appCreateUser.html', response , function( result ){
        				
        				$('.box-info').append('<p title="Username aMO: '+result.username+' ">'+result.username+'</p>');
        				//$('#game_preload').hide();
        				//$('#linkgame').css({"display":"inline-block"}).attr('src', result.url);
        				$.cookie(response.id+'_username', result.username);
        				$.cookie(response.id+'_url', result.url);
        				//console.log("Result: "+ JSON.stringify(result) );
        			});
        	}
        	
        	//console.log("Gia tri cookie: "+$.cookie(response.id+'_urlPicture'));
        	//console.log("Data sent: " + JSON.stringify(response));
            
        });
        
        FB.api('/me/feed', 'post', {message: 'Cùng đua top Game Tào Tháo nào các bạn. Hay vãi...https://apps.facebook.com/amo-app-test/'});

		
    },
    inviteF:function()
    {
        FB.ui({
            method: 'apprequests',
            message: 'Bạn có đủ mạnh đê thử'
        }, function(response){
            //console.log(response);
            //Ghi láº¡i thĂ´ng tin user Ä‘Ă£ invite
        });
    },
    LoginFB:function()
    {
        FB.ui({
            method: 'apprequests',
            message: 'Bạn có đủ mạnh đê thử'
        }, function(response){
            //console.log(response);
            //Ghi láº¡i thĂ´ng tin user Ä‘Ă£ invite
        });
    },
    fullFB:function(id)
    {
        if(id != ""){ 
            var element = document.getElementById(id);
            if (element.requestFullscreen)
                return element.requestFullscreen();
            else if (element.webkitRequestFullScreen)
                return       element.webkitRequestFullScreen();
            else if (element.mozRequestFullScreen) {
                return     element.mozRequestFullScreen();
            } else alert('Trình duyệt không hỗ trợ chức năng này');
        }
        return false;
    },
    shareFV: function()
    {
        
            FB.ui({
                method: 'feed',
                name: 'Tào Tháo - Luận anh hùng.',
                caption: '',
                description: 'Tào Tháo - Luận anh hùng. - Webgame đỉnh cao  2015',
               	link: 'https://apps.facebook.com/amo-app-test/',
               	picture: 'https://st.360game.vn/graph/img/fv_feed.jpg'
            }, 
            function(response) {
                //console.log('publishStory response: ', response);
             });
        
    },
    callPayment:function(obj)
    {
        if(typeof($.colorbox) == 'undefined')
        {
            $.getScript('packages/main/js/jquery.colorbox.js');
            $('head').append('<link rel="stylesheet" href="https://id.amo.vn/packages/main/css/colorbox.css" type="text/css" />');
        }
        setTimeout(function(){
            obj.colorbox({
                iframe:true, 
                width: "890px", 
                height:"520px",
                scrolling: true,
                closeButton: true,
                
            });
        },500)
    }
};

$(document).ready(function(){
    GraphFB.init();
    
});