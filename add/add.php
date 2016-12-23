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
$jobid = rand(0,100000000);

##################### SECTION 1: FORM VALIDATION ##############################
flog("Reading fields");

$title = $_POST["title"];
$ytcode = $_POST["ytcode"];
$composer = $_POST["composer"];
$begin = $_POST["begin"];
$end = $_POST["end"];
$source = $_POST["source"];
$name = $_POST["name"];
$email = $_POST["email"];
$check = $_POST["check"];
$opus = $_POST["opus"];

##################### SECTION 1: CREATE FILE STRUCTURE #######################
$folder = "../rep/".$jobid;
$mediafolder = "../rep/".$jobid."/media";
$pdf = "../rep/".$jobid."/media/pdf.pdf";
$infofile = "../rep/".$jobid."/info.dat";
$scorefile = "../rep/".$jobid."/score";

if (!file_exists($folder)) {
    mkdir($folder, 0777, true);
    mkdir($mediafolder, 0777, true);
}
else {
	flogerror("Error while creating file structure.");
}

##################### SECTION 3: FILE UPLOAD #################################
flog("Uploading full score");

$target_dir = $mediafolder;
$target_file = $pdf;
$uploadOk = 1;
$imageFileType = pathinfo($pdf,PATHINFO_EXTENSION);
// Check if file already exists
if (file_exists($target_file)) {
    flogerror("Sorry, file already exists.");
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "pdf") {
    flogerror("Wrong file type. The full score must be a pdf file.");
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["score"]["tmp_name"], $pdf)) {
        echo "The file ". basename( $_FILES["score"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.".$_FILES["score"]["name"];
    }
}
##################### SECTION 4: PDF TO  IMAGE CONVERSION ########################




##################### SECTION 5: CREATE INFO FILE #################################



##################### SECTION 6: OUTPUT FURTHER INSTRUCTIONS ######################
?>
</div>
</body>
</html>
