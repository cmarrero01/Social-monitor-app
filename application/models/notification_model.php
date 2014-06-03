<?php
class Notification_model extends CI_Model {

	function __construct()
	{
        // Call the Model constructor
		parent::__construct();
		$this->load->database();
	}

	/**
	* <sumary>
	* Trae las notificaciones si es que existen de cada filtro.
	* </sumary>
	**/
    public function get_notifications($options=array())
    {
		$default['idFiltro'] = '';
		$default['flag'] = '';
		$default['idPost'] = '';
		$set = $this->functions->merge($default,$options);
		
		if(isset($set->not)){
    		$this->db->from('sm_tw_fa_not');
		}else{
			$this->db->from('sm_tw_fa_posts');
		}
		
		if($set->idFiltro)$this->db->where('idFiltro',$set->idFiltro);
		if($set->flag)$this->db->where('flag',$set->flag);
		if($set->idPost)$this->db->where('idPost',$set->idPost);
		
    	$this->db->select('idPost,lastIdTwPost,lastIdFaPost,idFiltro,flag,countMessages');

    	$result = (!empty($set->idFiltro))?$this->db->get()->row():$this->db->get()->result();

    	return $result;
    }
	
	/**
	* <sumary>
	* Guarando el filtro
	* </sumary>
	**/
	public function save_not($options=array(),$not=false){
		$default = array();
		$set = $this->functions->merge($default,$options);
		
		if(isset($set->idPost) and !empty($set->idPost)){
			$result = $this->edit_not($options,$not);
		}else{
			$result = $this->add_not($options,$not);
		}
		
		return $result;
	}
	
	/**
	* <sumary>
	* Insertar notificacion si no existe aun
	* </sumary>
	**/
	public function add_not($options=array(),$not = false){
		
		if($not){
			$insert = $this->db->insert('sm_tw_fa_not',$options);
		}else{
			$insert = $this->db->insert('sm_tw_fa_posts',$options);
		}
		
		if($insert){
			$result = $this->db->insert_id();
		}else{
			$result = false;
		}
		
		return $result;
	}
	
	/**
	* <sumary>
	* Editar mensajes
	* </sumary>
	**/
	public function edit_not($options=array(),$not = false){
		$default['idPost'] = '';
		$set = $this->functions->merge($default,$options);
		
		if($not){
			$update = $this->db->update('sm_tw_fa_not',$options,array('idPost'=>$set->idPost));
		}else{
			$update = $this->db->update('sm_tw_fa_posts',$options,array('idPost'=>$set->idPost));
		}
		
		if($update){
			$result = $options['idFiltro'];
		}else{
			$result = false;
		}
		
		return $result;
	}
	
}
?>