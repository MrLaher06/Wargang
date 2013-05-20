<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Sport_Controller	extends	System_Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	__construct()
		{
				parent::__construct();

				$this->class	=	Sport_Model::instance();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	equipe(	$id_equipe	=	false	)
		{
				if(	!$id_equipe	)
						return	false;

				$list	=	$this->class->detail_equipe(	$id_equipe	);

				$view	=	new	View(	'sport/equipe'	);

				if(	$list	)
						$view->equipe	=	$list;

				$view->render(	true	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	archive_jour()
		{
				$list	=	$this->class->match_quotien();

				$view	=	new	View(	'sport/archive'	);

				if(	$list	)
						$view->equipe	=	$list;

				$view->render(	true	);
		}

}

?>