window.fbAsyncInit = function() {
    FB.init({
		  appId      : '329873953889468',
		  xfbml      : true,
		  status     : true,
		  cookie : true,
		  version    : 'v2.2'
	});
    
};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

$.getScript('https://id.amo.vn/packages/main/js/amoCouponfb.js');

/* ************************************************************************************************************************************** */
