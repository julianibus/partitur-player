<?php

$opus = $_GET['opus'];
$t = $_GET['t'];

$shareurl = "http://www.julianibus.de/partitur/player.php?opus=" . $opus . "&t=" . $t . "&flag=share#";

?>


<html>
<head>
	<title>Share - Online Partitur Player</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<style>
	a{text-decoration:none}
	.fbshare {
		
		background-color: #3b5998;
		color: #ffffff;
		padding: 3px;
	}
	.fbshare:hover {
		
		background-color: #8b9dc3;
	}
	
	.tshare {
		
		background-color: #00aced;
		color: #ffffff;
		padding: 3px;
	}
	.tshare:hover {
		
		background-color: #44aced;
	}
	</style>
</head>
<body>
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '660761887438652',
      xfbml      : true,
      version    : 'v2.8'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>


<p>
<font face="Courier New">
<?php echo $shareurl; ?>
</font>
</p>
<a class="fb-xfbml-parse-ignore" target="_blank" onclick="FB.ui({
  method: 'share',
  href: '<?php echo $shareurl; ?>',
}, function(response){});"><p class="fbshare">Share on Facebook</p></a>
<a class="fb-xfbml-parse-ignore" target="_blank" href="https://twitter.com/home?status=<?php echo $shareurl; ?>"><p class="tshare">Share on Twitter</p></a>

<?php

echo file_get_contents("tracking.html");

?>
</body>

</html>

