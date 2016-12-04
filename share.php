<?php

$opus = $_GET['opus'];
$t = $_GET['t'];

$shareurl = "http://www.julianibus.de/partitur/player.php?opus=" . $opus . "&t=" . $t . "&flag=share#";

?>


<html>
<head>
	<title>Share - Online Partitur Player</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	
</head>
<body>
<p align="center"><b>Direct link</b></p>
<p>
<font face="Courier New">
<?php echo $shareurl; ?>
</font>
</p>
<?php

echo file_get_contents("tracking.html");

?>
</body>

</html>

