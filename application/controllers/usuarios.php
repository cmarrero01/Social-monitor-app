<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	/**
	 * TwitterOauth class instance.
	 */
	private $connection;
	
	public function __construct(){
		parent::__construct();
        $this->load->model('user_model');
	}
	
	public function index()
	{
		$this->functions->checkUser();
        $data['users'] = $this->user_model->getUsers();
		$this->load->view('usuarios',$this->functions->navCheck($data));
	}

    /*
    *
    *
    * Muestra el formulario para agregar usuarios
    *
    */
    public function newUser($idUser=''){
        $this->functions->checkUser();

        if(!empty($idUser)){
            $data['users'] = $this->user_model->get_user($idUser);
        }else{
            $data['users'] = '';
        }

        $this->load->view('partials/users/new',$this->functions->navCheck($data));
    }

    /*
     * Funcion para agregar usuarios
     */
	public function addUser(){
        $this->functions->checkUser();

        $idAccount = $this->input->get_post('idAccount');
        $email = $this->input->get_post('email');
        $password = $this->input->get_post('password');
        $full_name = $this->input->get_post('full_name');
        $rpassword = $this->input->get_post('rpassword');

        $args = array(
            'email'=>$email,
            'password'=>md5($password),
            'full_name'=>$full_name,
            'idAccount'=>$idAccount
        );

        $newUser = $this->user_model->addNewUser($args);

        if($newUser){
            $data['msg'] = 'El usuario fue creado con exito';
            $data['class'] = 'success';
            $this->load->view('partials/users/new',$this->functions->navCheck($data));
        }else{
            $data['msg'] = 'Ops!, Tuvimos un problema al crear un usuario, por favor, intentelo nuevamente.';
            $data['class'] = 'error';
            $this->load->view('partials/users/new',$this->functions->navCheck($data));
        }
    }

    /*
     * Funcion para editar usuarios
     */
    public function editUser(){
        $this->functions->checkUser();

        $idAccount = $this->input->get_post('idAccount');
        $email = $this->input->get_post('email');

        $password = $this->input->get_post('password');
        $full_name = $this->input->get_post('full_name');
        $rpassword = $this->input->get_post('rpassword');

        $args = array();

        $args['email'] = $email;
        $args['full_name'] = $full_name;
        $args['idAccount'] = $idAccount;

        if(!empty($password)){
            $args['password'] = md5($password);
        }

        $newUser = $this->user_model->editUser($args);

        if($newUser){
            $data['msg'] = 'El usuario fue creado con exito';
            $data['class'] = 'success';
            $this->load->view('partials/users/new',$this->functions->navCheck($data));
        }else{
            $data['msg'] = 'Ops!, Tuvimos un problema al crear un usuario, por favor, intentelo nuevamente.';
            $data['class'] = 'error';
            $this->load->view('partials/users/new',$this->functions->navCheck($data));
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */