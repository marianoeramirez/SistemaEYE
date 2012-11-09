<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facturacion extends MX_Controller {
	var $namedb="pedido";
	function __construct()
	{
		parent::__construct();
		$this->load->model('facturacion_model');
	}
	function index()
	{
		$status=$this->facturacion_model->listas('status');
		if(is_array($status)){array_unshift($status,'');}
		$this->load->view('header_view');
		$this->load->view('menu_view');
		$this->load->view('facturacion_view',array('status'=>$status));
		$this->load->view('footer_view');
	}
	function con($id='')
	{
		if(!empty($id))
		{
			$arg['pedido'] = $this->facturacion_model->listar(array('where'=>array('pedido.id'=>$id)),'',true);
			if($arg['pedido'] !== false)
			{
				$this->load->library('form_validation');	
				$arg['contenido']=array();
				$arg['cantidad']=array();
				foreach($this->facturacion_model->productos_pedido($id) as $value)
				{
					$arg['contenido'][]=$value['id_producto'];
					$arg['cantidad'][]=$value['cantidad'];
				}
				
				$this->load->model('productos/productos_model');
				$arg['productos']=$this->facturacion_model->productos();
				$arg['action']='mod';
				
				$arg['pagos']=$this->facturacion_model->listas('status');
				$this->load->view('header_view');
				$this->load->view('facturacion_con_view',$arg);
				$this->load->view('footer_view');
			}
		}
	}
	function add()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('id_cliente', 'Cliente', 'required|min_length[3]|callback_empresa_check');
		$this->form_validation->set_rules('id[]', 'Productos', 'required');
		$this->form_validation->set_rules('id_status', 'Forma de pago', 'required');
		$this->form_validation->set_error_delimiters("<br /><div class='ui-state-error ui-corner-all error'><p><span class='ui-icon ui-icon-alert icon_msj'></span><span class='ui-icon ui-icon-circle-close cerrar_msj'></span><strong>Alerta:</strong> ","</p></div>");

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->model('productos/productos_model');
			$arg['productos']=$this->facturacion_model->productos();
			$arg['action']='add';
			$arg['contenido']=$this->input->post('id');
			$arg['cantidad']=$this->input->post('cnt');
			$arg['pagos']=$this->facturacion_model->listas('status');
			$this->load->view('header_view');
			$this->load->view('facturacion_add_view',$arg);
			$this->load->view('footer_view');
		}
		else
		{
			$insert=elements(array('id_cliente','id_status'),$this->input->post());
			$this->facturacion_model->insertar($insert,$this->input->post('id'),$this->input->post('cnt'));
			redirect('facturacion');
		}
	}
	function mod($id='')
	{
		if(!empty($id))
		{
			
			$arg['pedido'] = $this->facturacion_model->listar(array('where'=>array('pedido.id'=>$id)),'',true);
			if($arg['pedido'] !== false)
			{
				$this->load->library('form_validation');

				$this->form_validation->set_rules('id_cliente', 'Cliente', 'required|min_length[3]|callback_empresa_check');
				$this->form_validation->set_rules('id[]', 'Productos', 'required');
				$this->form_validation->set_rules('id_status', 'Forma de pago', 'required');
				$this->form_validation->set_error_delimiters("<br /><div class='ui-state-error ui-corner-all error'><p><span class='ui-icon ui-icon-alert icon_msj'></span><span class='ui-icon ui-icon-circle-close cerrar_msj'></span><strong>Alerta:</strong> ","</p></div>");

				if ($this->form_validation->run() == FALSE)
				{
					if($this->input->post('id')!= false &&  $this->input->post('cnt') != false)
					{
						$arg['contenido']=$this->input->post('id');
						$arg['cantidad']=$this->input->post('cnt');
					}else{
						$arg['contenido']=array();
						$arg['cantidad']=array();
						foreach($this->facturacion_model->productos_pedido($id) as $value)
						{
							$arg['contenido'][]=$value['id_producto'];
							$arg['cantidad'][]=$value['cantidad'];
						}
					}				
					$this->load->model('productos/productos_model');
					$arg['productos']=$this->facturacion_model->productos();
					$arg['action']='mod';
					
					$arg['pagos']=$this->facturacion_model->listas('status');
					$this->load->view('header_view');
					$this->load->view('facturacion_add_view',$arg);
					$this->load->view('footer_view');
				}
				else
				{
					$insert=elements(array('id_cliente','id_status'),$this->input->post());
					$this->facturacion_model->modificar($id,$insert,$this->input->post('id'),$this->input->post('cnt'));
					redirect('facturacion');
				}
			}
		}
	}
	function del($id='')
	{
		if(!empty($id))
		{
			$this->facturacion_model->borrar($id);
		}
	}
	function ajax()
	{
		switch($this->input->post('oper'))
		{
			case 'add':
				$insert=elements(array('cedula','nombres','apellidos'),$_POST);
				$insert['id_tipo'] = $this->input->post('tipo');
				$this->facturacion_model->insertar($insert);
			break;
			case 'edit':
				if($this->input->post('id'))
				{
					$mod=elements(array('cedula','nombres','apellidos','sexo'),$_POST);
					$mod['id_tipo'] = $this->input->post('tipo');
					$this->facturacion_model->modificar($this->input->post('cedula'),$mod);
				}
			break;
			default:
			$post=array(
				'limit'=>$this->input->post('rows'),
				'page'=>$this->input->post('page'),
				'orderby'=>$this->input->post('sidx'),
				'orden'=>$this->input->post('sord'),
				'select'=>"{$this->namedb}.*, {$this->namedb}_status.status, sum(precio*cantidad) as total"
			);
			if($this->input->post('_search'))
			{
				$search['like']=elements(array('fecha'),$this->input->post());
				$search['where']=elements(array('id_cliente','id','id_status'),$this->input->post());
				//var_dump($this->input->post());
			}else $search='';
			
			$count=$this->facturacion_model->count($search);
		
			if( $count >0 && $post['limit'] > 0) {
				$total_pages = ceil($count/$post['limit']);
				if ($post['page'] > $total_pages) $post['page']=$total_pages;
				$post['offset']=$post['limit']*$post['page'] - $post['limit'];
			} else {
				$total_pages = 0;
				$post['page']=0;
				$post['offset']=0;
			}
			
			$json->rows=$this->facturacion_model->listar($search,$post);
			$json->total=$total_pages;
			$json->page=$post['page'];
		
			$json->records=$count;
			echo json_encode($json);
			//echo $this->db->last_query();
			break;
		}
	}
	function clientes()
	{
		$q = strtolower($this->input->post("term"));
		$result='';
		if(!empty($q))
		{
			$this->db->select("cedula, CONCAT_WS(' ', cedula , nombres , apellidos ) as value");
			$this->db->from('usuario');
			$this->db->like('cedula',$q);
			$this->db->where('id_tipo', 1);
			$query=$this->db->get();
			if ($query->num_rows() > 0)
			{
				foreach ($query->result_array() as $row)
				{
				}
					$result[]=$row;
			}
		}
		echo json_encode($result);
	
	}
}
