<?php
class Users extends Controller {
    function Users(){
        parent::Controller();
        $this->load->model('db_users');
        $this->load->library('parser');
    }

    function _require_admin(){
        if( $this->session->userdata('userId') ){
            //TODO: Validate admin from db
            return true;
        }else{
            $this->session->set_flashdata('loginsource', uri_string());
            redirect('users/showLogin');
            return false;
        }
    }

	function index(){
		$this->manage();
	}

    function login(){
		if( $this->input->post('username') ){
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

	function manage( $action=null, $userId=0 ){
		$data['page_title'] = "Manage Users";
		$data['status_message'] = $this->session->flashdata('status_message');
		
		//Require Login or no admins to exist
		if( $this->db_users->userCount() == 0 || $this-> _require_admin() ){
			if( $action == "adduser" &&
					$this->input->post('username')!= "" &&
					$this->input->post('password')!=""){
					
				
				$newId = $this->db_users->addUser($this->input->post('username'),
												  $this->input->post('password'));

				redirect("/users/manage/edit/$newId");
				
			}else if( $userId == 0 ){
				//show user list
				

				
				$data['user_list'] = $this->db_users->getUserList();

				
				$this->load->view('header', $data);
				$this->parser->parse( 'user_manage_list', $data );
				$this->load->view('footer');
			}else{
				if( $action == "edit" ){
					$data['user_info'] = $this->db_users->getUserById($userId);
				
					$this->load->view('header', $data);
					
					$this->parser->parse( 'user_manage_edit', $data );
					$this->load->view('footer');
				}else if( $action == "changePass" && $this->input->post('password')!=""){
					
					$this->db_users->changePassword( $userId, $this->input->post('password') );
					$this->session->set_flashdata('status_message',"Password Changed");
					redirect("/users/manage/edit/$userId");
					
				}else if( $action == "delete" ){
					if( $this->session->userdata("userId") != $userId ){
						
						$this->db_users->deleteUser( $userId );
						$this->session->set_flashdata('status_message',"User Deleted");
						redirect("/users/manage/");
					}else{
						$this->session->set_flashdata('status_message',"For security reasons, you may not delete yourself");
						redirect("/users/manage/edit/$userId");
					}
				}
			}
		}	
	}
}
