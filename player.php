<?php

function delete_all_between($beginning, $end, $string) {
  $beginningPos = strpos($string, $beginning);
  $endPos = strpos($string, $end);
  if ($beginningPos === false || $endPos === false) {
    return $string;
  }

  $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);

  return str_replace($textToDelete, '', $string);
}

$opus = $_GET['opus'];
$editor = $_GET['editor'];

#Readout info.dat
$myFile = $opus . "/info.dat";
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

#Build page from src.html
$src = file_get_contents("src.html");
$trackinghtml = file_get_contents("tracking.html");

$src = str_replace("_OPUS_", $opus, $src);
$src = str_replace("_TITLE_", $info["title"], $src);
$src = str_replace("_COMPOSER_", $info["composer"], $src);
$src = str_replace("_MUSIC_", $info["music"], $src);
$src = str_replace("_MUSIC-URL_", $info["music-url"], $src);
$src = str_replace("_SCORE_", $info["score"], $src);
$src = str_replace("_SCORE-URL_", $info["score-url"], $src);
$src = str_replace("_CODE_", trim($info["code"]), $src);
$src = str_replace("_BEGIN_", $info["begin"], $src);
$src = str_replace("_END_", $info["end"], $src);
$src = str_replace("_TRACKING_", $trackinghtml, $src);

#Editor
if ($editor != 1) {
	$src = delete_all_between("_BEGINEDITOR_", "_ENDEDITOR_", $src);
}

#Menu
$menuhtml = "";
$links = explode(";",$info["links"]);
foreach ($links as $link)
{
	$linko = explode(",",$link);
	$code = $linko[0];
	$desc = $linko[1];
	
	$menuhtml = $menuhtml . "<li><a href='player.php?opus=" . $code . "'><font color='blue'>" . $desc . "</font></a></li>";
	
}

$src = str_replace("_MENU_", $menuhtml, $src);

#Output page
echo $src;


?>
