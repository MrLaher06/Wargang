<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

class	Erreur_Controller	extends	Controller	{

		/**
			* Méthode : 
			* @return
			*/
		public	function	__construct()
		{
				parent::__construct();

				$this->template	=	new	View(	'template/defaut/home'	);

				$this->template->titre	=	Kohana::config(	'config.name_site'	);

				$this->template->script	=	html::script(	array(	'js/jquery',	'js/home'	)	);

				$this->template->css	=	html::stylesheet(	'css/home'	);

				Event::add(	'system.post_controller',	array(	$this,	'_render'	)	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	type(	$val	)
		{
				if(	$val	==	403	)
						self::erreur_403();

				elseif(	$val	==	404	)
						self::erreur_404();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	erreur_404()
		{
				$this->template->msg	=	'Erreur 404';
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	erreur_403()
		{
				$this->template->msg	=	'Erreur 403';
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	_render()
		{
				$this->template->render(	true	);
		}

}

?>