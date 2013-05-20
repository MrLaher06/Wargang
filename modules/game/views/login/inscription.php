<?php	defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);	?>
<?php	echo	form::open(	'enregistrement',	array(	'id'	=>	'formInscript',	'name'	=>	'formInscript',	'onsubmit'	=>	'return inscription()'	)	);	?>
<table border="0" width="100%" cellpadding="3" cellspacing="3">
		<tr>
				<td><label for="usernameInscript">Identifiant</label> :</td>
				<td align="right"><input name="usernameInscript" id="usernameInscript" value="<?php	echo	cookie::get(	'usernameInscript'	);	?>" type="text" class="inputbox"/></td>
		</tr>
		<tr>
				<td><label for="passwordInscript">Mot de passe</label> :</td>
				<td align="right"><input name="passwordInscript" id="passwordInscript" value="" type="password" class="inputbox"/></td>
		</tr>
		<tr>
				<td><label for="password2Inscript">V&eacute;rifier mot de passe</label> :</td>
				<td align="right"><input name="password2Inscript" id="password2Inscript" value="" type="password" class="inputbox"/></td>
		</tr>
		<tr>
				<td><label for="emailInscript">Email</label> :</td>
				<td align="right"><input name="emailInscript" id="emailInscript" value="<?php	echo	cookie::get(	'emailInscript'	);	?>" type="text" class="inputbox"/></td>
		</tr>
		<tr>
				<td><?php	echo	$captcha;	?></td>
				<td align="right">Recopier le texte de l'image
						<input name="captcha_response" id="captcha_response" value="" type="text" class="inputbox"/></td>
		</tr>
		<tr>
				<td colspan="2" align="right"><input id="annul" value="Annuler" type="button" class="button"/> <input name="submitInscript" id="submitInscript" value="Inscription" type="submit" class="button"/></td>
		</tr>
</table>
<?php	echo	form::close();	?>