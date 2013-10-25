
<?php
class Score extends User_Controller {

	public function __construct () {
		parent::__construct();

		$this->load->model('ask');
		$this->load->model('score_m');
		$this->load->model('review_m');
	}

	function index() {
		for($i = 1; $i <= $this->ask->count_questions(); $i++) {
			if ($i<10) $answer = "answer0".$i; //FIXED
			else $answer = "answer".$i;
			$$answer = $this->input->post($answer);
			$input[$i] = $$answer;
		}

		if($this->input->post('submit') == "Yes") {
			$data['firstname'] = $this->session->userdata('fname');
			$data['lastname'] = $this->session->userdata('lname');
			$data['subject'] = $this->session->userdata('subject');

			if (strcmp($this->session->userdata('subject'),$this->ask->get_last_fin())!=0) {
				$data['score'] = $this->score_m->compute($input);
				$data['total'] = $this->ask->count_questions();

				$this->session->set_userdata('timeCheck', TRUE);
				$this->session->set_userdata('startExam', FALSE);
				
				// START TOFF NOTES: get latest scores for display
				if(strcmp($data['subject'], "reading_comprehension") == 0) {
					$score_array = array();
					$science = $this->score_m->get_scores("science");
					$mathematics = $this->score_m->get_scores("mathematics");
					$english = $this->score_m->get_scores("english");
					$reading_comprehension = $this->score_m->get_scores("reading_comprehension");

					$score_array[0] = $science[count($science)-1];
					$score_array[1] = $mathematics[count($mathematics)-1];
					$score_array[2] = $english[count($english)-1];
					$score_array[3] = $reading_comprehension[count($reading_comprehension)-1];

	         		$data['score'] = $score_array;
	         		$data['correct'] = array_sum($score_array);
			        $data['omits'] = $this->review_m->get_omits();
					$data['main_content'] = 'score';
				}
				// END TOFF NOTES
				
				else{
					$data['start'] = $this->ask->check_last_fin();
					$data['last_fin'] = $this->ask->get_last_fin();
					$data['main_content'] = 'transition';
				}
				$data['error_exist'] = FALSE;
			}

			else {
				
				if(strcmp($data['subject'], "reading_comprehension") == 0) {
					$score_array = array();
					$science = $this->score_m->get_scores("science");
					$mathematics = $this->score_m->get_scores("mathematics");
					$english = $this->score_m->get_scores("english");
					$reading_comprehension = $this->score_m->get_scores("reading_comprehension");

					$score_array[0] = $science[count($science)-1];
					$score_array[1] = $mathematics[count($mathematics)-1];
					$score_array[2] = $english[count($english)-1];
					$score_array[3] = $reading_comprehension[count($reading_comprehension)-1];

	         		$data['score'] = $score_array;
	         		$data['correct'] = array_sum($score_array);
			        $data['omits'] = $this->review_m->get_omits();
			        $data['main_content'] = 'score';
				}

				else {
					$data['start'] = $this->ask->check_last_fin();
					$data['last_fin'] = $this->ask->get_last_fin();
					$data['main_content'] = 'transition';					
				}

				$data['error_exist'] = TRUE;
			}

			$this->load->view('members_area', $data);
		}

		elseif ($this->input->post('pause') == "Save and Exit") {
			$this->ask->pause($input, $this->input->post('pseudotime'));
			redirect('site');
		}

		else
			redirect('site');
	}

	function checkState(){
		$this->session->set_userdata('startExam', FALSE);
	}

}