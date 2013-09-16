<?php
class Question extends User_Controller
{

	public function __construct () {
		parent::__construct();
	}

	public function index(){
		$this->load->model('ask');
		$this->ask->set_questions();
		$data['questions'] = $this->session->userdata('questions');
		$data['crand'] = $this->random_choice();

		if($this->ask->session_found() == FALSE){
			$data['qrand'] = $this->random_question();
			$data['answers'] = null;
		}

		else {
			$data['qrand'] = $this->session->userdata('sequence');
			$data['answers'] = $this->session->userdata('answers');
		}

		// Load view
		$data['firstname'] = $this->session->userdata('fname');
		$data['lastname'] = $this->session->userdata('lname');
		$data['main_content'] = 'questions';
		$this->load->view('members_area', $data);
	}

	function random_question(){
		$total = $this->ask->count_questions();
		$q_array = array();

		for($i = 0; $i < $total; $i++){
			$randomize = rand(0,$total-1);
		
			while(in_array($randomize,$q_array)){
				$randomize = rand(0,$total-1);
			}

			array_push($q_array,$randomize);			
			$q_array[$i] = $randomize;
		}

		$data = array(
			'sequence' => $q_array,
		);

		$this->session->set_userdata($data);
		return $q_array;
	}

	function random_choice(){
		$total = 4; 		//contant 4 choices
		$c_array = array();

		for($i = 0; $i < $total; $i++){
			$randomize = rand(0,$total-1);
		
			while(in_array($randomize,$c_array)){
				$randomize = rand(0,$total-1);
			}

			array_push($c_array,$randomize);							
			$c_array[$i] = $randomize;
		}

		return $c_array;
	}
}