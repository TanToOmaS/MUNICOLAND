
  window.fbAsyncInit = function() {
    FB.init({
      appId            : 'your-app-id',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v3.3'
    });
  };

<script async defer src="https://connect.facebook.net/en_US/sdk.js"></script>