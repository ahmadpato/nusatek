<?php
class User extends CI_Model {

	public function __construct(){
		$this->load->database();
	}

	public function list($param)
	{	
		if($param != ''){
			$this->db->like('id', $param['id'], 'both');
			$this->db->like('Firstname', $param['Firstname'], 'both');
			$this->db->like('Surname', $param['Surname'], 'both');
			$this->db->like('Username', $param['Username'], 'both');
			$this->db->like('Email', $param['Email'], 'both');
			$this->db->like('Nik', $param['Nik'], 'both');
			$this->db->like('Roles', $param['Roles'], 'both');
			$this->db->order_by('id','Desc');
			$this->db->limit('5', $param['Start']);
		}

		$this->db->where('Status','1');
		return $this->db->get('user');
	}

	public function listByParam($where)
	{
		$this->db->where($where);
		return $this->db->get('user');
	}

	public function save($body)
	{
		$data = array(
            'Firstname'         => $body['Firstname'],
            'Surname'           => $body['Surname'],
			'Username'         	=> $body['Username'],
			'password' 			=> password_hash($this->input->post('password'),PASSWORD_DEFAULT),
			'Email'         	=> $body['Email'],
            'Nik'           	=> $body['Nik'],
			'photo'           	=> $body['photo'],
			'Roles'           	=> $body['Roles'],
			'Status'           	=> '1',
		);
		
		return $this->db->insert('user', $data);
	}

	public function update($id, $body){
		
		$data = array(
            'firstname'         => $body['Firstname'],
            'Surname'           => $body['Surname'],
			'Username'         	=> $body['Username'],
			'password' 			=> password_hash($this->input->post('password'),PASSWORD_DEFAULT),
			'Email'         	=> $body['Email'],
            'Nik'           	=> $body['Nik'],
			'photo'           	=> $body['photo'],
			'Roles'           	=> $body['Roles'],
			'Status'           	=> '1',
		);
		
		$this->db->where($id);
		return $this->db->update('user', $data);
	}

	public function delete($where){

		$data = array(
			'Status'           	=> '0',
		);
		
		$this->db->where($where); 
		return $this->db->update('user', $data);
	}

	public function getRole($param)
	{	
		$this->db->select("id,roles");
        $this->db->from("user");
		$this->db->where($param);
		$query = $this->db->get();

		$data = $query->row_array();

		return $data;
	}
}

?>