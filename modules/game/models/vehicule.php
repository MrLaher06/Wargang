<?php
defined('SYSPATH') or die('Access non autoris&eacute;.');

class Vehicule_Model extends Model
{
	public $id = false;
	
	public $image_vehicule = false;
	
	public $reservoir = false;
	
	public $deplacement = false;
	
	public $name_vehicule = false;
	
	public $commentaire_vehicule = false;
	
	public $prix_plein = false;
	
	public $prix_vehicule = false;
	
	public $niveau_vehicule = false;

	public $etat_vehicule = false;

	protected static $instance;
	 
	public static function instance()
	{
		if (Vehicule_Model::$instance == NULL)
			new Vehicule_Model;

		return Vehicule_Model::$instance;
	}
	
	public function __construct()
	{
		parent::__construct();
		Vehicule_Model::$instance = $this;
	}
	
	/**
	* Methode : pour selection une voiture
	*/
	public function select_id( $id = false ) 
	{
		if( !$id )
			$id = Kohana::config( 'equipement.id_vehicule_defaut' );
			
		$query = $this->db->from('vehicules')->where( 'id', $id )->limit(1)->get();		
		
		if($query->count())
		{
			foreach( $query->current() as $key => $val )
				$this->$key = $val;
		}
		
		return $this;
	}
	
	/**
	* Methode : connaitre le deplacement du vehicule
	*/
	public function deplacement( $etat, $reservoir )
	{
		$deplacement = ( $etat > 0 ) ? $this->deplacement : Kohana::config( 'users.deplacement' );

		if( $etat < 100 )
			$deplacement = ( $etat > 0 ) ? round( $this->deplacement + ( $this->deplacement / $etat ) ) : Kohana::config( 'users.deplacement' );

		if( $deplacement > Kohana::config( 'users.deplacement' ) )
			$deplacement = Kohana::config( 'users.deplacement' );

		return ( $reservoir > 0 && $deplacement > 0  ) ? $deplacement : Kohana::config( 'users.deplacement' );
	}
}
?>