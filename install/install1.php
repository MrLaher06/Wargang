<?php
define( '_ACCES', 1 );

if (file_exists( '../application/config/database.php' ) && filesize( '../application/config/database.php' ) > 1)
{
	header( "Location: ../index.php" );
	exit();
}

require_once 'common.php';

$DBhostname = GetParam( $_POST, 'DBhostname', 'localhost' );
$DBuserName = GetParam( $_POST, 'DBuserName', 'root' );
$DBpassword = GetParam( $_POST, 'DBpassword', 'root' );
$DBname  	= GetParam( $_POST, 'DBname', 'wargang_jeu' );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Installation</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="install.css" type="text/css" />
<script  type="text/javascript">
<!--
function check() 
{
	var formValid=false;
	var f = document.form;
	if ( f.DBhostname.value == '' ) 
	{
		alert('Veuillez saisir un nom de serveur');
		f.DBhostname.focus();
		formValid=false;
	} 
	else if ( f.DBuserName.value == '' ) 
	{
		alert('Veuillez saisir le nom d\'utilisateur de la base de données');
		f.DBuserName.focus();
		formValid=false;
	} 
	else if ( f.DBname.value == '' ) 
	{
		alert('Veuillez saisir le nom de la base de données');
		f.DBname.focus();
		formValid=false;
	} 
	else if ( confirm('Etes vous certain que ces paramètres sont corrects?')) 
		formValid=true;

	return formValid;
}
//-->
</script>
</head>
<body onload="document.form.DBhostname.focus();">
<div id="ctr" align="center">
  <form action="install2.php" method="post" name="form" id="form" onsubmit="return check();">
    <div class="install">
      <div class="Conteneur">
        <div class="clr"></div>
        <h1>Configuration de la base de données MySQL:</h1>
        <div class="install-text">
          <p>Veuillez entrer le nom du serveur (hostname) sur lequel le jeu va être installé.</p>
          <p>Entrez le nom d'utilisateur, le mot de passe et le nom de la BDD MySQL que vous allez utiliser avec votre jeu.</p>
          <p>Entrez le préfixe des tables devant étre utilisé par cette installation et choisissez l'action adéquat à faire lorsqu'il existe des tables d'une installation précédente.</p>
          <p>Installez les exemples de contenu si vous n'étes pas expérimenté, sinon vous aurez un site presque entiérement vide de contenu pour débuter.</p>
        </div>
        <div class="install-form">
          <div class="form-block">
            <table cellpadding="3" cellspacing="3" class="content2">
              <tr>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td colspan="3"> Nom du serveur <br/>
                  <input name="DBhostname" type="text" class="inputbox" value="<?php echo "$DBhostname"; ?>" size="50" />
                  <em> <br />
                  Habituellement 'localhost'</em></td>
              </tr>
              <tr>
                <td colspan="3"> Nom d'utilisateur <br/>
                  <input name="DBuserName" id="DBuserName" type="text" class="inputbox" value="<?php echo "$DBuserName"; ?>" size="50" />
                  <em><br />
                  Soit 'root' ou un nom d'utilisateur fourni par l'hébergeur</em></td>
              </tr>
              <tr>
                <td colspan="3"> Mot de passe <br/>
                  <input name="DBpassword" type="password" class="inputbox" value="<?php echo "$DBpassword"; ?>" size="50" />
                  <br />
                  <em>Pour la sécurité du site l'utilisation d'un mot de passe est obligatoire pour le compte mysql</em></td>
              </tr>
              <tr>
                <td colspan="3" nowrap="nowrap"> Nom de la base de données <br/>
                  <input name="DBname" type="text" class="inputbox" value="<?php echo "$DBname"; ?>" size="50" />
                  <br />
                  <em>Certains hébergements limitent le nombre de noms de BDD par site. </em></td>
              </tr>
            </table>
          </div>
          <div class="far-right"><br />
            <input class="button" type="submit" name="next" value="Suivant >>"/>
          </div>
        </div>
        <div class="clr"></div>
        <div id="break"></div>
      </div>
    </div>
  </form>
</div>
<script type="text/javascript">
document.getElementById('DBuserName').focus();
</script>
</body>
</html>