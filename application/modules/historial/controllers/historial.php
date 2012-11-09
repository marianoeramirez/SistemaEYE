<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Historial extends MX_Controller {
	var $namedb="historial";
	function __construct()
	{
		parent::__construct();
		$this->load->model('historial_model');
	}
	function index()
	{
		$this->load->view('header_view');
		$this->load->view('menu_view');
		$this->load->view('historial_view');
		$this->load->view('footer_view');
	}
	function ajax()
	{
		switch($this->input->post('oper'))
		{
			case 'add':
				$insert=elements(array('cedula','nombres','apellidos'),$_POST);
				$insert['id_tipo'] = $this->input->post('tipo');
				$this->historial_model->insertar($insert);
			break;
			case 'edit':
				if($this->input->post('id'))
				{
					$mod=elements(array('cedula','nombres','apellidos','sexo'),$_POST);
					$mod['id_tipo'] = $this->input->post('tipo');
					$this->historial_model->modificar($this->input->post('cedula'),$mod);
				}
			break;
			default:
			$post=array(
				'limit'=>$this->input->post('rows'),
				'page'=>$this->input->post('page'),
				'orderby'=>$this->input->post('sidx'),
				'orden'=>$this->input->post('sord'),
				'select'=>"usuario.cedula, {$this->namedb}.*"
			);
			if($this->input->post('_search'))
			{
				$search['like']=elements(array('fecha'),$this->input->post());
				$search['where']=elements(array('id_cliente','id'),$this->input->post());
				//var_dump($this->input->post());
			}else $search='';
			
			$count=$this->historial_model->count($search);
		
			if( $count >0 && $post['limit'] > 0) {
				$total_pages = ceil($count/$post['limit']);
				if ($post['page'] > $total_pages) $post['page']=$total_pages;
				$post['offset']=$post['limit']*$post['page'] - $post['limit'];
			} else {
				$total_pages = 0;
				$post['page']=0;
				$post['offset']=0;
			}
			
			$json->rows=$this->historial_model->listar($search,$post);
			$json->total=$total_pages;
			$json->page=$post['page'];
		
			$json->records=$count;
			echo json_encode($json);
			//echo $this->db->last_query();
			break;
		}
	}
}
