<?php
	class Keytime_Model extends CI_Model{

        var $table = 'keytime';

		function __construct(){
        	parent::__construct();
    	}

        function addKeytime($data){
            return $this->db->insert($this->table,$data);
        }

    	function getKeytime($data){
            $query = $this->db->get_where($this->table,$data);
            return $query->row();
    	}

        function delKeytime($data){
            return $this->db->delete($this->table,$data);
        }

         function getKeytimeList($num,$offset){  
            $this->db->from($this->table);
            $this->db->order_by('time desc');
            $this->db->limit($num,$offset);
            $query = $this->db->get();
            return $query->result_array();
        }


         function getAllKeytimeList(){  
            $this->db->from($this->table);
            $this->db->order_by('time desc');
            $query = $this->db->get();
            return $query->result_array();
        }

        function updateKeytime($id,$data){
            $this->db->where('id',$id);
            return $this->db->update($this->table, $data); 
        }
	}
?>