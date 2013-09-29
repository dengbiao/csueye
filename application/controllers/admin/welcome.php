<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('subject_model','subject');
		$this->load->model('admin_model','admin');
	}

	public function index()
	{
		$rootSubjectList = $this->subject->getSubjectList(array('rootID'=> '0'));
		$data['rootSubjectList'] = $rootSubjectList;
		foreach ($rootSubjectList as $key => $subject) {
			# code...			
			$data['subjectList_'.$subject['id']]= $this->subject->getSubjectList(array('parentID'=> $subject['id']));
		}
		$this->load->view('index',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */