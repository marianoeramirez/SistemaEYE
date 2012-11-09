<?php
class Historial_Model extends CI_Model {
	var $namedb='historial';
	function listar($reglas='',$vars='',$row=false)
	{
		$vars = elements(array('limit', 'offset', 'orderby','orden','select'), $vars);
		$reglas = elements(array('where','like'),$reglas);
		
		if($vars['select']){$this->db->select($vars['select']);}
		$this->db->join("usuario", "usuario.cedula = {$this->namedb}.id_cliente");
		$this->db->from($this->namedb);
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
			var_dump($query->result_array());
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
	function insertar($array)
	{
		$this->db->insert($this->namedb, $array);
		return $this->db->insert_id();
	}
	function borrar($id)
	{
		$this->db->delete($this->namedb, array('id' => $id));
	}
	function modificar($id,$array)
	{
		$this->db->where('id', $id);
		$this->db->update($this->namedb, $array);
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
}
?>
