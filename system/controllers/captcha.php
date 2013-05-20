<?php defined('SYSPATH') OR die('No direct access allowed.');
class Captcha_Controller extends Controller 
{
	public function __call($method, $args)
	{
		Captcha::factory( $this->uri->segment(2) )->render(false);
	}
}
?>