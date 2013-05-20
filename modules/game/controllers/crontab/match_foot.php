<?php

$link	=	mysql_connect(	"localhost",	"root",	"root"	);
mysql_select_db(	"wargang_jeu"	);

$liste_vainqueur	=	false;

//Gestion du match en cours
$resultat	=	traitement();

//on gere les paris
generation_paris(	$resultat	);

if(	$liste_vainqueur	)
{
		foreach(	$liste_vainqueur	as	$key	=>	$argent	)
		{
				$message	=	'Vous venez de gagner de l\'argent en misant sur une équipe de football qui vient soit de gagner ou de faire match nul.<br />Cela vous fait un total de '.number_format(	$argent	).' $ <br /><br />Il faut savoir que si votre équipe à gagné, vos gains sont multiplié par 2, sinon vous récupérez ce que vous avez misé. Bien évidement, si votre équipe a perdu, vous perdez la totalité de vos gains.';
				email(	$key,	$message	);
		}
}

//Creation du nouveau match
generer_match();

mysql_close(	$link	);

//////////////////////////////////////////////////////////////////////


/*
	* traitement du match en cours
	*/
function	traitement()
{
		if(	$result	=	mysql_query(	"select * from `equipe_football_match` WHERE actif = 1 LIMIT 1"	)	)
		{
				$row	=	mysql_fetch_object(	$result	);

				$stat_equipe_domicile	=	0;
				$stat_equipe_visiteur	=	0;

				if(	$equipe_domicile	=	detail_equipe(	$row->equipe_domicile	)	)
						$stat_equipe_domicile	=	calcul_stat_equipe(	$equipe_domicile	);

				if(	$equipe_visiteur	=	detail_equipe(	$row->equipe_visiteur	)	)
						$stat_equipe_visiteur	=	calcul_stat_equipe(	$equipe_visiteur	);

				$but_victoire	=	rand(	0,	5	);

				$but_defaite	=	rand(	0,	$but_victoire	);

				if(	$stat_equipe_domicile	>	$stat_equipe_visiteur	)
				{
						$array	=	array(	'victoire'	=>	$row->equipe_domicile	);
						$sql	=	"`actif` = '0', `but_visiteur` = '".$but_defaite."', `but_domicile` = '".$but_victoire."' ";
				}
				elseif(	$stat_equipe_domicile	<	$stat_equipe_visiteur	)
				{
						$array	=	array(	'victoire'	=>	$row->equipe_visiteur	);
						$sql	=	"`actif` = '0', `but_visiteur` = '".$but_victoire."', `but_domicile` = '".$but_defaite."' ";
				}
				else
				{
						$array	=	array(	'victoire'	=>	0	);
						$sql	=	"`actif` = '0', `but_visiteur` = '".$but_victoire."', `but_domicile` = '".$but_victoire."' ";
				}

				$array['id_match']	=	$row->id;

				mysql_query(	"UPDATE `equipe_football_match` SET ".$sql." WHERE `id` = '".$row->id."'"	);

				return	$array;
		}
		mysql_free_result(	$result	);
}

/*
	* Creation du nouveau match
	*/

function	generer_match()
{
		if(	$result	=	mysql_query(	"select id, name from `equipe_football` ORDER BY RAND() LIMIT 2"	)	)
		{
				$v	=	0;
				$d	=	0;
				$date	=	date(	'Y-m-d H:i:s'	);

				$n	=	0;
				while(	$row	=	mysql_fetch_object(	$result	)	)
				{
						if(	$n	==	0	)
								$v	=	$row;
						else
								$d	=	$row;
						$n++;
				}
				mysql_query(	"INSERT INTO equipe_football_match (equipe_visiteur, equipe_domicile, equipe_visiteur_name, equipe_domicile_name, timer, date, actif) VALUES (".$v->id.",".$d->id.",'".$v->name."','".$d->name."',".time().",'".$date."', 1)"	);
		}
		mysql_free_result(	$result	);
}

/*
	* Detail de l'équipe
	*/

function	detail_equipe(	$equipe_id	)
{
		if(	$result	=	mysql_query(	"select * from `equipe_football` WHERE id = '".$equipe_id."' LIMIT 1"	)	)
		{
				$row	=	mysql_fetch_object(	$result	);
				mysql_free_result(	$result	);
				return	$row;
		}
		return	false;
}

/*
	* calcul de la moyenne de l'équipe
	*/

function	calcul_stat_equipe(	$equipe	)
{
		$moyenne	=	0;
		$moyenne	+=	round(	$equipe->attaque	*	rand(	0,	2	)	);
		$moyenne	+=	round(	$equipe->defense	*	rand(	0,	2	)	);
		$moyenne	+=	round(	$equipe->equilibre	*	rand(	0,	2	)	);
		$moyenne	+=	round(	$equipe->physique	*	rand(	0,	2	)	);
		$moyenne	+=	round(	$equipe->vitesse	*	rand(	0,	2	)	);
		$moyenne	+=	round(	$equipe->acceleration	*	rand(	0,	2	)	);
		$moyenne	+=	round(	$equipe->reaction	*	rand(	0,	2	)	);
		$moyenne	+=	round(	$equipe->agilite	*	rand(	0,	2	)	);
		$moyenne	+=	round(	$equipe->precision_dribble	*	rand(	0,	2	)	);
		$moyenne	+=	round(	$equipe->vitesse_dribble	*	rand(	0,	2	)	);
		$moyenne	+=	round(	$equipe->precision_passe_court	*	rand(	0,	2	)	);
		$moyenne	+=	round(	$equipe->vitesse_passe_court	*	rand(	0,	2	)	);
		$moyenne	+=	round(	$equipe->precision_passe_long	*	rand(	0,	2	)	);
		$moyenne	+=	round(	$equipe->vitesse_passe_long	*	rand(	0,	2	)	);
		$moyenne	+=	round(	$equipe->precision_tir	*	rand(	0,	2	)	);
		$moyenne	+=	round(	$equipe->puissance_tir	*	rand(	0,	2	)	);
		$moyenne	+=	round(	$equipe->technique_tir	*	rand(	0,	2	)	);
		$moyenne	+=	round(	$equipe->detente	*	rand(	0,	2	)	);
		$moyenne	+=	round(	$equipe->technique	*	rand(	0,	2	)	);
		$moyenne	+=	round(	$equipe->agressivite	*	rand(	0,	2	)	);
		$moyenne	+=	round(	$equipe->mentalite	*	rand(	0,	2	)	);
		$moyenne	+=	round(	$equipe->jeu_equipe	*	rand(	0,	2	)	);
		$moyenne	+=	round(	$equipe->regularite	*	rand(	0,	2	)	);
		$moyenne	+=	round(	$equipe->endurance	*	rand(	0,	2	)	);
		return	round(	$moyenne	/	24	);
}

/*
	* Creation du nouveau match
	*/

function	generation_paris(	$array_resultat	)
{
		if(	$result	=	mysql_query(	"select * from `equipe_football_paris`WHERE `id_match` = ".$array_resultat['id_match']." AND `actif` = 1"	)	)
		{
				while(	$row	=	mysql_fetch_object(	$result	)	)
				{
						if(	$row->id_equipe	==	$array_resultat['victoire']	)
								argent_user(	$row->id_user,	round(	$row->argent	*	2	)	);

						elseif(	$array_resultat['victoire']	==	0	)
								argent_user(	$row->id_user,	$row->argent	);
				}

				mysql_query(	"UPDATE `equipe_football_paris` SET `actif` = 0 WHERE `actif` = 1"	);
		}
		mysql_free_result(	$result	);
}

function	argent_user(	$id_user,	$argent	)
{
		global	$liste_vainqueur;

		$result	=	mysql_query(	"select email, argent from `users` WHERE `id` = '".$id_user."'"	);
		while(	$row	=	mysql_fetch_object(	$result	)	)
		{
				if(	isset(	$liste_vainqueur[$row->email]	)	)
						$liste_vainqueur[$row->email]	+=	$argent;
				else
						$liste_vainqueur[$row->email]	=	$argent;

				mysql_query(	"UPDATE `users` SET `argent` = '".round(	$row->argent	+	$argent	)."' WHERE `id` = '".$id_user."'"	);
		}
		mysql_free_result(	$result	);
}

function	email(	$to,	$message	)
{
		ob_start();
		require_once	'../../views/mail/body.php';
		$template	=	ob_get_contents();
		ob_end_clean();
		$subject	=	'Match de football sur War Gang';
		$headers	=	'MIME-Version: 1.0'."\r\n";
		$headers	.=	'Content-type: text/html; charset=UTF-8'."\r\n";
		$headers	.=	'From: contact@wargang.com'."\r\n";
		$headers	.=	'Reply-To: contact@wargang.com'."\r\n";
		$headers	.=	'X-Mailer: PHP/'.phpversion();


		mail(	$to,	$subject,	$template,	$headers	);
}

?>