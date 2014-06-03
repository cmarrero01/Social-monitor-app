<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* <sumary>
* Controller de la cuenta del usuario, login, registro, acceso.
* </sumary>
**/
class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		// Loading twitter configuration.
		$this->config->load('twitter');

        $config = array(
            'appId'  => '182035988617376',
            'secret' => '58098ca808958f31f1f62dfef9089e72'
        );
        $this->load->library('facebook', $config);

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
	* // Show the login form
	* </sumary>
	**/
	public function show($step='')
	{
		if(!empty($step)){
			$data['step'] = $step;
		}else{
			$data['step'] = '1';
		}
		$this->load->view('login',$this->functions->navCheck($data));
	}

    /*
     * Accedindo  al sistema con twitter
     */
    public function twitterLogin(){
        // Making a request for request_token
        $request_token = $this->connection->getRequestToken(base_url('/login/callback'));

        $this->session->set_userdata('tw_request_token', $request_token['oauth_token']);
        $this->session->set_userdata('tw_request_token_secret', $request_token['oauth_token_secret']);

        if($this->connection->http_code == 200)
        {
            $url = $this->connection->getAuthorizeURL($request_token);
            redirect($url);
        }
        else
        {
            // An error occured. Make sure to put your error notification code here.
            redirect(base_url('/error/twitterError'));
        }
    }

    /**
     * Callback function, landing page for twitter.
     * @access	public
     * @return	void
     */
    public function callback()
    {
        if($this->input->get('oauth_token') && $this->session->userdata('tw_request_token') !== $this->input->get('oauth_token'))
        {
            $this->show(2);
        }
        else
        {
            $access_token = $this->connection->getAccessToken($this->input->get('oauth_verifier'));

            if ($this->connection->http_code == 200)
            {
                $this->session->set_userdata('tw_access_token', $access_token['oauth_token']);
                $this->session->set_userdata('tw_access_token_secret', $access_token['oauth_token_secret']);
                $this->session->set_userdata('twitter_user_id', $access_token['user_id']);
                $this->session->set_userdata('twitter_screen_name', $access_token['screen_name']);

                $this->session->unset_userdata('tw_request_token');
                $this->session->unset_userdata('tw_request_token_secret');
                $twitterUser = $this->twitteroauth->get('https://api.twitter.com/1.1/account/settings.json');
                $this->session->set_userdata('tw_user',$twitterUser);
                $this->show(2);
            }
            else
            {
                // An error occured. Add your notification code here.
                redirect(base_url('/error/twitterError/callback'));
            }
        }
    }

    /**
	* <sumary>
	* /// Access to the descktop sistem
	* </sumary>
	**/
	public function access($email='',$pass='')
	{
		$this->load->model('user_model');		

		if(empty($email)){
			$email = $this->input->post('email');
			$pass = $this->input->post('password');
		}
		
		$pass = md5($pass);
		
		$user = $this->user_model->login($email,$pass);
        $fa_user = $this->facebook->api('/me');
		if($user && $fa_user){

            $userdata = array(
				'idUser'=> $user->idUser,
				'email'=> $user->email,
				'password'=> $user->password,
				'full_name'=> $user->full_name,
				'idAccount'=> $user->idAccount,
                'fa_user'=>$fa_user
               );

			$this->session->set_userdata($userdata);
            redirect('/home');

		}else{
			$this->session->sess_destroy();
			$this->show();
		}

	}
	

	
	/**
	* <sumary>
	* // Log Out
	* </sumary>
	**/
	public function logout(){
		
		$this->session->unset_userdata('tw_access_token');
		$this->session->unset_userdata('tw_access_token_secret');
		$this->session->unset_userdata('tw_request_token');
		$this->session->unset_userdata('tw_request_token_secret');
		$this->session->unset_userdata('twitter_user_id');
		$this->session->unset_userdata('twitter_screen_name');
		
		$this->session->sess_destroy();
        $this->show();
	}
	
	/**
	* <sumary>
	* // Sesion destroy
	* </sumary>
	**/
	public function reset_session(){
		
		$this->session->unset_userdata('tw_access_token');
		$this->session->unset_userdata('tw_access_token_secret');
		$this->session->unset_userdata('tw_request_token');
		$this->session->unset_userdata('tw_request_token_secret');
		$this->session->unset_userdata('twitter_user_id');
		$this->session->unset_userdata('twitter_screen_name');
		$this->session->sess_destroy();
	}
	
	/**
	* <sumary>
	* //Verificamos que el mail no exista en la base de datos
	* </sumary>
	**/
	public function validateEmail($email=''){
		
		if(empty($email)){
			$email = $this->input->post('email');
		}
		
		if($validateEmail->result){
			echo 'true';
		}else{
			echo 'false';
		}
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */