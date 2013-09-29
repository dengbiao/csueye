<?php
	class Document extends CI_Controller{

		function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('subject_model','subject');
			$this->load->model('document_model','document');
			$this->load->model('admin_model','admin');
		}

		public function parse_login() {		
			if (!$this->session->userdata('login')) {
				echo "<script>window.alert('会话超时，请重新登录！');window.location.href='".site_url("admin/admin")."';</script>";
				exit();
			}	
		}

		public function upload_config(){
			$config['upload_path'] = './resources/uploads/document/';
	    	$config['allowed_types'] = '*';
        	$config['max_size'] = '512000';
			$config['encrypt_name'] = true;
			$this->load->library('upload', $config);
		}

		function toDocumentAdd(){
        	$this->parse_login();
			$sid = end($this->uri->segment_array());
			$data['subject'] = $this->subject->getSubject(array('id'=>$sid));
			$this->load->view('admin/documentAdd',$data);
		}
		function documentAdd(){
        	$this->parse_login();
			$admin = $this->session->userdata('login');
			$sid = $this->input->post('sid');
			$this->upload_config();
		  	if(!$this->upload->do_upload("docPath")){
			  	echo"<script>window.alert('".$this->upload->display_errors()."');history.back();</script>";
				exit();
		  	} 
		  	$p=$this->upload->data();
			$insert = array(
				'subjectID' => $sid,
				'author' => $admin->account,
				'title' => $this->input->post('title'),
				'brief' => $this->input->post('brief'),
				'path' => $p['file_name'],
				'addTime' => date('Y-m-d H:i:s')
			);
			if($this->document->addDocument($insert)){
				echo "<script>window.alert('添加成功！');
            		window.location.href='".site_url("admin/document/documentList/sid/".$sid)."';</script>";
				return;
			}
			echo "<script>window.alert('添加失败，系统繁忙或填写错误...');history.back();</script>";
		}

		function toDocumentModify(){
			$this->parse_login();
			$query = array('id'=> end($this->uri->segment_array()));
			$document = $this->document->getDocument($query);
			$data['document'] = $document;
			$data['subject'] = $this->subject->getSubject(array('id'=>$document->subjectID));
			$this->load->view('admin/documentModify',$data);
		}
		function documentModify(){
			$this->parse_login();
			$id = $this->input->post('id');
			$sid = $this->input->post('sid');
			$this->upload_config();
			if($this->input->post('docPath')==""){
				$update = array(
					'title' => $this->input->post('title'),
					'brief' => $this->input->post('brief')
				);
				if($this->document->updateDocument($id,$update)){
	            	echo "<script>window.alert('修改成功！');
	            		window.location.href='".site_url("admin/document/documentList/sid/".$sid)."';</script>";
					return;
				}
				echo "<script>window.alert('添加失败，系统繁忙或填写错误...');history.back();</script>";
		  	}else{
			  	if(!$this->upload->do_upload("docPath")){
				  	echo"<script>window.alert('".$this->upload->display_errors()."');history.back();</script>";
					exit();
			  	} 
			  	$p=$this->upload->data();
			  	$update = array(
			  		'title' => $this->input->post('title'),
					'brief' => $this->input->post('brief'),
					'path' => $p['file_name'],
			  	);
			  	if($this->document->updateDocument($id,$update)){
	            	echo "<script>window.alert('修改成功！');
	            		window.location.href='".site_url("admin/document/documentList/sid/".$sid)."';</script>";
					return;
				}
				echo "<script>window.alert('添加失败，系统繁忙或填写错误...');history.back();</script>";
		  	}
		}

		function documentDel(){
			$this->parse_login();
			$data = array('id' => end($this->uri->segment_array()));
			$document = $this->document->getDocument($data);
			if($this->document->delDocument($data)){
            	echo "<script>window.alert('删除成功！');window.location.href='".site_url("admin/document/documentList/sid/".$document->subjectID)."';</script>";
            	return;
			}
			echo"<script>window.alert('删除失败，系统繁忙或着填写错误...');history.back();</script>";
		}

		function documentList(){
        	$this->parse_login();
			$sid = end($this->uri->segment_array());
			$this->load->library('pagination');    
			$config['base_url'] = site_url("admin/document/documentList/sid/".$sid."/page");
			$config['total_rows'] = $this->document->getDocumentNumBySub($sid);
			$config['per_page'] = 10; 
			$config['use_page_numbers'] = TRUE;
			$config['uri_segment'] = 7;
			$pageNum=$this->uri->segment(7)?$this->uri->segment(7):1;
			$pageNum==1 ? $offset=0 : $offset=$config['per_page']*($pageNum-1);
			$documentList = $this->document->getDocumentListBySub($sid,$config['per_page'],$offset);
			$this->pagination->initialize($config); 
			$pager=$this->pagination->create_links();
			$data['subject']=$this->subject->getSubject(array('id'=>$sid));
			$data['pager']=$pager;
			$data['documentList']=$documentList;
			$data['total_num']=$config['total_rows'];
			$this->load->view('admin/documentList',$data);			
		}

		function documentSearch(){
			$this->parse_login();
			$sid = $this->input->post('sid');
			$info = $this->input->post('info');
			//$this->load->library('pagination');    
			//$config['base_url'] = site_url("news/newsList/sid/".$sid."/page");
			//$config['total_rows'] = $this->news->getNewsNumByInfo($sid,$info);
			//$config['per_page'] = 20; 
			//$config['use_page_numbers'] = TRUE;
			//$config['uri_segment'] = 6;
			//$pageNum=$this->uri->segment(6)?$this->uri->segment(6):1;
			//$pageNum==1 ? $offset=0 : $offset=$config['per_page']*($pageNum-1);
			//$newsList=$this->news->getNewsListBySub($sid,$config['per_page'],$offset);
			//$this->pagination->initialize($config); 
			//$pager=$this->pagination->create_links();
			$documentList = $this->document->getDocumentListByInfo($sid,$info,20,0);
			$data['subject'] = $this->subject->getSubject(array('id'=>$sid));
			$data['pager'] = "";
			$data['documentList'] = $documentList;
			$data['total_num'] = $this->document->getDocumentNumByInfo($sid,$info);
			$this->load->view('admin/documentList',$data);	
		}

	}
?>
