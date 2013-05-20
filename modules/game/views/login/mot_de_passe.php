<?php	defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);	?>
<?php	echo	form::open(	'envois_mot_de_passe',	array(	'id'	=>	'formMDP',	'name'	=>	'formMDP',	'onsubmit'	=>	'return mot_de_passe()'	)	);	?>
<table width="100%" border="0" cellpadding="3" cellspacing="3">
		<tr>
				<td colspan="2" align="center">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
										<td><label for="emailMDP">Email</label> :</td>
										<td align="right">
												<input name="emailMDP" type="text" class="inputbox" id="emailMDP" value="" size="30"/>
										</td>
								</tr>
						</table>
				</td>
		</tr>
		<tr>
				<td><?php	echo	$captcha;	?></td>
				<td align="right">Recopier le texte de l'image
						<input name="captcha_response" id="captcha_response" value="" type="text" class="inputbox"/></td>
		</tr>
		<tr>
				<td colspan="2" align="right"><input id="annul" value="Annuler" type="button" class="button"/> <input name="submitMDP" id="submitMDP" value="Envoyer par e-mail" type="submit" class="button"/></td>
		</tr>
</table>
<?php	echo	form::close();	?>