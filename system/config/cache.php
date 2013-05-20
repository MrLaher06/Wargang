<?php defined('SYSPATH') OR die('No direct access allowed.');
$config['actif'] = false;
 
$config['default'] = array
(
	'driver'   => 'file',
	'params'   => APPPATH.'cache',
	'lifetime' => 1800,
	'requests' => 1000
);

$config['cache_type'] = array
(
	'users'   => ( 3600 * 24 ),
	'arme'   => ( 3600 * 24 ),
	'protection'   => ( 3600 * 24 ),
	'drogues'   => ( 3600 * 24 ),
	'carte'   => ( 3600 * 24 ),
	'gang'   => ( 3600 * 24 )
);
?>
