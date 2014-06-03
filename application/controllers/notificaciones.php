<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notificaciones extends CI_Controller {
	/**
	 * TwitterOauth class instance.
	 */
	private $connection;
	
	public function __construct(){
		parent::__construct();
		// Loading TwitterOauth library. Delete this line if you choose autoload method.
		$this->load->library('twitteroauth');
		// Loading twitter configuration.
		$this->config->load('twitter');
		// Loading model of filtros
		$this->load->model('filtro_model');
		//Loading notifications
		$this->load->model('notification_model');
		
		if($this->session->userdata('access_token') && $this->session->userdata('access_token_secret'))
		{
			// If user already logged in
			$this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->session->userdata('access_token'),  $this->session->userdata('access_token_secret'));
		}
		elseif($this->session->userdata('request_token') && $this->session->userdata('request_token_secret'))
		{
			// If user in process of authentication
			$this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->session->userdata('request_token'), $this->session->userdata('request_token_secret'));
		}
		else
		{
			// Unknown user
			$this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'));
		}
	}
	
	public function index()
	{
		$this->functions->checkUser();
		
	}
	
	public function messages()
	{
		$this->functions->checkUser();
		// Chequea si hay mas mensajes y los guarda en la base de datos
		$this->functions->checkMessages();
		/*
		* Pregunta cuantos mensajes hay sin leer para cada filtro
		*/
		$filtros = $this->filtro_model->get_filtros();
		$notifications['not'] = array();
		foreach($filtros as $filtro){
			$not = $this->notification_model->get_notifications(array('idFiltro'=>$filtro->idFiltro,'not'=>1));
			$notifications['not'][$filtro->idFiltro]['name'] = $filtro->name;
			$notifications['not'][$filtro->idFiltro]['messages'] = $not->countMessages;
		}
		
		echo json_encode($notifications);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */