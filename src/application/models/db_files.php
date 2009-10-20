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
}
?> 
