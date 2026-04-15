<?php

$db_conn = mysqli_connect('localhost', 'root', '', 'lar_edu_track',3306);
if (!$db_conn) {
  die("Connection Failed: " . mysqli_connect_error());
    exit;
  }

date_default_timezone_set('Asia/Kolkata');
?>
