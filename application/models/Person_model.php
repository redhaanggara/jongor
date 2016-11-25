<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person_model extends CI_Model {

	var $table = 'persons';
	var $column_order = array('firstName','lastName','gender','address','dob',null); //set column field database for datatable orderable
	var $column_search = array('firstName','lastName','address'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

	public function login_Admin($un,$pw){
        $this->db->select("*"); 
		$this->db->from("admin");
		$this->db->where("username=",$un);
		$this->db->where("password=",$pw);
		$this->db->limit(1);
		
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function data_pendaftar(){
		$this->db->select("*"); 
		$this->db->from("pendaftar");
		$query= $this->db->get();
		return $query->result();
	}

	public function insert_data_regis($data){
		$this->db->insert("pendaftar", $data);
		return $this->db->insert_id();
	}

	public function data_cetak($id){
		$this->db->select("*"); 
		$this->db->from("pendaftar");
		$this->db->where("id=",$id);
		$query= $this->db->get();
		return $query->result();
	}

	public function update_data_regis($id,$data){
		$this->db->where('id', $id);
        $this->db->update('pendaftar', $data);
        
       	return $this->data_cetak($id);
	}

	public function admin_update_data_pendaftar($id,$data){
		$this->db->where('id', $id);
        $this->db->update('pendaftar', $data);
        if ($this->db->affected_rows()) {
        	return 0;
        }
        else{
        	return 1;
        }
	}

	public function admin_delete_pendaftar_mdl($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('pendaftar');
	}


}

?>
