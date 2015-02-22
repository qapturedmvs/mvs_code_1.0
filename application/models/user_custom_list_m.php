<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Custom_List_M extends MVS_Model
{
	
	protected $_table_name = 'mvs_custom_lists';
	protected $_primary_key = 'list_id';
	protected $_order_by = 'list_time';
	public $per_page = 50;
  
	function __construct (){
		parent::__construct();
	}
  
	public function get_lists($usr_id){
		
		$filters = array(
			'where' => 'usr_id = '.$usr_id,
			'order_by' => 'list_time DESC'
		);
		
		$lists = $this->get_data(NULL, 0, TRUE, $filters);
		
		if(isset($lists['data']))
			return $lists;
		else
			return FALSE;
		
	}
	
	public function get_list_detail($list_id, $usr_id){
		
		$filters = array(
			'where' => 'usr_id = '.$usr_id.' AND list_id = '.$list_id,
		);
		
		$list = $this->get_data(NULL, 0, FALSE, $filters);
		
		if(isset($list['data']))
			return $list['data'];
		else
			return FALSE;
		
	}
	
	public function create_delete_list($data){
		
		if($data['action'] === 'cncl'){
			unset($data['action']);
			$this->db->insert('mvs_custom_lists', $data);
			$result = $this->db->insert_id();
		}else{
			$this->db->where('list_id = '.$data['list_id'].' AND usr_id = '.$data['usr_id']);
			$this->db->delete('mvs_custom_lists');
			$result = 'dcl';
		}
		
		return $result;
		
	}
	
	public function get_custom_lists($data){
		
		$filters = array(
			'select' => 'cl.list_id, cl.list_title, cld.ldt_id',
			'from' => 'mvs_custom_lists cl',
			'join' => array('mvs_custom_list_data cld', 'cld.list_id = cl.list_id AND cld.mvs_id = '.$data['mvs_id'], 'left'),
			'where' => 'cl.usr_id = '.$data['usr_id'],
			'order_by' => 'cl.list_time DESC'
		);
		
		$cl = $this->get_data(NULL, 0, FALSE, $filters);
		
		if(isset($cl['data']))
			return $cl['data'];
		else
			return FALSE;
		
	}
	
	public function check_custom_list($data){
		
		if($data['action'] == 'atcl'){
			unset($data['action']);
			
			$this->db->select('cld.ldt_id');
			$this->db->join('mvs_custom_list_data cld', 'cld.list_id = cl.list_id AND cld.mvs_id = '.$data['mvs_id'], 'left');
			$db_data = $this->db->get_where('mvs_custom_lists cl', array('cl.list_id' => $data['list_id'], 'cl.usr_id' => $data['usr_id']), 1)->row();
			
			if(count($db_data) > 0)
				return $db_data->ldt_id;
			else
				return FALSE;
			
		}else{
			unset($data['action']);
			
			$this->db->select('cld.list_id');
			$this->db->join('mvs_custom_lists cl', 'cl.list_id = cld.list_id AND cl.usr_id = '.$data['usr_id'], 'inner');
			$db_data = $this->db->get_where('mvs_custom_list_data cld', array('cld.ldt_id' => $data['ldt_id']), 1)->row();
			
			if(count($db_data) > 0)
				return $db_data->list_id;
			else
				return FALSE;
			
		}
		
	}
	
	public function add_remove_from_list($data){
		
		if($data['action'] === 'atcl'){
			unset($data['action']);
			$this->db->insert('mvs_custom_list_data', $data);
			$result = $this->db->insert_id();
		}else{
			$this->db->where('ldt_id = '.$data['ldt_id'].' AND mvs_id = '.$data['mvs_id']);
			$this->db->delete('mvs_custom_list_data');
			$result = 'rfcl';
		}
		
		return $result;
		
	}
	
  
}

?>