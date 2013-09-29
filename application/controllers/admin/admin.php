<?php
	class Admin extends CI_Controller{

		function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->library('encrypt');
			$this->load->model('admin_model','admin');
			$this->load->model('subject_model','subject');
		}

		function index(){
			$this->load->view('admin/login');
		}

		function login(){
			$password = $this->input->post("password");
			$query = array(
				'account' => $this->input->post("account")
			);
			$admin = $this->admin->getAdmin($query);

			if($admin && ($this->encrypt->decode($admin->password)==$password)){
				if($admin->enable==0){
					echo "<script>window.alert('该用户已被冻结，请联系超级管理员进行处理！');history.back();</script>";
					return;
				}
				date_default_timezone_set('Asia/Shanghai');//获取当前时间相差6小时,解决方法：1.php.ini将date.timezone的值设为Asia/Shanghai; 2.date_default_timezone_set('Asia/Shanghai')
				$temp = array(
					'lastLoginTime' => date('Y-m-d H:i:s'),
					'lastLoginIP' => $this->input->ip_address(),
					'loginCount' => $admin->loginCount+1
				);
				$this->admin->updateAdmin($admin->account,$temp);//记录用户登录时间、IP
				$this->session->set_userdata("login",$admin);
				$this->load->view('admin/index');
				return;
			}
			echo "<script>window.alert('用户名或密码错误！');history.back();</script>";
		}

		function toAdminAdd(){
			$this->load->view('admin/adminAdd');
		}
        function adminAdd(){
        	$this->parse_login();
        	$data =  array('account' => $this->input->post("account"));
        	if($this->admin->getAdmin($data)){
        		echo "<script>window.alert('该用户名已经存在！');history.back();</script>";
        		return;
        	}
        	$password = $this->input->post('password1');
            $temp = array(
            	'account' => $this->input->post('account'),
	            'password' => $this->encrypt->encode($password),
	            'realName' => $this->input->post('realName'),
	            'isRoot' => $this->input->post('isRoot'),
	            'addTime' => date('Y-m-d H:i:s')
	        );
            if($this->admin->addAdmin($temp)){
            	echo "<script>window.alert('添加成功！');
            		window.location.href='".site_url("admin/admin/adminList")."';</script>";
            	return;
            }
            echo "<script>window.alert('添加失败，系统繁忙或填写错误...');history.back();</script>";            
        }

		function adminList(){
        	$this->parse_login();
			$this->load->library('pagination');    
			$config['base_url'] = site_url("admin/adminList/page");
			$config['total_rows'] = $this->admin->getAdminNum();
			$config['per_page'] = 10; 
			$config['use_page_numbers'] = TRUE;
			$config['uri_segment'] = 5;
			$pageNum=$this->uri->segment(5)?$this->uri->segment(5):1;
			$pageNum==1 ? $offset=0 : $offset=$config['per_page']*($pageNum-1);
			$adminList=$this->admin->getAdminListByPage($config['per_page'],$offset);
			$this->pagination->initialize($config); 
			
			$pager=$this->pagination->create_links();
			$data['pager']=$pager;
			$data['adminList']=$adminList;
			$data['total_num']=$config['total_rows'];
			$this->load->view('admin/adminList',$data);
		}

		function toAdminModify(){
        	$this->parse_login();
			$temp = array('account' => end($this->uri->segment_array()));
			$admin = $this->admin->getAdmin($temp);
			$data['admin1'] = $admin;
			$data['password'] = $this->encrypt->decode($admin->password);
			$this->load->view('admin/adminModify',$data);
		}
		function adminModify(){
        	$this->parse_login();
			$account = $this->input->post('account');
			$password = $this->input->post('password1');
			$data = array(
				'password' => $this->encrypt->encode($password),
				'realName' => $this->input->post('realName'),
				'isRoot' => $this->input->post('isRoot'));
			if($this->admin->updateAdmin($account,$data)){
            	echo "<script>window.alert('修改成功！');window.location.href='".site_url("admin/admin/adminList")."';</script>";
            	return;
			}	
			echo"<script>window.alert('修改失败，系统繁忙或着填写错误...');history.back();</script>";
		}

		function adminDel(){
        	$this->parse_login();
			$temp = array('account' => end($this->uri->segment_array()));
			if($this->admin->delAdmin($temp)){
            	echo "<script>window.alert('删除成功！');window.location.href='".site_url("admin/admin/adminList")."';</script>";
            	return;
			}
			echo"<script>window.alert('删除失败，系统繁忙或着填写错误...');history.back();</script>";
		}

		function adminEnable(){
        	$this->parse_login();
			$account = end($this->uri->segment_array());;
			$data = array('enable' => $this->uri->segment(7));
			if($this->admin->updateAdmin($account,$data)){
            	echo "<script>window.alert('状态修改成功！');window.location.href='".site_url("admin/admin/adminList")."';</script>";
            	return;
			}
			echo"<script>window.alert('修改状态失败，系统繁忙或着填写错误...');history.back();</script>";
		}

		function adminSearch(){
			$this->parse_login();
			$info = $this->input->post('info');
			$adminList = $this->admin->getAdminListByInfo($info);
			$data['pager'] = "";
			$data['adminList'] = $adminList;
			$data['total_num'] = $this->admin->getAdminNumByInfo($info);
			$this->load->view('admin/adminList',$data);
		}

		function logout(){
			$this->session->unset_userdata('login');
			redirect(site_url("admin/admin"));
		}

		public function parse_login() {		
			if (!$this->session->userdata('login')) {
				echo "<script>window.alert('会话超时，请重新登录！');window.location.href='".site_url("admin/admin")."';</script>";
				exit();
			}	
		}

	}
?>
