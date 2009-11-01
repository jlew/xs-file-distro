<?php
class db_files extends Model {
    function db_files() {
        parent::Model();
    }

    function addFile( $name, $filename, $type, $desc, $size){
        $sql = 'INSERT INTO `file` (`name`, `filename`, `type`, `description`, `size`) VALUES ( ?,?,?,?,? )';
        return $this->db->query( $sql, array($name, $filename, $type, $desc, $size));
    }

    function getFileList(){
        $sql = "SELECT * FROM  `file`";
        $query = $this->db->query( $sql );
        return $query->result_array();
    }

    function getFileInfo( $id ){
        $sql = "SELECT * FROM `file` WHERE `id`=?";
        $query = $this->db->query( $sql, array( $id ) );
        
        if ($query->num_rows() > 0){
            return $query->row_array(); 
        }
    }

    //TAGS
    function addTag($id, $tag){
        $tagID = $this->_tagID($tag);
        if( $tagID == -1 ){
            //Add tag
            $sql = "INSERT INTO `tags` ( `name` ) VALUES ( ? );";
            $query = $this->db->query( $sql, array( $tag ) );
            $tagID = $this->db->insert_id();
        }

        //Do not add if tag exists for file
        $sql = "SELECT `id` FROM `tag-map` WHERE `file_id` = ? AND `tag_id` = ? LIMIT 1;";
        $query = $this->db->query( $sql, array( $id, $tagID ) );
        if( $query->num_rows() == 0 ){
            $sql = "INSERT INTO  `tag-map` (`file_id`,`tag_id`)VALUES (?,?);";
            $sql = $this->db->query( $sql, array( $id, $tagID ) );
        }
    }

    function removeTag($id, $tag){
        $tagID = $this->_tagID($tag);
        if( $tagID != -1 ){
            $sql = "DELETE FROM `tag-map` WHERE `file_id` = ? AND `tag_id` = ?;";
            $sql = $this->db->query( $sql, array( $id, $tagID ) );
            $this->_cleanOrphanTag( $tagID );
        }
    }

    function _cleanOrphanTag( $tagID ){
        //TODO: Check if orphan and clean if so
    }

    function _tagID( $tag ){
        //Check if tag exists
        $sql = "SELECT `tag_id` FROM  `tags` WHERE  `name` =  ? LIMIT 1;";
        $query = $this->db->query( $sql, array( $tag ) );
        
        if ($query->num_rows() > 0){
            $row = $query->row();
            return $row->tag_id;
        }
        return -1;
    }
    
    function getTags($id){
        $sql = "SELECT `tag-map`.`id`, `tags`.`name` FROM  `tag-map` " .
               "INNER JOIN `tags` ON `tag-map`.`tag_id` = `tags`.`tag_id` WHERE  `tag-map`.`file_id`=?";
        $query = $this->db->query( $sql, array( $id ) );
        return $query->result_array();
    }

    function getTagList(){
        //TODO GET COUNT AND ORDER
        $sql = "SELECT * FROM `tags`";
        $query = $this->db->query( $sql );
        return $query->result_array();
    }

    function getFilesByTag( $tag ){
        $tag_id = $this->_tagID( $tag );

        if( $tag_id != -1 ){
            $sql = "SELECT `file`.* FROM `file` LEFT JOIN `tag-map` ON `file`.`id` = `tag-map`.`file_id` WHERE `tag-map`.`tag_id` = ?;";
            $query = $this->db->query( $sql, array( $tag_id ) );
            return $query->result_array();
        }
    }
}
