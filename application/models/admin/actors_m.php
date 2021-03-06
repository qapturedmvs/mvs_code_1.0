<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actors_M extends MVS_Model
{
		
	protected $_table_name = 'mvs_stars';
	protected $_primary_key = 'str_id';
	protected $_order_by = 'str_id';
	public $per_page = 100;
	protected $_actor_id = NULL;
	protected $_search_name = NULL;

	function __construct ()
	{
		parent::__construct();
			
	}
	
	public function actors($offset = 0, $id = NULL){
		
		if(!$this->input->post('search_name', TRUE))
		{
			if($id == NULL){
				
				$db_data = $this->get_data($id, $offset, FALSE);
				
			}else{
				
				$db_data = $this->get_data($id);
				
			}
			
		}
		else
		{
			$_search_name = $this->input->post('search_name', TRUE);
			
			
			if(strlen($_search_name) > 3)
			{
				$filters = array(
						'select' => '*', 
						'from' => 'mvs_stars', 
						'like' => array('str_name', $_search_name, 'both')
				);
				
				$db_data = $this->get_data(NULL, 0, FALSE, $filters);
				
			}
			else
				$db_data['data'] = "type 4 or more characters please!";
		}
		
		if (count($db_data['data']))
				return $db_data;
			else
				return FALSE;
	}
	
	public function cast($id)
	{
		
		$movies_arr = NULL;
		$casting_arr = $this->db->get_where('mvs_cast', array('str_id' => $id))->result();
		$cast_type_arr = $this->db->get('mvs_cast_type')->result();
		$ids = array();
		
		if( count($casting_arr) )
		{
			foreach($casting_arr as $c)
				array_push($ids, $c->mvs_id );
					
			$this->db->select('mvs_title, mvs_year, mvs_id, mvs_rating');
			$this->db->from('mvs_movies');
			$this->db->where_in('mvs_movies.mvs_id', $ids);
			
			$movies_arr = $this->db->get()->result();
			
			for($i =0;  $i < count($movies_arr); ++$i)
			{
				$movies_arr[$i]->char_name = $casting_arr[$i]->char_name;
				
				foreach($cast_type_arr as $type){
					if($type->type_id == $casting_arr[$i]->type_id)
						$movies_arr[$i]->type_title = $type->type_title;
				}
					
				$movies_arr[$i]->type_id = $casting_arr[$i]->type_id;
			}
		}
		
		if(count($movies_arr))
			return $movies_arr;
		else
			return FALSE;
	}
	
	public function set_photo($slug = NULL){
		
		if($slug){
			
			$this->db->where('str_slug', $slug);
			$this->db->update('mvs_stars', array('str_photo' => 1));
			
		}
		
		
	}

}