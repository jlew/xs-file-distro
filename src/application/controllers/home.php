<?php
class Home extends Controller {
    function Home(){
        parent::Controller();	
    }
	
    function index(){
        $this->load->model('db_files');
        $data['filelist'] = $this->db_files->getFileList();

        $this->load->library('parser');
        $this->parser->parse( 'home', $data );
    }
}
