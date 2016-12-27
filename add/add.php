<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Progress - Online Partitur Player</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">

</head>
<body id="main_body">
<div id="form_container">
<?php

ob_implicit_flush(true);
ob_end_flush();

function flog($msg) {
	echo $msg."<br>";
	ob_flush();
	flush();
}

function flogb($msg) {
	echo "<b>".$msg."</b><br>";
	ob_flush();
	flush();
}
function flogerror($msg) {
	echo "<font color='red'><b>".$msg."</b></font>"."<br>";
	ob_flush();
	flush();
}


//Create unique jobid
$jobid = date('Ymd-H-i-s');
$failed = false;

##################### SECTION 1: FORM VALIDATION ##############################
//flog("Reading fields...");

$title = $_REQUEST["title"];
$ytcode = $_REQUEST["ytcode"];
$composer = $_REQUEST["composer"];
$begin = $_REQUEST["begin"];
$end = $_REQUEST["end"];
$source = $_REQUEST["source"];
$name = $_REQUEST["name"];
$email = $_REQUEST["email"];
$check = $_REQUEST["check"];
$opus = $_REQUEST["opus"];
$score = $_REQUEST["score"];

##################### SECTION 1: CREATE FILE STRUCTURE #######################
//flog("Creating file structure...");
$folder = "../rep/".$jobid;
$nfolder = "../rep/".$opus;
$mediafolder = "../rep/".$jobid."/media";
$pdf = "../rep/".$jobid."/media/pdf.pdf";
$pdfloc = "pdf.pdf";
$infofile = "../rep/".$jobid."/info.dat";
$scorefile = "../rep/".$jobid."/score";
$pdfimg = "../rep/".$jobid."/media/".$opus.".png";

if (!file_exists($folder)) {
    mkdir($folder, 0777, true);
    mkdir($mediafolder, 0777, true);
}
else {
	flogerror("Error while creating file structure.");
	$failed = true;
}

##################### SECTION 3: FILE DOWNLOAD #################################
//flog("Downloading full score...");

$output = shell_exec("sh fetch.sh ".$mediafolder." " . $score . " " . $pdfloc . " " . $opus);
echo "<pre>$output</pre>";

//flogb("Done.");

##################### SECTION 5: CREATE INFO FILE #################################

$content = "";
$content .= "title#".$title."\n";
$content .= "composer#".$composer."\n";
$content .= "score#".$source."\n";
$content .= "music#".$ytcode."\n";
$content .= "code#".$ytcode."\n";
$content .= "begin#".$begin."\n";
$content .= "end#".$end."\n";
$content .= "author#".$name."\n";
$content .= "email#".$email."\n";
$content .= "links#";

file_put_contents($infofile, $content);

$content2 = "0";
file_put_contents($scorefile, $content2);



##################### SECTION 6: OUTPUT FURTHER INSTRUCTIONS ######################

//Finish job by renaming dir
if (!file_exists($nfolder)) {
    rename($folder, $nfolder);
}
else {
	flogerror("Error while creating file structure.");
	$failed = true;
}


if ($failed == true){
	exit();
}
?>

<div id="msg" style="display:inline;">
	<table cellpadding="10px">
	<tr>
		<td style="vertical-align:top;">
	<div class="pa" style="vertical-align:top;"><img style="width:80px;height:80px;" src="../favicon.ico"></div></td><td>
	<div class="pa" style=""><h2>Composition added</h2>
	<p>When finished the composition will be available at <pre>http://partitur.org/<?php echo $opus;?></pre>Now continue to the editor for syncing full score and music. It can be found at:<pre>http://partitur.org/<?php echo $opus;?>&editor=1</pre></p>
	<p style="text-align="center"><a href='http://partitur.org/add/edit.php?opus=<?php echo $opus;?>'>STsART EDITOR NOW</a></p></div>
	</td></tr></table>	

</div>
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
