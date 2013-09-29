<?php
	class Keytime extends CI_Controller{

		function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('keytime_model','keytime');
			$this->load->model('admin_model','admin');
		}

		//添加栏目
		function toKeytimeAdd(){
        	$this->parse_login();
			$this->load->view('admin/keytimeAdd');
		}

		//添加栏目
		function keytimeAdd(){
        	$this->parse_login();
			$insert = array(
				'time' => $this->input->post('time'),
				'event' => $this->input->post('event')//判断新增栏目是固定文章(flag=1)还是动态新闻(flag=2)
			);
			if($this->keytime->addKeytime($insert)){
				redirect(site_url("admin/keytime/keytimeList/"));
				return;
			}
			echo "<script>window.alert('添加失败，系统繁忙或填写错误...');history.back();</script>";
		}

		//进入栏目修改页面
		function toKeytimeModify(){
        	$this->parse_login();
			$query = array('id'=>$this->uri->segment(5));
			$keytime = $this->keytime->getKeytime($query);
			$data['keytime'] = $keytime;
			$this->load->view('admin/keytimeModify',$data);
		}
		//修改栏目
		function keytimeModify(){
        	$this->parse_login();
			$id = $this->input->post('id');
			$data=array(
				'time'=>$this->input->post('time'),
				'event'=>$this->input->post('event')
			);
			if($this->keytime->updateKeytime($id,$data)){
				echo "<script>window.alert('修改成功！');
            		window.location.href='".site_url("admin/keytime/keytimeList/")."';</script>";
				return;
			}	
			echo"<script>window.alert('修改失败，系统繁忙或填写错误...');history.back();</script>";
		}

		//删除栏目
		function keytimeDel(){
        	$this->parse_login();
			$id = $this->uri->segment(5);
			$data = array('id'=>$id);
			$subject = $this->keytime->getKeytime($data);
			if($this->keytime->delKeytime($data)){	
				redirect(site_url("admin/keytime/keytimeList/"));
				return;
			}
			echo"<script>window.alert('删除失败，系统繁忙或着填写错误...');history.back();</script>";
		}

		//栏目列表
		function keytimeList(){
        	$this->parse_login();
			$keytimeList = $this->keytime->getAllKeytimeList();
			$data['keytimeList'] = $keytimeList;
			$this->load->view('admin/keytimeList',$data);
		}

		public function parse_login() {		
			if (!$this->session->userdata('login')) {
				echo "<script>window.alert('会话超时，请重新登录！');window.location.href='".site_url("admin/admin")."';</script>";
				exit();
			}	
		}

	}
?>
