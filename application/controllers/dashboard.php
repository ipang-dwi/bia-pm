<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}
	
	public function index(){
		if($this->session->userdata('logged_in')!=""){
			$this->session->set_userdata('option','');
			$this->load->view('milestone');
		}
		else
			header('location:'.base_url().'');
	}
	
	public function task(){
		if($this->session->userdata('logged_in')!=""){
			$this->session->set_userdata('option','task');
			$crud = new grocery_CRUD();
			$crud->set_table('task');
			$crud->set_subject('Task');
			if($this->session->userdata('jt')=='client'){
				$crud->unset_add();	
				$crud->unset_edit();
				$crud->unset_delete();
			}
			$crud->set_relation('id_project','project','project')
				 ->set_relation('id_type','type','type')
				 ->set_relation('id_part','part','part')
				 ->set_relation('id_status','status','status');
			$crud->display_as('id_project','Project')
				 ->display_as('id_part','Part')
				 ->display_as('id_type','Type')
				 ->display_as('id_status','Status');
			$crud->required_fields('id_project','task','id_part','id_type','id_status');
			$output = $crud->render();

			$this->_example_output($output);
		}
		else
			header('location:'.base_url().'');
	}
	
	public function project_task($aero = ''){
		if($this->session->userdata('logged_in')!=""){
			$crud = new grocery_CRUD();
			$crud->set_table('task');
			$crud->set_subject('Task');
			if($this->session->userdata('jt')=='client'){
				$crud->unset_add();	
				$crud->unset_edit();
				$crud->unset_delete();
				//$crud->where('id_user',$apem);
			}
			if($aero != ''){
				$aero = str_replace("%20", " ", $aero);
				$crud->where('project',$aero);
				$this->session->set_userdata('option','task '.$aero );
			}
			$crud->set_relation('id_project','project','project')
				 ->set_relation('id_type','type','type')
				 ->set_relation('id_part','part','part')
				 ->set_relation('id_status','status','status');
			$crud->display_as('id_project','Project')
				 ->display_as('id_part','Part')
				 ->display_as('id_type','Type')
				 ->display_as('id_status','Status');
			$crud->required_fields('id_project','task','id_part','id_type','id_status');
			$output = $crud->render();

			$this->_example_output($output);
		}
		else
			header('location:'.base_url().'');
	}
	
	public function project(){
		if($this->session->userdata('logged_in')!=""){
			$this->session->set_userdata('option','project');
			$crud = new grocery_CRUD();
			$crud->set_table('project');
			$crud->set_subject('Project');
			$apem = $this->session->userdata('id_user');
			if($this->session->userdata('jt')=='client'){
				$crud->unset_add();	
				$crud->unset_edit();
				$crud->unset_delete();
				//$crud->where('id_user',$apem);
			}
			$crud->set_relation('id_user','user','username');
			$crud->display_as('id_user','Owner');
			$crud->required_fields('project');
			$output = $crud->render();

			$this->_example_output($output);
		}
		else
			header('location:'.base_url().'');
	}
	
	public function type(){
		if($this->session->userdata('logged_in')!=""){
			$this->session->set_userdata('option','type');
			$crud = new grocery_CRUD();
			$crud->set_table('type');
			$crud->set_subject('Type');
			$crud->required_fields('type');
			$output = $crud->render();

			$this->_example_output($output);
		}
		else
			header('location:'.base_url().'');
	}
	
	public function part(){
		if($this->session->userdata('logged_in')!=""){
			$this->session->set_userdata('option','part');
			$crud = new grocery_CRUD();
			$crud->set_table('part');
			$crud->set_subject('Part');
			$crud->required_fields('part');
			$output = $crud->render();

			$this->_example_output($output);
		}
		else
			header('location:'.base_url().'');
	}
	
	public function user(){
		if($this->session->userdata('logged_in')!=""){
			$this->session->set_userdata('option','user');
			$crud = new grocery_CRUD();
			$crud->set_table('user');
			$crud->display_as('job_title','Job Title');
			$crud->set_subject('User');
			$crud->required_fields('username','password','pic');
			$crud->set_field_upload('pic','assets/uploads/pics');
			$output = $crud->render();

			$this->_example_output($output);
		}
		else
			header('location:'.base_url().'');
	}
	
	public function profile(){
		if($this->session->userdata('logged_in')!=""){
			$this->session->set_userdata('option','profile');
			$crud = new grocery_CRUD();
			$crud->set_table('user');
			$crud->unset_add()
				 ->unset_delete()
				 ->unset_print()
				 ->unset_export();
			if($this->session->userdata('jt')=='client')
				$crud->unset_edit();		 
			$crud->where('username',$this->session->userdata('username'));
			$crud->display_as('job_title','Job Title');
			$crud->set_subject('User');
			$crud->required_fields('username','password','pic');
			$crud->set_field_upload('pic','assets/uploads/pics');
			$output = $crud->render();

			$this->_example_output($output);
		}
		else
			header('location:'.base_url().'');
	}
	
	public function status(){
		if($this->session->userdata('logged_in')!=""){
			$this->session->set_userdata('option','status');
			$crud = new grocery_CRUD();
			$crud->set_table('status');
			$crud->set_subject('Status');
			$crud->required_fields('status');
			$output = $crud->render();

			$this->_example_output($output);
		}
		else
			header('location:'.base_url().'');
	}
	
	public function _example_output($output = null)
	{
		$this->load->view('lte.php',$output);
	}
	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */