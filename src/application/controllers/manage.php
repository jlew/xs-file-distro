<?php
class Manage extends Controller {
    function Manage(){
        parent::Controller();
        $this->load->model('db_files');
        $this->load->helper('form');
    }
	
    function index(){
        //$data['filelist'] = $this->db_files->getFileList();

        //$this->load->library('parser');
        //$this->parser->parse( 'home', $data );
    }

    function file( $id, $action='show', $data='' ){

        if( $action == 'addtag'){
            $this->db_files->addTag( $id, $this->input->post('tag') );
            redirect("/manage/file/$id");
        }else if( $action == 'removetag' ){
            $this->db_files->removeTag( $id, $data );
            redirect("/manage/file/$id");
        }

        $data['id'] = $id;
        $data['info'] = array($this->db_files->getFileInfo( $id ));
        $data['tags'] = $this->db_files->getTags( $id );

        $this->load->library('parser');
        $this->parser->parse( 'manage_file', $data );
    
    }
}
