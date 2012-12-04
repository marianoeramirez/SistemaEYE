<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos extends MX_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('productos_model');
	}
	function index()
	{
		$modelo=$this->productos_model->listas('modelo');
		$marca=$this->productos_model->listas('marca');
		$tipo=$this->productos_model->listas('tipo');
		$genero=$this->productos_model->listas('genero');
		if(is_array($modelo)){array_unshift($modelo,'');}
		if(is_array($marca)){array_unshift($marca,'');}
		if(is_array($tipo)){array_unshift($tipo,'');}
		if(is_array($genero)){array_unshift($genero,'');}
		$this->load->view('header_view');
		$this->load->view('menu_view');
		$this->load->view('productos_view',array('modelo'=>$modelo,'marca'=>$marca,'tipo'=>$tipo,'genero'=>$genero));
		$this->load->view('footer_view');
	}
	function ajax()
	{
		switch($this->input->post('oper'))
		{
			case 'add':
				$insert=elements(array('codigo','nombre','color','manufactura','precio'),$_POST);
				$insert['id_modelo'] = $this->input->post('modelo');
				$insert['id_marca'] = $this->input->post('marca');
				$insert['id_tipo'] = $this->input->post('tipo');
				$insert['id_genero'] = $this->input->post('genero');
				$this->productos_model->insertar($insert);
			break;
			case 'edit':
				if($this->input->post('id'))
				{
					$mod=elements(array('codigo','nombre','color','manufactura','precio'),$_POST);
					$mod['id_modelo'] = $this->input->post('modelo');
					$mod['id_marca'] = $this->input->post('marca');
					$mod['id_tipo'] = $this->input->post('tipo');
					$mod['id_genero'] = $this->input->post('genero');
					$this->productos_model->modificar($this->input->post('id'),$mod);
				}
			break;
			case 'del':
				if($this->input->post('id'))
				{
					$this->productos_model->borrar($this->input->post('id'));
				}
			break;
			default:
			$post=array(
				'limit'=>$this->input->post('rows'),
				'page'=>$this->input->post('page'),
				'orderby'=>$this->input->post('sidx'),
				'orden'=>$this->input->post('sord'),
				'select'=>'producto.id, producto.codigo, producto.nombre, producto_marca.marca, producto_modelo.modelo, producto_tipo.tipo, producto_genero.genero, precio, color, manufactura'
			);
			if($this->input->post('_search'))
			{
				$search['like']=elements(array('nombre','precio'),$this->input->post());
				$search['where']=elements(array('codigo','id_tipo','id_marca','id_modelo','id_genero'),$this->input->post());
			}else $search='';
			
			$count=$this->productos_model->count($search);
		
			if( $count >0 && $post['limit'] > 0) {
				$total_pages = ceil($count/$post['limit']);
				if ($post['page'] > $total_pages) $post['page']=$total_pages;
				$post['offset']=$post['limit']*$post['page'] - $post['limit'];
			} else {
				$total_pages = 0;
				$post['page']=0;
				$post['offset']=0;
			}
			
			$json->rows=$this->productos_model->listar($search,$post);
			$json->total=$total_pages;
			$json->page=$post['page'];
		
			$json->records=$count;
			echo json_encode($json);
			break;
		}
	}
}
