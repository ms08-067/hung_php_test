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
            //FB.Canvas.setSize();
        	//FB.Canvas.setAutoGrow();	
        }
        
    },
    
    checkAllow: function()
    {
    	
    	$('#element_to_pop_up').bPopup({
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
    	
	    FB.api('/me?fields=id,name,email', {}, function(response) {
	    	
	    	FB.api('me/picture?width=180&height=180&redirect=false', {}, function(res) {
	    		response.url_profile = res.data.url;
	    		console.log("Data: " + JSON.stringify(response));
	    		$.get('https://id.amo.vn/amoTNCreateUser.html', response , function( result ){
	    			$("#indexStart").fadeIn(2000);
		    		$('#element_to_pop_up').bPopup().close();
		    	});
	    		
	    	});
	    		
	    });
	    
    }
};

$(document).ready(function(){
	
	GraphFB.init();
    
});







