<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Users_Controller	extends	Template_Admin_Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				$this->template->titre	=	'Liste des utilisateurs';

				$query	=	Database::instance()->select(	'id, username, facebook, y, x, hp, niveau as lvl, argent, planque, recherche, ip'	)
								->from(	'users'	)
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
												$lien	=	'admin/users/detail/'.$val2;

										if(	$key2	==	'facebook'	)
												$val2	=	$val2	?	'<b class="vert">oui</b>'	:	'<b class="rouge">non</b>';

										if(	$key2	==	'planque'	)
												$val2	=	$val2	?	'<b class="vert">oui</b>'	:	'<b class="rouge">non</b>';

										if(	$key2	==	'recherche'	)
												$val2	=	$val2	?	'<b class="vert">oui</b>'	:	'<b class="rouge">non</b>';

										if(	$key2	==	'y'	)
												$val2	=	chr(	$val2	+	64	);

										if(	$val2	!==	false	)
												$val->$key2	=	html::anchor(	$lien,	text::limit_chars(	$val2,	40,	'...',	false	)	);
								}
								$rows[]	=	$val;
						}
						$this->template->contenu	=	Table::instance()->init(	'users',	array(	'class'	=>	'tablesorter'	)	)->rows(	$rows	)->tri(	false,	30	)->get();
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	detail(	$id_user	)
		{
				$db	=	Database::instance();

				$query	=	$db->select(	'SQL_NO_CACHE *, users.id as id'	)
								->from(	'users'	)
								->join(	'protections',	'protections.id',	'users.id_protection',	'LEFT'	)
								->join(	'vehicules',	'vehicules.id',	'users.id_vehicule',	'LEFT'	)
								->join(	'armes',	'armes.id',	'users.id_arme',	'LEFT'	)
								->join(	'gangs',	'gangs.id',	'users.id_gang',	'LEFT'	)
								->where(	'users.id',	$id_user	)
								->limit(	1	)
								->get();

				if(	$query->count()	)
				{
						$ip_info	=	@simplexml_load_file(	'http://ipinfodb.com/ip_query.php?ip='.$query->current()->ip	);

						$map	=	new	Gmap(	'map'	);

						if(	$position	=	$map->address_to_ll(	$ip_info->City.' '.$ip_info->RegionName.' '.$ip_info->CountryName	)	)
						{
								if(	$position[0]	&&	$position[1]	&&	is_numeric(	$position[0]	)	&&	is_numeric(	$position[1]	)	)
								{
										$map->center(	$position[0],	$position[1],	7	)->controls(	'large'	)->types(	'G_PHYSICAL_MAP',	'add'	);
										$map->add_marker(	$position[0],	$position[1],	'<strong>'.$query->current()->username.'</strong>'
												.'<p><strong>Pays</strong> : '.$ip_info->CountryName.' ('.$ip_info->CountryCode.')</p>'
												.'<p><strong>Région</strong> : '.$ip_info->RegionName.' ('.$ip_info->RegionCode.')</p>'
												.'<p><strong>Ville</strong> : '.$ip_info->City.'</p>'	);
								}
						}

						$this->template->button	=	true;

						$this->template->titre	=	'Détail de l\'utilisateur';

						$this->template->contenu	=	new	View(	'admin/users/detail'	);

						$this->template->contenu->users	=	$query->current();

						$this->template->contenu->gangs	=	$db->select(	'id, nom_gang'	)->from(	'gangs'	)->get();

						$this->template->contenu->armes	=	$db->select(	'id, name_arme, munition_arme'	)->from(	'armes'	)->get();

						$this->template->contenu->protections	=	$db->select(	'id, name_protection'	)->from(	'protections'	)->get();

						$this->template->contenu->vehicules	=	$db->select(	'id, name_vehicule'	)->from(	'vehicules'	)->get();

						$this->template->contenu->localisation	=	$ip_info;

						$this->template->contenu->api_url	=	Gmap::api_url();

						$this->template->contenu->map	=	$map->render();
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	enregistrement(	$type,	$id_user	=	false	)
		{
				$db	=	Database::instance();

				if(	isset(	$_POST['banni']	)	&&	$_POST['banni']	)
						$_POST['planque']	=	1;

				if(	$_POST	&&	(	$type	==	'sauve'	||	$type	==	'valid'	)	)
				{
						if(	!empty(	$_POST['password']	)	)
								$_POST['password']	=	Auth::instance()->hash_password(	$_POST['password']	);
						else
								unset(	$_POST['password']	);

						$db->update(	'users',	$_POST,	array(	'id'	=>	$_POST['id']	)	);
				}
				elseif(	$_POST	&&	$type	==	'trash'	)
				{
						$db->delete(	'users_drogues',	array(	'id_user'	=>	$_POST['id']	)	);
						$db->delete(	'roles_users',	array(	'user_id'	=>	$_POST['id']	)	);
						$db->delete(	'users',	array(	'id'	=>	$_POST['id']	)	);
				}

				if(	$type	==	'annul'	||	$type	==	'valid'	||	$type	==	'trash'	)
						url::redirect(	'admin/users'	);
				else
						url::redirect(	'admin/users/detail/'.$id_user	);
		}

}

?>