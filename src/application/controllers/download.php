<?php
class Download extends Controller {
    function Download(){
        parent::Controller();
        $this->load->model('db_files');
    }
	
    function index(){
        redirect("home");
    }

    function file( $file_id ){
        $this->config->load('upload');
        $dFile = $this->db_files->getFileInfo( $file_id );

        $this->load->helper('download');
        $data = file_get_contents( $this->config->item('upload_path') . $dFile['filename'] );

        force_download($dFile['filename'], $data);
    }
}
