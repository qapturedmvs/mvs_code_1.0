<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Auth_Ajx extends Ajx_Controller{
		function __construct(){
			parent::__construct();
			
			$this->load->model('user_m');
			
		}
		
		//Facebook Authantication
		public function fb_auth(){
			
			$auth = $this->input->post(NULL, TRUE);
			$token = hash('sha512', 'fb'.$auth['id']);
			
			if($auth['gender'] == 'male')
				$auth['gender'] = 'm';
			elseif($auth['gender'] == 'female')
				$auth['gender'] = 'f';
			else
				$auth['gender'] = 0;
			
			$data = array(
				'fb_id' => $auth['id'],
				'usr_nick' => gnrtSlug('user'),
				'usr_name' => $auth['name'],
				'usr_email' => (isset($auth['email'])) ? $auth['email'] : '',
				'usr_password' => hash('sha512', str_shuffle(strtolower(random_string('alpha', 4)).'+$'.random_string('numeric', 4))),
				'usr_token' => $token,
				'usr_gender' => $auth['gender'],
				'usr_act_key' => hash('sha1', 'fb'.$auth['id']),
				'usr_time' => date($this->config->item('mvs_db_time'))
			);
			
			$user = $this->user_m->user_auth('sp_fb_auth', $data);
			
			$this->data['result'] = $this->_build_session($user, $token, TRUE);
			$this->load->view('results/_social_auth', $this->data);

		}
		
		//Google+ Authantication
		public function gp_auth(){
			
			$auth = $this->input->post(NULL, TRUE);
			$token = hash('sha512', 'gp'.$auth['id']);

			if($auth['gender'] == 'male')
				$auth['gender'] = 'm';
			elseif($auth['gender'] == 'female')
				$auth['gender'] = 'f';
			else
				$auth['gender'] = 0;
			
			$data = array(
				'gp_id' => $auth['id'],
				'usr_nick' => gnrtSlug('user'),
				'usr_name' => $auth['displayName'],
				'usr_email' => (isset($auth['email'])) ? $auth['email'] : '',
				'usr_password' => hash('sha512', str_shuffle(strtolower(random_string('alpha', 4)).'+$'.random_string('numeric', 4))),
				'usr_token' => $token,
				//'lgn_token' => hash('sha512', $auth['id'].random_string('alpha', 4)),
				'usr_gender' => $auth['gender'],
				'usr_act_key' => hash('sha1', 'gp'.$auth['id']),
				'usr_time' => date($this->config->item('mvs_db_time'))
			);

			$user = $this->user_m->user_auth('sp_gp_auth', $data);
			
			$this->data['result'] = $this->_build_session($user, $token, TRUE);
			$this->load->view('results/_social_auth', $this->data);

		}
		
		//Twitter Authantication
		public function tw_auth(){
			

			
		}
		
	
	}

?>