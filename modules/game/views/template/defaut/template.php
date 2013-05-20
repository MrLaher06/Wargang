<?php	defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
		<head>
				<title><?php	echo	html::specialchars(	Kohana::config(	'config.name_site'	)	)	?></title>
				<meta name="description" content="Bienvenue sur wargang"/>
				<meta name="keywords" lang="fr" content="wargang, gang, jeu, game, strategie, gratuit, GTA, en, ligne"/>
				<meta name="generator" content="Wargang" />
				<meta name="robots" content="index,follow" />
				<link rel="icon" type="image/x-icon" href="<?php	echo url::base();	?>favicon.ico" />
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
				<script> var url = '<?php	echo url::base(TRUE);	?>'; </script>
				<?php
				echo	isset(	$css	)	?	$css	:	'';
				echo	isset(	$script	)	?	$script	:	'';
				echo	html::meta(	array(	'generator'	=>	'OpenRPG',	'robots'	=>	'noindex, nofollow'	)	);
				?>
				<?php	if(	isset(	$facebook	)	)	:	?>

						<style type="text/css">
								<!--
								body {
										border:1px solid #000;
										min-height:590px;
								}
								-->
						</style>
				<?php	endif	?>
		</head>
		<body>
				<div id="contenu"><?php	echo	isset(	$contenu	)	?	$contenu	:	false;	?><?php	echo	isset(	$debug	)	?	$debug	:	false;	?></div>
				<div id="drogues"><?php	echo	isset(	$drogues	)	?	$drogues	:	false;	?></div>
				<div id="gang"><?php	echo	isset(	$gang	)	?	$gang	:	false;	?></div>
				<div id="user"><?php	echo	isset(	$user	)	?	$user	:	false;	?></div>
				<div id="historique"><?php	echo	isset(	$historique	)	?	$historique	:	false;	?></div>
				<div id="tchat"><?php	echo	isset(	$tchat	)	?	$tchat	:	false;	?></div>
				<div id="competences"><?php	echo	isset(	$competences	)	?	$competences	:	false;	?></div>
				<div id="msg"></div>
				<?php	echo	isset(	$menu_top	)	?	$menu_top	:	false;	?>
				<?php	if(	isset(	$audience	)	)
						echo	$audience;	?>
				<div id="msg_alerte"></div>
				<?php	echo!isset(	$facebook	)	?	html::script(	'js/template.js'	)	:	html::script(	'js/template_facebook.js'	);	?>
		</body>
</html>