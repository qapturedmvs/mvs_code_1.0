<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Logout extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();
		}
    
    public function index(){
      $this->session->sess_destroy();
      redirect('', 'refresh');
    }
  
  }

?>