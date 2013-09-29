<?php
	class News_Model extends CI_Model{

        var $table = 'news';

		function __construct(){
        	parent::__construct();
    	}

        function addNews($data){
            return $this->db->insert($this->table,$data);
        }

    	function getNews($data){
            $query = $this->db->get_where($this->table,$data);
            return $query->row();
    	}

        function delNews($data){
            return $this->db->delete($this->table,$data);
        }

        function getNewsListByInfo($subjectID,$info,$num,$offset){
            $this->db->from($this->table);
            $this->db->where('subjectID',$subjectID);
            $this->db->like('title',$info);
            $this->db->order_by('addTime desc');
            $this->db->limit($num,$offset);
            $query = $this->db->get();
            return $query->result_array();
        }
        function getNewsNumByInfo($subjectID,$info){
            $this->db->from($this->table);
            $this->db->where('subjectID',$subjectID);
            $this->db->like('title',$info);
            $query = $this->db->get();
            return $query->num_rows();
        }

        function getNewsListBySub($subjectID,$num,$offset){          
            // $this->db->select('news.id as id','subject.name as subjectName','admin.account as adminName','news.title as title','news.addTime as addTime');
            // $this->db->from('news');
            // $this->db->join('subject','news.subjectID=subject.id');
            // $this->db->join('admin','news.adminID=admin.id');
            // $this->db->where('news.subjectID',$subjectID);
            // $this->db->order_by('news.addTime desc');
            // $this->db->limit($num,$offset);
            // $query = $this->db->get();

            // $sql="select a.id id,a.title title,a.addTime addTime,a.flag flag,b.account adminName from news a join admin b on a.adminID=b.id where a.subjectID=".$subjectID." order by a.addTime desc limit ".$offset.",".$num;
            // $query = $this->db->query($sql);
            $this->db->from($this->table);
            $this->db->where('subjectID',$subjectID);
            $this->db->order_by('addTime desc');
            $this->db->limit($num,$offset);
            $query = $this->db->get();
            return $query->result_array();
        }
        function getNewsNumBySub($subjectID){
            $this->db->from($this->table);
            $this->db->where('subjectID',$subjectID);
            $query = $this->db->get();
            return $query->num_rows();
        }

        function updateNews($id,$data){
            $this->db->where('id',$id);
            return $this->db->update($this->table, $data); 
        }

        function getPictureNewsList($num)
        {
            $this->db->from($this->table);
            $this->db->where('flag','1');
            $this->db->order_by('addTime desc');
            $this->db->limit($num,0);
            $query = $this->db->get();
            return $query->result_array();
        }
        
        function getSchoolPictureNewsList($subjectID,$num)
        {
            $this->db->from($this->table);
            $this->db->where('subjectID',$subjectID);
            $this->db->where('flag','1');
            $this->db->order_by('addTime desc');
            $this->db->limit($num,0);
            $query = $this->db->get();
            return $query->result_array();
        }


        function getNewestNews($subjectID)
        {
            $this->db->from($this->table);
            $this->db->where('subjectID',$subjectID);
            $this->db->order_by('addTime desc');
            $query = $this->db->get();
            return $query->first_row();
        }

        // function getNewsListByRoot($rootID,$num,$offset){
        //     $this->db->select('id','subject.name as subjectName','admin.account as adminName','title','addTime');
        //     $this->db->from('news');
        //     $this->db->join('subject','news.subjectID=subject.id');
        //     $this->db->join('admin','news.adminID=admin.id');
        //     $this->db->where('subject.rootID',$rootID);
        //     $this->db->order_by('addTime desc');
        //     $this->db->limit($num,$offset);
        //     $query = $this->db->get();
        //     return $query->result_array();
        // }

        // function getNewsNumByRoot($rootID){
        //     $this->db->from('news');
        //     $this->db->join('subject','news.subjectID=subject.id');
        //     $this->db->where('subject.rootID',$rootID);
        //     $query = $this->db->get();
        //     return $query->num_rows();
        // }
	}
?>