<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Combat_Controller	extends	Template_Admin_Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				$this->template->titre	=	'Liste des combats';
				$this->template->contenu	=	'';

				$query	=	Database::instance()->select(	'combats.id, users.id as attaque, username, nom_gang, combats.y, combats.x, actif, date, type_defense as type'	)
								->from(	'combats'	)
								->join(	'users',	'users.id',	'combats.id_attaque'	)
								->join(	'gangs',	'gangs.id',	'combats.gang_attaque'	)
								->where(	'id_combat',	0	)
								->where(	'CURDATE() < date group by hour(date)'	)
								->orderby(	'combats.id',	'DESC'	)
								->get();

				if(	$query->count()	)
				{
						foreach(	$query	as	$val	)
						{
								$id_user	=	false;

								foreach(	$val	as	$key2	=>	$val2	)
								{
										if(	$key2	==	'attaque'	||	$key2	==	'username'	)
										{
												if(	$key2	==	'attaque'	)
														$id_user	=	$val2;

												$val->$key2	=	html::anchor(	'admin/users/detail/'.$id_user,	text::limit_chars(	strip_tags(	$val2	),	80,	'...',	true	)	);
										}

										if(	$key2	==	'actif'	)
												$val->$key2	=	$val2	?	'<strong class="rouge">en cours</strong>'	:	'<b class="vert">fini</strong>';

										if(	$key2	==	'y'	)
												$val->$key2	=	chr(	$val2	+	64	);

										if(	$key2	==	'attaque'	)
												unset(	$val->$key2	);
								}
								$rows[]	=	$val;
						}

						$th	=	array(	'ID combat',	'pseudo',	'nom du gang',	'y',	'x',	'activité',	'date',	'type'	);

						$this->template->contenu	.=	'<h2>Liste des combats du jour</h2>';
						$this->template->contenu	.=	Table::instance()->init(	'distinct_users_multi_compte',	array(	'class'	=>	'tablesorter'	)	)->th(	$th	)->rows(	$rows	)->tri(	false,	30	)->get();
				}
		}

}

?>