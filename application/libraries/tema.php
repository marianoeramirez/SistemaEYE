<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tema{
	var $CI;
	var $_tema;

 	function __construct()
    {
		$this->CI =& get_instance();
		$this->_tema=array(
			'mobile'=>$this->CI->agent->is_mobile(),
			'tema_celular'=>'a',
			'keywords'=>'',
			'description'=>'',
			'title'=>'EYE-2000',
			'map_lat'=>'10.546569',
			'map_lng'=>'-66.874146',
			'map_zoom'=>'13',
			'email'=>'prueba@gmail.com',
			'direccion'=>'Av. Principal San Antonio de los Altos, C.C. San Antonio Plaza (Redoma de Rosalito), Nivel 2, Local 87',
			'tel_local'=>'0212-491.18.97',
			'tel_cel'=>'0416-827.74.07',
			'page'=>''
		);
    }
	function is_cell()
	{
		return $this->_tema['mobile'];
	}
}

?>
