<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Functions{
	/**
	 * TwitterOauth class instance.
	 */
	private $connection;
	
	function __construct(){
		$this->_ci = & get_instance();
		$this->_ci->load->model('notification_model');
		$this->_ci->load->model('filtro_model');
        $config = array(
            'appId'  => '182035988617376',
            'secret' => '58098ca808958f31f1f62dfef9089e72'
        );
        $this->_ci->load->library('facebook', $config);
	}
	
	/**
	* <sumary>
	* Check if user is loged
	* </sumary>
	**/
	public function checkUser(){
		
		$this->_ci->load->library('session');
		$userCheck = $this->_ci->session->userdata('email');

		if(!$userCheck or !$this->checkFacebookUser() or !$this->checkTwitterUser()){
			if($this->_ci->uri->segment(1) != 'login'){
				redirect('/login/','location');
			}
		}else{
			if($this->_ci->uri->segment(1) == 'login'){
				redirect('/home','location');
			}
			return true;
		}
	}

    /*
     * Check if user is login with facebook
     */
    public function checkFacebookUser(){
        $user = $this->_ci->facebook->getUser();
        if(!$user){
            $this->destroy_session();
            return false;
        }
        return true;
    }

    /*
     * Check if user is login with twitter
     */
    public function checkTwitterUser(){
        if($this->_ci->session->userdata('tw_access_token') && $this->_ci->session->userdata('tw_access_token_secret')){
            return true;
        }else{
            return false;
        }
    }

    /*
     * Destroy session
     */
    public function destroy_session(){
        $this->_ci->session->unset_userdata('tw_access_token');
        $this->_ci->session->unset_userdata('tw_access_token_secret');
        $this->_ci->session->unset_userdata('tw_request_token');
        $this->_ci->session->unset_userdata('tw_request_token_secret');
        $this->_ci->session->unset_userdata('twitter_user_id');
        $this->_ci->session->unset_userdata('twitter_screen_name');
        $this->_ci->session->sess_destroy();
    }
	/**
	* <sumary>
	* Check if user is loged and return true or false.
	* </sumary>
	**/
	public function checkUserView(){
		
		$this->_ci->load->library('session');
		$userCheck = $this->_ci->session->userdata('email');

		if(!$userCheck){
			return false;
		}else{
			return $this->_ci->session->all_userdata();
		}
	}
	
	/**
	* <sumary>
	* Parse XML to an jason objet.
	* </sumary>
	**/
	public function xmlToJsonToString($xml){
		
		$json = json_encode($xml);
		$string = json_decode($json);
		return $string;
	}
	
	/**
	* <sumary>
	* Verifca el tipo de navegacion para mostrar o no el header y footer
	* </sumary>
	**/
	public function navCheck($data = array()){
		
		$data['menu_filtros'] = $this->_ci->filtro_model->get_filtros();
		
		if(!isset($_GET['ajax'])){
			if($this->_ci->uri->segment(1) != 'login'){
				$views['menu'] = $this->_ci->load->view('partials/template/menu',$data,true);	
			}else{
				$views['menu'] = '';
			}
			$data['header'] = $this->_ci->load->view('partials/template/header',$views,true);
			$data['footer'] = $this->_ci->load->view('partials/template/footer',$views,true);
			
		}else{
			
			if($_GET['ajax'] != 'false'){
				$views['menu'] = '';
				$data['header'] = '';
				$data['footer'] = '';
			}else{
				$views['menu'] = $this->_ci->load->view('partials/template/menu',$data,true);
				$data['header'] = $this->_ci->load->view('partials/template/header',$views,true);
				$data['footer'] = $this->_ci->load->view('partials/template/footer',$views,true);
			}
		}
		
		return $data;
	}
	
	/**
	* <sumary>
	* Parsea una URL y toma lo que hay despues de la base url
	* </sumary>
	**/
	public function parseUrl($next){
		$next = explode('/',$next);
		if(isset($next[3])){
			return $next[3];
		}else{
			return '';
		}
	}
	
	/**
	* <sumary>
	* Si una cadena tiene mas de 280 caracteres, la corta y le agrega un link para ver mas
	* </sumary>
	**/
	public function stringLength($string){
		
		if(strlen($string) > 280){
			$string = substr($string, 0, 280);
			$string.= '... <a href="#" class="see-more">Ver mas</a>';
		}
		
		return $string;
	}
	
	/**
	  * Functions for merge
	  *
	  * @access     public
	  * @return     void
	**/
	public function merge($default, $options, $array=FALSE){
		if (is_array($options)) {
			  $settings = array_merge($default, $options);
		  } else {
			  parse_str($options, $output);
			  $settings = array_merge($default, $output);
		  }
  
		  return ($array) ? $settings : (Object) $settings;
	}
	
	/**
	  * Filters for twitter
	  *
	  * @access     public
	  * @return     array
	**/
	public function tw_filter($idFiltro = '', $options = array(),$response = false){
		// Reviso el usuario
		$this->checkUser();
		//Preseteo el idFiltro segun el primer criterio
		$default['idFiltro'] = $idFiltro;
		//Hago un merge con las opciones por defecto con las que vienen por argumento
		$set = $this->merge($default,$options);
		//Traigo el filtro segundo el criterio
		$filtro = $this->_ci->filtro_model->get_filtros(array('idFiltro'=>$set->idFiltro));

		//Armo la query para twitter
		$args['q'] = $filtro->words;
		$args['geocode'] = '19.447817,-99.122086,40mi';
		$args['result_type'] = 'mixed';
		$args['count'] = 10;
		
		//Si existe una consulta previa, tomo el ultimo ID consultado.
		$since_id = $this->_ci->input->get('since_id');
		
		//Si el ultimo id es verdadero, filtro los twitts para que comiencen desde este id
		if($since_id){
			$args['since_id'] = $since_id;
		}
		//Traigo de las notificaciones la URL del next
		$not = $this->_ci->notification_model->get_notifications(array('idFiltro'=>$set->idFiltro));
		//Si existen notifiaciones, traigo el next.
		if(!empty($not)){
			$args['since_id'] = $not->lastIdTwPost;
		}
		// Si estamos chequeando mensajes, tomamos el ultimo since id de las notificaciones
		if(isset($set->not) && !empty($set->not)){
			$args['since_id'] = $set->not;
		}
		//Llamo a todos los twitts con estos argumentos.
		$twitts = $this->_ci->twitteroauth->get('https://api.twitter.com/1.1/search/tweets.json',$args);
		//Asigno todo a un array
		$data['twitts'] = $twitts;
		//Tomo el ID mayor que tenga en la consulta
		if(isset($twitts->statuses)){
			foreach($twitts->statuses as $t){

                $screen_name = '@'.$t->user->screen_name;
                $message = $screen_name.' '.$filtro->twMessage;
                //$this->sendTwitt($t->id_str,$message);

				if($since_id < $t->id_str){
					$since_id = $t->id_str;
				}
			}
		}
		
		//Devuelvo los argumentos que se manejan en la consulta
		$data['argument'] = $filtro->words;
		//Devuelvo el ultimo id de twit encontrado.
		$data['since_id'] = $since_id;
		
		if(isset($set->resetNot) && $set->resetNot == 1){
			$this->resetNotifications(array('idFiltro'=>$set->idFiltro,'since_id'=>$since_id));
		}
		
		//Retorno el array de datos
		return $data;
	}
	
	/**
	  * Filters for Facebook
	  *
	  * @access     public
	  * @return     array
	**/
	public function fa_filter($idFiltro = '', $options = array(),$response = false){
		//Chequeo el usuario
		$this->checkUser();
		//Seteo por defecto el filtro con el primer argumento
		$default['idFiltro'] = $idFiltro;
		//Hago un merge de los valores por defecto, con el de las opciones que vienen por argumento
		$set = $this->merge($default,$options);
		//Traigo los datos de configuracion del filtro
		$filtro = $this->_ci->filtro_model->get_filtros(array('idFiltro'=>$set->idFiltro));
		// Si ya he consultado el filtro, tengo este valor para traer mas datos.
		$next = $this->_ci->input->get('next');
		
		$words = $this->parseWords($filtro->words,true);
		//Si next esta lleno, lo tomo como URL
		if($next){
			$until = explode('until=',$next);
			echo $until = $until[1];
			$args = array('q'=>$words,'type'=>'post','limit'=>'10','until'=>$until);
		}else{
			//Esta URL es la que llama la api de facebook
			$args = array('q'=>$words,'type'=>'post','limit'=>'10');
		}
		
		//Traigo de las notificaciones la URL del next
		$not = $this->_ci->notification_model->get_notifications(array('idFiltro'=>$set->idFiltro));
		//Si existen notifiaciones, traigo el next.
		if(!empty($not)){
			if($not->lastIdFaPost){
				$until = explode('until=',$not->lastIdFaPost);
				$until = $until[1];
				$args = array('q'=>$words,'type'=>'post','limit'=>'10','until'=>$until);
			}else{
				$args = array('q'=>$words,'type'=>'post','limit'=>'10');
			}
		}
		
		// Si estamos chequeando mensajes, tomamos el ultimo since id de las notificaciones
		if(isset($set->not) && !empty($set->not)){
			$until = explode('until=',$set->not);
			$until = $until[1];
			$args = array('q'=>$words,'type'=>'post','limit'=>'10','until'=>$until);
		}
		// Hago la llamada a facebook
		$posts = $this->_ci->facebook->api('search','GET',$args);
		// Parseo la url para que tomar todo menos la base que no la necesito.
		if(isset($posts['paging']['next']) && !empty($posts['paging']['next'])){
			$posts['paging']['next'] = $this->parseUrl($posts['paging']['next']);
		}else{
			$posts['paging']['next'] = '';
		}
		$posts['paging']['next'] = $this->parseUrl($posts['paging']['next']);
		
		if(isset($set->resetNot) && $set->resetNot == 1){
			$this->resetNotifications(array('idFiltro'=>$set->idFiltro,'lastIdFaPost'=>$posts['paging']['next']));
		}
		//Devuelvo todos los post
		return $posts;
	}
	
	/**
	  * Reseteamos el filtro, y ponemos el contador en 0
	  *
	  * @access     public
	  * @return     array
	**/
	public function resetNotifications($options=array()){
		
		//Preseteo el idFiltro segun el primer criterio
		$default['idFiltro'] = '';
		$default['since_id'] = '';
		$default['lastIdFaPost'] = '';
		
		//Hago un merge con las opciones por defecto con las que vienen por argumento
		$set = $this->merge($default,$options);
		
		//Notificaciones
		if(isset($set->not)){
			$not = $this->_ci->notification_model->get_notifications(array('idFiltro'=>$set->idFiltro,'not'=>1));
		}else{
			$not = $this->_ci->notification_model->get_notifications(array('idFiltro'=>$set->idFiltro));
		}
		
		$update = array();
		
		//If notificacions exists
		if(!empty($not)){
			$update['idPost'] = $not->idPost;
		}
		
		//Update Twiiter
		if(isset($set->since_id) && !empty($set->since_id)){
			$update['lastIdTwPost'] = $set->since_id;
		}
		
		//Update facebook
		if(isset($set->lastIdFaPost) && !empty($set->lastIdFaPost)){
			$update['lastIdFaPost'] = $set->lastIdFaPost;
		}
		
		$update['idFiltro'] = $set->idFiltro;
		
		if(isset($set->countMessages)){
			$update['countMessages'] = $set->countMessages;
		}else{
			$update['countMessages'] = 0;
		}
		
		if(isset($set->flag)){
			$update['flag'] = $set->flag;
		}else{
			$update['flag'] = 0;
		}
		
		
		//Guardamos las notifiaciones reseteadas.
		if(isset($set->not)){
			$save = $this->_ci->notification_model->save_not($update,true);
			$save = $this->_ci->notification_model->save_not($update);
		}else{
			$save = $this->_ci->notification_model->save_not($update);
			$not = $this->_ci->notification_model->get_notifications(array('idFiltro'=>$set->idFiltro,'not'=>1));
				//If notificacions exists
			if(!empty($not)){
				$update['idPost'] = $not->idPost;
			}
			$save = $this->_ci->notification_model->save_not($update,true);
			
		}
		return $save;
	}
	
	public function parseWords($words='',$red=true){
		
		$words = explode(' ',$words);
		
		if(is_array($words)){
			if($red){
				$words = implode('+|+',$words);
			}else{
				$words = implode('+OR+',$words);
			}
		}
		return $words;
	}

	/**
	  * Chequeamos si existen nuevos mensajes para twittrer y facebook por cada
	  * filtro cargado en el sistema
	  * @access     public
	  * @return     array
	**/
	public function checkMessages(){
		// Traigo todos los filtros
		$filtros = $this->_ci->filtro_model->get_filtros();
		//Si tengo filtros entro
		if(!empty($filtros)){
			//Recorro todos los filtros
			foreach($filtros as $filtro){
				//Traigo las notificaciones existentes
				$not = $this->_ci->notification_model->get_notifications(array('idFiltro'=>$filtro->idFiltro,'not'=>true));
				//Si existen notificaciones entro
				if(!empty($not)){
					//Armo las variables con los datos de las notificaciones
					$idNot = $not->idPost;
					$lastIdTwPost = $not->lastIdTwPost;
					$lastIdFaPost = $not->lastIdFaPost;
					$countMessages = $not->countMessages;
					$flag = $not->countMessages;
					
				}else{
					//Si no hay notificaciones, busco los ultimos datos que tenga de la consulta al filtro y armo las variables.
					$posts = $this->_ci->notification_model->get_notifications(array('idFiltro'=>$filtro->idFiltro));
					if(!empty($posts)){
						//Armos las variables de las notificaciones
						$idNot = '';
						$lastIdTwPost = $posts->lastIdTwPost;
						$lastIdFaPost = $posts->lastIdFaPost;
						$countMessages = $posts->countMessages;
						$flag = $posts->countMessages;
					}else{
						//Si no hay notifiaciones ni ultimo acceso al filtro, entonces dejo todo en blanco.
						$idNot = '';
						$lastIdTwPost = '';
						$lastIdFaPost = '';
						$countMessages = '';
						$flag = '';
					}
				}
				
				// hago la consulta a los filtros, segun lo que tenga en las notificaciones
				$messagesTw = $this->tw_filter($filtro->idFiltro,array('not'=>$lastIdTwPost));
				$messagesFa = $this->fa_filter($filtro->idFiltro,array('not'=>$lastIdFaPost));
				//Tomo los ultimos registros de los filtros
				$lastIdTwPost = $messagesTw['since_id'];
				$lastIdFaPost = $messagesFa['paging']['next'];
				
				// Cuento cuantos sin leer tengo
				$totalTwitts = 0;
				if(isset($messagesTw['twitts']->statuses)){
					$totalTwitts = count($messagesTw['twitts']->statuses);
				}
				
				// Cuento cuantos sin leer tengo
				$totalPosts = 0;
				if(isset($messagesFa['data'])){
					$totalPosts = count($messagesFa['data']);
				}

				$countMessages = $totalPosts+$totalTwitts+$countMessages;
				
				$update = array(
					'idFiltro'=>$filtro->idFiltro,
					'since_id'=>$lastIdTwPost,
					'lastIdFaPost'=>$lastIdFaPost,
					'countMessages'=>$countMessages,
					'flag'=>1,
					'not'=>1
				);
				
				$this->resetNotifications($update);
				
			}//End Foreach
		}//end if filtro
	}//End class

    /*
     * Send Messages to twitter
     */
    public function sendTwitt($in_reply_to='',$message)
    {

        $content = $this->_ci->twitteroauth->get('account/verify_credentials');
        $data = array(
            'status' => $message,
            'in_reply_to_status_id' => $in_reply_to
        );
        $result = $this->_ci->twitteroauth->post('statuses/update', $data);
    }

    /*
     * Set Date correctly
     */
    public function parseDate($date){
        $clean = explode('+',$date);
        return $clean[0];
    }
}
?>