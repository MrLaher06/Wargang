<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Bots_Controller	extends	Template_Admin_Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				$this->template->titre	=	'Liste des bots';

				$query	=	Database::instance()->select(	'id, nom, hp, xp, argent, niveau, sexe, image'	)->from(	'ennemis'	)->get();

				if(	$query->count()	)
				{
						foreach(	$query	as	$val	)
						{
								$lien	=	false;

								foreach(	$val	as	$key2	=>	$val2	)
								{
										if(	!$lien	)
												$lien	=	'admin/bots/detail/'.$val2;

										if(	$val2	!==	false	)
												$val->$key2	=	html::anchor(	$lien,	text::limit_chars(	strip_tags(	$val2	),	80,	'...',	true	)	);
								}
								$rows[]	=	$val;
						}
						$this->template->contenu	=	Table::instance()->init(	'ennemis',	array(	'class'	=>	'tablesorter'	)	)->rows(	$rows	)->tri(	false,	30	)->get();
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	detail(	$id_user	)
		{
				$db	=	Database::instance();

				$query	=	$db->select(	'SQL_NO_CACHE *, ennemis.id as id'	)
								->from(	'ennemis'	)
								->join(	'protections',	'protections.id',	'ennemis.id_protection',	'LEFT'	)
								->join(	'vehicules',	'vehicules.id',	'ennemis.id_vehicule',	'LEFT'	)
								->join(	'armes',	'armes.id',	'ennemis.id_arme',	'LEFT'	)
								->where(	'ennemis.id',	$id_user	)
								->limit(	1	)
								->get();

				if(	$query->count()	)
				{
						$this->template->button	=	true;

						$this->template->titre	=	'Détail du bot';
						$this->template->contenu	=	new	View(	'admin/bots/detail'	);
						$this->template->contenu->bots	=	$query->current();

						$this->template->contenu->armes	=	$db->select(	'armes.id, armes.name_arme, armes.munition_arme'	)
										->from(	'armes'	)
										->get();

						$this->template->contenu->protections	=	$db->select(	'id, name_protection'	)->from(	'protections'	)->get();

						$this->template->contenu->vehicules	=	$db->select(	'id, name_vehicule'	)->from(	'vehicules'	)->get();
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	enregistrement(	$type,	$id_ennemis	=	false	)
		{
				$db	=	Database::instance();

				if(	$_POST	&&	(	$type	==	'sauve'	||	$type	==	'valid'	)	)
						$db->update(	'ennemis',	$_POST,	array(	'id'	=>	$_POST['id']	)	);

				elseif(	$_POST	&&	$type	==	'trash'	)
						$db->delete(	'ennemis',	array(	'id'	=>	$_POST['id']	)	);

				if(	$type	==	'annul'	||	$type	==	'valid'	||	$type	==	'trash'	)
						url::redirect(	'admin/bots'	);
				else
						url::redirect(	'admin/bots/detail/'.$id_ennemis	);
		}

}

?>