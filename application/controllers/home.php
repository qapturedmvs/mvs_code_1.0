<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Home extends Frontend_Controller{
		function __construct(){
			parent::__construct();
		}
		
		public function index(){
			
			$this->data['subview'] = 'home';
			$this->load->view('_main_body_layout', $this->data);	
			
		}
			
	}

?>