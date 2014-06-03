<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuraciones extends CI_Controller {
	/**
	 * TwitterOauth class instance.
	 */
	private $connection;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('configuration_model');
	}
	
	public function index()
	{
		$this->functions->checkUser();
		$data['conf'] = $this->configuration_model->get_configurations();
		
		$this->load->view('configuraciones',$this->functions->navCheck($data));
	}
	
	public function save(){
		
		
		$tw_username = $this->input->post('tw_username');
		$tw_consumer_key = $this->input->post('tw_consumer_key');
		$tw_consumer_secret = $this->input->post('tw_consumer_secret');
		$tw_access_token = $this->input->post('tw_access_token');
		$tw_access_token_secret = $this->input->post('tw_access_token_secret');
		$fa_username = $this->input->post('fa_username');
		$fa_password = $this->input->post('fa_password');
		$fa_api_key = $this->input->post('fa_api_key');
		$fa_api_secret = $this->input->post('fa_api_secret');
		$tw_username_company = $this->input->post('tw_username_company');
		$fa_username_company = $this->input->post('fa_username_company');
		
		$twitter = array(
			'consumer_key'=>$tw_consumer_key,
			'consumer_secret'=>$tw_consumer_secret,
			'access_token'=>$tw_access_token,
			'access_token_secret'=>$tw_access_token_secret,
			'username'=>$tw_username,
			'password'=>$tw_consumer_key,
			'idAccount'=>1,//El ID account debe ser dinamico, para crear el sistema multicuenta
			'username_company'=>$tw_username_company
		);
		
		$facebook = array(
			'api_key'=>$fa_api_key,
			'api_secret'=>$fa_api_secret,
			'username'=>$fa_username,
			'password'=>$fa_password,
			'idAccount'=>1,//El ID account debe ser dinamico, para crear el sistema multicuenta
			'username_company'=>$fa_username_company
		);
		
		$configurations = array();
		$configurations['twitter'] = $twitter;
		$configurations['facebook'] = $facebook;
		
		$conf = $this->configuration_model->save($configurations);
		
		if($conf){
			$data['alert'] = '<div class="alert alert-block alert-success">
								  <button type="button" class="close" data-dismiss="alert">&times;</button>
								  <h4>Todo Perfecto</h4>
								  Los datos de configuraciones han sido guardados correctamente.
							  </div>';
		}else{
			$data['alert'] = '<div class="alert alert-block alert-error">
								  <button type="button" class="close" data-dismiss="alert">&times;</button>
								  <h4>Oops!</h4>
								  Tuvimos un problema al guardar los datos, intentelo nuevamente o mandenos un mail a soporte@unvil.com.ar, para que podamos resolver su problema.
							  </div>';
		}
		
		$data['conf'] = $this->configuration_model->get_configurations();
		
		$this->load->view('configuraciones',$this->functions->navCheck($data));
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */