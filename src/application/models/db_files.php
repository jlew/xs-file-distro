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
        $this->db->insert('file', $data);
        return $this->db->insert_id();
    }

    function editFileDesc( $id, $desc ){
        $this->db->where('id', $id);
        $this->db->update('file', array('description'=>$desc)); 
    }

    function deleteFile( $id ){
        //Select file
        $fileInfo = $this->getFileInfo( $id );

        if( $fileInfo ){
            //Get file tags
            $tags = $this->getTags($id);

            //Delete tags
            foreach( $tags as $tag ){
                $this->removeTagById( $id, $tag['tag_id'] );
            }

            //Delete file
            $this->db->delete('file', array('id' => $id));
            return $fileInfo['filename'];
        }
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
        $this->removeTagById( $id, $tagID );
    }
    
    function removeTagById($id, $tagID){
        if( $tagID != -1 ){
            $this->db->delete('tagmap', array('file_id' => $id, 'tag_id' => $tagID)); 
            $this->_cleanOrphanTag( $tagID );
        }
    }

    function _cleanOrphanTag( $tagID ){
        $query = $this->db->where('tag_id', $tagID);
        $this->db->from('tagmap');
        if( $this->db->count_all_results() == 0 ){
            $this->db->delete('tags',array( 'tag_id'=>$tagID));
        }
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
        $sql = "
          SELECT t1.tag_id, t1.tag_count, tags.name
          FROM tags
          JOIN(
           SELECT COUNT(id) AS tag_count, tag_id
           FROM tagmap
           GROUP BY tag_id
           ) AS t1 ON tags.tag_id = t1.tag_id
          ORDER BY tag_count DESC
        ";
        
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    function getFilesByTag( $tag ){
        $tag_id = $this->_tagID( $tag );
        return $this->getFilesByTagId( $tag_id );
    }
    
    function getFilesByTagId( $tag_id ){
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
