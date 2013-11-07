<?php
session_start();
unset($_SESSION["sessioname"]);
session_destroy(); // detroy it
header("location: index.php");
?>