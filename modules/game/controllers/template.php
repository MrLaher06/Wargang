<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

abstract	class	Template_Controller	extends	Controller	{

		public	$template	=	'template/defaut/template';
		public	$auto_render	=	true;

		/**
			* M�thode : 
			* @return
			*/
		public	function	__construct()
		{
				parent::__construct();

				$this->template	=	new	View(	$this->template	);

				$this->template->titre	=	Kohana::config(	'config.name_site'	);

				$this->template->script	=	html::script(	Kohana::config(	'template.script'	)	);

				$this->template->css	=	html::stylesheet(	Kohana::config(	'template.css'	)	);

				if(	$this->auto_render	==	true	)
						Event::add(	'system.post_controller',	array(	$this,	'_render'	)	);
		}

		/**
			* M�thode : 
			* @return
			*/
		public	function	ajax()
		{
				$this->template	=	'template/defaut/ajax_template';

				$this->template	=	new	View(	$this->template	);

				$this->template->titre	=	Kohana::config(	'config.name_site'	);

				$this->template->script	=	html::script(	Kohana::config(	'template.script'	)	);

				$this->template->css	=	html::stylesheet(	Kohana::config(	'template.css'	)	);
		}

		/**
			* M�thode : 
			* @return
			*/
		public	function	_render()
		{
				if(	$this->auto_render	)
						$this->template->render(	true	);
		}

}

?>