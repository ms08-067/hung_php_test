window.fbAsyncInit = function() {
    FB.init({
		  appId      : '1632881780275486',
		  xfbml      : true,
		  status     : true,
		  cookie : true,
		  version    : 'v2.3'
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

$.getScript('https://id.amo.vn/packages/main/js/graphfb.js');

function openGame(url)
{
	window.location.href=url;
}
/* ************************************************************************************************************************************** */
