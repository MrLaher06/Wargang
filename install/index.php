<?php
define( '_ACCES', 1 );

if (file_exists( '../application/config/database.php' ) && filesize( '../application/config/database.php' ) > 1)
{
	header( "Location: ../index.php" );
	exit();
}

require_once( 'common.php' );

$sp = ini_get( 'session.save_path' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Installation - Pré installation</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="install.css" type="text/css" />
</head>
<body>
<div id="ctr" align="center">
	<div class="install">
		<div class="Conteneur">
			<h1> Permissions des répertoires: </h1>
			<div class="install-text">
				<p> Certains répertoires doivent être accessibles en lecture et écriture. </p>
				<p> Si certains des répertoires listés co-contre sont dans l'état <b><font color="red">Non modifiable</font></b>, alors vous devrez changer les CHMOD pour les rendre <b><font color="green">Modifiables</font></b>. </p>
				<div class="clr">&nbsp;&nbsp;</div>
				<div class="ctr"></div>
			</div>
			<div class="install-form">
				<div class="form-block">
					<table class="content">
						<?php
						writableCell( 'application/cache' );
						writableCell( 'application/logs' );
						writableCell( 'application/config' );
						writableCell( 'images/avatars' );
						?>
					</table>
				</div>
				<div class="clr"></div>
			</div>
			<div class="clr"></div>
			<h1> Vérification des paramètres nécessaires: </h1>
			<div class="install-text">
				<p> Si certains éléments sont écrits en <font color="red">rouge</font>, alors veuillez prendre les mesures nécessaires pour les corriger. </p>
				<div class="ctr"></div>
			</div>
			<div class="install-form">
				<div class="form-block">
					<table class="content">
						<tr>
							<th class="item"> PHP version &gt;= 5.2.4 </th>
							<td align="left"><?php 
							$vs = @phpversion(); 
							echo $vs < '5.2.4' ? '<b><font color="red">Non ('.$vs.')</font></b>' : '<b><font color="green">Oui ('.$vs.')</font></b>';
							?></td>
						</tr>
						<tr>
							<th valign="top"><a href="http://www.php.net/gd" target="_blank">Support GD</a> </th>
							<td align="left"><?php echo @extension_loaded('gd') ? '<b><font color="green">Oui</font></b>' : '<b><font color="red">Non</font></b>'; ?></td>
						</tr>
						<tr>
							<th><a href="http://www.php.net/getimagesize" target="_blank">Getimagesize</a> </th>
							<td align="left"><?php echo @function_exists( 'getimagesize' ) ? '<b><font color="green">Oui</font></b>' : '<b><font color="red">Non</font></b>';?></td>
						</tr>
						<tr>
							<th><a href="http://www.php.net/zlib" target="_blank">Compression ZLIB</a> </th>
							<td align="left"><?php echo @extension_loaded('zlib') ? '<b><font color="green">Oui</font></b>' : '<b><font color="red">Non</font></b>';?></td>
						</tr>
						<tr>
							<th><a href="http://www.php.net/xml" target="_blank">Support XML</a> </th>
							<td align="left"><?php echo @extension_loaded('xml') ? '<b><font color="green">Oui</font></b>' : '<b><font color="red">Non</font></b>';?></td>
						</tr>
						<tr>
							<th><a href="http://www.php.net/mysql" target="_blank">Support MySQL</a> </th>
							<td align="left"><?php echo @function_exists( 'mysql_connect' ) ? '<b><font color="green">Oui</font></b>' : '<b><font color="red">Non</font></b>';?></td>
						</tr>
						<?php 
						
						if(@function_exists( 'php_ini_loaded_file' )) { ?>
						<tr>
							<th>Chemin du fichier php.ini</th>
							<td align="left"><?php
							$inipath = php_ini_loaded_file();
							
							if ($inipath) 
									echo '<b><font color="green">'.$inipath.'</font></b>';
							?></td>
						</tr>
						<?php } ?>
						<tr>
							<th>PCRE UTF-8</th>
							<?php	if(	!function_exists(	'preg_match'	)	): ?>
							<td class="fail"><a href="http://php.net/pcre">PCRE</a> <b><font color="green">Non</font></b></td>
							<?php	elseif(	!@preg_match(	'/^.$/u',	'ñ'	)	): ?>
							<td class="fail"><a href="http://php.net/pcre">PCRE</a> <b><font color="red">Non</font></b></td>
							<?php	elseif(	!@preg_match(	'/^\pL$/u',	'ñ'	)	): ?>
							<td class="fail"><a href="http://php.net/pcre">PCRE</a> <b><font color="red">Non</font></b></td>
							<?php	else	:	?>
							<td><b><font color="green">Oui</font></b></td>
							<?php	endif	?>
						</tr>
						<tr>
							<th>Reflection Enabled</th>
							<?php	if(	class_exists(	'ReflectionClass'	)	): ?>
							<td><b><font color="green">Oui</font></b></td>
							<?php	else	:		?>
							<td class="fail"> PHP <a href="http://www.php.net/reflection">reflection</a> <b><font color="red">Non</font></b></td>
							<?php	endif	?>
						</tr>
						<tr>
							<th>Filters Enabled</th>
							<?php	if(	function_exists(	'filter_list'	)	): ?>
							<td><b><font color="green">Oui</font></b></td>
							<?php	else	:		?>
							<td class="fail"> The <a href="http://www.php.net/filter">filter</a> <b><font color="red">Non</font></b></td>
							<?php	endif	?>
						</tr>
						<tr>
							<th>Iconv Extension Loaded</th>
							<?php	if(	extension_loaded(	'iconv'	)	): ?>
							<td><b><font color="green">Oui</font></b></td>
							<?php	else	:		?>
							<td class="fail"> The <a href="http://php.net/iconv">iconv</a> <b><font color="red">Non</font></b></td>
							<?php	endif	?>
						</tr>
						<tr>
							<th>SPL Enabled</th>
							<?php	if(	function_exists(	'spl_autoload_register'	)	): ?>
							<td><b><font color="green">Oui</font></b></td>
							<?php	else	:		?>
							<td class="fail"><a href="http://php.net/spl">SPL</a> <b><font color="red">Non</font></b></td>
							<?php	endif	?>
						</tr>
						<tr>
							<th>Multibyte String Enabled</th>
							<?php	if(	extension_loaded(	'mbstring'	)	): ?>
							<td><b><font color="green">Oui</font></b></td>
							<?php	else:	;	?>
							<td class="fail">The <a href="http://php.net/mbstring">mbstring</a> <b><font color="red">Non</font></b></td>
							<?php	endif	?>
						</tr>
						<?php	if(	extension_loaded(	'mbstring'	)	): ?>
						<tr>
							<th>Mbstring Not Overloaded</th>
							<?php	if(	ini_get(	'mbstring.func_overload'	)	&	MB_OVERLOAD_STRING	): ?>
							<td class="fail"> The <a href="http://php.net/mbstring">mbstring</a> <b><font color="red">Non</font></b></td>
							<?php	else	:	?>
							<td><b><font color="green">Oui</font></b></td>
							<?php	endif	?>
						</tr>
						<?php	endif	?>
					</table>
				</div>
			</div>
			<div class="clr"></div>
			<?php
				$wrongSettingsTexts = array();
				
				if ( @ini_get('magic_quotes_gpc') == '1' ) 
					$wrongSettingsTexts[] = 'Paramètre PHP magic_quotes_gpc est sur `ON` au lieu de `OFF`';

				if ( @ini_get('register_globals') == '1' )
					$wrongSettingsTexts[] = 'Paramètre PHP register_globals est sur `ON` au lieu de `OFF`';

				if ( count($wrongSettingsTexts) ) 
				{
					?>
			<h1> Vérification de la sécurité: </h1>
			<div class="install-text">
				<p> Les paramètres PHP Serveur suivants ne sont pas optimum pour la <strong>Sécurité</strong> de votre site, il vous est recommandé de les modifier: </p>
			</div>
			<div class="install-form">
				<div class="form-block" style=" border: 1px solid #cc0000; background: #ffffcc;">
					<table class="content">
						<tr>
							<td class="item"><ul style="margin: 0px; padding: 0px; padding-left: 5px; text-align: left; padding-bottom: 0px; list-style: none;">
									<?php
										foreach ($wrongSettingsTexts as $txt) {
											?>
									<li style="min-height: 25px; padding-bottom: 5px; padding-left: 25px; color: red; font-weight: bold;" >
										<?php
												echo $txt;
												?>
									</li>
									<?php
										}
										?>
								</ul></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="clr"></div>
			<?php
		}
		?>
			<h1> Configuration recommandée: </h1>
			<div class="install-text">
				<p> Ces paramètres PHP sont recommandés afin d'assurer 
					une pleine compatibilité avec le script. </p>
				<p> Toutefois cela fonctionne correctement s'ils ne sont pas activés. <br /> </p>
				<div class="ctr"></div>
			</div>
			<div class="install-form">
				<div class="form-block">
					<table class="content">
						<tr>
							<td class="toggle" width="500px"> Directive </td>
							<td class="toggle"> Recommandé </td>
							<td class="toggle"> Actuel </td>
						</tr>
						<?php
					$php_recommended_settings = array(array ('Safe Mode','safe_mode','OFF'),
					array ('Display Errors','display_errors','ON'),
					array ('File Uploads','file_uploads','ON'),
					array ('Magic Quotes GPC','magic_quotes_gpc','OFF'),
					array ('Magic Quotes Runtime','magic_quotes_runtime','OFF'),
					array ('Register Globals','register_globals','OFF'),
					array ('Output Buffering','output_buffering','OFF'),
					array ('Session auto start','session.auto_start','OFF'),
					);
					
					foreach ($php_recommended_settings as $phprec) 
					{
					?>
						<tr>
							<th class="item"><?php echo $phprec[0]; ?>: </th>
							<td class="toggle"><?php echo $phprec[2]; ?>: </td>
							<td><b>
								<?php
							if ( get_php_setting($phprec[1]) == $phprec[2] ) {
							?>
								<font color="green">
								<?php
							} else {
							?>
								<font color="red">
								<?php
							}
							echo get_php_setting($phprec[1]);
							?>
								</font> </b>
							<td>
						</tr>
						<?php
						}
						?>
					</table>
				</div>
			</div>
			<div class="clr"></div>
			<br />
			<div class="far-right">
				<input type="button" class="button" value="Vérifier à nouveau" onclick="window.location=window.location" />
				<input name="Button2" type="submit" id="submit" class="button" value="Suivant >>" onclick="window.location='install1.php';" />
			</div>
			<div class="clr"></div>
		</div>
	</div>
	</form>
</div>
<script type="text/javascript">
document.getElementById('submit').focus();
</script>
</body>
</html>
