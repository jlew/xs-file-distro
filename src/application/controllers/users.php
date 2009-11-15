<?php
class Users extends Controller {
    function Users(){
        parent::Controller();
        $this->load->model('db_users');
        $this->load->library('parser');
    }

	function index(){
		if( $this->session->userdata('userId') ){
			//MANAGE ACCOUNT OPTIONS
		}else{
			$this->showLogin();
		}
	}

    function login(){
		if( $this->input->post('username') ){
			$this->load->model('db_users');
			$account = $this->db_users->getAdmin($this->input->post('username'),
												 $this->input->post('password'));
												 
			if( $account == false ){
				$this->showLogin();
			}else{
				$this->session->set_userdata('userId', $account['id'] );
				redirect( $this->session->flashdata('loginsource') );
			}
		}else{
			$this->showLogin();
		}
	}

    function showLogin(){
		$this->session->keep_flashdata('loginsource');
		$data['page_title'] = "Login Required";
				
		$this->load->view('header', $data);
		$this->parser->parse( 'user_login', $data );
		$this->load->view('footer');
	}
}
