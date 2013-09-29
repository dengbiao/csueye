<?php
	class Document_Model extends CI_Model{

        var $table = 'document';

		function __construct(){
        	parent::__construct();
    	}

        function addDocument($data){
            return $this->db->insert($this->table,$data);
        }

    	function getDocument($data){
            $query = $this->db->get_where($this->table,$data);
            return $query->row();
    	}

        function delDocument($data){
            return $this->db->delete($this->table,$data);
        }

        function getDocumentListBySub($subjectID,$num,$offset){
            $this->db->from($this->table);
            $this->db->where('subjectID',$subjectID);
            $this->db->order_by('addTime desc');
            $this->db->limit($num,$offset);
            $query = $this->db->get();
            return $query->result_array();
        }

        function getDocumentNumBySub($subjectID){
            $this->db->from($this->table);
            $this->db->where('subjectID',$subjectID);
            $query = $this->db->get();
            return $query->num_rows();
        }

        function getDocumentListByInfo($subjectID,$info,$num,$offset){
            $this->db->from($this->table);
            $this->db->where('subjectID',$subjectID);
            $this->db->like('title',$info);
            $this->db->order_by('addTime desc');
            $this->db->limit($num,$offset);
            $query = $this->db->get();
            return $query->result_array();
        }

        function getDocumentNumByInfo($subjectID,$info){
            $this->db->from($this->table);
            $this->db->where('subjectID',$subjectID);
            $this->db->like('title',$info);
            $query = $this->db->get();
            return $query->num_rows();
        }

        function updateDocument($id,$data){
            $this->db->where('id',$id);
            return $this->db->update($this->table, $data); 
        }
	}
?>