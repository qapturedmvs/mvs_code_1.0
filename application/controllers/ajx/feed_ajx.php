<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Feed_Ajx extends Ajx_Controller{
    
		function __construct(){
			parent::__construct();

			$this->load->model('feed_m');
      
		}
    
    public function index(){ show_404(); }
    
    public function wall($p = 1){
      
			$json = (object) array();
			$data = array('nick' => $this->get_vars['nick'], 'p' => $p);
      $feeds = $this->feed_m->wall_json($data);
      
      if($feeds){

				$feeds = $this->_build_feed_tree($feeds);
				//var_dump($feeds);
        $json->result = 'OK';
        $json->data = $feeds;
      }else{
        $json->result = 'FALSE';
        $json->data = '';
      }

      $data['json'] = json_encode($json);
      
     // $this->load->view('json/main_json_view', $data);
      
    }
		
		private function _build_feed_tree(Array $data, $parent = 0){ 

			$tree = array();
			
			foreach ($data as $d){
				
				$d = (object) $d;
								 
				
				if($d->feed_ref_id !== NULL && (int)$d->feed_ref_id === (int)$parent){
					
					if((int)$parent !== 0)
						var_dump($d->feed_ref_id);
					
					$children = $this->_build_feed_tree($data, $d->feed_id);
					
					if(!empty($children))
						$d->feed_ref = $children;
				
					$tree[] = $d;

				}elseif($d->feed_type !== 'ref'){
					
					
					
				}
				
				$d->feed_time = time_calculator($d->feed_time);
				
			}
			 
			return $tree;
		}
  
  }

?>