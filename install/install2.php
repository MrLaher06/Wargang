<?php
define( '_ACCES', 1 );

if (file_exists( '../application/config/database.php' ) && filesize( '../application/config/database.php' ) > 1)
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
$DBPrefix = '';

$database = null;
$errors = array();

if (!$DBhostname || !$DBuserName || !$DBname)
	db_err ("stepBack3","Les paramètres de connexion à la base de données sont incorrects ou manquants.");

$database = new database( $DBhostname, $DBuserName, $DBpassword, '', '', false );
$test = $database->getErrorMsg();

if (!$database->_resource)
	db_err ('stepBack2','Le mot de passe et le nom d\'utilisateur sont incorrects.');

$configArray['DBhostname'] = $DBhostname;
$configArray['DBuserName'] = $DBuserName;
$configArray['DBpassword'] = $DBpassword;
$configArray['DBname']	 = $DBname;

$sql = "CREATE DATABASE `$DBname`";
$database->setQuery( $sql );
$database->query();
$test = $database->getErrorNum();

if ($test != 0 && $test != 1007)
	db_err( 'stepBack', 'Erreur de base de données : ' . $database->getErrorMsg() );

$database = new database( $DBhostname, $DBuserName, $DBpassword, $DBname, $DBPrefix );

populate_db( $database );
	
function db_err($step, $alert) 
{
	global $DBhostname,$DBuserName,$DBpassword,$DBDel,$DBname;
	
	echo "<form name=\"$step\" method=\"post\" action=\"install1.php\">
	<input type=\"hidden\" name=\"DBhostname\" value=\"$DBhostname\">
	<input type=\"hidden\" name=\"DBuserName\" value=\"$DBuserName\">
	<input type=\"hidden\" name=\"DBpassword\" value=\"$DBpassword\">
	</form>\n";
	echo "<script>alert(\"$alert\"); document.location.href='install1.php';</script>";  
	exit();
}


function populate_db( &$database, $sqlfile='wargang_jeu.sql') 
{
	global $errors;

	$mqr = @get_magic_quotes_runtime();
	@set_magic_quotes_runtime(0);
	$query = fread( fopen( 'sql/' . $sqlfile, 'r' ), filesize( 'sql/' . $sqlfile ) );
	@set_magic_quotes_runtime($mqr);
	$pieces  = split_sql($query);

	for ($i=0; $i<count($pieces); $i++) 
	{
		$pieces[$i] = trim($pieces[$i]);
		if(!empty($pieces[$i]) && $pieces[$i] != "#") 
		{
			$database->setQuery( $pieces[$i] );
			if (!$database->query())
				$errors[] = array ( $database->getErrorMsg(), $pieces[$i] );
		}
	}
}

function split_sql($sql) 
{
	$sql = trim($sql);
	$sql = preg_replace("/\n#[^\n]*\n/", "\n", $sql);

	$buffer = array();
	$ret = array();
	$in_string = false;

	for($i=0; $i<strlen($sql)-1; $i++) 
	{
		if($sql[$i] == ";" && !$in_string) 
		{
			$ret[] = substr($sql, 0, $i);
			$sql = substr($sql, $i + 1);
			$i = 0;
		}

		if($in_string && ($sql[$i] == $in_string) && $buffer[1] != "\\")
			$in_string = false;
		elseif(!$in_string && ($sql[$i] == '"' || $sql[$i] == "'") && (!isset($buffer[0]) || $buffer[0] != "\\"))
			$in_string = $sql[$i];

		if(isset($buffer[1]))
			$buffer[0] = $buffer[1];

		$buffer[1] = $sql[$i];
	}

	if(!empty($sql))
		$ret[] = $sql;

	return($ret);
}

$isErr = intval( count( $errors ) );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Installation</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="install.css" type="text/css" />
</head>
<body onload="document.form.sitename.focus();">
<div id="ctr" align="center">
	<form action="install3.php" method="post" name="form" id="form">
    <input type="hidden" name="DBhostname" value="<?php echo "$DBhostname"; ?>" />
    <input type="hidden" name="DBuserName" value="<?php echo "$DBuserName"; ?>" />
    <input type="hidden" name="DBpassword" value="<?php echo "$DBpassword"; ?>" />
    <input type="hidden" name="DBname" value="<?php echo "$DBname"; ?>" />
		<div class="install">
			<div class="Conteneur">
				<h1>Base de donnée :</h1>
				<h2>
					<?php if ($isErr) { ?>
					Il semble qu'il y ait eu des problèmes lors de l'insertion des données dans la base de données!<br /> Vous ne pouvez pas continuer.
					<?php } else { ?>
					<b>SUCCES!</b><br /><br />L'installation de la base de données a été correctement effectué<br/>
					<?php } ?>
				</h2>
				<div class="install-form">
					<?php
				if ($isErr) 
				{
					echo '
					<div class="form-block">
						<table class="content2"><tr><td colspan="2">';
					echo "Error log:<br />\n";
					echo '<textarea rows="25" cols="66">';
					
					foreach($errors as $error)
						echo 'SQL='.stripslashes( $error[0] ).":\n- - - - - - - - - -\n".stripslashes( $error[1] )."\n= = = = = = = = = =\n\n";
	
					echo '</textarea>';
					echo "</td></tr></table>
					</div>\n";
  			} ?>
					<div class="far-right">
						<?php if (!$isErr) { ?>
						<br />
						<input class="button" type="submit" id="submit" name="next" value="Suivant >>"/>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="clr"></div>
			<div id="break"></div>
		</div>
	</form>
</div>
<script type="text/javascript">
document.getElementById('submit').focus();
</script>
</body>
</html>
