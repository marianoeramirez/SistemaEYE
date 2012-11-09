<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes extends MX_Controller {
	var $namedb="usuario";
	function __construct()
	{
		parent::__construct();
		$this->load->model('clientes_model');
	}
	function index()
	{
		$tipo=$this->clientes_model->listas('tipo');
		if(is_array($tipo)){array_unshift($tipo,'');}
		$this->load->view('header_view');
		$this->load->view('menu_view');
		$this->load->view('clientes_view',array('tipo'=>$tipo));
		$this->load->view('footer_view');
	}
	function ajax()
	{
		switch($this->input->post('oper'))
		{
			case 'add':
				$insert=elements(array('cedula','usuario','nombres','apellidos','sexo','email','f_nacimiento','tele_local','tele_celular'),$_POST);
				$insert['id_tipo'] = $this->input->post('tipo');
				$insert['pwd'] = sha1($this->input->post('pwd'));
				$this->clientes_model->insertar($insert);
			break;
			case 'edit':
				if($this->input->post('id'))
				{
					$mod=elements(array('cedula','usuario','nombres','apellidos','sexo','email','f_nacimiento','tele_local','tele_celular'),$_POST);
					$mod['id_tipo'] = $this->input->post('tipo');
					$mod['pwd'] = sha1($this->input->post('psw'));
					$this->clientes_model->modificar($this->input->post('cedula'),$mod);
				}
			break;
			case 'del':
				if($this->input->post('id'))
				{
					$this->clientes_model->borrar($this->input->post('id'));
				}
			break;
			default:
			$post=array(
				'limit'=>$this->input->post('rows'),
				'page'=>$this->input->post('page'),
				'orderby'=>$this->input->post('sidx'),
				'orden'=>$this->input->post('sord'),
				'select'=>"{$this->namedb}.cedula, {$this->namedb}.usuario, {$this->namedb}.nombres, {$this->namedb}_tipo.tipo, {$this->namedb}.*"
			);
			if($this->input->post('_search'))
			{
				$search['like']=elements(array('nombres','usuario','apellidos'),$this->input->post());
				$search['where']=elements(array('cedula','id_tipo'),$this->input->post());
				//var_dump($this->input->post());
			}else $search='';
			
			$count=$this->clientes_model->count($search);
		
			if( $count >0 && $post['limit'] > 0) {
				$total_pages = ceil($count/$post['limit']);
				if ($post['page'] > $total_pages) $post['page']=$total_pages;
				$post['offset']=$post['limit']*$post['page'] - $post['limit'];
			} else {
				$total_pages = 0;
				$post['page']=0;
				$post['offset']=0;
			}
			
			$json->rows=$this->clientes_model->listar($search,$post);
			$json->total=$total_pages;
			$json->page=$post['page'];
		
			$json->records=$count;
			echo json_encode($json);
			//echo $this->db->last_query();
			break;
		}
	}
}
