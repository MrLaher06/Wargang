<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<style type="text/css">
body, html {
	background-color:#000;
	font-family:Arial, Helvetica, sans-serif;
	color: #FFF;
	font-size:11px;
	padding:0;
	margin:0;
}
a {
	font-size: 11px;
	color: #990000;
	text-decoration: none;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
#conteneur {
	background:url('<?php	echo url::base(TRUE);	?>images/mail/body.jpg') no-repeat;
	margin-top:50px;
	border:1px solid #6a0700;
	color:#e6af2b;
}
#footer {
	padding:10px;
}
#detail {
	padding: 0 15px 15px 15px;
}
h1 {
	margin:0;
}
</style>
<table width="600" align="center" cellpadding="0" cellspacing="0" id="conteneur">
	<tr>
		<td height="100" align="left" valign="top"></td>
	</tr>
	<tr>
		<td height="300" align="left" valign="top"><div id="detail">
				<h1>Bonjour,</h1>
				<br /> <br /> Vous venez de recevoir un e-mail du site <a href="<?php	echo url::base();	?>">War Gang</a> pour vous prévenir que :<br /> <br /> <?php echo $message; ?> <br /> <br /> <br /> Merci,<br /> L'équipe de War Gang</div></td>
	</tr>
	<tr>
		<td height="50" valign="middle"><div id="footer">Ce message a été envoyé à <a href="mailto:<?php echo $to; ?>"><?php echo $to; ?></a>. Si vous souhaitez contrôler les messages électroniques que vous recevez de la part de <a href="<?php	echo url::base();	?>">War Gang</a>, accédez à la page suivante : <a href="<?php	echo url::base();	?>">cliquez sur ce lien</a><br /> Ensuite identifiez vous, et désactiver l'option "recevoir un mail" dans votre profil.</div></td>
	</tr>
</table>
</body>
</html>
