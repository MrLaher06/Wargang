<?php

defined(	'SYSPATH'	)	OR	die(	'No direct access allowed.'	);

class	Home_Controller	extends	Controller	{

		protected	$description	=	'La guerre des gangs a commencé !';
		protected	$auto_render	=	true;

		/**
			* Méthode : 
			* @return
			*/
		public	function	__construct()
		{
				parent::__construct();

				$this->template	=	new	View(	'template/defaut/home'	);

				$this->template->titre	=	Kohana::config(	'config.name_site'	);

				$this->template->msg	=	$this->input->get(	'msg'	);

				Event::add(	'system.post_controller',	array(	$this,	'_render'	)	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	index()
		{
				if(	Auth::instance()->logged_in()	)
						url::redirect(	'panel'	);

				$this->template->script	=	html::script(	array(	'js/jquery',	'js/jquery.easing',	'js/jquery.fancybox',	'js/home'	)	);

				$this->template->css	=	html::stylesheet(	'css/home'	);

				if(	cookie::get(	md5(	'banni'	)	)	)
						return	false;

				$this->template->contenu	=	new	View(	'login/identification'	);
				//$this->template->contenu = new View( 'login/reset' );

				$score	=	Score_Model::instance()->top_liste(	'argent',	1	);

				if(	$score->count()	)
						$this->template->contenu->best_user	=	$score->current();
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	score()
		{
				if(	Auth::instance()->logged_in()	)
						url::redirect(	'panel'	);

				$this->description	=	'Top 10 des meilleurs gangsters sur War gang';

				$this->template->titre	=	'Top 10 des gangsters sur War gang';

				$this->template->css	=	html::stylesheet(	'css/overlay'	);

				$score	=	Score_Model::instance()->top_liste(	'argent',	10	);

				if(	$score->count()	)
				{
						$this->template->contenu	=	new	View(	'score/conteneur'	);
						$this->template->contenu->resultat	=	$score;
						$this->template->contenu->home	=	true;
				}
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	journal()
		{
				$this->description	=	'Journal qui annonce les actions sur War gang';

				$this->template->titre	=	'Journal de War gang';

				$this->template->css	=	html::stylesheet(	'css/overlay'	);

				$this->template->contenu	=	new	View(	'journal/conteneur'	);
				$this->template->contenu->resultat	=	Journal_Model::instance()->select(	3	);
				$this->template->contenu->home	=	true;
		}

		public	function	rss()
		{
				if(	$resultat	=	Journal_Model::instance()->select()	)
				{
						header(	"content-type: application/xml"	);
						echo	'<?xml version="1.0" encoding="UTF-8"?>'."\n";

						$v	=	new	View(	'autres/rss'	);
						$v->resultat	=	$resultat;
						echo	$v;
				}

				$this->auto_render	=	false;
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	screenshot()
		{
				if(	Auth::instance()->logged_in()	)
						url::redirect(	'panel'	);

				$this->description	=	'Capture écran qui montre War gang en action';

				$this->template->titre	=	'Capture écran de War gang';

				$this->template->css	=	html::stylesheet(	'css/overlay'	);

				$this->template->contenu	=	html::image(	'images/screenshot/panel.jpg'	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	story()
		{
				if(	Auth::instance()->logged_in()	)
						url::redirect(	'panel'	);

				$this->description	=	'Histoire qui explique un peu le jeu War gang';

				$this->template->titre	=	'Histoire de War gang';

				$this->template->css	=	html::stylesheet(	'css/overlay'	);

				$this->template->contenu	=	new	View(	'autres/story'	);
				$this->template->contenu->home	=	true;
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	archives(	$page	=	false	)
		{
				cookie::set(	'page_archive',	$page	);

				$journal	=	Journal_Model::instance();

				$pagination	=	new	Pagination(	array(	'total_items'	=>	$journal->count_all(),	'items_per_page'	=>	10,	'base_url'	=>	'archives/page/'	)	);

				$this->template->script	=	html::script(	array(	'js/jquery',	'js/jquery.easing',	'js/jquery.fancybox',	'js/home'	)	);

				$this->template->css	=	html::stylesheet(	'css/archives'	);

				$this->template->contenu	=	new	View(	'journal/archives'	);
				$this->template->contenu->resultat	=	$journal->select(	10,	$pagination->sql_offset	);
				$this->template->contenu->pagination	=	$pagination;
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	archives_detail(	$id	=	false	)
		{
				$this->template->script	=	html::script(	array(	'js/jquery',	'js/jquery.easing',	'js/jquery.fancybox',	'js/home'	)	);

				$this->template->css	=	html::stylesheet(	'css/archives'	);

				$this->template->contenu	=	new	View(	'journal/archives'	);
				$this->template->contenu->resultat	=	Journal_Model::instance()->unique(	$id	);
				$this->template->contenu->sommaire	=	cookie::get(	'page_archive',	1	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	facebook()
		{
				if(	Auth::instance()->logged_in()	)
						url::redirect(	'panel'	);

				$this->template->css	=	html::stylesheet(	'css/home'	);

				$this->template->script	=	html::script(	array(	'js/jquery',	'js/jquery.easing',	'js/jquery.fancybox',	'js/home'	)	);

				$this->template->contenu	=	new	View(	'login/facebook'	);
		}

		/**
			* Méthode : 
			* @return
			*/
		public	function	_render()
		{
				$this->template->metatag	=	html::meta(	array(	'generator'	=>	'War gang',
								'robots'	=>	'noindex, nofollow',
								'description'	=>	$this->description,
								'keywords'	=>	'wargang, gang, gang virtuel, mafia, mafia virtuel, gangsta, gangsta virtuel, gangster, gangster virtuel, racaille, caillera'	)	);
				if(	$this->auto_render	)
						$this->template->render(	true	);
		}

}

?>