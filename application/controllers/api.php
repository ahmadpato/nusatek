<?php

class Api extends CI_Controller {

  public function response($code, $message, $response){
		$json = array(
			'code'          => $code,
			'message'       => $message,
			'status'       => 'success',
			'response' => $response
		);
		$this->output->set_status_header($code)
					->set_content_type('application/json')
					->set_output(json_encode($json));
	}

	public function index()
	{
		$this->response(200, 'hello', []);
	}

	public function __construct()
	{
	  parent::__construct();
	  $this->load->model('user', 'user');
	  $this->body = json_decode(file_get_contents('php://input'), true);
	}

	public function create()
	{
		$save = $this->user->save(($this->body));
		$this->response(200, 'create user', $save);
	}

	public function get()
	{
		$param = array(
			'id' => @$_GET['id'],
			'Firstname' => @$_GET['Firstname'],
			'Surname' => @$_GET['Surname'],
			'Username' => @$_GET['Username'],
			'Email' => @$_GET['Email'],
			'Nik' => @$_GET['Nik'],
			'Roles' => @$_GET['Roles'],
			'Start'  => (int) @$_GET['page']
		);

		$this->response(200, 'list user', $this->user->list($param)->result_array());
	}

	public function getDetail($id)
	{
		$param = array('id' => $id);
		$this->response(200, 'get data by id '.$id, $this->user->listByParam($param)->row_array());
	}

	public function update($id)
	{	
		$checkRole =  $this->checkRole($id);
		
		//if roles admin can update
		if($checkRole['roles'] == 'ADM'){
			
			$save = $this->user->update($id, ($this->body));
			$this->response(200, 'update user', $save);
		} else {
			$save = [];
			$this->response(400, 'failed update', $save);
		}
	}

	public function delete($id)
	{
		$param = array('id' => $id);
		$this->response(200, 'delete data by id '.$id, $this->user->delete($param));
	}

	private function checkRole($id)
	{
		$param = array('id' => $id);

		$data = $this->user->getRole($param);
		
		return $data;
	}
}
?>