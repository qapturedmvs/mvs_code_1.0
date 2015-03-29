<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class User_Custom_List_Ajx extends Ajx_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->load->model('user_custom_list_m');
      
		}
		
		public function index(){ show_404(); }
    
    public function list_lister(){
				
			$json = (object) array();
			$usr_id = (isset($this->get_vars['usr'])) ? $this->get_vars['usr'] : $this->user['usr_id'];
			$lists = $this->user_custom_list_m->get_lists($usr_id);
			
			if($lists){
				$json->result = 'OK';
				$json->total_count = $lists['total_count'];
				$json->data = $lists['data'];
			}else{
				$json->result = 'FALSE';
				$json->data = '';
			}
			
			$this->data['json'] = json_encode($json);
			
			$this->load->view('json/main_json_view', $this->data);
				
    }
		
		public function edit_list_detail(){
				
			if(isset($this->user['usr_id'])){
				
				$vars = $this->input->post(NULL, TRUE);
				$data = array('list_id' => $vars['id'], 'usr_id' => $this->user['usr_id'], 'list_title' => $vars['title']);
					
				$this->data['ecl_result'] = $this->user_custom_list_m->edit_custom_list($data);
					
			}else{
				
				$this->data['ecl_result'] = 'no-user';
				
			}
			
			$this->load->view('results/_cl_edit_list', $this->data);

		}
		
		public function cl_remove_multi_item(){
				
			if(isset($this->user['usr_id'])){
				
				$ids = $this->input->post('ids', TRUE);
				$data = array('usr_id' => $this->user['usr_id'], 'ldt_id' => implode(',', $ids));
				
				$this->data['lst_result'] = $this->user_custom_list_m->multi_remove_from_list($data);

			}else{
				
				$this->data['lst_result'] = 'no-user';
				
			}
			
			$this->load->view('results/_cl_multi_remove', $this->data);

		}
  
  }

?>