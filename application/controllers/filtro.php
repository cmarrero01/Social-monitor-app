<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filtro extends CI_Controller {
	
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
		$this->show();
	}
	
	public function show($filtro = '',$response = false){
			
		// This call will always work since we are fetching public data.
		$next = $this->input->get('next');
		
		if($next){
			$posts = $this->facebook->api($next);
		}else{
			$posts = $this->facebook->api('search?q='.$filtro.'&type=post&center=24.086589,-102.502441&distance=1796&limit=10');
		}
		if(!empty($posts)){
			$posts['paging']['next'] = $this->functions->parseUrl($posts['paging']['next']);
		}else{
			$posts['paging']['next'] = '';
		}
		
		$data['facebook'] =  $posts;
		
		
		$args['q'] = $filtro;
		$args['geocode'] = '24.086589,-102.502441,1796mi';
		$args['result_type'] = 'mixed';
		$args['count'] = 10;

		$since_id = $this->input->get('since_id');
		
		if($since_id){
			$args['since_id'] = $since_id;
		}
		
		$twitts = $this->twitteroauth->get('https://api.twitter.com/1.1/search/tweets.json',$args);
			
		$data['filtro'] = $twitts;

		if(isset($twitts->statuses)){
			foreach($twitts->statuses as $t){
				if($since_id < $t->id_str){
					$since_id = $t->id_str;
				}
			}
		}
		
		$data['argument'] = $filtro;
		$data['since_id'] = $since_id;
		
		if(!$response){
			$data['filter_partial'] = $this->load->view('filter_partial',$this->functions->navCheck($data),true);
			$this->load->view('filtro',$data);
		}else{
			$this->load->view('filter_partial',$this->functions->navCheck($data));
		}
		
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */