<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Follow_Actions_Ajx extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->load->model('follow_m');
      
		}
    
    public function follow_unfollow_user($action = NULL){
      
      if($this->input->is_ajax_request()){
				
				if(isset($this->user['usr_id'])){
					
					$this->data['action'] = $action;
					$id = $this->input->post('id', TRUE);
					$data = array('action' => $action, 'flwr_usr_id' => $this->user['usr_id']);
					
					if($action === 'follow')
						$data['flwd_usr_id'] = $id;
					else
						$data['flw_id'] = $id;

					$this->data['follow_result'] = $this->follow_m->follow_unfollow($data);
					
				}else{
					
					$this->data['follow_result'] = 'no-user';
					
				}
			
			}else{
				
				$this->data['follow_result'] = FALSE;
				
			}
				
			$this->load->view('results/_follow_user', $this->data);
      
    }
    
  }
  
?>