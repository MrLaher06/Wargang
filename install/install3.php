<?php

define( '_ACCES', 1 );


if (file_exists( '../application/config/database.php' ) && filesize( '../application/config/database.php' ) > Z)
{
	header( "Location: ../index.php" );
	exit();
}

require_once( 'common.php' );
require_once( 'db.class.php' );

$DBhostname = GetParam( $_POST, 'DBhostname', '' );
$DBuserName = GetParam( $_POST, 'DBuserName', '' );
$DBpassword = GetParam( $_POST, 'DBpassword', '' );
$DBname  	= GetParam( $_POST, 'DBname', '' );
$DBPrefix  	= '';

$config = "<?php
defined('SYSPATH') OR die('No direct access allowed.');
\$config['default'] = array
(
	'benchmark'     => true,
	'persistent'    => false,
	'connection'    => array
	(
		'type'     => 'mysql',
		'user'     => '$DBuserName',
		'pass'     => '$DBpassword',
		'host'     => '$DBhostname',
		'port'     => 3306,
		'socket'   => false,
		'database' => '$DBname'
	),
	'character_set' => 'utf8',
	'table_prefix'  => '$DBPrefix',
	'object'        => true,
	'cache'         => false,
	'escape'        => true
);
?>";

if (($fp = fopen("../application/config/database.php", "w"))) 
{
	fputs( $fp, $config, strlen( $config ) );
	fclose( $fp );
	$canWrite = true; 
}
else
	$canWrite = false; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Installation</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="install.css" type="text/css" />
</head>
<body>
<div id="ctr" align="center">
	<form action="dummy" name="form" id="form">
		<div class="install">
			<div class="Conteneur">
				<h1> Félicitations! Votre installation a reussi.</h1>
				<div class="install-text"> Vous pouvez desormais jouer avec votre jeu. <br /><br />Pensez à éditer le fichier <b><font color="green">application/config/config.php</font></b> <br /> Et à modifier les 2 variables :
					<ul>
						<li>$config['site_domain'] = <b><font color="green">'localhost/Wargang/'</font></b>;<br /> C'est URL ou se trouvera votre jeu.</li>
						<li>$config['url_absolut'] = <b><font color="green">'/chemin/absolut/Wargang/'</font></b>; <br />C'est le chemin d'accès au fichiers sur votre server.</li>
					</ul>
				</div>
				<div class="install-form">
					<div class="form-block">
						<table width="100%">
							<tr>
								<td align="center"><h5>Détails de connexion à l'administration et au jeu</h5></td>
							</tr>
							<tr>
								<td align="center" class="notice"><b>Nom d'utilisateur : admin</b></td>
							</tr>
							<tr>
								<td align="center" class="notice"><b>Mot de passe : admin</b></td>
							</tr>
							<tr>
								<td></td>
							</tr>
							<?php if (!$canWrite) { ?>
							<tr>
								<td class="small"> Le fichier de configuration ou le répertoire n'est pas modifiable,
									ou il y a eu un problème à la création du fichier du fichier de connexion MySQL. Vous devrez créer un fichier application/config/database.php et y copier le code suivant, puis l'uploader à la racine de votre site. </td>
							</tr>
							<tr>
								<td align="center"><textarea rows="5" cols="60" name="configcode" onClick="javascript:this.form.configcode.focus();this.form.configcode.select();" ><?php echo htmlspecialchars( $config );?></textarea></td>
							</tr>
							<?php } ?>
						</table>
					</div>
					<p>Cliquez sur le bouton pour afficher le jeu</p>
					<div class="far-right"> <br />
						<input class="button" type="button" id="button" name="runSite" value="Accéder au jeu" onClick="window.location.href='../'"/>
					</div>
				</div>
				<div id="break"></div>
				<div class="clr"></div>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
document.getElementById('button').focus();
</script>
</body>
</html>