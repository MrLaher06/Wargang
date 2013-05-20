<?php	defined(	'SYSPATH'	)	OR	die(	'No direct access allowed.'	);	?>
<div class="conteneur">
		<?php	if(	!isset(	$frame	)	||	$frame	===	false	)	:	?>
		  <h1>War Gang</h1>
		<?php	endif	?>
		<?php	echo	form::open(	'login',	array(	'id'	=>	'formLogin'	)	);	?>
		<table border="0" cellpadding="3" cellspacing="3" width="100%">
				<tr>
						<td>
								<label for="username">Identifiant : </label>
						</td>
						<td align="right">
								<input name="username" id="username" value="" type="text" class="inputbox"/>
						</td>
				</tr>
				<tr>
						<td>
								<label for="password">Mot de passe : </label>
						</td>
						<td align="right">
								<input name="password" id="password" value="" type="password" class="inputbox"/>
						</td>
				</tr>
				<tr>
						<td colspan="2">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
												<td valign="middle">Se souvenir de moi:
														<input name="remenber" type="checkbox" value="1" />
												</td>
												<td align="right" valign="middle">
														<input name="submit" id="submit" value="Connexion" type="submit" class="button"/>
												</td>
										</tr>
								</table>
						</td>
				</tr>
		</table>
		<?php	if(	!isset(	$frame	)	||	$frame	===	false	)	:	?>
				<div style="display:none; text-align:center;" id="optionChoix"> <a href="javascript:;" id="inscription">Inscription</a> - <a href="javascript:;" id="motDePasse">Mot de passe oubli&eacute;</a> </div>
		<?php	endif	?>
		<?php	echo	form::close();	?>
  <div id="optionLogin"></div>
  <div class="mineur">Ce jeu est interdit aux personnes de moins de 18 ans.</div>
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


