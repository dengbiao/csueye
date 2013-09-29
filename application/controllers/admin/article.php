<?php
	class Article extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('subject_model','subject');
			$this->load->model('article_model','article');
			$this->load->model('admin_model','admin');
		}

		function toArticle(){
        	$this->parse_login();
			$sid = end($this->uri->segment_array());
			$subject = $this->subject->getSubject(array('id'=>$sid));
			$query = array('subjectID'=>$sid);
			$article = $this->article->getArticle($query);
			$data['subject'] = $subject;
			if($article){
				$data['article'] = $article;
				$this->load->view('admin/articleModify',$data);
			}else{
				$this->load->view('admin/articleAdd',$data);
			}
		}

		function articleAdd(){
        	$this->parse_login();
			$sid = $this->input->post('sid');
			$insert = array(
				'subjectID' => $sid,
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
				'updateTime' => date('Y-m-d H:i:s')
			);
			if($this->article->addArticle($insert)){
				$pid = $this->input->post('pid');
				//redirect(site_url("subject/subjectList/pid/".$pid));
            	echo "<script>window.alert('添加成功！');
            		window.location.href='".site_url("admin/subject/subjectList/pid/".$pid)."';</script>";
            	return;
			}
			echo "<script>window.alert('添加失败，系统繁忙或填写错误...');history.back();</script>";
		}

		function articleModify(){
        	$this->parse_login();
			$id = $this->input->post('id');
			$update = array(
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
				'updateTime' => date('Y-m-d H:i:s')
			);
			if($this->article->updateArticle($id,$update)){
				$pid = $this->input->post('pid');
            	echo "<script>window.alert('修改成功！');
            		window.location.href='".site_url("admin/subject/subjectList/pid/".$pid)."';</script>";
				return;
			}
			echo "<script>window.alert('添加失败，系统繁忙或填写错误...');history.back();</script>";
		}

		public function parse_login() {		
			if (!$this->session->userdata('login')) {
				echo "<script>window.alert('会话超时，请重新登录！');window.location.href='".site_url("admin/admin")."';</script>";
				exit();
			}	
		}
	}
?>
