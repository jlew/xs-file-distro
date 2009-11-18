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

    function getUserById( $id ){
	$this->db->where('id', $id);
	$query = $this->db->get('admins', 1);

    	if( $query->num_rows() == 0 ){
	    return false;
	}else{
	    return $query->row_array();
	}
    }
    
    function getUserList(){
	return $this->db->get('admins')->result_array();
    }

    function addUser($userName, $password){
	 $data = array(
            'username' => $userName,
            'password' => md5($password)
	    );
        $this->db->insert('admins', $data);
        return $this->db->insert_id();
    }

    function changePassword( $userId, $password ){
    	$this->db->where('id', $userId);
        $this->db->update('admins', array('password'=>md5($password))); 
    }

    function deleteUser( $userId ){
    	$this->db->delete('admins', array('id'=>$userId) );
    }

    function userCount(){
	return $this->db->count_all('admins');
    }
}
