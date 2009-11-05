<?php
class Manage extends Controller {
    function Manage(){
        parent::Controller();
        $this->load->model('db_files');
        $this->load->helper('form');
    }
	
    function index(){
        redirect( "home" );
    }

    function file( $id, $action='show', $data='' ){

        if( $action == 'addtag'){
            $this->db_files->addTag( $id, $this->input->post('tag') );
            redirect("/manage/file/$id");
        }else if( $action == 'removetag' ){
            $this->db_files->removeTagById( $id, $data );
            redirect("/manage/file/$id");
        }else if( $action == 'editdesc' ){
            $this->db_files->editFileDesc( $id, $this->input->post('desc') );
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
        $data['page_title'] = "Manage " . $data['info'][0]['name'];
        $data['tags'] = $this->db_files->getTags( $id );

        $this->load->library('parser');
        
        $this->load->view('header', $data);
        $this->parser->parse( 'manage_file', $data );
        $this->load->view('footer');
    
    }
}
