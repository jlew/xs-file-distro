<?php
class db_users extends Model {
    function db_users() {
        parent::Model();
    }

    function getAdmin( $username, $password ){
	$this->db->where('username', $username);
	$this->db->where('password', md5($password) );
	$query = $this->db->get('admins', 1);

    	if( $query->num_rows() == 0 ){
	    return false;
	}else{
	    return $query->row_array();
	}
    }
}
