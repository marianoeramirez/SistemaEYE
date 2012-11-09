<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends MX_Controller {
	public function index($paginas)
	{
		$this->tema->_tema['description']=$paginas['descripcion'];
		$this->tema->_tema['page']=$paginas['titulo'];
		$this->load->view('header_view');
		$this->load->view('menu_view');
		$this->load->view('page_view',$paginas);
		$this->load->view('footer_view');
	}
	function contactenos()
	{
		$this->load->view('header_view');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('asunto', 'Asunto', 'required|trim|min_length[3]|max_length[40]');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|max_length[40]');
		$this->form_validation->set_rules('correo', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('mensaje', 'Mensaje', 'required|max_length[500]');
		$this->form_validation->set_error_delimiters("<br /><div class='ui-state-error ui-corner-all error'><p><span class='ui-icon ui-icon-alert icon_msj'></span><span class='ui-icon ui-icon-circle-close cerrar_msj'></span><strong>Alerta:</strong> ","</p></div>");
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('contactenos_view');
		}
		else
		{
			$mensaje= array(
			'nombre' => $this->input->post('nombre'),
			'correo' => $this->input->post('correo'),
			'asunto' => $this->input->post('asunto'),
			'mensaje' => $this->input->post('mensaje')
			);
			$array['mensaje']=json_encode($mensaje);
			if($this->users->auth())
			{
				$array['de']=$this->users->cod();
			}
			else
			{
				$array['de']=0;
			}
			$array['asunto']="Mensaje desde la pagina";
			$array['para']=$contenido['cod_user'];
			$this->db->set("fecha","now()",false);
			$this->db->insert('mensajes', $array);
			$contenido['titulo']='Mensaje enviado con exito';
			$contenido['contenido']= jquery_nice('Mensaje Enviado con exito');	
		}
		$this->load->view('footer_view');
	
	}
	function _remap($method,$args)
	{
		$method = str_replace('.html','',$method);
		switch ($method)
		{
			case 'contactenos':
			$this->contactenos();
			break;
			default:
			if(!empty($method))
			{
				$this->load->model('paginas_model');
				$pagina=$this->paginas_model->listar(array('where'=>array('url'=>$method)),'',true);
				
				if($pagina!=false)
				{
					$this->index($pagina);
				}
				else
				{	
					show_404();
				}
			}
			else
			{
				show_404();
			}
		}
	}
	
}
