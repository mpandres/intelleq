<?php
class User extends Admin_Controller
{

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		// Fetch all users
		$this->data['admins'] = $this->user_m->get();
		$this->load->model('membership_model');
		$this->data['users'] = $this->membership_model->get();//$this->db->query('SELECT email_address FROM membership');

		$this->data['subview'] = 'admin/user/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit($id = NULL){
		//Fetch a user or set a new one
		if($id == 'user')
			redirect('admin/user');
		elseif($id == 'question')
			redirect('admin/question');
		elseif($id == 'reviewer')
			redirect('admin/reviewer');
		
		elseif ($id) {
			$this->data['user'] = $this->user_m->get($id);
			count($this->data['user']) || $this->data['errors'][] = 'User could not be found';
		}

		else 
			$this->data['user'] = $this->user_m->get_new();
		
		
		//Set up the form
		$rules = $this->user_m->rules_admin;
		$id || $rules['password']['rules'] .= '|required';
		$this->form_validation->set_rules($rules);
		
		//Process the form
		if($this->form_validation->run() == TRUE) {
			$data = $this->user_m->array_from_post(array('name', 'email', 'password'));
			$data['password'] = $this->user_m->hash($data['password']);
			$this->user_m->save($data, $id);
			redirect('admin/user');
		}
		
		//Load the view
		$this->data['subview'] = 'admin/user/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function delete($id){
		$this->user_m->delete($id);
		redirect('admin/user');
	}

	public function login(){
		// Redirect a user if he's already logged in
		$dashboard = 'admin/dashboard';
		$this->user_m->loggedin() == FALSE || redirect($dashboard);
		
		// Set form
		$rules = $this->user_m->rules;
		$this->form_validation->set_rules($rules);
		
		// Process form
		if ($this->form_validation->run() == TRUE) {
			// We can login and redirect
			if ($this->user_m->login() == TRUE) {
				redirect($dashboard);
			}
			else {
				$this->session->set_flashdata('error', 'That email/password combination does not exist');
				redirect('admin/user/login', 'refresh');
				//echo "invalid";
			}
		}
		
		// Load view
		else {
			$this->data['subview'] = 'admin/user/login';
			$this->load->view('admin/_layout_modal', $this->data);
		}
	}

	public function logout(){
		$this->user_m->logout();
		redirect('admin/user/login');
	}

	public function _unique_email($str){
		// Do NOT validate if email already exists
		// UNLESS it's the email for the current user
		
		$id = $this->uri->segment(4);
		$this->db->where('email', $this->input->post('email'));
		!$id || $this->db->where('id !=', $id);
		$user = $this->user_m->get();
		
		if (count($user)) {
			$this->form_validation->set_message('_unique_email', '%s should be unique');
			return FALSE;
		}
		
		return TRUE;
	}

	function search_admin(){
		$this->load->model('user_m');
		$name = $this->input->post('name');
		$this->data['admin'] = $this->user_m->search_admin($name);
		$this->data['subview'] = 'admin/user/search';
		$this->load->view('admin/_layout_main', $this->data);		
	}

	function search_member(){
		$this->load->model('user_m');
		$name = $this->input->post('name');
		$this->data['user'] = $this->user_m->search_member($name);
		$this->data['subview'] = 'admin/user/search_member';
		$this->load->view('admin/_layout_main', $this->data);		
	}

	function activate($id){
		$this->load->model('user_m');
		$this->user_m->activate($id);
		redirect('admin/user');
	}

	function deactivate($id){
		$this->load->model('user_m');
		$this->user_m->deactivate($id);
		redirect('admin/user');
	}

	function question(){
		redirect('admin/question');
	}

	function reviewer(){
		redirect('admin/reviewer');
	}
}