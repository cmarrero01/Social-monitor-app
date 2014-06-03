<?php
/**
* <sumary>
* Modelo del usuario, represanta todas las acciones del usuario.
* </sumary>
**/

class User_model extends CI_Model {

	function __construct()
	{
        // Call the Model constructor
		parent::__construct();
		$this->load->database();
	}

	/**
	* <sumary>
	* 	Consulta a la base de datos por el usuario con email y passowrd.
	* </sumary>
	**/
    public function login($email,$password)
    {

    	$this->db->from('sm_user');
    	$this->db->where('email',$email);
    	$this->db->where('password',$password);
    	$this->db->select('idUser,email,password,full_name,idAccount');

		//aca traeriramos el usuario y el pass para que corrensponde a ese $id
    	$result = $this->db->get()->row();

    	return $result;

    }

	/**
	* <sumary>
	* 
	* </sumary>
	**/
	//Vericar si el email de registro ya esta registro
	public function exist_email($email)		// corroboramos que si exite el email esta registrado
	{
		$query = $this->db->get_where('sm_user',array('email' => $email));
		if ($query->num_rows() > 0)
		{
		   $existNoEmail = false;		// el email existe
		}
		else
		{
			$existNoEmail = true;		//el email no esta registrado por lo que podemos registrar al usuario
		}
		
		return $existNoEmail;
	}
	
	/**
	* <sumary>
	* 
	* </sumary>
	**/
	//guardamos los datos de registro en la BD
	public function register_user($email, $password, $favoriteGame,$date)
	{
		$password = md5($password);
		$data = array(
			'email' => $email ,
			'password' => $password
			);

		$query = $this->db->insert('sm_user',$data);
		return true;
	}
	
	/**
	* <sumary>
	* 	//Trae todos los datos del usuarios
	* </sumary>
	**/
	public function get_user($idUser)
	{
		$query = $this->db->get_where('sm_user',array('idUser' => $idUser));
		if ($query->num_rows() > 0)
		{
		   $userData = $query->result();		// guardo los resultados
		}
		else
		{
			$userData = false;		//el usuario no existe por lo que devuelvo false
		}
		
		return $userData;
	}

    /*
     * Get All Users
     *
     */
    public function getUsers($options=array())
    {
        $this->db->from('sm_user');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $userData = $query->result();		// guardo los resultados
        }
        else
        {
            $userData = false;		//el usuario no existe por lo que devuelvo false
        }

        return $userData;
    }

    /*
     * Agrega un usuario a la base de datos
     */
    public function addNewUser($options=array()){
        $insert = $this->db->insert('sm_user',$options);
        return $insert;
    }

}
?>