<?php
defined('SYSPATH') or die('Access non autoris&eacute;.');

class Sport_Model extends Model
{	
	protected static $instance;
	 
	public static function instance()
	{
		if (Sport_Model::$instance == NULL)
			new Sport_Model;

		return Sport_Model::$instance;
	}
	
	public function __construct()
	{
		parent::__construct();
		Sport_Model::$instance = $this;
	}
	
	/**
	* Methode : 
	*/
	public function liste_equipe() 
	{	
		$query = $this->db->from('equipe_football')->orderby('name','ASC')->get();
											
		return $query->count() ? $query : false;
	}
	
	/**
	* Methode : 
	*/
	public function detail_equipe( $id_equipe, $select = '*' ) 
	{	
		$query = $this->db->select($select)->from('equipe_football')->where('id',$id_equipe)->limit(1)->get();
											
		return $query->count() ? $query->current() : false;
	}
	
	/**
	* Methode : 
	*/
	public function match_en_cours() 
	{	
		$query = $this->db->from('equipe_football_match')
											->where('actif', 1)
											->limit(1)
											->get();
											
		return $query->count() ? $query->current() : false;
	}
	
	/**
	* Methode : les match du jour
	*/
	public function match_quotien() 
	{	
		$query = $this->db->from('equipe_football_match')
											->where('actif', 0)
											->where('day(NOW()) = day(date)')
											->get();
											
		return $query->count() ? $query : false;
	}
}
?>