<?php
class Home extends Controller {
    function Home(){
        parent::Controller();
        $this->load->model('db_files');
        $this->load->library('parser');
        $this->load->config('display_settings');
    }
	
    function index(){
        $data['page_title'] = 'Home';
        
        $data['filelist'] = $this->db_files->getFilesByTag($this->config->item('homepage_tag'));

        $this->load->view('header', $data);
        $this->parser->parse( 'file_list', $data );
        $this->load->view('footer');
    }

    function files(){
        $data['page_title'] = 'File List';
        $data['filelist'] = $this->db_files->getFileList();

        $this->load->view('header', $data);
        $this->parser->parse( 'file_list', $data );
        $this->load->view('footer');
    }
    
    function tag( $tag_id=null ){
        if( $tag_id != null ){
            $data['page_title'] = "Home &gt; Files taged under $tag_id";
            $data['filelist'] = $this->db_files->getFilesByTagId($tag_id);
        
            $this->load->view('header', $data);
            $this->parser->parse( 'file_list', $data );
            $this->load->view('footer');
        }else{
            $data['page_title'] = "Home &gt; Tag List";
            $data['taglist'] = $this->db_files->getTagList();
        
            $this->load->view('header', $data);
            $this->parser->parse( 'tag_list', $data );
            $this->load->view('footer');
        }
    }
}
