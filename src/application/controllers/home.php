<?php
class Home extends Controller {
    function Home(){
        parent::Controller();
        $this->load->model('db_files');
        $this->load->library('parser');
        $this->load->config('settings');
        $this->load->config('upload');
        $this->lang->load('home');
    }
	
    function index(){
        $data['page_title'] = $this->lang->line('home_title');
        
        $data['filelist'] = $this->db_files->getFilesByTag($this->config->item('homepage_tag'));
        $data['uploadUrl'] = $this->config->item("base_url") . $this->config->item("public_path");

        $this->load->view('header', $data);
        $this->parser->parse( 'file_list', $data );
        $this->load->view('footer');
    }

    function files(){
        $data['page_title'] = $this->lang->line('file_list');
        $data['filelist'] = $this->db_files->getFileList();
        $data['uploadUrl'] = $this->config->item("base_url") . "/". $this->config->item("public_path");

        $this->load->view('header', $data);
        $this->parser->parse( 'file_list', $data );
        $this->load->view('footer');
    }

    function search(){
        $search = $this->input->post('search');
        if( $search == ""){
            redirect("/home");
        }else{
            $data['page_title'] = $this->lang->line('search') . " &gt; $search";
            $data['filelist'] = $this->db_files->searchFile($search);
            $data['taglist'] = $this->db_files->searchTag($search);
            $data['uploadUrl'] = $this->config->item("base_url") . "/". $this->config->item("public_path");
            $this->load->view('header', $data);
            $this->parser->parse( 'tag_list', $data );
            $this->parser->parse( 'file_list', $data );
            $this->load->view('footer');
        }
    }
    
    function tag( $tag_id=null ){
        if( $tag_id != null ){
            $data['page_title'] = $this->lang->line('files_by_tag');
            $data['filelist'] = $this->db_files->getFilesByTagId($tag_id);
            $data['uploadUrl'] = $this->config->item("base_url") . "/". $this->config->item("public_path");
        
            $this->load->view('header', $data);
            $this->parser->parse( 'file_list', $data );
            $this->load->view('footer');
        }else{
            $data['page_title'] = $this->lang->line('tag_list');
            $data['taglist'] = $this->db_files->getTagList();
        
            $this->load->view('header', $data);
            $this->parser->parse( 'tag_list', $data );
            $this->load->view('footer');
        }
    }
}
