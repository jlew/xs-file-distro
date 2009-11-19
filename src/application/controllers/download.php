<?php
class Download extends Controller {
    function Download(){
        parent::Controller();
    }

    function index(){
        redirect("home");
    }

    function file( $file_id ){
        $this->config->load('upload');
        $this->load->model('db_files');
        $this->load->helper('download');
        
        $dFile = $this->db_files->getFileInfo( $file_id );
        $data = file_get_contents( $this->config->item('upload_path') . $dFile['filename'] );

        force_download($dFile['filename'], $data);
    }
}
