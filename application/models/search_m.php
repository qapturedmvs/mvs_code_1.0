<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_M extends MVS_Model
{
	
	function __construct (){
		parent::__construct();
	
	}
  
  public function find_movies_stars($data){
    
    $data['keyword'] = $this->cleaner($data['keyword']);
    $data['offset'] = ($this->cleaner($data['offset']) - 1) * $data['per_page'];
    
    $results = $this->db->call_procedure('sp_search', $data);

		if($results)
			return $results;
		else
			return FALSE;
    
  }
  
  public function suggest_movies_stars($data){
    
    $data['keyword'] = $this->cleaner($data['keyword']);
    $results = $this->db->call_procedure('sp_search', $data);

		if($results)
			return $results;
		else
			return FALSE;
    
  }
  
  public function find_users($data){

    $data['keyword'] = $this->cleaner($data['keyword']);
    $data['offset'] = ($data['offset'] !== 0) ? ($this->cleaner($data['offset']) - 1) * $data['per_page'] : $data['offset'];
    $data['type'] = $this->cleaner($data['type']);
    $results = $this->db->call_procedure('sp_search_user', $data);

		if($results)
			return $results;
		else
			return FALSE;
    
  }
  
  public function get_cities($data){
    
    $data['keyword'] = $this->cleaner($data['keyword']);
    $results = $this->db->call_procedure('sp_search_location', $data);

		if($results)
			return $results;
		else
			return FALSE;
    
  }
  
}

?>