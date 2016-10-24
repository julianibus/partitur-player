<?php

  $msg = $_GET["msg"];

  file_put_contents("log.txt", $msg."\n", FILE_APPEND);

?>
