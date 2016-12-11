<?php

	$msg = $_GET["msg"];
	$file_data = $msg;
	$file_data .= "\n".file_get_contents('log.txt');
	file_put_contents('log.txt', $file_data);
?>
