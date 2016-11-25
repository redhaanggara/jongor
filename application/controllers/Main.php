<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends CI_controller{
	public $model= NULL;
	public function __construct(){
		parent:: __construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('Person_model');
	}

	public function index(){
		$this->load->view('homeview');
	}

	public function login(){
        $btn=$_POST['btnlogin'];
	
		if($btn){
			$this->load->view('cbn');
		}
		else{
			$this->load->view('homeview');
		}

	}

	public function home_page(){
		redirect('http://ibgf.azurewebsites.net');
	}

	public function page_register(){
		 $this->load->view('register_view');
	}

}

?>
