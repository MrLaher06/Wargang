<?php
defined('SYSPATH') or die('Access non autoris&eacute;.');

class Protection_Model extends Model
{
	public $id = false;
	
	public $image_protection = false;
		
	public $defense = false;
		
	public $prix_protection = false;
		
	public $commentaire_protection = false;
	
	public $name_protection = false;
	
	public $niveau_protection = false;
	
	protected static $instance;
	 
	public static function instance()
	{
		if (Protection_Model::$instance == NULL)
			new Protection_Model;

		return Protection_Model::$instance;
	}
	
	public function __construct()
	{
		parent::__construct();
		Protection_Model::$instance = $this;
	}
	
	/**
	* Methode : pour selection une protection
	*/
	public function select_id( $id = false ) 
	{
		if( !$id )
			$id = Kohana::config( 'equipement.id_protection_defaut' );
			
		$query = $this->db->from('protections')->where( 'id', $id )->limit(1)->get();		
		
		if($query->count())
		{
			foreach( $query->current() as $key => $val )
				$this->$key = $val;
		}
		
		return $this;
	}
	
	/**
	* Methode : connaitre la defense du e la protection
	*/
	public function defense()
	{
		return $this->defense;
	}
}
?>