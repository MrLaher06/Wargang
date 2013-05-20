<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Score_Controller	extends	System_Controller	{

		private	$class;

		/**
			* M�thode : 
			* @return
			*/
		public	function	__construct()
		{
				parent::__construct();

				$this->class	=	Score_Model::instance();
				return;
		}

		/**
			* M�thode : 
			* @return
			*/
		public	function	index(	$ajax	=	false	)
		{
				echo	self::liste_top();
				return;
		}

		/**
			* M�thode : 
			* @return
			*/
		public	function	liste_top()
		{
				$list	=	$this->class->top_liste();

				if(	$list->count()	)
				{
						$view	=	new	View(	'score/conteneur'	);
						$view->resultat	=	$list;
						return	$view;
				}
				return;
		}

}

?>