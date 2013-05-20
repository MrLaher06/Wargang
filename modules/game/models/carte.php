<?php
defined('SYSPATH') or die('Access non autoris&eacute;.');

class Carte_Model extends Model
{
	public $batiment = false;
	
	public $user = false;
	
	public $bot = false;
	
	protected static $instance;
	 
	public static function instance()
	{
		if (Carte_Model::$instance == NULL)
			new Carte_Model;

		return Carte_Model::$instance;
	}
	
	public function __construct()
	{
		parent::__construct();
		Carte_Model::$instance = $this;
	}
	
	/* 
	* Chargement de la liste des batiments
	*/
	public function liste_batiment()
	{
		$donnees = $this->db->select('*, carte.id as id')->from('carte')->join('gangs', 'gangs.id', 'carte.id_gang', 'LEFT')->get();
		
		if( $donnees->count() )
			foreach ( $donnees as $var )
				$this->batiment[$var->x][$var->y] = $var;
		
		return $this;
	}
	
	/**
	* Chargement de la liste des users
	*/
	public function liste_users( $id, $x_min, $y_min, $x_max, $y_max ) 
	{
		$query = $this->db->select('*, users.id as id')
												->from('users')
												->join('gangs', 'gangs.id', 'users.id_gang', 'LEFT')
												->where('( x BETWEEN '.$x_min.' AND '.$x_max.' ) AND ( y BETWEEN '.$y_min.' AND '.$y_max.' )')
												->where( array('planque' => 0, 'prison' => 0, 'users.id !=' => $id) )
												->get();
		
		if( $query->count() )
			foreach( $query as $val )
				$this->user[$val->x][$val->y][] = $val;
				
		return $this;
	}
	
	/**
	* Methode : pour retrouver un batiment
	*/
	public function search_batiment( $y, $x )
	{ 
		if( isset($this->batiment[$x][$y]) ) 
			return $this->batiment[$x][$y];
		
		return false;
	}
	
	/**
	* Methode : pour retrouver un batiment
	*/
	public function search_user( $y, $x )
	{ 
		if( isset($this->user[$x][$y]) ) 
			return $this->user[$x][$y];
		
		return false;
	}
	
	/**
	* Methode : connaitre les cases qui sont visible par le joueur
	*/
	public static function visibilite( $y, $x, $yUser, $xUser, $niveau = 0 )
	{
		$taille_carte = Kohana::config( 'carte.taille_carte' );
		
		if( $y < 1 || $x < 1 || $y > $taille_carte || $x > $taille_carte )
			return false;
			
		if( $niveau < 5 ) 
			$vue =4;
		elseif( $niveau < 10 )
			$vue = 5;
		elseif( $niveau < 20 )
			$vue = 6;
		elseif( $niveau < 30 )
			$vue = 7;
		elseif( $niveau < 50 )
			$vue = 8;
		elseif( $niveau < 70 )
			$vue = 9;
		else
			$vue = 10;
			
		if( ( $yUser + $vue ) > $y && ( $yUser - $vue ) < $y && ( $xUser + $vue ) > $x && ( $xUser - $vue ) < $x )
		{
			if($yUser > $y)
				$valeurlat = ($yUser - $y);
			else
				$valeurlat = ($y - $yUser);
		
			if($xUser > $x)
				$valeurlng = ($xUser - $x);
			else
				$valeurlng = ($x - $xUser);
		
			if($vue > $valeurlng + $valeurlat)
				return true;
		}
		
		return false;
	}
	
	/**
	* Methode : place les lien de déplacement selon le joueur
	*/
	public static function lien_deplacement( $y, $x, $yUser, $xUser )
	{
		if( ( $y == $yUser + 1 && $x == $xUser + 1 ) )
			return 8;
		elseif( ( $y == $yUser + 1 && $x == $xUser - 1 ) )
			return 6;
		elseif( ( $y == $yUser + 1 && $x == $xUser ) )
			return 7; 
		elseif( ( $y == $yUser - 1 && $x == $xUser + 1 ) )
			return 3;
		elseif( ( $y == $yUser - 1 && $x == $xUser - 1 ) )
			return 1;
		elseif( ( $y == $yUser - 1 && $x == $xUser ) )
			return 2;
		elseif( ( $y == $yUser && $x == $xUser + 1 ) )
			return 5;
		elseif( ( $y == $yUser && $x == $xUser - 1 ) )
			return 4;
		
		return false;
	}
}
?>