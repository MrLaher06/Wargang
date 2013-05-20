<?php

defined(	'SYSPATH'	)	OR	die(	'No direct access allowed.'	);

/**
	*  @package    forums
	*  @author     George Truong <george@georgetruong.com>
	*/
class	Thread_Controller	extends	Controller	{

		function	__construct()
		{

				parent::__construct();
				$this->page	=	View::factory(	'forums/layout'	)
								->set(	'navigation',	new	View(	'forums/navigation'	)	);
		}

		function	index()
		{

				// Retrieve all the threads from the database and wrap it around an
				// array to render on the view
				$threads	=	ORM::factory(	'thread'	)->find_all();
				$body_data	=	array(	'threads'	=>	$threads	);

				// Set layout, set variables, and render the page
				$this->page
						->set(	'body_content',	new	View(	'forums/admin/index',	$body_data	)	)
						->render(	TRUE	);
		}

		function	delete_threads()
		{

				if(	$form_data	=	$this->input->post()	)
				{
						foreach(	$form_data	as	$key	=>	$value	)
						{
								if(	substr(	$key,	0,	7	)	==	'thread_'	&&	$value	==	'on'	)
								{
										ORM::factory(	'thread'	)
												->delete(	$thread_id	=	substr(	$key,	7	)	);
								}
						}
				}

				url::redirect(	'admin/thread/index'	);
		}

}