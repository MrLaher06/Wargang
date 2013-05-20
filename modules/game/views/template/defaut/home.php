<?php	defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
		<head>
				<title><?php	echo	isset(	$titre	)	?	$titre	:	Kohana::config(	'config.name_site'	);	?></title>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
				<?php
				echo	isset(	$metatag	)	?	$metatag	:	'';
				echo	isset(	$css	)	?	$css	:	'';
				?>
				<link rel="icon" type="image/x-icon" href="<?php	echo url::base();	?>favicon.ico" />
				<script> var url = '<?php	echo url::base(TRUE);	?>'; </script>
		</head>
		<body>
				<div id="contener_home">
						<?php	if(	isset(	$msg	)	)	:	?>
								<div class="Cmsg">
										<div class="msg"><?php	echo	$msg;	?></div>
								</div>
						<?php	endif	?>
						<div id="contenu_identification"> <?php	echo	isset(	$contenu	)	?	$contenu	:	'';	?> </div>
				</div>
				<?php	if(	isset(	$audience	)	)
						echo	$audience;	?>
				<?php	echo	isset(	$script	)	?	$script	:	'';	?>
		</body>
</html>