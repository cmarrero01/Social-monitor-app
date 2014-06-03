<?php
/**
* <sumary>
* Modelo del usuario, represanta todas las acciones del usuario.
* </sumary>
**/

class configuration_model extends CI_Model {

	function __construct()
	{
        // Call the Model constructor
		parent::__construct();
		$this->load->database();
	}

	/*
	*
	* <sumary>
	* Guarda los datos de configuraciones en la base de datos
	* </sumary>
	*
	*/
    public function save($options)
    {	
		//Traigo las configuraciones actuales, para saber si editamos o insertamos.
		$conf = $this->get_configurations();
		
		// Eidtamos o guardamos las configuraciones de twitter
		if(!empty($conf['twitter'])){
			$twConf = $this->db->update('sm_tw_conf',$options['twitter'],array('idAccount'=>1));
		}else{
			$twConf = $this->db->insert('sm_tw_conf',$options['twitter']);
		}
		
		// Editamos o guardamos las configuraciones de facebook
		if(!empty($conf['facebook'])){
			$faConf = $this->db->update('sm_fa_conf',$options['facebook'],array('idAccount'=>1));
		}else{
			$faConf = $this->db->insert('sm_fa_conf',$options['facebook']);
		}
		
		if($twConf && $faConf){
			return true;
		}else{
			return false;
		}
    }

	/**
	* <sumary>
	* Trae todas las configuraciones
	* </sumary>
	**/
    public function get_configurations($options = array())
    {
		/*
		Para realizar multicuenta este proyecto, el ID account debera ser variable
		*/
		$default['idAccount'] = 1;
		$set = $this->functions->merge($default,$options);
		
		// Configuraciones
		$configurations = array();
		$configurations['twitter'] = $this->get_tw_conf(array('idAccount'=>$set->idAccount));
		$configurations['facebook'] = $this->get_fa_conf(array('idAccount'=>$set->idAccount));
		
		//Retorno las configuraciones en un solo array
    	return $configurations;

    }
	
	/**
	* <sumary>
	* Traemos las configuraciones de twitter
	* </sumary>
	**/
    public function get_tw_conf($options = array())
    {
		$default[] = '';
		
		$set = $this->functions->merge($default,$options);
		
		/*
		Traemos las configuraciones de twiiter
		*/
    	$this->db->from('sm_tw_conf');
    	$this->db->where('idAccount',$set->idAccount);
		//
    	$this->db->select('idOpt,consumer_key,consumer_secret,access_token,access_token_secret,username,password,username_company');

		//aca traeriramos el usuario y el pass para que corrensponde a ese $id
    	$result = $this->db->get()->row();

    	return $result;

    }
	
	/**
	* <sumary>
	* Traemos las configuraciones de facebook
	* </sumary>
	**/
    public function get_fa_conf($options = array())
    {
		$default[] = '';
		
		$set = $this->functions->merge($default,$options);
		
		/*
		Traemos las configuraciones de facebook
		*/
    	$this->db->from('sm_fa_conf');
    	$this->db->where('idAccount',$set->idAccount);
		//
    	$this->db->select('idOpt,api_key,api_secret,username,password,username_company');

		//aca traeriramos el usuario y el pass para que corrensponde a ese $id
    	$result = $this->db->get()->row();

    	return $result;

    }


}
?>