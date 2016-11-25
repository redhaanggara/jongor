<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Pendaftar extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pendaftar_model');
	}

	public function index(){
		$this->load->view('black');
	}

	public function ajax_list(){
	
		$list = $this->Pendaftar_model->get_datatables();
		$data = array();
		$no = 1;
		foreach ($list as $person) {
			$row = array();
			$row[]= $person->id;
			$row[] = $no++;
			/*if($person->photo){
				$row[] = '<a href="'.base_url('upload/'.$person->photo).'" target="_blank"><img src="'.base_url('upload/'.$person->photo).'" class="img-responsive" /></a>';
			}
			else{
				$row[] = '(No photo)';
			}*/
			$row[] = $person->waktu;
			$row[] = $person->nama;
			$row[] = $person->gender;
			$row[] = $person->jurusan;
			$row[] = $person->angkatan;
			$row[] = $person->nohp;
			$row[] = $person->email;
			$row[] = $person->idline;
			$row[] = $person->hobi;
			$row[] = $person->prestasi;
			$row[] = $person->alamat;
			$row[] = $person->status;
			//$row[] = $person->prestasi;
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Pendaftar_model->count_all(),
						"recordsFiltered" => $this->Pendaftar_model->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->Pendaftar_model->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		
		$data = array(
			    'nama' => $this->input->post('nama'),
				'gender' => $this->input->post('gender'),
				'jurusan' => $this->input->post('jurusan'),
				'angkatan' => $this->input->post('gender'),
				'nohp' => $this->input->post('nohp'),
				'email' => $this->input->post('email'),
				'idline' => $this->input->post('idline'),
				'hobi' => $this->input->post('hobi'),
				'prestasi' => $this->input->post('prestasi'),
				'alamat' => $this->input->post('alamat'),
			);

		/*if(!empty($_FILES['photo']['name']))
		{
			$upload = $this->_do_upload();
			$data['photo'] = $upload;
		}*/

		$insert = $this->Pendaftar_model->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
			    'nama' => $this->input->post('nama'),
				'gender' => $this->input->post('gender'),
				'jurusan' => $this->input->post('jurusan'),
				'angkatan' => $this->input->post('gender'),
				'nohp' => $this->input->post('nohp'),
				'email' => $this->input->post('email'),
				'idline' => $this->input->post('idline'),
				'hobi' => $this->input->post('hobi'),
				'prestasi' => $this->input->post('prestasi'),
				'alamat' => $this->input->post('alamat'),
			);

		/*if($this->input->post('remove_photo')) // if remove photo checked
		{
			if(file_exists('upload/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
				unlink('upload/'.$this->input->post('remove_photo'));
			$data['photo'] = '';
		}

		if(!empty($_FILES['photo']['name']))
		{
			$upload = $this->_do_upload();
			
			//delete file
			$person = $this->Pendaftar->get_by_id($this->input->post('id'));
			if(file_exists('upload/'.$person->photo) && $person->photo)
				unlink('upload/'.$person->photo);

			$data['photo'] = $upload;
		}*/

		$this->Pendaftar_model->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		//delete file
		$person = $this->Pendaftar->get_by_id($id);
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
}

?>