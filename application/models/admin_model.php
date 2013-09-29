<?php
	class Admin_Model extends CI_Model{

        var $table = 'admin';

		function __construct(){
        	parent::__construct();
    	}

        function addAdmin($data){
            return $this->db->insert($this->table,$data);
        }

        function getAdmin($data){
            $query = $this->db->get_where($this->table,$data);
            return $query->row();
        }

        function getAdminListByPage($num,$offset){
            $this->db->from($this->table);
            $this->db->order_by('lastLoginTime desc');
            $this->db->limit($num,$offset);
            $query=$this->db->get();
            return $query->result_array();
        }

        function getAdminNum(){
            $query = $this->db->get_where($this->table);
            return $query->num_rows();
        }

        function getAdminListByInfo($info){
            $this->db->from($this->table);
            $this->db->like('account',$info);
            $this->db->order_by('lastLoginTime desc');
            //$this->db->limit($num,$offset);
            $query=$this->db->get();
            return $query->result_array();
        }
        function getAdminNumByInfo($info){
            $this->db->from($this->table);
            $this->db->like('account',$info);
            $query=$this->db->get();
            return $query->num_rows();
        }


        function delAdmin($data){
            return $this->db->delete($this->table,$data);
        }

        function updateAdmin($account,$data){
            $this->db->where('account',$account);
            return $this->db->update($this->table, $data); 
        }

	}
?>