<?php

$opus = $_GET["opus"];
$mode = $_GET["mode"];

if ($mode == "1"){
	$file = "../rep/".$opus."/score";
	$modus = "syncing data";
}
elseif ($mode == "2"){
	$file = "../rep/".$opus."/info.dat";
	$modus = "main info";
}
elseif ($mode == "3"){
	$file = "../rep/".$opus."/markers";
	$modus = "repetition data";
}
else {
	echo "Error: Invalid parameters.";
	exit();
}
	


// configuration
$url = 'http://partitur.org/add/edit.php?opus='.$opus;

// check if form has been submitted
if (isset($_POST['text']))
{
    // save the text contents
    file_put_contents($file, $_POST['text']);

    // redirect to form again
    header(sprintf('Location: %s', $url));
    printf('<a href="%s">Moved</a>.', htmlspecialchars($url));
    exit();
}

// read the textfile
$text = file_get_contents($file);

?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Editor - Online Partitur Player</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">

</head>
<body id="main_body">
<div id="form_container">

<table cellpadding="10px">
<tr>
	<td style="vertical-align:top;">
<div class="pa" style="vertical-align:top;"><img style="width:80px;height:80px;" src="../favicon.ico"></div></td><td>
<div class="pa" style=""><h2>Editing <?php echo $modus;?> of <?php echo $opus;?></h2>
<p></p>

</div>
</td></tr></table>	
<br>
<br>
<!-- HTML form -->
<form action="" method="post">
<textarea style="width:100%; height: 300px;margin:10px;" name="text"><?php echo htmlspecialchars($text) ?></textarea>
<br>
<p style="text-align:center;">
<input type="submit" value="Save"/> <input type="button" onclick="location.href='edit.php?opus=<?php echo $opus;?>'" value="Cancel and go back" />
</p>
</form>


</div>
<script type="text/javascript">
var sc_project=11187792; 
var sc_invisible=1; 
var sc_security="f3fde1da"; 
var scJsHost = (("https:" == document.location.protocol) ?
"https://secure." : "http://www.");
document.write("<sc"+"ript type='text/javascript' src='" +
scJsHost+
"statcounter.com/counter/counter.js'></"+"script>");
</script>
<noscript><div class="statcounter"><a title="shopify
analytics ecommerce" href="http://statcounter.com/shopify/"
target="_blank"><img class="statcounter"
src="//c.statcounter.com/11187792/0/f3fde1da/1/"
alt="shopify analytics ecommerce"></a></div></noscript>

</body>
</html>
