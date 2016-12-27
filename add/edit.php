<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Editor - Online Partitur Player</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">

</head>
<body id="main_body">
<div id="form_container">
<?php

$opus = $_GET['opus'];

if (!file_exists("../rep/" . $opus)) {
  echo file_get_contents("../opus_not_found.html");
  exit();
}

if ( !(isset( $_GET['opus'] ) && !empty( $_GET['opus'] )) ) {
  echo file_get_contents("../opus_not_found.html");
  exit();
}



?>
<!-- HTML form -->
<table cellpadding="10px">
<tr>
	<td style="vertical-align:top;">
<div class="pa" style="vertical-align:top;"><img style="width:80px;height:80px;" src="../favicon.ico"></div></td><td>
<div class="pa" style=""><h2>Editing <?php echo $opus;?></h2>
<p>Choose what you want to edit.</p>

</div>
</td></tr></table>	
<br>
<br>
<div style="border:solid; border-width:2px; border-color:orange; background-color:yellow;padding:5px;margin:10px;">
<h3>Syncing data</h3>
<p>At first you need to tell the Online Partitur Player when tu turn the pages.</p>
<p><a href="editor.php?opus=<?php echo $opus;?>&mode=1">Start editing syncing data</a></p>
</div>

<br>

<div style="border:solid; border-width:2px; border-color:orange; background-color:yellow;padding:5px;margin:10px;">
<h3>Main info</h3>
<p>Check again the basic information of the composition and make sure there are no mistakes.</p>
<p><a href="editor.php?opus=<?php echo $opus;?>&mode=2">Start editing main info</a></p>
</div>

<br>

<div style="border:solid; border-width:2px; border-color:orange; background-color:yellow;padding:5px;margin:10px;">
<h3>Repetitions</h3>
<p>If there are repetitions in the composition that cannot be handled by the provided syncing data please mark them here.</p>
<p><a href="editor.php?opus=<?php echo $opus;?>&mode=3">Start editing repetitions</a></p>
</div>


<br>
<br>
<p style="margin:10px;">
<a href="http://partitur.org/<?php echo $opus; ?>">Test this composition</a>
<br><br>
<a href="http://partitur.org/">Return to the main page</a><br>
<a href="http://partitur.org/add">Add another composition</a>
</p>

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
