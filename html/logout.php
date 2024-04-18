<?php
session_start();
session_unset();
$_SESSION = array();
session_destroy(); // destroy session
header("location:index.php");
exit();
