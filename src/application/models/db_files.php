<?php
// This modle file uses code iginter's active record system to ensure
// portability. Documentation can be found here
// http://codeigniter.com/user_guide/database/active_record.html
class db_files extends Model {
    function db_files() {
        parent::Model();
    }

    function addFile( $name, $filename, $type, $desc, $size){
        $data = array(
            'name' => $name,
            'filename' => $filename,
            'type' => $type,
            'description' => $desc,
            'size' => $size
            );
        return $this->db->insert('file', $data);
    }

    function getFileList(){
        $query = $this->db->get('file');
        return $query->result_array();
    }

    function getFileInfo( $id ){
        $query = $this->db->get_where('file', array('id' => $id));
        
        if ($query->num_rows() > 0){
            return $query->row_array(); 
        }
    }

    //TAGS
    function addTag($id, $tag){
        $tagID = $this->_tagID($tag);
        if( $tagID == -1 ){
            //Add tag
            $data = array( 'name' => $tag );
            $this->db->insert('tags', $data); 
            $tagID = $this->db->insert_id();
        }

        //Do not add if tag exists for file        
        $this->db->select('id');
        $this->db->where('file_id', $id);
        $this->db->where('tag_id', $tagID);
        $query = $this->db->get('tagmap',1);

        //If no rows returned, add record
        if( $query->num_rows() == 0 ){
            $data = array( 'file_id' => $id, 'tag_id' => $tagID );
            $this->db->insert('tagmap', $data);
        }
    }

    function removeTag($id, $tag){
        $tagID = $this->_tagID($tag);
        if( $tagID != -1 ){
            $this->db->delete('tagmap', array('file_id' => $id, 'tag_id' => $tagID)); 
            $this->_cleanOrphanTag( $tagID );
        }
    }

    function _cleanOrphanTag( $tagID ){
        //TODO: Check if orphan and clean if so
    }

    function _tagID( $tag ){
        //Check if tag exists
        $this->db->select('tag_id');
        $this->db->where('name', $tag); 
        $query = $this->db->get('tags',1);
        
        if ($query->num_rows() > 0){
            $row = $query->row();
            return $row->tag_id;
        }
        return -1;
    }
    
    function getTags($id){
        $this->db->select('tagmap.*, tags.name');
        $this->db->from('tagmap');
        $this->db->join('tags', 'tagmap.tag_id = tags.tag_id', 'inner');
        $this->db->where('tagmap.file_id', $id );
        $query = $this->db->get();
        return $query->result_array();
    }

    function getTagList(){
        $query = $this->db->get('tags');
        return $query->result_array();
    }

    function getFilesByTag( $tag ){
        $tag_id = $this->_tagID( $tag );

        if( $tag_id != -1 ){
            $this->db->select('file.*');
            $this->db->from('file');
            $this->db->join('tagmap', 'file.id = tagmap.file_id', 'left');
            $this->db->where('tagmap.tag_id', $tag_id);
            $query = $this->db->get();
            return $query->result_array();
        }
    }
}
