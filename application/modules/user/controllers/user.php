<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MX_Controller {
	function login()
	{
		if( $this->input->post('user')!= false && $this->input->post('psw') != false )
		{
			$login=$this->users->login($this->input->post('user'), $this->input->post('psw'));			
		}
		else
		{
			$login = array('msj'=>"Usuario o contrase&ntilde;a vacio.",'login'=>false);
		}
		echo json_encode($login);
	}
	function logout()
	{
		$this->users->logout();
		redirect('');
	}
}
