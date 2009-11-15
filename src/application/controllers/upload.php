<?php

class Upload extends Controller {
    function Upload(){
        parent::Controller();
        $this->load->helper('form');
        $this->load->config('settings');
    }


    function _require_admin(){
        if( $this->session->userdata('userId') ){
            //$this->load->model('db_users');
            //TODO: Validate admin from db
            return true;
        }else{
            $this->session->set_flashdata('loginsource', uri_string());
            redirect('users/showLogin');
            return false;
        }
    }
    
    function index(){
        $continue = true;
        if( $this->config->item('ManageRequireLogin') ){
            $continue = $this->_require_admin();
        }

        if($continue){
            $this->load->view('header', array('page_title'=>"Upload file"));
            $this->load->view('upload_form', array('error' => ' ' ));
            $this->load->view('footer');
        }
    }

    function do_upload(){
        $continue;
        if( $this->config->item('ManageRequireLogin') ){
            $continue = $this->_require_admin();
        }

        if($continue){
            $this->load->library('upload');
            
            $this->load->model('db_files');

            $this->load->view('header', array('page_title'=>"Upload file"));
            if ( ! $this->upload->do_upload()){
                $error = array('error' => $this->upload->display_errors());

                $this->load->view('upload_form', $error);
            }else{
                $data = array('upload_data' => $this->upload->data());
                $displayName = $this->input->post('filename');
                
                // Save file data into db
                $addId = $this->db_files->addFile( 
                    form_prep($displayName),
                    $data['upload_data']['file_name'],
                    $data['upload_data']['file_type'],
                    $this->input->post('description'),
                    $data['upload_data']['file_size']
                );

                $this->load->library('session');
                $this->session->set_flashdata('status_message', 'File Uploaded');
                redirect( "/manage/file/$addId" );
            }
            $this->load->view('footer');
        }
    }
}
?>
