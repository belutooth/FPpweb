<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
	public function index(){
		$this->load->view('forum-index.php');
	}

	public function forumCat(){
		if(isset($_SESSION['username'])){
			$this->load->model('LoginModel');
			$data = array();
			$query = $this->HomeModel->getData();
			$data['posts'] = $query;
			$this->load->view('forum-forum.php',$data);
	     } else $this->load->view('forum-forum.php');		
	}
	
	public function forum(){
		if(isset($_SESSION['username'])){
			$this->load->model('LoginModel');
			$data = array();
			$query = $this->HomeModel->getData();
			$data['posts'] = $query;
			$this->load->view('forum-category.php',$data);
	     } else $this->load->view('forum-category.php');
	}

	public function thread(){
		if(isset($_SESSION['username'])){
			$this->load->model('LoginModel');
			$data = array();
			$query = $this->HomeModel->getData();
			$data['posts'] = $query;
			$this->load->view('forum-thread.php',$data);
	     } else $this->load->view('forum-thread.php');
	}

	public function profile($id){
		$this->data['posts']=$this->HomeModel->getProfileData($id);

		$this->load->view('forum-profile.php',$this->data);
	}

	public function stats($id){ 
		$this->data['posts']=$this->HomeModel->getProfileData($id);
		$this->load->view('profile-overview.php',$this->data);
	}

	public function komen(){
		
		$this->load->view('profile-komentar.php');
	}

	public function trit(){
		$this->load->view('profile-thread.php');
	}

	public function posting(){
		if(isset($_SESSION['username'])){
			$this->load->model('LoginModel');
			$data = array();
			$query = $this->HomeModel->getData();
			$data['posts'] = $query;
			$this->load->view('post-thread.php',$data);
	     } else $this->load->view('post-thread.php');
	}

	public function createThread(){
		$this->form_validation->set_rules('title','Judul','required');
		$this->form_validation->set_rules('content','Isi','required');
		if($this->form_validation->run() == false){
			$this->form_validation->set_message('Judul dan isi topik tidak boleh kosong');
			redirect('page/posting?s=gagal');
		} else {
			$title = $this->input->post('title');
			$tag = $this->input->post('tag');
			$content = $this->input->post('content');

			$this->load->model('ThreadModel');
			$this->ThreadModel->insert($title, $tag, $content);
		}
	}

	 function create()
    {
		 $pass=md5($this->input->post('pass'));
        $data = array(
					
					'user_username'=>$this->input->post('user'),
					  'user_name'=>$this->input->post('nama'),
					   'user_email'=>$this->input->post('email1'),
						'user_password'=>$pass);
        
		 
    $this->HomeModel->add_data($data);
        $this->forum();
    }
}