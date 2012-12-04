<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users{
	var $CI;
	var $_user;
	var $_select = "cedula, usuario, nombres, apellidos, habilitado, id_tipo";
 	function __construct()
    {
		$this->CI =& get_instance();
		$this->_user = $this->CI->session->userdata('user');
    }
	function refresh()
	{
		$this->CI->db->select($this->_select);
		$this->CI->db->where('cedula', $this->_user['cedula']);
		$this->CI->db->limit(1);
		$query = $this->CI->db->get('usuario');
		$row = $query->row_array();
		//login ok
		if($query->num_rows()==1)
		{
			$this->_user=$row;
			$this->CI->session->set_userdata('user',$row);
			$this->CI->db->set('f_log','NOW()',false);
			$this->CI->db->set('ip',$_SERVER['REMOTE_ADDR']);
			$this->CI->db->where('cedula',$row['cedula']);
			$this->CI->db->update('usuario');
			return true;
		}else{
			$this->logout();
			return false;
		}
	}
	function login($user = "", $psw = "")
	{
		if(empty($user)||empty($psw))
			return array('login'=> FALSE,'msj'=> 'Faltan Datos por rellenar');

		$this->CI->db->select($this->_select);
		$this->CI->db->where('usuario', $user);
		$this->CI->db->where('pwd', sha1($psw));
		$this->CI->db->limit(1);
		$query = $this->CI->db->get('usuario');
		$row = $query->row_array();
		if($query->num_rows()==1 && $row['habilitado'] == 1)
		{
			$this->_user=$row;
			$this->CI->session->set_userdata('user',$row);
			$this->CI->db->set('f_log','NOW()',false);
			$this->CI->db->set('ip',$_SERVER['REMOTE_ADDR']);
			$this->CI->db->where('cedula',$row['cedula']);
			$this->CI->db->update('usuario');
			return array('login'=>true);
		}
		elseif($query->num_rows()==1 && $row['habilitado'] == 0 )
		{
			$this->logout();
			return array('msj'=>"Cuenta inhabilitada por el Administrador.",'login'=>false);
		}
		else
		{
			$this->logout();
			return array('msj'=>"Usuario o contrase&ntilde;a Invalida..",'login'=>false);
		}
	}
	function logout()
	{
		$this->CI->session->unset_userdata('user');
		$this->_user = false;
	}
	function menu_top()
	{
		$this->CI->db->select('titulo, url');
		$this->CI->db->where('menu', 1);
		$query = $this->CI->db->get('paginas');
		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}
	function menu()
	{
		if ($this->_auth==true)
		{
		  /*Niveles de administracion:

			0 	Super Administrador
			1 	Administrador
			2 	Vendedor
			3 	Empresa
			4 	Registrados*/
			switch($this->_tipo_usuario)
			{
				case 0:
				$menu=array(
					'Usuarios'=>array( 'link' => 'admin/vendedores', 'hijos' => array( 'Agregar Usuario' => 'admin/vendedores/add')),
					'Articulo'=>array( 'link' => 'admin/articulos', 'hijos' => array( 'Agregar Articulo' => 'admin/articulos/add')),
					'Servicios'=>array( 'link' => 'admin/publisnet/supervisor', 'hijos' => array( '&nbsp;' => ''))
				);
				break;
				case 1:
				$menu=array(
					'Vendedores'=>array( 'link' => 'admin/vendedores', 'hijos' => array( 'Agregar Vendedor' => 'admin/vendedores/add')),
					'Empresas'=>array( 'link' => 'admin/empresas/supervisor', 'hijos' => array( '&nbsp;' => '')),
					'Servicios'=>array( 'link' => 'admin/publisnet/supervisor', 'hijos' => array( '&nbsp;' => ''))
				);
				break;
				case 2:
				$menu=array(
					'Empresas'=>array( 'link' => 'admin/empresas', 'hijos' => array( 'Agregar Empresas' => 'admin/empresas/add')),
					'Servicios'=>array('link' => 'admin/publisnet', 'hijos' => array('Agregar Servicios' => 'admin/publisnet/add'))
				);
				break;
				case 3:
				$menu=array(
				);
				break;
				case 4:
				$menu=array(
				);
				break;
			}

			return $menu;
		}
	}
	function is_login()
    {
    	return ($this->_user !== false)? true : false;
    
    }
    function get_user()
	{
		return $this->_user;
	}
	function get_usuario()
	{
		return $this->_user['usuario'];
	}
	function get_nombre()
	{
		return $this->_user['nombre'];
	}
	function get_tipo()
	{
		return $this->_user['id_tipo'];
	}
}

?>
