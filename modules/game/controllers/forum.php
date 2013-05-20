<?php

defined(	'SYSPATH'	)	OR	die(	'No direct access allowed.'	);

class	Forum_Controller	extends	System_Controller	{

		public	function	__construct()
		{
				parent::__construct();
				$this->page	=	View::factory(	'forums/layout'	)->set(	'navigation',	new	View(	'forums/navigation'	)	);
		}

		public	function	index()
		{
				$threads	=	ORM::factory(	'thread'	)->find_all();

				$body_data	=	array(	'threads'	=>	$threads	);

				$this->page->set(	'body_content',	new	View(	'forums/view_all',	$body_data	)	)->render(	TRUE	);
		}

		public	function	view(	$thread_id	)
		{
				$thread	=	ORM::factory(	'thread',	$thread_id	);

				if(	!$thread->loaded	)
						url::redirect(	'forum'	);

				$body_data	=	array(	'thread'	=>	$thread	);

				if(	count(	$thread->posts	)	<=	0	)
						$this->page->set(	'body_content',	new	View(	'forums/view_no_posts'	)	);
				else
						$this->page->set(	'body_content',	new	View(	'forums/view',	$body_data	)	);

				$this->page->render(	TRUE	);
		}

		public	function	create()
		{
				if(	(	$data	=	$this->input->post()	)	&&	isset(	$data['subject']	)	)
				{
						$thread	=	ORM::factory(	'thread'	);
						$thread->title	=	$data['subject'];
						$thread->time_created	=	date::unix2mysql();
						$thread->save();

						$post	=	ORM::factory(	'post'	);
						$post->thread_id	=	$thread->id;
						$post->from	=	$this->_user->username;
						$post->message	=	$data['message'];
						$post->time_created	=	date::unix2mysql();
						$post->save();

						self::view(	$thread->id	);
				}
				else
						$this->page->set(	'body_content',	new	View(	'forums/create'	)	)->render(	TRUE	);
		}

		public	function	reply()
		{
				if(	(	$data	=	$this->input->post()	)	&&	isset(	$data['message']	)	)
				{
						$thread	=	ORM::factory(	'thread',	$data['thread_id']	);

						if(	!$thread->loaded	)
								url::redirect(	'forum'	);

						$post	=	ORM::factory(	'post'	);
						$post->thread_id	=	$thread->id;
						$post->from	=	$this->_user->username;
						$post->message	=	$data['message'];
						$post->time_created	=	date::unix2mysql();
						$post->save();
				}

				self::view(	$thread->id	);
		}

}

?>