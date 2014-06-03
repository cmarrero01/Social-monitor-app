<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filtros extends CI_Controller {

	/**
	 * TwitterOauth class instance.
	 */
	private $connection;
	
	public function __construct(){
		parent::__construct();
		// Loading TwitterOauth library. Delete this line if you choose autoload method.
		$this->load->library('twitteroauth');
        $config = array(
            'appId'  => '182035988617376',
            'secret' => '58098ca808958f31f1f62dfef9089e72'
        );
        $this->load->library('facebook', $config);
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
		$this->show();
	}
	
	/**
	* <sumary>
	* Muestra 1 o mas filtros segun el criterio
	* </sumary>
	**/
	public function show($idFiltro = ''){
		$this->functions->checkUser();

		$data['filtros'] = $this->filtro_model->get_filtros(array('idFiltro'=>$idFiltro));
		$this->load->view('filtros',$this->functions->navCheck($data));
	}
	
	/**
	* <sumary>
	* Muestra el formulario para agregar filtros
	* </sumary>
	**/
	public function add(){
		$this->functions->checkUser();
		
		$this->load->view('partials/filtros/filter_form',$this->functions->navCheck());
	}
	
	/**
	* <sumary>
	* Muestra el formulario para editar un filtro
	* </sumary>
	**/
	public function edit($idFiltro){
		$this->functions->checkUser();
		
		if(empty($idFiltro)){
			$idFiltro = $this->input->get('idFiltro');
		}
		
		$data['filtro'] = $this->filtro_model->get_filtros(array('idFiltro'=>$idFiltro));
		$this->load->view('partials/filtros/filter_form',$this->functions->navCheck($data));
	}
	
	/**
	* <sumary>
	* toma todos los elementos del formulario y los guarda en la base, y muestra el mismo formulario con un mensaje de alerta.
	* </sumary>
	**/
	public function save(){
		$this->functions->checkUser();
		
		$idFiltro = $this->input->post('idFiltro');
		$name = $this->input->post('name');
		$words = $this->input->post('words');
		$status = $this->input->post('status');
		$isAutomatic = $this->input->post('isAutomatic');
		$twMessage = $this->input->post('twMessage');
		$faceMessage = $this->input->post('faceMessage');
		$showInHome = $this->input->post('showInHome');
		
		$form = array(
			'idFiltro'=>$idFiltro,
			'name'=>$name,
			'words'=>$words,
			'status'=>$status,
			'isAutomatic'=>$isAutomatic,
			'twMessage'=>$twMessage,
			'faceMessage'=>$faceMessage,
			'showInHome'=>$showInHome,
			'idAccount'=>1//Este ID de cuenta, debe ser dinamico para el plan multicuenta
		);
		
		$save = $this->filtro_model->save_filtro($form);
		
		if($save){
			$data['alert'] = '<div class="alert alert-block alert-success">
								  <button type="button" class="close" data-dismiss="alert">&times;</button>
								  <h4>Todo Perfecto</h4>
								  Los datos del filtro han sido guardados correctamente.
							  </div>';
			$data['filtro'] = $this->filtro_model->get_filtros(array('idFiltro'=>$save));
		}else{
			$data['alert'] = '<div class="alert alert-block alert-error">
								  <button type="button" class="close" data-dismiss="alert">&times;</button>
								  <h4>Oops!</h4>
								  Tuvimos un problema al guardar los datos, intentelo nuevamente o mandenos un mail a soporte@unvil.com.ar, para que podamos resolver su problema.
							  </div>';
		}
		
				
		$this->load->view('partials/filtros/filter_form',$this->functions->navCheck($data));
	}
	
	/**
	* <sumary>
	* Elimina Filtros
	* </sumary>
	**/
	public function delete($idFiltro=''){
		$this->functions->checkUser();
		
		if(empty($idFiltro)){
			$idFiltro = $this->input->get('idFiltro');
		}
		
		$delete = $this->filtro_model->delete_filtro(array('idFiltro'=>$idFiltro));
		
		if($delete){
			$data['alert'] = '<div class="alert alert-block">
								  <button type="button" class="close" data-dismiss="alert">&times;</button>
								  <h4>Eliminado</h4>
								  El filtro fue eliminado correctamente.
							  </div>';
		}else{
			$data['alert'] = '<div class="alert alert-block alert-error">
								  <button type="button" class="close" data-dismiss="alert">&times;</button>
								  <h4>Oops!</h4>
								  Tuvimos un problema al eliminar los datos, intentelo nuevamente o mandenos un mail a soporte@unvil.com.ar, para que podamos resolver su problema.
							  </div>';
		}
		
		$data['filtros'] = $this->filtro_model->get_filtros();
		$this->load->view('filtros',$this->functions->navCheck($data));
	}
	
	/**
	* <sumary>
	* Muestra todos los twitts y posts del filtro seleccionado
	* </sumary>
	**/
	public function see($idFiltro = '', $options = array(),$response = false){

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
	
	/*
	*
	*
	*
	* Form for Answer to post or twitter
	*
	*/
	public function answerModal(){
        $data = $this->preparePost();
		$this->load->view('partials/filtros/answer',$data);
	}
	
	/*
	*
	*
	*
	* Form for Answer to post or twitter
	*
	*/
	public function retwittPost(){
        $data = $this->preparePost();
		$this->load->view('partials/filtros/retwitter',$data);
	}

    /*
     * Get all data for retwitt and share post and status.
     */
	private function preparePost(){

        $idRed = $this->input->get_post('idRed');
        $idPost  = $this->input->get_post('idPost');
        $idFiltro = $this->input->get_post('idFiltro');

        $filtro = $this->filtro_model->get_filtros(array('idFiltro'=>$idFiltro));
        $post = ($idRed==1)?$this->getTwitById($idPost):$this->getStatusById($idPost);

        $data = array(
            'idRed'=>$idRed,
            'idPost'=>$idPost,
            'filtro'=>$filtro,
            'post'=>$post
        );

        return $data;
    }

    /*
     * Get 1 only twit from twitter by id
     */
    private function getTwitById($idPost){
        $twitt =  $this->twitteroauth->get('https://api.twitter.com/1.1/statuses/show.json?id='.$idPost);
        if(!empty($twitt)){
            return $twitt;
        }else{
            return false;
        }
    }

    /*
     * Get 1 only post from facebook by id
     */
    private function getStatusById($idPost){
        $session =  $this->session->all_userdata();
        $idUser = $this->input->get_post('iduser');
        $user =  $this->facebook->api('/'.$idUser);
        if(!empty($user)){
            return $user;
        }else{
            return false;
        }
    }

    /*
     * Send message to network
     */
    public function sendMessage(){

        $idRed = $this->input->get_post('idRed');
        $idPost = $this->input->get_post('idPost');
        $message = $this->input->get_post('message');
        $is_answer = $this->input->get_post('is_answer');

        if($idRed==1){
            if($is_answer){
                $data = array(
                    'status' => $message,
                    'in_reply_to_status_id' => $idPost
                );
                $result = $this->twitteroauth->post('statuses/update', $data);
                echo json_encode($result);
            }else{
                $result = $this->twitteroauth->post('statuses/retweet/'.$idPost);
                echo json_encode($result);
            }
        }else{
            $msg_body = array(
                'message' => $message
            );
            $result = $this->facebook->api('/me/feed', 'post', $msg_body );
            echo json_encode($result);
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */