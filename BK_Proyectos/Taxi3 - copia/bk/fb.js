function statusChangeCallback(response) {
	console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
    	// Logged into your app and Facebook.
      	window.location.replace('./fbapp/login-callback.php');
    } else if (response.status === 'not_authorized') {
      	// The person is logged into Facebook, but not your app.
        //alert('User not authorised');
        document.getElementById('fbstatus').innerHTML='You are not connected to Facebook';
    } else {
      	// The person is not logged into Facebook, so we're not sure if
      	// they are logged into this app or not.
        document.getElementById('fbstatus').innerHTML='You are not logged in into Facebook';
        window.location.replace('./fbapp/logout-callback.php');
    }
}

function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
}

window.fbAsyncInit = function() {
	FB.init({
	appId      : '1564307063870897',
	cookie     : true,  // enable cookies to allow the server to access 
	                    // the session
	xfbml      : true,  // parse social plugins on this page
	version    : 'v2.5' // use any version
});
	
};

// Load the SDK asynchronously
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
