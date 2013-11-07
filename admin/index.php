<?php include ('security.php'); ?>
<?php
//Essa parte da página é onde verifica se o usuário já está logado e manda ele para a painel.php se não estiver logado deixa ele na index.
setcookie("login","",time()-3600);
setcookie("senha","",time()-3600);


if(isset($_SESSION["sessioname"])){
include ('painel.php');
}else{

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8"> 
<link rel="shortcut icon" href="img/favicon.ico" />
<link href="../css/bootstrap.css" rel="stylesheet">
<link href="../css/bootstrap-responsive.css" rel="stylesheet">
<title>Forevis | Painel ~ *</title>
</head>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
<style type="text/css">
body {
    padding-top: 10%;
    padding-bottom: 40px;
     }

.form-signin {
    max-width: 300px;
    padding: 19px 29px 29px;
    margin: 0 auto 20px;
    background-color: #fff;
    border: 1px solid #e5e5e5;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
    -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
     box-shadow: 0 1px 2px rgba(0,0,0,.05);
    }
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
     margin-bottom: 10px;
     }
    .form-signin input[type="text"],
    .form-signin input[type="password"] {
    font-size: 16px;
    height: auto;
    margin-bottom: 15px;
    padding: 7px 9px;
    }
</style>
<body>
<?php
$acao = $_GET ['acao'];
if($acao == 'login') {
	$email = $_POST['email'];
	$password2 = $_POST['password'];
}	
require_once('../config.php');
$sql = mysql_query("SELECT * FROM users WHERE email='".addslashes($_POST['email'])."'") or die("O nome do UsuÃ¡rio ou Senha estÃ¡ incorrecto. MySQL erro:".mysql_error()); // vê se o username existe ou não

//Contador de acessos para inserir no banco a quantidade de acesos do usuário.
$result = mysql_fetch_array($sql);
$numero = $result['acessos'];
$soma = $numero + 1;

//Criptografia MD5,pega a senha que o usuário postou e transforma ela em MD5
//$passwordMD5 = md5($password2);

//Esse if aqui embaixo não funciona,nem meche senão buga
if($password2=="" ) {
$senhaembranco = "<b>Entre com seu usuário e senha.</b>";
}elseif($result['password'] == ($password2)) {
header("location: painel.php");
session_start();
header("Cache-control: private");
$_SESSION["sessioname"] = $_POST['email'];

//Pega data para campo último acesso
$date = date("y/m/d H:i");
//Pegar o IP
$ip = $_SERVER["REMOTE_ADDR"];

$sql2 = mysql_query("UPDATE `users` SET `acessos` = '$soma',`ultimoacesso` = '$date' WHERE `users`.`email` ='".addslashes($_POST['email'])."'");
mysql_query ($sql12);
echo ("<script>
window.location.href = \"painel.php\";
</script>
");
}else{
$senhaerrada = "<div class='alert alert-error'> <button type='button' class='close' data-dismiss='alert'>&times;</button> <strong>Atenção</strong> usuário ou senha inválida</div>";
echo "<meta HTTP-EQUIV='refresh' CONTENT='60;URL=/'>";
}

if(!isset($_SESSION["sessioname"])){
echo "
<div class='container'>
<form name='acessar' method='post' class='form-signin' action='index.php?acao=login'>
	<center><img src='../img/logo.jpg' /></center>
		<h3 class='form-signin-heading'>Painel de controle</h3>";
		echo $senhaerrada;
echo "<input type='text' class='input-block-level' placeholder='E-mail...' name='email' id='email' value='$email' />";
echo "<input type='password' class='input-block-level' placeholder='Senha...' name='password'  id='password' value='$password' />" ;
echo "<button class='btn btn-large btn-block btn-primary' type='submit'>Entrar</button>" ;

echo "</form>";
echo "</div>";
}else{
}
?>
</div>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
<?php
}
?>
