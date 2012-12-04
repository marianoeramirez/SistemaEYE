<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Router class */
require APPPATH."third_party/MX/Router.php";

class MY_Router extends MX_Router {
 
    function MY_Router()
    {
        parent::__construct();
    }
 
    function _validate_request($segments)
    {
		//echo count($segments)."i";
        // Comprueba que el controlador no existe
       	
       	//var_dump(file_exists(APPPATH."modules/$segments[0]/controllers/"));
		if(count($segments)>=1)
		{
			if (!file_exists(APPPATH.'controllers/'.$segments[0].EXT) && !file_exists(APPPATH.'controllers/'.$segments[0]) && !file_exists(APPPATH."modules/$segments[0]/controllers/"))
			{
				
				array_unshift($segments,"inicio");
			}
		}
        return parent::_validate_request($segments);
    }
}
?>
