<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Match_Controller	extends	Template_Admin_Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				$this->template->titre	=	'Liste des matcsh de football';

				$query	=	Database::instance()->select(	'id,
																					 equipe_visiteur_name as visiteur, 
																					 equipe_domicile_name as domicile, 
																					 but_visiteur, 
																					 but_domicile, 
																					 date, 
																					 actif,
																					 (SELECT COUNT(*) FROM equipe_football_paris WHERE id_match = equipe_football_match.id ) as paris,
																					 id as annuler'	)
								->from(	'equipe_football_match'	)
								->orderby(	'id',	'DESC'	)
								->get();

				if(	$query->count()	)
				{
						foreach(	$query	as	$val	)
						{
								$lien	=	false;

								foreach(	$val	as	$key2	=>	$val2	)
								{
										if(	!$lien	)
												$lien	=	'admin/match/detail/'.$val2;

										if(	$key2	==	'actif'	)
												$val->$key2	=	$val2	?	'<strong class="rouge">en cours</strong>'	:	'<strong class="vert">fini</strong>';

										elseif(	$key2	==	'date'	)
												$val->$key2	=	date::FormatDate(	$val2	);

										elseif(	$key2	==	'annuler'	)
												$val->$key2	=	html::anchor(	'admin/match/annuler/'.$val2,	'<strong>Annuler</strong>'	);

										if(	$key2	!=	'annuler'	)
												$val->$key2	=	html::anchor(	$lien,	text::limit_chars(	$val->$key2,	80,	'...',	true	)	);
								}
								$rows[]	=	$val;
						}
						$this->template->contenu	=	Table::instance()->init(	'match',	array(	'class'	=>	'tablesorter'	)	)->rows(	$rows	)->tri(	false,	30	)->get();
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	detail(	$id_match	)
		{
				$this->template->titre	=	'Liste des paris sur le match - '.html::anchor(	'admin/match',	'Revenir'	);

				$query	=	Database::instance()->select(	'equipe_football_paris.id,
																					equipe_football_paris.id_user,
																					users.username as gangster,
																					equipe_football.name as equipe,
																					equipe_football_paris.date,
																					equipe_football_paris.argent,
																					equipe_football_paris.actif'	)
								->from(	'equipe_football_paris'	)
								->join(	'users',	'users.id',	'equipe_football_paris.id_user'	)
								->join(	'equipe_football',	'equipe_football.id',	'equipe_football_paris.id_equipe'	)
								->where(	'id_match',	$id_match	)
								->orderby(	'equipe_football_paris.id',	'DESC'	)
								->get();

				if(	$query->count()	)
				{
						foreach(	$query	as	$val	)
						{
								$lien	=	false;
								$id_user	=	false;

								foreach(	$val	as	$key2	=>	$val2	)
								{
										if(	$key2	==	'actif'	)
												$val->$key2	=	$val2	?	'<strong class="rouge">en cours</strong>'	:	'<strong class="vert">fini</strong>';

										elseif(	$key2	==	'date'	)
												$val->$key2	=	date::FormatDate(	$val2	);

										elseif(	$key2	==	'id_user'	||	$key2	==	'gangster'	)
										{
												if(	$key2	==	'id_user'	)
														$id_user	=	$val2;

												$val->$key2	=	html::anchor(	'admin/users/detail/'.$id_user,	text::limit_chars(	$val2,	80,	'...',	true	)	);
										}

										if(	$key2	==	'id_user'	)
												unset(	$val->$key2	);
								}
								$rows[]	=	$val;
						}
						$this->template->contenu	=	Table::instance()->init(	'match',	array(	'class'	=>	'tablesorter'	)	)->rows(	$rows	)->tri(	false,	30	)->get();
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	annuler(	$id_match	)
		{
				Database::instance()->update(	'equipe_football_match',	array(	'actif'	=>	0	),	array(	'id'	=>	$id_match	)	);

				url::redirect(	'admin/match'	);
		}

}

?>