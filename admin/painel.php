<?php include ('security.php'); ?>
<?php
//Essa parte da página é onde verifica se o usuário já está logado e manda ele para a painel.php se não estiver logado deixa ele na index.
setcookie("login","",time()-3600);
setcookie("senha","",time()-3600);


if(!isset($_SESSION["sessioname"])){
include ('index.php');
}else{

//o final "} " está no final da página para validação.
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8"> 
<link rel="shortcut icon" href="img/favicon.ico" />
<link href="../css/bootstrap.css" rel="stylesheet">
<link href="../css/bootstrap-responsive.css" rel="stylesheet">
<title>Forevis | Painel ~*</title>
</head>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
<body>
<a href='#'>
				<img src='../img/logo.jpg' />
			</a>
<?php
if(!isset($_SESSION["sessioname"])){
include ('index.php');
}else{
$sql = mysql_query("SELECT * FROM users WHERE email='".addslashes($_SESSION['sessioname'])."'") or die("O nome do Usuário ou Senha está incorrecto. MySQL erro:".mysql_error()); // vê se o username existe ou não
$result = mysql_fetch_array($sql);
$usuariologado = $result['nome'];
echo "<div align='right'";
echo "<font face='Arial' size='2'>Olá, " ;
echo $result['nome']  . "   " . " / " ;
echo "<a href='logout.php' align='right' >Sair</a>" ;
echo "</font>";
echo "</div>";
}
?>
<div class="navbar">
	<div class="navbar-inner">
		<a class="brand" href="#">Administração</a>
		<ul class="nav">
			<li class="active"><a href="#">Posts</a></li>
			<li><a href="upload.php">Upload</a></li>
		</ul>
    </div>
</div>
<div class='row'>
	<div class='span10 offset1'>
		<table class='table table-bordered'>
			<tr>
				<th>Id</th>
				<th>Foto</th>
				<th>Usuario</th>
				<th>Data</th>
			</tr>		
<?php
error_reporting(0);
	$numreg = 10; // Quantos registros por página vai ser mostrado
	if (!isset($pg)) {
		$pg = 0;
	}
	$inicial = $_GET['pg'] * $numreg;
require_once('../config.php');
$sql = mysql_query("SELECT * FROM `posts` ORDER BY `id` DESC LIMIT $inicial, $numreg ");
$sql_conta = mysql_query("SELECT * FROM `posts`");
$quantreg = mysql_num_rows($sql_conta);
$achados = mysql_num_rows($sql);
echo "Econtrados <span class='badge badge-warning'>$quantreg</span> registros";
echo "<div class='span4 offset7'>";

include("paginacao.php");
echo "</div>";
$pegarusuario = mysql_fetch_array($sql_conta);
		while ($users = mysql_fetch_object($sql)) {
			echo 	"<td>$users->id</td>";
			echo 	"<td>";
			echo 	"$users->hash</td>";
			echo 	"<td>";
			echo 	"$users->user</td>";
			echo 	"<td>";
			echo date('d/m/y', strtotime($users->timestramp));
			echo    "</td>";
			echo	"<td>";
			if ($usuariologado == $users->user){			
			echo    "<center><a href='?id=$users->id'<buttom class='btn btn-danger'>Apagar</buttom></a></center>";
			echo	"</td>";
			echo	"<td>";
			echo 	"<div class='span1'><a href='http://forevis.com.br/uploaded/$users->hash' TARGET='_blank' ><img src='http://forevis.com.br/";echo "uploaded/$users->hash' TARGET='_blank' /></a></div>";
			echo	"</td>";
			echo  	"</tr>";
			}else{
			echo	"<td>";
			echo 	"<div class='span1'><a href='http://forevis.com.br/uploaded/$users->hash' TARGET='_blank' ><img src='http://forevis.com.br/";echo "uploaded/$users->hash' TARGET='_blank' /></a></div>";
			echo	"</td>";
			echo  	"</tr>";
	}
	}
	if($_GET['id']){
	$id = $_GET['id'];
	$idsearch = mysql_query("SELECT id,user FROM `posts` where id like $id ");
	$resultados = mysql_fetch_array($idsearch);
	$user = $resultados['user'];
	if($usuariologado == $user){
	mysql_query("DELETE FROM `posts` WHERE id = ".$_GET['id']);
	echo "<meta HTTP-EQUIV='refresh' CONTENT='4;URL=painel.php'>";
	echo "</div><div class='alert alert-success'><strong>Sucesso!</strong> a foto foi deletada.</div>";
	}Else{
	 echo "</div><div class='alert alert-block'>
    <button type='button' class='close' data-dismiss='alert'>&times;</button>
    <h4>Opa!</h4>
    não podemos apagar a foto selecionada !
    </div>";
	echo "<meta HTTP-EQUIV='refresh' CONTENT='4;URL=painel.php'>";
	}
	}
	echo "</tbody>";
	echo "</table>";
	echo "<br>";
?>
</div>
</div>
</div>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
<?php
}
?>
