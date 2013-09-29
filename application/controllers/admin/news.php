<?php
	class News extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('subject_model','subject');
			$this->load->model('news_model','news');
			$this->load->model('admin_model','admin');
		}

		public function parse_login() {		
			if (!$this->session->userdata('login')) {
				echo "<script>window.alert('会话超时，请重新登录！');window.location.href='".site_url("admin/admin")."';</script>";
				exit();
			}	
		}

		public function upload_config(){
			$config['upload_path'] = './resources/uploads/news/';
	    	$config['allowed_types'] = 'gif|jpg|png|jpeg|PNG|JPG';
        	$config['max_size'] = '2048';
			$config['encrypt_name'] = true;
			$this->load->library('upload', $config);
		}

		function toNewsAdd(){
        	$this->parse_login();
			$sid = end($this->uri->segment_array());
			$data['subject'] = $this->subject->getSubject(array('id'=>$sid));
			$this->load->view('admin/newsAdd',$data);
		}
		function newsAdd(){
        	$this->parse_login();
			$admin = $this->session->userdata('login');
			$sid = $this->input->post('sid');
			$this->upload_config();
			if($this->input->post('hasPic')=="on"){
				if($this->upload->do_upload("picPath")){
					$p=$this->upload->data();
					$insert = array(
						'subjectID' => $sid,
						'author' => $admin->account,
						'title' => $this->input->post('title'),
						'source' => $this->input->post('source'),
						'content' => $this->input->post('content'),
						'picPath' => $p['file_name'],
						'addTime' => date('Y-m-d H:i:s'),
						'updateTime' => date('Y-m-d H:i:s'),
						'flag' => $this->input->post('flag')=='on' ? 1 : 0
					);
					if($this->news->addNews($insert)){
						echo "<script>window.alert('添加成功！');
		            		window.location.href='".site_url("admin/news/newsList/sid/".$sid)."';</script>";
						return;
					}
					echo "<script>window.alert('添加失败，系统繁忙或填写错误...');history.back();</script>";
				}else{
					echo"<script>window.alert('".$this->upload->display_errors()."');history.back();</script>";
				}
			}else{
				$insert = array(
					'subjectID' => $sid,
					'author' => $admin->account,
					'title' => $this->input->post('title'),
					'source' => $this->input->post('source'),
					'content' => $this->input->post('content'),
					'addTime' => date('Y-m-d H:i:s'),
					'updateTime' => date('Y-m-d H:i:s'),
					'flag' => $this->input->post('flag')=='on' ? 1 : 0
				);
				if($this->news->addNews($insert)){
					echo "<script>window.alert('添加成功！');
	            		window.location.href='".site_url("admin/news/newsList/sid/".$sid)."';</script>";
					return;
				}
				echo "<script>window.alert('添加失败，系统繁忙或填写错误...');history.back();</script>";
			}
		}

		function toNewsModify(){
			$this->parse_login();
			$query = array('id'=> end($this->uri->segment_array()));
			$news = $this->news->getNews($query);
			$data['news'] = $news;
			$data['subject'] = $this->subject->getSubject(array('id'=>$news->subjectID));
			$this->load->view('admin/newsModify',$data);
		}
		function newsModify(){
			$this->parse_login();
			$id = $this->input->post('id');
			$this->upload_config();
			if($this->input->post('hasPic')=="on"){
				if($this->upload->do_upload("picPath")){
				  	$p=$this->upload->data();
				  	$update = array(
				  		'title' => $this->input->post('title'),
						'source' => $this->input->post('source'),
						'content' => $this->input->post('content'),
						'picPath' => $p['file_name'],
						'updateTime' => date('Y-m-d H:i:s')
				  	);
				  	if($this->news->updateNews($id,$update)){
						$sid = $this->input->post('sid');
		            	echo "<script>window.alert('修改成功！');
		            		window.location.href='".site_url("admin/news/newsList/sid/".$sid)."';</script>";
						return;
					}
					echo "<script>window.alert('添加失败，系统繁忙或填写错误...');history.back();</script>";
			  	}else{			  		
				  	echo"<script>window.alert('".$this->upload->display_errors()."');history.back();</script>";
			  	}
		  	}else{
			  	$update = array(
					'title' => $this->input->post('title'),
					'source' => $this->input->post('source'),
					'content' => $this->input->post('content'),
					'updateTime' => date('Y-m-d H:i:s')
				);
				if($this->news->updateNews($id,$update)){
					$sid = $this->input->post('sid');
	            	echo "<script>window.alert('修改成功！');
	            		window.location.href='".site_url("admin/news/newsList/sid/".$sid)."';</script>";
					return;
				}
				echo "<script>window.alert('添加失败，系统繁忙或填写错误...');history.back();</script>";
		  	}
		}

		function newsDel(){
			$this->parse_login();
			$data = array('id' => end($this->uri->segment_array()));
			$news = $this->news->getNews($data);
			if($this->news->delNews($data)){
            	echo "<script>window.alert('删除成功！');window.location.href='".site_url("admin/news/newsList/sid/".$news->subjectID)."';</script>";
            	return;
			}
			echo"<script>window.alert('删除失败，系统繁忙或着填写错误...');history.back();</script>";
		}

		function newsList(){
        	$this->parse_login();
			$sid = end($this->uri->segment_array());
			$this->load->library('pagination');    
			$config['base_url'] = site_url("admin/news/newsList/sid/".$sid."/page");
			$config['total_rows'] = $this->news->getNewsNumBySub($sid);
			$config['per_page'] = 10; 
			$config['use_page_numbers'] = TRUE;
			$config['uri_segment'] = 7;
			$pageNum=$this->uri->segment(7)?$this->uri->segment(7):1;
			$pageNum==1 ? $offset=0 : $offset=$config['per_page']*($pageNum-1);
			$newsList=$this->news->getNewsListBySub($sid,$config['per_page'],$offset);
			$this->pagination->initialize($config); 
			$pager=$this->pagination->create_links();
			$data['subject']=$this->subject->getSubject(array('id'=>$sid));
			$data['pager']=$pager;
			$data['newsList']=$newsList;
			$data['total_num']=$config['total_rows'];
			$this->load->view('admin/newsList',$data);			
		}

		function newsSearch(){
			$this->parse_login();
			$sid = $this->input->post('sid');
			$info = $this->input->post('info');
			$newsList = $this->news->getNewsListByInfo($sid,$info,20,0);
			$data['subject'] = $this->subject->getSubject(array('id'=>$sid));
			$data['pager'] = "";
			$data['newsList'] = $newsList;
			$data['total_num'] = $this->news->getNewsNumByInfo($sid,$info);
			$this->load->view('admin/newsList',$data);	
		}

	}
?>
