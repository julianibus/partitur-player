<html>
<head>
<title>Online Partitur Player: YouTube video availability</title>
<meta name="author" content="Julian Wienand">
<meta name="description" content="Musik, Bild, Text und Notenmaterial - der Online Partitur Player erlaubt es, alle Aspekte eines großen musikalischen Werks (Opern, Sinfonien  etc.) auf einen Bick zu erleben.">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta id="meta" name="viewport" content="width=device-width; initial-scale=0.8" />
<link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
<link rel="stylesheet" href="style.css">

</head>
<body>
	
<div class="titlebar">
<div style="margin:0 auto;">
Online Partitur Player: YouTube video availability
</div>
</div>


<div id="content">
<div style="text-align: center;"><a href="index.html">Back to index page</a></div>
	
	<br>
	<br>
<?php

function yt_exists($videoID) {
	$videoIDd = preg_replace('/\s+/', '', $videoID);
    $theURL = "http://www.youtube.com/oembed?url=http://www.youtube.com/watch?v=$videoIDd&format=json";
    $headers = get_headers($theURL);

    if (substr($headers[0], 9, 3) !== "404") {
        return true;
    } else {
        return false;
    }
}

function listFolderFiles($dir){
    $ffs = scandir($dir);
    echo '<table style="border-spacing: 10px 0;">';
    foreach($ffs as $ff){
        if($ff != '.' && $ff != '..'){
            if(is_dir($dir.'/'.$ff) && file_exists($dir.'/'.$ff . "/info.dat")) { 
				$myFile = $dir.'/'.$ff . "/info.dat";
				$fh = fopen($myFile, 'r');
				$theData = fread($fh, filesize($myFile));
				$assoc_array = array();
				$my_array = explode("\n", $theData);
				foreach($my_array as $line)
				{
				    $tmp = explode("#", $line);
				    $assoc_array[$tmp[0]] = $tmp[1];
				}
				fclose($fh);
				
				$info = $assoc_array;
				
				
				
				
				echo "<tr><td><a href='http://partitur.org/$ff'>".$ff.'</a></td>';
					if (yt_exists($info["code"]) == true) {
							echo '<td>'.$info["title"].'</td>';
							echo '<td><b><font color="green">FOUND</font></b></td>';
					}
					else {
						echo '<td><font color="red">'.$info["title"].'</font></td>';
						echo '<td><b><font color="red">MISSING</font></b></td>';
					}
				
				echo '<td><a href="http://youtube.com/watch?v='.$info["code"].'">-></a></td>';
				
				echo '</tr>';
				flush();
				ob_flush();
			}
        }
    }
    echo '</table>';
}

listFolderFiles('rep');

?>
</div>

<!-- Start of StatCounter Code for Default Guide -->
<script type="text/javascript">
var sc_project=11187792; 
var sc_invisible=0; 
var sc_security="f3fde1da"; 
var scJsHost = (("https:" == document.location.protocol) ?
"https://secure." : "http://www.");
document.write("<sc"+"ript type='text/javascript' src='" +
scJsHost+
"statcounter.com/counter/counter.js'></"+"script>");
</script>
<noscript><div class="statcounter"><a title="web analytics"
href="http://statcounter.com/" target="_blank"><img
class="statcounter"
src="//c.statcounter.com/11187792/0/f3fde1da/0/" alt="web
analytics"></a></div></noscript>
<!-- End of StatCounter Code for Default Guide -->

</body>

</html>
