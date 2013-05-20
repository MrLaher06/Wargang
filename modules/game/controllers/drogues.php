<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Drogues_Controller	extends	System_Controller	{

		private	$class;

		/**
			* Méthode : 
			* @return
			*/
		public	function	__construct()
		{
				parent::__construct();

				$this->class	=	Drogues_Model::instance();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				if(	!request::is_ajax()	)
						return	false;

				echo	self::afficher_liste();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	afficher_liste()
		{
				if(	$temps	=	$this->_user->prison()	)
						return	Flic_Controller::afficher_prison(	$temps	);

				if(	$this->_user->planque	)
						return	Users_Controller::planque_view();

				self::liste_drogue();

				$view	=	new	View(	'drogues/liste_drogues'	);
				$view->donnees	=	$this->class->select_liste(	$this->_user->niveau	);
				$view->liste_drogue	=	$this->class->drogue_user(	$this->_user->id	);
				$view->dernier_vente	=	$this->class->vente_drogue();

				return	$view;
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	detail(	$id	)
		{
				$view	=	new	View(	'drogues/detail'	);
				$view->val	=	$this->class->detail_drogue(	$id	);
				$view->render(	true	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	liste_drogue()
		{
				if(	!request::is_ajax()	||	$this->_user->planque	)
						return	false;

				$id_drogue	=	(int)	$this->input->post(	'id_drogue'	);
				$quantite	=	(int)	$this->input->post(	'quantite'	);

				if(	$id_drogue	&&	$quantite	&&	is_numeric(	$quantite	)	&&	$quantite	<=	99	)
				{
						$info_drogue	=	$this->class->detail_drogue(	$id_drogue	);

						$prix_payable	=	round(	$quantite	*	$info_drogue->prix	);

						if(	$prix_payable	<=	$this->_user->argent	)
						{
								$array	=	array(	'deal'	=>	1,	'x'	=>	$this->_user->x,	'y'	=>	$this->_user->y	);

								if(	!database::instance()->select(	'id'	)->from(	'ennemis'	)->where(	$array	)->limit(	1	)->get()->count()	)
								{
										echo	'<script language="javascript" type="text/javascript">alert("Il n\'y a aucun dealer sur cette case.");</script>';
										return	false;
								}

								$nbr_drog	=	0;

								if(	$liste_drogue	=	$this->class->drogue_user(	$this->_user->id	)	)
								{
										foreach(	$liste_drogue	as	$list_drog	)
												$nbr_drog	+=	count(	$list_drog	);
								}

								if(	$nbr_drog	+	$quantite	>	99	)
								{
										echo	'<script language="javascript" type="text/javascript">alert("Vous ne pouvez pas avoir plus de 99 drogues.");</script>';
										return	false;
								}

								$this->_user->argent	-=	$prix_payable;

								$this->_user->xp	+=	$quantite;

								$this->_user->achat_drogue	+=	$quantite;

								$this->_user->modifier();

								$this->class->insert_achat(	$this->_user->id,	$id_drogue,	$quantite	);

								Statistiques_Model::instance()->insertion(	$this->_user->id,	'achat_drogue'	);
						}
				}
		}

}

?>