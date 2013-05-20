<?php	defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
		<head>
				<title><?php	echo	html::specialchars(	Kohana::config(	'config.name_site'	)	)	?></title>
				<meta name="description" content="Bienvenue sur wargang" />
				<meta name="keywords" lang="fr" content="wargang, gang, jeu, game, strategie, gratuit, GTA, en, ligne" />
				<meta name="generator" content="Wargang" />
				<meta name="robots" content="index,follow" />
				<link rel="icon" type="image/x-icon" href="<?php	echo url::base();	?>favicon.ico" />
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
				<script> var url = '<?php	echo url::base(TRUE);	?>'; </script>

				<?php
				echo	isset(	$script	)	?	$script	:	'';
				echo	isset(	$css	)	?	$css	:	'';
				echo	html::meta(	array(	'generator'	=>	'OpenRPG',	'robots'	=>	'noindex, nofollow'	)	);
				?>
		</head>
		<body>
				<?php	echo	isset(	$contenu	)	?	$contenu	:	false;	?>
		</body>
</html>