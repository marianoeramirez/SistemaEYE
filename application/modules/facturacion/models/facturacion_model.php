<?php
class Facturacion_Model extends CI_Model {
	var $namedb='pedido';
	function listar($reglas='',$vars='',$row=false)
	{
		$vars = elements(array('limit', 'offset', 'orderby','orden','select'), $vars);
		$reglas = elements(array('where','like'),$reglas);
		
		if($vars['select']){$this->db->select($vars['select']);}
		$this->db->join("{$this->namedb}_producto", "{$this->namedb}.id = {$this->namedb}_producto.id_pedido");
		$this->db->join("producto", "producto.id = {$this->namedb}_producto.id_producto");
		$this->db->join("{$this->namedb}_status", "{$this->namedb}.id_status = {$this->namedb}_status.id");
		$this->db->join("usuario", "{$this->namedb}.id_cliente = usuario.cedula");
		$this->db->from($this->namedb);
		$this->db->group_by('id_pedido');
		if($reglas['where']){
			foreach($reglas['where'] as $key => $value)
			{
				if($value != false) $this->db->where($key,$value);
			}
		}
		if($reglas['like']){
			foreach($reglas['like'] as $key => $value)
			{
				if($value != false) $this->db->like($key,$value);
			}
		}
		if($vars['orderby'] && $vars['orden']) $this->db->order_by($vars['orderby'],$vars['orden']);
		elseif($vars['orderby']) $this->db->order_by($vars['orderby']);
		
		if($vars['limit'] && $vars['offset']) $this->db->limit($vars['limit'],$vars['offset']);
		elseif($vars['limit']) $this->db->limit($vars['limit']);
		
		$query=$this->db->get();
		if ($query->num_rows() > 1)
		{
			return $query->result_array();
		}
		elseif($query->num_rows() == 1)
		{
			return ($row)? $query->row_array() : $query->result_array();
		}
		else
		{
			return false;
		}
	}
	function count($reglas='')
	{
		$reglas = elements(array('where','like'),$reglas);
		if($reglas['where']){
			foreach($reglas['where'] as $key => $value)
			{
				if($value != false) $this->db->where($key,$value);
			}
		}
		if($reglas['like']){
			foreach($reglas['like'] as $key => $value)
			{
				if($value != false) $this->db->like($key,$value);
			}
		}
		$this->db->from($this->namedb);
		return $this->db->count_all_results();
	}
	function productos_pedido($id)
	{
		$this->db->where('id_pedido',$id);
		$query = $this->db->get('pedido_producto');
		if ($query->num_rows() > 0){
			return $query->result_array();
		}
		else
		{
			return false;
		}
	
	}
	function insertar($insertar,$productos,$cnt)
	{
		$this->db->set('fecha','NOW()',false);
		$this->db->insert($this->namedb,$insertar);
		$insert = array();
		foreach($productos as $key => $value)
		{
			$insert[]=array(
				'id_pedido'=>$this->db->insert_id(),
				'id_producto'=>$value,
				'cantidad'=>$cnt[$key]
			);
		}
		$this->db->insert_batch($this->namedb.'_producto', $insert);
		return $this->db->insert_id();
	}
	function borrar($id)
	{
		$this->db->delete($this->namedb, array('id' => $id));
	}
	function modificar($id,$array,$productos,$cnt)
	{
		$this->db->where('id', $id);
		$this->db->update($this->namedb, $array);
		$this->db->delete($this->namedb.'_producto', array('id_pedido' => $id));
		$insert = array();
		foreach($productos as $key => $value)
		{
			$insert[]=array(
				'id_pedido'=>$id,
				'id_producto'=>$value,
				'cantidad'=>$cnt[$key]
			);
		}
		$this->db->insert_batch($this->namedb.'_producto', $insert);
	}
	function listas($name)
	{
		$this->db->select("id, $name");
		$this->db->order_by('id');
		$query=$this->db->get("{$this->namedb}_$name");
		if ($query->num_rows() > 0){
			foreach($query->result_array() as $row )
			{
				$result[$row['id']]=$row[$name];
			}
			return $result;
		}
		else
		{
			return false;
		}
	
	}
	function productos()
	{
		$this->db->select('id, codigo, nombre, precio');
		$query=$this->db->get('producto');
		if ($query->num_rows() > 0){
			foreach($query->result_array() as $row )
			{
				$result[$row['id']]=$row;
			}
			return $result;
		}
		else
		{
			return false;
		}
	}
}
?>
