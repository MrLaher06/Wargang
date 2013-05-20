<?php	defined(	'SYSPATH'	)	OR	die(	'No direct access allowed.'	);	?>
<div class="conteneur">
		<?php	if(	!isset(	$frame	)	||	$frame	===	false	)	:	?>
		  <h1>War Gang</h1>
		<?php	endif	?>
  <h2 align="center" style="margin-top:20px;">Reset en cours de préparation</h2>
  <div align="center" style="margin-top:20px; margin-bottom:20px;">Ouverture à <blink>20h00</blink> (Paris)</div>
</div>
<?php	if(	!isset(	$frame	)	||	$frame	===	false	)	:	?>
		<ul class="menu_home">
				<li><?php	echo	html::anchor(	'home/story',	'Histoire',	array(	'class'	=>	'iframe',	'title'	=>	'Histoire de War Gang'	)	);	?></li>
				<li><a target="_blank" href="http://www.openrpg.fr/forums/wargang" title="Forum de War Gang">Forum</a></li>
				<li><?php	echo	html::anchor(	'home/score',	'Scores',	array(	'class'	=>	'iframe',	'title'	=>	'Liste des meilleurs joueurs sur War Gang'	)	);	?></li>
				<li><?php	echo	html::anchor(	'home/journal',	'Journal',	array(	'class'	=>	'iframe',	'title'	=>	'Le journal de War Gang'	)	);	?></li>
				<li><?php	echo	html::anchor(	'home/screenshot',	'Capture écran',	array(	'class'	=>	'iframe',	'title'	=>	'Une capture écran de War Gang'	)	);	?></li>
		</ul>
		<h2 class="best_user"><?php	echo	$best_user->username;	?> est le gangster le plus puissant</h2>
<?php	endif	?>


