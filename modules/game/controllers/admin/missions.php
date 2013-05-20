<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Missions_Controller	extends	Template_Admin_Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				$this->template->titre	=	'Liste des missions des gangsters';

				$query	=	Database::instance()->select(	'users_mission.id,
																					 id_user, 
																					 username, 
																					 type, 
																					 users_mission.date, 
																					 users_mission.argent, 
																					 users_mission.xp, 
																					 users_mission.actif, 
																					 users_mission.id as annuler'	)
								->from(	'users_mission'	)
								->join(	'users',	'users.id',	'users_mission.id_user'	)
								->orderby(	'id',	'DESC'	)
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

										elseif(	$key2	==	'argent'	)
												$val->$key2	=	number_format(	$val2	).' $';

										elseif(	$key2	==	'xp'	)
												$val->$key2	=	number_format(	$val2	);

										elseif(	$key2	==	'annuler'	)
												$val->$key2	=	html::anchor(	'admin/missions/annuler/'.$val2,	'<strong>Annuler</strong>'	);

										elseif(	$key2	==	'id_user'	||	$key2	==	'username'	)
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
						$this->template->contenu	=	Table::instance()->init(	'users_mission',	array(	'class'	=>	'tablesorter'	)	)->rows(	$rows	)->tri(	false,	30	)->get();
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	annuler(	$id_mission	)
		{
				Database::instance()->update(	'users_mission',	array(	'actif'	=>	0,	'argent'	=>	0,	'xp'	=>	0	),	array(	'id'	=>	$id_mission	)	);

				url::redirect(	'admin/missions'	);
		}

}

?>