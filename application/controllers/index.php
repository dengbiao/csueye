<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

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
		$this->load->helper('text');
		$this->load->model('subject_model','subject');
		$this->load->model('news_model','news');
		$this->load->model('keytime_model','keytime');
		$this->load->model('article_model','article');
		$this->load->model('admin_model','admin');
	}

	public function index()
	{
		$rootSubjectList = $this->subject->getSubjectList(array('rootID'=> '0'));
		$pictureNews = $this->news->getPictureNewsList(5);
		$keytimeList = $this->keytime->getKeytimeList(3,0);
		$schoolPictureNews = $this->news->getSchoolPictureNewsList("8",2);
		$data['rootSubjectList'] = $rootSubjectList;
		$data['pictureNews'] = $pictureNews;
		$data['keytimeList'] = $keytimeList;
		$data['schoolPictureNews'] = $schoolPictureNews;
		foreach ($rootSubjectList as $key => $subject) {
			# code...			
			$subList = $this->subject->getSubjectList(array('parentID'=> $subject['id']));
			$data['subjectList_'.$subject['id']]= $subList;
			foreach ($subList as $subListKey => $subListValue) {
				switch ($subListValue["flag"]) {
					case 2:
						$data['bindItem_'.$subListValue['id']] = $this->news->getNewestNews($subListValue['id'],1);
						break;
					case 1:
						$data['bindItem_'.$subListValue['id']] = $this->article->getArticle(array('subjectID'=> $subListValue['id']));
						break;
					case 0:
						# code...
						$data['bindItem_'.$subListValue['id']] = $this->subject->getSubjectList(array('parentID'=> $subListValue['id']));
						break;
				}
			}
		}
		$this->load->view('index',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */