<?php

class Upload extends Controller {
    function Upload(){
        parent::Controller();
        $this->load->config('settings');
        $this->load->model('db_users');
        $this->lang->load('upload');
    }
    
    function index(){
        if(!$this->config->item('ManageRequireLogin') || $this->db_users->requireAdmin()){
            $this->load->view('header', array('page_title'=>$this->lang->line('upload_file')));
            $this->load->view('upload_form', array('error' => ' ' ));
            $this->load->view('footer');
        }
    }

    function do_upload(){
        if(!$this->config->item('ManageRequireLogin') || $this->db_users->requireAdmin()){
            $this->load->library('upload');
            
            $this->load->model('db_files');

            $this->load->view('header', array('page_title'=>$this->lang->line('upload_file')));
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
                $this->session->set_flashdata('status_message', $this->lang->line('file_uploaded'));
                redirect( "/manage/file/$addId" );
            }
            $this->load->view('footer');
        }
    }
}
?>
