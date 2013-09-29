<?php
	class Subject extends CI_Controller{

		function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('subject_model','subject');
			$this->load->model('admin_model','admin');
		}

		//添加栏目
		function subjectAdd(){
        	$this->parse_login();
			$pid = end($this->uri->segment_array());
			$pSubject = $this->subject->getSubject(array('id'=>$pid));
			$insert = array(
				'parentID' => $pid,
				'rootID' => $this->session->userdata('rootID'),
				'name' => $this->input->post('name'),
				'flag' => $this->input->post('flag')//判断新增栏目是固定文章(flag=1)还是动态新闻(flag=2)
			);
			if($this->subject->addSubject($insert)){
				// 新增栏目成功，将父栏目的flag值置为0	
				$update = array('flag'=>0);
				$this->subject->updateSubject($pid,$update); //notice：需要在数据库做事务处理！！！
				redirect(site_url("admin/subject/subjectList/pid/".$pid));
				return;
			}
			echo "<script>window.alert('添加失败，系统繁忙或填写错误...');history.back();</script>";
		}

		//进入栏目修改页面
		function toSubjectModify(){
        	$this->parse_login();
			$query = array('id'=>end($this->uri->segment_array()));
			$subject = $this->subject->getSubject($query);
			$data['subject'] = $subject;
			$this->load->view('admin/subjectModify',$data);
		}
		//修改栏目
		function subjectModify(){
        	$this->parse_login();
			$id = $this->input->post('id');
			$data=array(
				'name'=>$this->input->post('name'),
				'brief'=>$this->input->post('brief'),
				'flag'=>$this->input->post('flag')
			);
			if($this->subject->updateSubject($id,$data)){
				$pid = $this->input->post('pid');
				echo "<script>window.alert('修改成功！');
            		window.location.href='".site_url("admin/subject/subjectList/pid/".$pid)."';</script>";
				return;
			}	
			echo"<script>window.alert('修改失败，系统繁忙或填写错误...');history.back();</script>";
		}

		//删除栏目
		function subjectDel(){
        	$this->parse_login();
			$id = end($this->uri->segment_array());
			$data = array('id'=>$id);
			$subject = $this->subject->getSubject($data);
			$pid = $subject->parentID;
			if($this->subject->delSubject($data)){	
				redirect(site_url("admin/subject/subjectList/pid/".$pid));
				return;
			}
			echo"<script>window.alert('删除失败，系统繁忙或着填写错误...');history.back();</script>";
		}

		//栏目列表
		function subjectList(){
        	$this->parse_login();
			$pid = end($this->uri->segment_array());
			$subject = $this->subject->getSubject(array('id'=> $pid));
			if($subject->parentID==0){
				$this->session->set_userdata("rootID",$subject->id);//设置根栏目
			}
			$subjectList = $this->subject->getSubjectList(array('parentID'=> $pid));
			$data['pSubject'] = $subject;
			$data['subjectList'] = $subjectList;
			$this->load->view('admin/subjectList',$data);
		}

		public function parse_login() {		
			if (!$this->session->userdata('login')) {
				echo "<script>window.alert('会话超时，请重新登录！');window.location.href='".site_url("admin/admin")."';</script>";
				exit();
			}	
		}

	}
?>
