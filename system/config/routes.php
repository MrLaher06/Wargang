<?php 
defined('SYSPATH') or die('No direct access allowed.');

// principaux
$config['_default'] = '/home';
$config['index'] = '/home';
$config['home'] = '/home';
$config['panel'] = '/jeu';
$config['admin'] = '/admin/home';

//RSS
$config['rss'] = '/home/rss';

// inscription et tout le reste pour la home page 
$config['login'] = '/login/login';
$config['logout'] = '/login/logout';
$config['inscription'] = '/option_login/inscription/inscription';
$config['validation/(.*)'] = '/option_login/inscription/validation/$1';
$config['mot_de_passe'] = '/option_login/mot_de_passe/mot_de_passe';
$config['enregistrement'] = '/option_login/inscription/register';
$config['envois_mot_de_passe'] = '/option_login/mot_de_passe/envois';
$config['modifier'] = '/users/modification';

// pour le jeu
$config['joueur'] = '/users/stat_left';
$config['competence'] = '/users/competense_right';
$config['credit'] = '/aide/credit';
$config['envois_tchat'] = '/tchat/envois';

// la carte
$config['carte'] = '/carte/afficher';
$config['deplacement'] = '/carte/deplacement';
$config['actualiser_carte'] = '/carte/refresh_ajax';

//Archives
$config['archives/detail/(.*)/(.*)/(.*)'] = '/home/archives_detail/$3';
$config['archives/page/(.*)'] = '/home/archives/$1';

?>
