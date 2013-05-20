<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Statistiques_Controller	extends	System_Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				if(	$this->_user->planque	)
				{
						echo	Users_Controller::planque_view();
						return	false;
				}

				$total_stat	=	0;

				$v	=	new	View(	'statistiques/general'	);

				for(	$n	=	0;	$n	<=	24;	$n++	)
				{
						$valeur_batiment[$n]	=	'['.$n.', 0]';
						$valeur_user[$n]	=	'['.$n.', 0]';
						$valeur_bot[$n]	=	'['.$n.', 0]';
				}

				if(	$stats	=	Statistiques_Model::instance()->stat_combat_quotien(	$this->_user->id	)	)
				{
						foreach(	$stats	as	$val	)
						{
								if(	$val->type_defense	==	'batiment'	)
										$valeur_batiment[$val->heure]	=	'['.$val->heure.', '.$val->nbr.']';
								elseif(	$val->type_defense	==	'user'	)
										$valeur_user[$val->heure]	=	'['.$val->heure.', '.$val->nbr.']';
								elseif(	$val->type_defense	==	'bot'	)
										$valeur_bot[$val->heure]	=	'['.$val->heure.', '.$val->nbr.']';

								$total_stat	+=	$val->nbr;
						}
				}

				$v->total_stat	=	$total_stat;
				$v->tableau_stat_batiment	=	$valeur_batiment;
				$v->tableau_stat_user	=	$valeur_user;
				$v->tableau_stat_bot	=	$valeur_bot;
				$v->heigth	=	250;

				$v->liste_users	=	false;

				if(	Gang_Model::instance()->select_id(	$this->_user->id_gang	)->id_user_gang	==	$this->_user->id	&&	$this->_user->id_gang	>	1	)
						$v->liste_users	=	Gang_Model::instance()->liste_users_gang(	$this->_user->id_gang	);

				$v->render(	true	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	detail(	$type	=	false,	$user	=	false	)
		{
				if(	$this->_user->planque	)
						return	false;

				$id_user	=	$this->_user->id;

				if(	Gang_Model::instance()->select_id(	$this->_user->id_gang	)->id_user_gang	==	$this->_user->id	&&	$this->_user->id_gang	>	1	)
						$id_user	=	$user	?	$user	:	$this->_user->id;

				$total_stat	=	0;
				$total_stat_mois	=	0;
				$jour_actuel	=	date(	'd'	);

				$v	=	new	View(	'statistiques/detail'	);

				for(	$n	=	0;	$n	<=	24;	$n++	)
						$valeur[$n]	=	'['.$n.', 0]';

				for(	$n	=	1;	$n	<=	$jour_actuel;	$n++	)
						$valeur_mois[$n]	=	'['.$n.', 0]';

				if(	$stats	=	Statistiques_Model::instance()->stat_par_type_quotien(	$id_user,	$type	)	)
				{
						foreach(	$stats	as	$val	)
						{
								$valeur[$val->heure]	=	'['.$val->heure.', '.$val->nbr.']';

								$total_stat	+=	$val->nbr;
						}
				}

				if(	$stats	=	Statistiques_Model::instance()->stat_par_type_mois(	$id_user,	$type	)	)
				{
						foreach(	$stats	as	$val	)
						{
								$valeur_mois[$val->jour]	=	'['.$val->jour.', '.$val->nbr.']';

								$total_stat_mois	+=	$val->nbr;
						}
				}

				$v->total_stat	=	$total_stat;
				$v->tableau_stat	=	$valeur;
				$v->total_stat_mois	=	$total_stat_mois;
				$v->tableau_stat_mois	=	$valeur_mois;
				$v->jour_actuel	=	$jour_actuel;

				$v->render(	true	);
		}

}

?>