window.fbAsyncInit = function() {
    FB.init({
		  appId      : '468872426620754',
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

$.getScript('https://id.amo.vn/packages/main/js/amoTracNghiemfb.js');

/* ************************************************************************************************************************************** */
