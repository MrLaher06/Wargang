<?php

mysql_connect(	"localhost",	"root",	"root"	);
mysql_select_db(	"wargang_jeu"	);

$result	=	mysql_query(	"select * from `users`"	);

$message	=	false;

while(	$row	=	mysql_fetch_object(	$result	)	)
{
		if(	$row->last_activity	<	time()	-	600	&&	$row->last_login	<	time()	-	(	600	*	3	)	&&	$row->planque	==	0	)
		{
				$message	.=	'Mise en planque de : '.$row->username."<br />\n";

				email(	$row->email,	'Vous avez été mis en planque automatique car aucune activé n\'a été dédecté depuis plus de 10 min.'	);

				mysql_query(	"UPDATE `users` SET `planque` = '1' WHERE `id` = '".$row->id."'"	);
				mysql_query(	"UPDATE `combats` SET `actif` = '0' WHERE `id_attaque` = '".$row->id."' AND `actif` = '1'"	);
				mysql_query(	"UPDATE `combats` SET `actif` = '0' WHERE `id_defense` = '".$row->id."' AND `actif` = '1' AND `type_defense` = 'user'"	);
				mysql_query(	"UPDATE `ennemis` SET `x` = round((rand()*14)+1), `y` = round((rand()*14)+1), `deal` = round(rand()*1)"	);
				mysql_query(	"INSERT INTO tchat (name, texte, id_gang, timer, type) VALUES ('".$row->username."','".$row->username." a &eacute;t&eacute; mis en planque automatiquement',".$row->id_gang.",".time().",'info')"	);
		}
}

mysql_free_result(	$result	);

function	email(	$to,	$message	)
{
		ob_start();
		require_once	'../../views/mail/body.php';
		$template	=	ob_get_contents();
		ob_end_clean();
		$subject	=	'Mise en planque';
		$headers	=	'MIME-Version: 1.0'."\r\n";
		$headers	.=	'Content-type: text/html; charset=UTF-8'."\r\n";
		$headers	.=	'From: contact@wargang.com'."\r\n";
		$headers	.=	'Reply-To: contact@wargang.com'."\r\n";
		$headers	.=	'X-Mailer: PHP/'.phpversion();


		mail(	$to,	$subject,	$template,	$headers	);
}

?>