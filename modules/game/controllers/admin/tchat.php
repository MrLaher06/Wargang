<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Tchat_Controller	extends	Template_Admin_Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				$this->template->titre	=	'Liste des derniers messages postés sur le tchat';

				$query	=	Database::instance()->select(	'users.id as id_user, name as expediteur, nom_gang as gang, texte, name_priver as destinataire, timer, type, tchat.id as supprimer'	)
								->from(	'tchat'	)
								->join(	'users',	'users.username',	'tchat.name'	)
								->join(	'gangs',	'gangs.id',	'tchat.id_gang',	'LEFT'	)
								->orderby(	'tchat.id',	'DESC'	)
								->get();

				if(	$query->count()	)
				{
						$ip	=	array(	);

						foreach(	$query	as	$val	)
						{
								$id_user	=	false;

								foreach(	$val	as	$key2	=>	$val2	)
								{
										if(	$key2	==	'id_user'	||	$key2	==	'expediteur'	)
										{
												if(	$key2	==	'id_user'	)
														$id_user	=	$val2;

												$val->$key2	=	html::anchor(	'admin/users/detail/'.$id_user,	text::limit_chars(	strip_tags(	$val2	),	80,	'...',	true	)	);
										}

										if(	$key2	==	'timer'	)
												$val->$key2	=	date::convertir_date(	time()	-	$val2	);

										if(	$key2	==	'supprimer'	)
												$val->$key2	=	html::anchor(	'admin/tchat/supprimer/'.$val2,	'Supprimer'	);

										if(	$key2	==	'destinataire'	&&	!$val2	)
												$val->$key2	=	'Aucun';

										if(	$key2	==	'id_user'	)
												unset(	$val->$key2	);
								}

								$rows[]	=	$val;
						}

						$this->template->contenu	=	Table::instance()->init(	'tchat',	array(	'class'	=>	'tablesorter'	)	)->rows(	$rows	)->tri(	false,	30	)->get();
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	supprimer(	$id	)
		{
				Database::instance()->delete(	'tchat',	array(	'id'	=>	$id	)	);
				url::redirect(	'admin/tchat'	);
		}

}

?>