<?php
	class Article_Model extends CI_Model{

		var $table = 'article';

		function __construct(){
        	parent::__construct();
    	}

    	function addArticle($data){
            return $this->db->insert($this->table,$data);
        }

        function getArticle($data){
            $query = $this->db->get_where($this->table,$data);
            return $query->row();
        }

        function updateArticle($id,$data){
            $this->db->where('id',$id);
            return $this->db->update($this->table, $data); 
        }
	}

?>