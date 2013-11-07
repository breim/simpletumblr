<?php
error_reporting(0);
	$quant_pg = ceil($quantreg/$numreg);
	$quant_pg++;
	
	// Verifica se esta na primeira página, se nao estiver ele libera o link para anterior
	if ( $_GET['pg'] > 0) { 
	echo "<div class='botao'><div class='span4 offset2'>";
		echo "<a href=".$PHP_SELF."?pg=".($_GET['pg']-1) ."><b>&larr; anterior</b></a></div></div>";
	} else { 
	echo "<div class='botao'><div class='span4 offset2'>";
		echo "<font color=#CCCCCC>&larr; anterior</font></div></div>";
	}
	
	// Verifica se esta na ultima página, se nao estiver ele libera o link para próxima
	if (($_GET['pg']+2) < $quant_pg) { 
	echo "<div class='botao'><div class='span4 offset2'>";
		echo "<a href=".$PHP_SELF."?pg=".($_GET['pg']+1)."><b>próximo  &rarr;</b></a></div></div>";
	} else { 
	echo "<div class='botao'><div class='span4 offset2'>";
		echo "<font color=#CCCCCC>próximo  &rarr;</font></div></div>";
	}
?>