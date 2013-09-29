<?php
	class Subject_Model extends CI_Model{

        var $table = 'subject';

		function __construct(){
        	parent::__construct();
    	}

        function addSubject($data){
            return $this->db->insert($this->table,$data);
        }


    	function getSubject($data){
    		$query = $this->db->get_where($this->table,$data);
            return $query->row();
    	}

        function getSubjectList($data){
            $query = $this->db->get_where($this->table,$data);
            return $query->result_array();
        }

        function updateSubject($id,$data){
            $this->db->where('id',$id);
            return $this->db->update($this->table, $data); 
        }

        function delSubject($data){
            return $this->db->delete($this->table,$data);
        }

	}
?>