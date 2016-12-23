<?php

	$msg = $_GET["msg"];
	$file_data = $msg;
	$file_data .= "\n".file_get_contents('log.txt');
	$fp = fopen("log.txt", "w");

	if (flock($fp, LOCK_EX)) {
	
	    fwrite($fp, $file_data);
	
	    flock($fp, LOCK_UN);
	} else {
	    echo "failed to obtain lock";
	}

fclose($fp);
?>
