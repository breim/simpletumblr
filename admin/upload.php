<?php include ('security.php'); ?>
<?php
error_reporting(0);
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
<meta name="description" content="e-procurrement,vendas,compras,valorbase">
<link rel="shortcut icon" href="img/favicon.ico" />
<link href="../css/bootstrap.css" rel="stylesheet">
<link href="../css/bootstrap-responsive.css" rel="stylesheet">
<title>Forevis! Sweeeet ~ </title>
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
error_reporting(0);
if(!isset($_SESSION["sessioname"])){
include ('index.php');
}else{
$sql = mysql_query("SELECT * FROM users WHERE email='".addslashes($_SESSION['sessioname'])."'") or die("O nome do Usuário ou Senha está incorrecto. MySQL erro:".mysql_error()); // vê se o username existe ou não
$result = mysql_fetch_array($sql);
echo "<div align='right'";
echo "<font face='Arial' size='2'>Olá, " ;
$user = $result['nome'];

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
			<li><a href="index.php">Posts</a></li>
			<li class="active"><a href="upload.php">Upload</a></li>
		</ul>
    </div>
</div>
<div class='span10 offset1'>
<h3>Upload de fotos</h3>
<h5>para enviar fotos,sigas as regras ao lado.</h5>
<div class='container-fluid'>
	<div class='row-fluid'>
		<div class='span3 offset2'>
			<form method="post" action="upload.php?acao=upload" enctype="multipart/form-data">
			<label>Digite o texto a ser exibido:</label>		
			<textarea name="text" rows='3'></textarea><br>
			<label>Selecione as fotos</label>
			<div class='fileinputs'>
				<input type='file' name='arquivo'/>
					<br><br>
					<input type='submit' class='btn btn-large btn-primary' value='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Enviar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' />
			</div>
		</div>
		<div class='span4 offset3'>
		<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Regra 1:</strong> Tamanho máximo de arquivos é 2mb.<br>
		<strong>Regra 2:</strong> Extensões válidas são jpg,png ou gif.
    </div></div>
	</div>
</div>

<?php
$acao = $_GET ['acao'];
if($acao == 'upload') {
$text = $_POST ['text'];
}
// Pasta onde o arquivo vai ser salvo
$_UP['pasta'] = '../uploaded/';

// Tamanho máximo do arquivo (em Bytes)
$_UP['tamanho'] = 4024 * 4024 * 12; // 2Mb

// Array com as extensões permitidas
$_UP['extensoes'] = array('jpg', 'png', 'gif' ,'pdf');

// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
$_UP['renomeia'] = false;

// Array com os tipos de erros de upload do PHP
$_UP['erros'][0] = 'Não houve erro';
$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$_UP['erros'][4] = 'Não foi feito o upload do arquivo';

// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
if ($_FILES['arquivo']['error'] != 0) {
die("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['arquivo']['error']]);
exit; // Para a execução do script
}

// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar

// Faz a verificação da extensão do arquivo
$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
if (array_search($extensao, $_UP['extensoes']) === false) {
}

// Faz a verificação do tamanho do arquivo
else if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
echo "O arquivo enviado é muito grande, envie arquivos de até 12Mb.";
}

// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
else {
// Primeiro verifica se deve trocar o nome do arquivo
if ($_UP['renomeia'] == true) {
// Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
//$nome_final = time().'.jpg';
} else {
// Mantém o nome original do arquivo
$data = time();
$varnome = md5($_FILES['arquivo']['name']);
$nome_final = $varnome . '.' . $extensao;

/*Criar uma tabela no banco onde iremos verificar esse processo em back office para aprovação
A mesma ficaria setada com ID,IDUSER,CNPJ e FLAGS de aprovação, teria que ser uma tabela diferente da já existente no sistema
*/
}

// Depois verifica se é possível mover o arquivo para a pasta escolhida
if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {
$date = date("y/m/d H:i");
$user = $result['nome'];
//conectar ao db
require_once('../config.php');
$query = "INSERT INTO `posts` (`id`, `hash`, `user`, `text`, `timestramp`) VALUES ('', '$nome_final', '$user', '$text', '$date')";
mysql_query($query);
// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
echo "Upload efetuado com sucesso!";
$link = $_UP['pasta'] . $nome_final;
echo "<meta HTTP-EQUIV='refresh' CONTENT='4;URL=upload.php'>";
	echo "<div class='alert alert-success'><strong>Sucesso!</strong> $nome_final a foto foi inserida no site.</div>";
echo "<br />";
} else {
// Não foi possível fazer o upload, provavelmente a pasta está incorreta
echo "Não foi possível enviar o arquivo, tente novamente";
}

}
?>
<hr>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
<?php
}
?>
