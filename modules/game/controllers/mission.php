<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Mission_Controller	extends	System_Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	__construct()
		{
				parent::__construct();

				$this->class	=	Batiment_Model::instance();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				if(	$this->_user->planque	)
						return	Users_Controller::planque_view();

				$missions	=	$this->class->verif_mission(	$this->_user->id	);
				$valeur	=	false;

				if(	$missions->count()	)
				{
						foreach(	$missions	as	$val	)
						{
								if(	!$val->id_combat	)
								{
										if(	$val->type	!=	'vehicule'	)
										{
												$fini	=	0;
												if(	(	$v	=	$this->class->valide_mission(	$val->type,	$this->_user->id,	$val->id_mission,	$val->date	)	)	&&	!$v->id_users_mission	)
														$fini	=	1;
										}

										if(	$val->type	==	'user'	&&	$val->actif	)
										{
												$info	=	$this->class->option_mission(	'username, x, y, avatar',	'users',	$val->id_mission	);
												if(	$info->count()	)
														$valeur[]	=	array(	'fini'	=>	$fini,	'mission'	=>	$val,	'val'	=>	$info->current()	);
										}
										elseif(	$val->type	==	'bot'	&&	$val->actif	)
										{
												$info	=	$this->class->option_mission(	'nom, x, y, image',	'ennemis',	$val->id_mission	);
												if(	$info->count()	)
														$valeur[]	=	array(	'fini'	=>	$fini,	'mission'	=>	$val,	'val'	=>	$info->current()	);
										}
										elseif(	$val->type	==	'batiment'	&&	$val->actif	)
										{
												$info	=	$this->class->option_mission(	'nom, x, y, image',	'carte',	$val->id_mission	);
												if(	$info->count()	)
														$valeur[]	=	array(	'fini'	=>	$fini,	'mission'	=>	$val,	'val'	=>	$info->current()	);
										}
										elseif(	$val->type	==	'vehicule'	&&	$val->actif	)
										{
												$fini	=	$val->id_mission	==	$this->_user->id_vehicule	?	1	:	0;
												$info	=	$this->class->option_mission(	'name_vehicule, image_vehicule',	'vehicules',	$val->id_mission	);
												if(	$info->count()	)
														$valeur[]	=	array(	'fini'	=>	$fini,	'mission'	=>	$val,	'val'	=>	$info->current()	);
										}
								}
						}
				}

				$view	=	new	View(	'mission/detail'	);
				$view->donnees	=	$valeur;
				$view->render(	true	);
		}

}

?>