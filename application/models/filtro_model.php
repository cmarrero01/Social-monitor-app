<?php
/**
* <sumary>
* Modelo del usuario, represanta todas las acciones del usuario.
* </sumary>
**/

class Filtro_model extends CI_Model {

	function __construct()
	{
        // Call the Model constructor
		parent::__construct();
		$this->load->database();
	}

	/**
	* <sumary>
	* Trame todos los filtros o 1 dependendiendo del criterio de busqueda.
	* </sumary>
	**/
    public function get_filtros($options=array())
    {
		/*
		Para realizar multicuenta este proyecto, el ID account debera ser variable
		*/
		$default['idAccount'] = 1;
		$default['idFiltro'] = '';
		$set = $this->functions->merge($default,$options);
		
    	$this->db->from('sm_filtro');
		
		if($set->idFiltro)$this->db->where('idFiltro',$set->idFiltro);
		if(isset($set->showInHome))$this->db->where('showInHome',$set->showInHome);
		
    	$this->db->select('idFiltro,name,words,isAutomatic,twMessage,faceMessage,status,showInHome');

		//aca traeriramos el usuario y el pass para que corrensponde a ese $id
    	$result = (!empty($set->idFiltro))?$this->db->get()->row():$this->db->get()->result();

    	return $result;
    }
	
	/**
	* <sumary>
	* Guarando el filtro
	* </sumary>
	**/
	public function save_filtro($options=array()){
		$default = array();
		$set = $this->functions->merge($default,$options);
		
		if(isset($set->idFiltro) and !empty($set->idFiltro)){
			$result = $this->edit_filtro($options);
		}else{
			$result = $this->add_filtro($options);
		}
		
		return $result;
	}
	
	/**
	* <sumary>
	* Insertar filtro
	* </sumary>
	**/
	public function add_filtro($options=array()){
		$insert = $this->db->insert('sm_filtro',$options);
		
		if($insert){
			$result = $this->db->insert_id();
		}else{
			$result = false;
		}
		
		return $result;
	}
	
	/**
	* <sumary>
	* Editar filtro
	* </sumary>
	**/
	public function edit_filtro($options=array()){
		
		$update = $this->db->update('sm_filtro',$options,array('idFiltro'=>$options['idFiltro']));
		
		if($update){
			$result = $options['idFiltro'];
		}else{
			$result = false;
		}
		
		return $result;
	}
	
	/**
	* <sumary>
	*Elimina un filtro
	* </sumary>
	**/
	public function delete_filtro($options=array()){
		$default = array();
		$set = $this->functions->merge($default,$options);
		$delete = $this->db->delete('sm_filtro',array('idFiltro'=>$set->idFiltro));
		return $delete;
	}
	
}
?>