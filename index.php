<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8"> 
<meta name="description" content="forevis,humor,blogforevis,risadas,brincadeira,imagens,memes">
<link rel="shortcut icon" href="img/favicon.ico" />
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<?php 
require_once('config.php');
$confs = mysql_query("SELECT * FROM `siteconf`");
$result = mysql_fetch_array($confs);
$titulo = $result['title'];
$link = $result['link'];
$registros = $result['registros'];
?>
<title><?php echo $titulo?></title>
</head>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38490858-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=475068522560635";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<html xmlns:fb="http://ogp.me/ns/fb#">
<body>
<div class="wrapper">
			<a href='/'>
				<img src="<?php $link;?>img/header2.jpg" />
			</a><br><br>
				<div class="row-fluid">
				<div class="span7">
<?php
error_reporting(0);
	$link = $_GET ['link'];
	if($link == '') {
	include ("timeline.php");
	include("paginacao.php"); echo "<br><br>"; 
	echo "<br><br>";
	}
	if($link == 'upload') {
	require ('upload.php');
	}
?>
			</div>
			<div class="row-fluid">
				<div class='span5'>
				<div style="padding-left:18px;">
				<h2><center>SOCIAL</center></h2>
					<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FBlogForevis&amp;width=350&amp;height=350&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=false&amp;header=false&amp;appId=139446629455879" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:350px; height:350px;" allowTransparency="true"></iframe>
					<br><br>
				<h2><center>PARCEIROS</center></h2>		
				<h2><center>Propaganda</center></h2>		   
				<h2><center>Comentários</center></h2>		
					<fb:comments href="http://www.forevis.com.br" width="350" num_posts="10"></fb:comments>
					</div>
				</div>
 			</div>
		</div>
	</div>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>