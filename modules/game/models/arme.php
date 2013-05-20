<?php
defined('SYSPATH') or die('Access non autoris&eacute;.');

class Arme_Model extends Model
{
	public $id = false;
	
	public $image_arme = false;
	
	public $munition = 0;
	
	public $attaque = false;
	
	public $precision = false;
	
	public $prix_arme = false;
	
	public $prix_munition = false;
	
	public $commentaire_arme = false;
	
	public $name_arme = false;
	
	public $niveau_arme = false;
	
	protected static $instance;
	 
	public static function instance()
	{
		if (Arme_Model::$instance == NULL)
			new Arme_Model;

		return Arme_Model::$instance;
	}
	
	public function __construct()
	{
		parent::__construct();
		Arme_Model::$instance = $this;
	}
	
	/**
	* Methode : pour selection une arme
	*/
	public function select_id( $id = false ) 
	{
		if( !$id )
			$id = Kohana::config( 'equipement.id_arme_defaut' );
			
		$query = $this->db->from('armes')->where( 'id', $id )->limit(1)->get();		
		
		if($query->count())
		{
			foreach( $query->current() as $key => $val )
				$this->$key = $val;
		}
		
		return $this;
	}
	
	/**
	* Methode : attaque de l'arme
	*/
	public function attaque() 
	{
		return ( $this->munition > 0 ) ? round( ( ( $this->attaque * 2 ) + $this->precision ) / 3 ) : 0;
	}
}
?>