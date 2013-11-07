<?php
error_reporting(0);
	$quant_pg = ceil($quantreg/$numreg);
	$quant_pg++;
	
	// Verifica se esta na primeira página, se nao estiver ele libera o link para anterior
	if ( $_GET['pg'] > 0) { 
	echo "<div class='span1'>";
		echo "<a href=".$PHP_SELF."?pg=".($_GET['pg']-1) ."><b>&laquo; anterior</b></a></div>";
	} else { 
	echo "<div class='span1'>";
		echo "<font color=#CCCCCC>&laquo; anterior</font></div>";
	}
	
	// Verifica se esta na ultima página, se nao estiver ele libera o link para próxima
	if (($_GET['pg']+2) < $quant_pg) { 
	echo "<div class='span1'>";
		echo "<a href=".$PHP_SELF."?pg=".($_GET['pg']+1)."><b>próximo &raquo;</b></a></div>";
	} else { 
	echo "<div class='span1'>";
		echo "<font color=#CCCCCC>próximo &raquo;</font></div>";
	}
?>