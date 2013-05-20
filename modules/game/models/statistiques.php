<?php
defined('SYSPATH') or die('Access non autoris&eacute;.');

class Statistiques_Model extends Model
{	
	protected static $instance;
	 
	public static function instance()
	{
		if (Statistiques_Model::$instance == NULL)
			new Statistiques_Model;

		return Statistiques_Model::$instance;
	}
	
	public function __construct()
	{
		parent::__construct();
		Statistiques_Model::$instance = $this;
	}
	
	/**
	* Methode : qui affiche les stat combats quotidien
	*/
	public function stat_combat_quotien( $id_user ) 
	{	
		$query = $this->db->select('count(*) as nbr, hour(date) as heure, type_defense')
											->from('combats')
											->where('id_attaque', $id_user)
											->where('CURDATE() < date group by type_defense , hour(date)')
											->get();
											
		return $query->count() ? $query : false;
	}
	
	/**
	* Methode :
	*/
	public function stat_par_type_quotien( $id_user, $type = 'achat_drogue' ) 
	{	
		$query = $this->db->select('count(*) as nbr, hour(date) as heure, type')
											->from('statistiques')
											->where(array( 'id_user' => $id_user, 'type' => $type ) )
											->where('CURDATE() < date group by hour(date)')
											->get();
											
		return $query->count() ? $query : false;
	}
	
	/**
	* Methode :
	*/
	public function stat_par_type_mois( $id_user, $type = 'achat_drogue' ) 
	{	
		$query = $this->db->select('count(*) as nbr, day(date) as jour, type')
											->from('statistiques')
											->where(array( 'id_user' => $id_user, 'type' => $type ) )
											->where('MONTH(date) = MONTH(NOW()) GROUP BY type, DAY(date)')
											->get();
											
		return $query->count() ? $query : false;
	}
	
	/**
	* Méthode : 
	* @return
	*/
	public function insertion( $id_user, $type ) 
	{	
		return $this->db->insert('statistiques', array('id_user' => $id_user, 'date' =>date::NOW(), 'type' => $type ) );
	}
}
?>