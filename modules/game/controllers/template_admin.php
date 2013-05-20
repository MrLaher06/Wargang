<?php

defined(	'SYSPATH'	)	or	die(	'No direct access allowed.'	);

abstract	class	Template_Admin_Controller	extends	Controller	{

		public	$template	=	'template/admin/template';
		public	$auto_render	=	true;

		/**
			* M�thode : 
			* @return
			*/
		public	function	__construct()
		{
				parent::__construct();

				$system	=	new	System_Controller;
				$system->admin();

				$this->template	=	new	View(	$this->template	);

				$this->template->script	=	html::script(	Kohana::config(	'template.script_admin'	)	);

				$this->template->css	=	html::stylesheet(	Kohana::config(	'template.css_admin'	)	);

				$this->template->menu	=	new	View(	'template/admin/menu_admin'	);

				$this->template->menu_right	=	new	View(	'template/admin/menu_right_admin'	);

				$this->template->titre	=	Kohana::config(	'config.name_site'	);

				$this->template->button	=	false;

				$this->template->add_element_button	=	false;

				if(	$this->auto_render	==	true	)
						Event::add(	'system.post_controller',	array(	$this,	'_render'	)	);
		}

		/**
			* M�thode : 
			* @return
			*/
		public	function	_render()
		{
				if(	$this->template->button	!==	false	||	$this->template->add_element_button	!==	false	)
						$this->template->button	=	new	View(	'template/admin/button_valide_admin'	);

				if(	$this->template->add_element_button	!==	false	)
						$this->template->button->add	=	$this->template->add_element_button;

				$this->profiler	=	new	Profiler;
				$this->profiler->disable();
				$this->template->debug	=	'<a name="debug_bar" /><div id="boutonDebug">Ouvrir le panneau de debug</div>';
				$this->template->debug	.=	'<div style="display:none; margin:10px;" id="divDebug">';
				$this->template->debug	.=	$this->profiler->render(	TRUE	);
				$this->template->debug	.=	'</div>';

				if(	$this->auto_render	)
						$this->template->render(	true	);
		}

}

?>