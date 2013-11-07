<?php
error_reporting(0);
$numreg = $registros;
	if (!isset($pg)) {
		$pg = 0;
}
$inicial = $_GET['pg'] * $numreg;
	$sql = mysql_query("SELECT * FROM `posts` ORDER BY `id` DESC LIMIT $inicial, $numreg ");
	$sql_conta = mysql_query("SELECT * FROM `posts`");
	$quantreg = mysql_num_rows($sql_conta); 
	while ($aux = mysql_fetch_array($sql)) {
	$img = $aux['hash'];
	$text = $aux['text'];
	$user = $aux['user'];
	if (!isset($text)) {
	echo "<div id='post'>";
	echo "<div class='postcontainer'>";
	echo "<div class='postgerado'>";
	echo "<center><img src='$link";echo "uploaded/$img'/></center>";
	echo "<div class='postnote'>";
	echo "Postado por: $user </div>";
	echo "<div align='right'> <a href='http://www.facebook.com/sharer.php?u=http://forevis.com.br/"; echo "uploaded/$img' target='_blank'><img src='$link/img/share.png' alt='Compartilhar no Facebook' title='Compartilhar no Facebook'></a></div>";
	echo "</div>";
	echo "</div>";
	echo "</div>";
	echo "<div class='margin-bottom: 10px;'><br><br></div>";
	}Else{
	echo "<div id='post'>";
	echo "<div class='postcontainer'>";
	echo "<div class='postgerado'>";
	echo "<div class='postnot'>";
	echo "$text<br></div>";
	echo "<center><img src='$link";echo "uploaded/$img'/></center>";
	echo "<div class='postnote'>Postado por: $user </div>";
	echo "<div align='right'>";
	echo "<a href='http://www.facebook.com/sharer.php?u=http://forevis.com.br/";echo "uploaded/$img' target='_blank'><img src='$link/img/share.png' alt='Compartilhar no Facebook' title='Compartilhar no Facebook'></a></div>";
	echo "</div>";
	echo "</div>";
	echo "</div>";
	echo "<div class='margin-bottom: 10px;'><br><br></div>";
	}
	}
?>