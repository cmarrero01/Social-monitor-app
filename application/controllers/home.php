<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	/**
	 * TwitterOauth class instance.
	 */
	private $connection;
	
	/**
	 * Controller constructor
	 */
	function __construct()
	{
		parent::__construct();
		// Loading TwitterOauth library. Delete this line if you choose autoload method.
		$this->load->library('twitteroauth');
		// Loading twitter configuration.
		$this->config->load('twitter');
		// Loading model of filtros
		$this->load->model('filtro_model');

        if($this->session->userdata('tw_access_token') && $this->session->userdata('tw_access_token_secret'))
        {
            // If user already logged in
            $this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->session->userdata('tw_access_token'),  $this->session->userdata('tw_access_token_secret'));
        }
        elseif($this->session->userdata('tw_request_token') && $this->session->userdata('tw_request_token_secret'))
        {
            // If user in process of authentication
            $this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->session->userdata('tw_request_token'), $this->session->userdata('tw_request_token_secret'));
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
		// Traemos el filtro que este seteado para mostrarse en el home
		$filtros = $this->filtro_model->get_filtros(array('showInHome'=>1));
		if(!empty($filtros)){
			// Llamamos al filtro con el filtro seleccionado.
			$this->show($filtros[0]->idFiltro);
		}else{
			$data = array();
			$this->load->view('no-filters',$this->functions->navCheck($data));
		}
	}
	
	public function show($idFiltro = '', $options=array(),$response = false){
		$this->functions->checkUser();

		$options['resetNot'] = '1';
		$data = $this->functions->tw_filter($idFiltro, $options,$response);
		$data['posts'] = $this->functions->fa_filter($idFiltro, $options,$response);
        $data['idFiltro'] = $idFiltro;
        $data['filtro'] = $this->filtro_model->get_filtros(array('idFiltro'=>$idFiltro));

		if(!$response){
			$data['filter_partial'] = $this->load->view('partials/filtros/filter_partial',$this->functions->navCheck($data),true);
			$this->load->view('partials/filtros/filtro',$this->functions->navCheck($data));
		}else{
			$this->load->view('partials/filtros/filter_partial',$this->functions->navCheck($data));
		}
	}
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */