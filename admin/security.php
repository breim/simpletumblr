<?php 
error_reporting(0);
setcookie("login","",time()-360000);
setcookie("senha","",time()-360000);
session_start();
 
if(!isset($_SESSION["sessioname"])){
session_destroy();
}else{
require_once "../config.php"; 
$username = $_SESSION["sessioname"];
$sql = mysql_query("SELECT * FROM users WHERE email='$email'") or die("O nome de Utilizador ou Senha está incorrecto. MySQL erro:".mysql_error());
$result = mysql_fetch_array($sql);
}
?>
