<?php
class Manage extends Controller {
    function Manage(){
        parent::Controller();
        $this->load->model('db_files');
        $this->load->model('db_users');
        $this->load->config('settings');
        $this->load->library('parser');
        $this->lang->load('manage_files');
    }
    
    function index(){
        redirect( "home" );
    }

    function file( $id, $action='show', $data='' ){
        // Only allow if require admin is false or (true and they are logged in)
        if( !$this->config->item('ManageRequireLogin') || $this->db_users->requireAdmin() ){
            if( $action == 'addtag'){
                $this->db_files->addTag( $id, $this->input->post('tag') );
                $this->session->set_flashdata('status_message', $this->lang->line('tag_added'));
                redirect("/manage/file/$id");
            }else if( $action == 'removetag' ){
                $this->db_files->removeTagById( $id, $data );
                $this->session->set_flashdata('status_message', $this->lang->line('tag_removed'));
                redirect("/manage/file/$id");
            }else if( $action == 'editdesc' ){
                $this->db_files->editFileDesc( $id, $this->input->post('desc') );
                $this->session->set_flashdata('status_message', $this->lang->line('desc_updated'));
                redirect("/manage/file/$id");
            }else if( $action == 'editname' ){
                $this->db_files->editDisplayName( $id, form_prep($this->input->post('name')) );
                $this->session->set_flashdata('status_message', $this->lang->line('name_updated'));
                redirect("/manage/file/$id");
            }else if( $action == 'deleteFile' ){
                $this->load->config('upload');
                $fileName = $this->db_files->deleteFile( $id );
                if( $fileName ){
                    unlink( ($this->config->item('upload_path') . $fileName) );
                }
                redirect("/home/");
            }

            $data['id'] = $id;
            $data['info'] = array($this->db_files->getFileInfo( $id ));
            $data['page_title'] = $this->lang->line('manage') . " " . $data['info'][0]['name'];
            $data['tags'] = $this->db_files->getTags( $id );

            $data['status_message'] = $this->session->flashdata('status_message');

            $this->load->library('parser');
            
            $this->load->view('header', $data);
            $this->parser->parse( 'manage_file', $data );
            $this->load->view('footer');

        }
    }
}
