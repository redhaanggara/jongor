<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person extends CI_Controller {

private $username; private $password; private $adm;

	public function __construct()
	{
		parent::__construct();
		require_once (APPPATH . 'third_party/dompdf/dompdf_config.inc.php');
		$this->load->model('person_model','person');
		$this->load->library(array('session','email'));
		//$this->load->library('email');
		$this->load->helper('url');
	}

	public function index()
	{
		
		$this->load->view('person_view');
	}

	public function ajax_list()
	{
	
		$list = $this->person->get_datatables();
		$data = array();
		$no = 1;
		foreach ($list as $person) {
			$row = array();
			$row[] = $no++;
			if($person->photo){
				$row[] = '<a href="'.base_url('upload/'.$person->photo).'" target="_blank"><img src="'.base_url('upload/'.$person->photo).'" class="img-responsive" /></a>';
			}
			else{
				$row[] = '(No photo)';
			}
			$row[] = $person->ibgf;
			$row[] = $person->firstName;
			$row[] = $person->lastName;
			$row[] = $person->gender;
			$row[] = $person->address;
			$row[] = $person->dob;
			$row[] = $person->handphone;
			$row[] = $person->email;
			$row[] = $person->title;
			$row[] = $person->posisi;
			$row[] = $person->jurusan;
			$row[] = $person->angkatan;
			$row[] = $person->prestasi;
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->person->count_all(),
						"recordsFiltered" => $this->person->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->person->get_by_id($id);
		$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		
		$data = array(
			    'ibgf' => $this->input->post('ibgf'),
				'firstName' => $this->input->post('firstName'),
				'lastName' => $this->input->post('lastName'),
				'gender' => $this->input->post('gender'),
				'address' => $this->input->post('address'),
				'dob' => $this->input->post('dob'),
				'handphone' => $this->input->post('nohp'),
				'email' => $this->input->post('email'),
				'title' => $this->input->post('gelar'),
				'posisi' => $this->input->post('posisi'),
				'jurusan' => $this->input->post('jurusan'),
				'angkatan' => $this->input->post('angkatan'),
				'prestasi' => $this->input->post('prestasi'),
			);

		if(!empty($_FILES['photo']['name']))
		{
			$upload = $this->_do_upload();
			$data['photo'] = $upload;
		}

		$insert = $this->person->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
			    'ibgf' => $this->input->post('ibgf'),
				'firstName' => $this->input->post('firstName'),
				'lastName' => $this->input->post('lastName'),
				'gender' => $this->input->post('gender'),
				'address' => $this->input->post('address'),
				'dob' => $this->input->post('dob'),
				'handphone' => $this->input->post('nohp'),
				'email' => $this->input->post('email'),
				'title' => $this->input->post('gelar'),
				'posisi' => $this->input->post('posisi'),
				'jurusan' => $this->input->post('jurusan'),
				'angkatan' => $this->input->post('angkatan'),
				'prestasi' => $this->input->post('prestasi'),
			);

		if($this->input->post('remove_photo')) // if remove photo checked
		{
			if(file_exists('upload/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
				unlink('upload/'.$this->input->post('remove_photo'));
			$data['photo'] = '';
		}

		if(!empty($_FILES['photo']['name']))
		{
			$upload = $this->_do_upload();
			
			//delete file
			$person = $this->person->get_by_id($this->input->post('id'));
			if(file_exists('upload/'.$person->photo) && $person->photo)
				unlink('upload/'.$person->photo);

			$data['photo'] = $upload;
		}

		$this->person->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		//delete file
		$person = $this->person->get_by_id($id);
		if(file_exists('upload/'.$person->photo) && $person->photo)
			unlink('upload/'.$person->photo);
		
		$this->person->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	private function _do_upload()
	{
		$config['upload_path']          = 'upload/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 5000; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('photo')) //upload and validate
        {
            $data['inputerror'][] = 'photo';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('firstName') == '')
		{
			$data['inputerror'][] = 'firstName';
			$data['error_string'][] = 'First name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('lastName') == '')
		{
			$data['inputerror'][] = 'lastName';
			$data['error_string'][] = 'Last name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('dob') == '')
		{
			$data['inputerror'][] = 'dob';
			$data['error_string'][] = 'Date of Birth is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('gender') == '')
		{
			$data['inputerror'][] = 'gender';
			$data['error_string'][] = 'Please select gender';
			$data['status'] = FALSE;
		}

		if($this->input->post('address') == '')
		{
			$data['inputerror'][] = 'address';
			$data['error_string'][] = 'Addess is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	public function signin(){
		$this->username= $_POST['username'];
		$this->password= $_POST['password'];

		$result= $this->person->login_admin($this->username,$this->password);
		if ($result == TRUE) {
			$this->session->set_userdata('admin', $this->username);

			$this->get_data_pendaftar();
		}
		else{
			$this->load->view('cbn');
		}
	}

	public function logout(){
		$this->session->unset_userdata('admin');
		$this->session->sess_destroy();
		redirect('http://ibgf.azurewebsites.net');

	}

	public function get_pendaftar(){
		$this->get_data_pendaftar();
	}

	public function get_data_pendaftar(){
		$result['posts']= $this->person->data_pendaftar();
		$this->load->view('window', $result);
	}

	public function insert_regis(){
		$hobiarray="";
		$prestasiarray="";
		$nama= $_POST['nama'];
		$gender= $_POST['gender'];
		$jurusan= $_POST['jurusan'];
		$angkatan= $_POST['angkatan'];
		$nohp= $_POST['nohp'];
		$email= $_POST['email'];
		$idline= $_POST['idline'];
		$hobi= $_POST['hobi'];
		foreach ($hobi as $dt) {
			$hobiarray= $hobiarray." ,".$dt;
		}
		$prestasi= $_POST['prestasi'];
		foreach ($prestasi as $dt) {
			$prestasiarray= $prestasiarray." ,".$dt;
		}
		$alamat= $_POST['alamat'];

		$data = array(
			    'nama' => $nama,
				'gender' => $gender,
				'jurusan' => $jurusan,
				'angkatan' => $angkatan,
				'nohp' => $nohp,
				'email' => $email,
				'idline' => $idline,
				'hobi' => $hobiarray,
				'prestasi' => $prestasiarray,
				'alamat' => $alamat,
			);
		$id= $this->person->insert_data_regis($data);
			
			if ($id !== 0) {
				$query['posts']= $this->person->data_cetak($id);
				$this->load->view('cetak',$query);
			}
	}

	public function create_pdf(){

		$id= $_GET['id'];
		//$nama $_GET['nama'];
		//$email= $_GET['email'];

		$data= $this->person->data_cetak($id);
		
		foreach ($data as $key) {
			$str = "<br><br><br><br><br><br><center>
					<h2> Profile Calon Regis PBGF 2017 </h2></center>";
			$str .= "<center>";
			$str .= "<table border=\"1\">";
			$str .= "<tr> <td>Nama</td> <td>Gender</td> <td>Jurusan</td> <td>Angkatan</td> <td>No. Handphone</td> <td>Email</td> <td>Id LINE</td> <td>Hobi</td> <td>Prestasi</td> <td>Alamat</td> </tr>";
			$str .= "<tr><td>".$key->nama."</td> <td>".$key->gender."</td> <td>".$key->jurusan."</td> <td>".$key->angkatan."</td> <td>".$key->nohp."</td> <td>".$key->email."</td> <td>".$key->idline."</td> <td>".$key->hobi."</td> <td>".$key->prestasi."</td> <td>".$key->alamat."</td></tr>";
			$str .= "</table>";
			$str .= "</center>";

	  		$dompdf = new DOMPDF();
			$dompdf->load_html($str);
			//dompdf->set_paper("A4");
			$dompdf->render();
			$canvas = $dompdf->get_canvas();
			$dompdf->stream("GoldenTicketPBGF2017.pdf");
		}
	}

	public function update_data_regis(){
		$id= $_GET['id'];
		$data['post']= $this->person->data_cetak($id);
		$this->load->view('register_update_view',$data);
	}

	public function update_insert_data(){
		$id= $_GET['id'];
		$nama= $_POST['nama'];
		$gender= $_POST['gender'];
		$jurusan= $_POST['jurusan'];
		$angkatan= $_POST['angkatan'];
		$nohp= $_POST['nohp'];
		$email= $_POST['email'];
		$idline= $_POST['idline'];
		$hobi= $_POST['hobi'];
		$prestasi= $_POST['prestasi'];
		$alamat= $_POST['alamat'];

		/*echo $id;
		echo $nama;
		echo $gender;
		echo $jurusan;
		echo $angkatan;
		echo $nohp;
		echo $email;
		echo $idline;
		echo $hobi;
		echo $prestasi;
		echo $alamat;*/

		$data = array(
			    'nama' => $nama,
				'gender' => $gender,
				'jurusan' => $jurusan,
				'angkatan' => $angkatan,
				'nohp' => $nohp,
				'email' => $email,
				'idline' => $idline,
				'hobi' => $hobi,
				'prestasi' => $prestasi,
				'alamat' => $alamat,
			);

		$query['posts']= $this->person->update_data_regis($id,$data);
		$this->load->view('cetak',$query);
	}

	public function admin_update_pendaftar(){
		$id= $_GET['id'];
		$data['post']= $this->person->data_cetak($id);
		$this->load->view('admin_update_pendaftar',$data);
	}

	public function admin_save_update(){
		$id= $_GET['id'];
		$nama= $_POST['nama'];
		$gender= $_POST['gender'];
		$jurusan= $_POST['jurusan'];
		$angkatan= $_POST['angkatan'];
		$nohp= $_POST['nohp'];
		$email= $_POST['email'];
		$idline= $_POST['idline'];
		$hobi= $_POST['hobi'];
		$prestasi= $_POST['prestasi'];
		$alamat= $_POST['alamat'];

		$data = array(
			    'nama' => $nama,
				'gender' => $gender,
				'jurusan' => $jurusan,
				'angkatan' => $angkatan,
				'nohp' => $nohp,
				'email' => $email,
				'idline' => $idline,
				'hobi' => $hobi,
				'prestasi' => $prestasi,
				'alamat' => $alamat,
			);
        
        $feedback= $this->person->admin_update_data_pendaftar($id,$data);

        if ($feedback==0) {
        	$this->get_data_pendaftar();
        }
        else{

        }

	}

	public function admin_delete_pendaftar(){
		$id= $_GET['id'];
		$this->person->admin_delete_pendaftar_mdl($id);
		$this->get_data_pendaftar();
	}

	public function send_email(){

		$id= $_GET['id'];
		$nama= $_GET['nama'];
		$email= $_GET['email'];

        $config = [
         'protocol'=> 'smtp',
         'smtp_host'=> 'smtp.mail.yahoo.com',
         'smtp_user'=> 'ibgffasilkom@yahoo.com',
         'smtp_pass'=> 'rizkyrendy2016',
         'smtp_port'=> '465',
         'smtp_crypto'=> 'ssl',
         'smtp_timeout'=> 180,
         'charset'=> 'iso-8859-1',
         'mailtype'=> 'html',
         'newline'=> "\r\n"];

		$this->email->initialize($config);

		$this->email->from('ibgffasilkom@yahoo.com','IBGF Fasilkom');
		$this->email->to($email);
	
		
		$this->email->subject("Your Golden Ticket");

		$message= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
			"http://www.w3.org/TR/xhtml1/DTD/xxhtml1-strict.dtd"><html><head>
			<meta http-equiv="Content-type" content="text/html"; charset="utf-8"/></head><body';

		$message .= '<p>Dear my friend, &nbsp '. $nama  .' </p>';
		$message .= 'Thanks for your participation On PBGF 2017 we so appreciate it, you can download your PDF file in this link<strong> <a target="_blank" href="http://ibgf.azurewebsites.net/index.php/person/create_pdf ?id=  '. $id .' &nama= '. $nama .' &email= '. $email .' "> Just Click </a></strong> after you download, Please print out and give it to our panitia';
		$message .= 'Thank you,';
		$message .= '<p>Enjoy my friend</p>';
		$message .= '</body></html>';
		
		$this->email->message($message);

		
		if($this->email->send()){
			$this->load->view('succes_send',['email'=>$email]);
		}
		else{
			show_error($this->email->print_debugger());
		}
	}

}
?>
