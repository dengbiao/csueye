<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Downloadlist extends CI_Controller {



	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('text');
		$this->load->model('subject_model','subject');
		$this->load->model('article_model','article');
		$this->load->model('news_model','news');
		$this->load->model('document_model','document');
		$this->load->model('admin_model','admin');
	}

	public function index()
	{
		$doc_sub_id = end($this->uri->segment_array());
		$rootSubjectList = $this->subject->getSubjectList(array('rootID'=> '0'));
		$documentlist = $this->document->getDocumentListBySub($doc_sub_id,20,0);
		$currentSubject = $this->subject->getSubject(array('id'=> $doc_sub_id));
		$currentSlibingSubjects = $this->subject->getSubjectList(array('parentID'=> $currentSubject->parentID));
		
		$parentSubject = $this->subject->getSubject(array('id'=> $currentSubject->parentID));
		$data["parentSubject"] = $parentSubject;

		$data['rootSubjectList'] = $rootSubjectList;
		$data["documentlist"] = $documentlist;
		$data["currentSlibingSubjects"] = $currentSlibingSubjects;
		$data["currentSubject"] = $currentSubject;
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
		$this->load->view('downloadlist',$data);
	}


	public function view()
	{
		$doc_sub_id = end($this->uri->segment_array());
		$rootSubjectList = $this->subject->getSubjectList(array('rootID'=> '0'));
		$documentlist = $this->document->getDocumentListBySub($doc_sub_id,20,0);
		$currentSubject = $this->subject->getSubject(array('id'=> $doc_sub_id));
		$currentSlibingSubjects = $this->subject->getSubjectList(array('parentID'=> $currentSubject->parentID));
		
		$parentSubject = $this->subject->getSubject(array('id'=> $currentSubject->parentID));
		$data["parentSubject"] = $parentSubject;

		$data['rootSubjectList'] = $rootSubjectList;
		$data["documentlist"] = $documentlist;
		$data["currentSlibingSubjects"] = $currentSlibingSubjects;
		$data["currentSubject"] = $currentSubject;
		foreach ($rootSubjectList as $key => $subject) {
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
		$this->load->view('downloadlist',$data);
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */