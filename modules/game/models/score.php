<?php
defined('SYSPATH') or die('Access non autoris&eacute;.');

class Score_Model extends Model
{
	protected static $instance;
	 
	public static function instance()
	{
		if (Score_Model::$instance == NULL)
			new Score_Model;

		return Score_Model::$instance;
	}
	
	public function __construct()
	{
		parent::__construct();
		Score_Model::$instance = $this;
	}
	
	/**
	* Methode : liste des 50 users par argent
	*/
	public function top_liste( $top = 'argent', $limit = 50 ) 
	{
		$query = $this->db->select('*, users.id as id')
											->from('users')
											->join('gangs', 'gangs.id', 'users.id_gang', 'LEFT')
											->limit($limit)
											->orderby( array( 'niveau' => 'DESC', $top => 'DESC' ) )
											->get();
								
		return $query->count() ? $query : false;
	}
}
?>