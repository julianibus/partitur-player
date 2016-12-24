<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Progress - Online Partitur Player</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
<script type="text/javascript" src="view.js"></script>

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

##################### SECTION 1: FORM VALIDATION ##############################
flog("Reading fields...");

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
flog("Creating file structure...");
$folder = "../rep/".$jobid;
$mediafolder = "../rep/".$jobid."/media";
$pdf = "../rep/".$jobid."/media/pdf.pdf";
$infofile = "../rep/".$jobid."/info.dat";
$scorefile = "../rep/".$jobid."/score";
$pdfimg = "../rep/".$jobid."/media/".$opus.".png";

if (!file_exists($folder)) {
    mkdir($folder, 0777, true);
    mkdir($mediafolder, 0777, true);
}
else {
	flogerror("Error while creating file structure.");
}

##################### SECTION 3: FILE DOWNLOAD #################################
flog("Downloading full score...");

$url  = $score;
$path = $pdf;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$data = curl_exec($ch);

curl_close($ch);

file_put_contents($path, $data);

##################### SECTION 4: PDF TO  IMAGE CONVERSION ########################
flogb("Processing PDF file...");
$imagick = new Imagick();
$imagick->readImage($pdf);
//$imagick->writeImage($pdfimg, false);
$imagick->setImageCompressionQuality(140);
$num_pages = $imagick->getNumberImages();
for($i = 0;$i < $num_pages; $i++) {         
	flog("		Page ".$i);

	// Set iterator postion
	$imagick->setIteratorIndex($i);

	// Write Images to temp 'upload' folder     
	$imagick->writeImage("../rep/".$jobid."/media/".$opus."-".$i.".png");
}
flogb("Done.");

##################### SECTION 5: CREATE INFO FILE #################################

$content = "";
$content .= "title#".$title."\n";
$content .= "composer#".$composer."\n";
$content .= "score#".$source."\n";
$content .= "score-url#".$source."\n";
$content .= "music#".$ytcode."\n";
$content .= "music-url#".$ytcode."\n";
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
?>
</div>
</body>
</html>
