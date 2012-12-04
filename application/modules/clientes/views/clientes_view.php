<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/ui.jqgrid.css" />
<script src="<?php echo base_url(); ?>js/grid.locale-es.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/jquery.jqGrid.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
$("#list").jqGrid({
	url: '<?php echo site_url("clientes/ajax"); ?>',
	datatype: "json",
	mtype: 'post',
   	colNames:['Cédula','User', 'Nombres','Apellidos','Email','Sexo','Telf Local','Telf Celular','Nacimiento','Tipo','Password'],
   	colModel:[
   		{name:'cedula',index:'cedula', width:50,"searchrules":{integer:true, number:true}, align:'center',editable:true, editrules:{ required:true}},
   		{name:'usuario',index:'usuario', width:80, editable:true, editrules:{required:true, edithidden:true}, hidden:true},
   		{name:'nombres',index:'nombres', width:80, editable:true, editrules:{required:true}},
   		{name:'apellidos',index:'apellidos', width:80, editable:true, editrules:{required:true}},
   		{name:'email',index:'email', width:80, editable:true, editrules:{required:true, edithidden:true,email:true}, hidden:true},
   		{name:'sexo',index:'sexo', width:80, formatter:'select', editable:true, edittype:"select" ,editoptions:{value:":;0:Hombre;1:Mujer"}, editrules:{required:true, edithidden:true}, hidden:true},
   		{name:'tele_local',index:'tele_local', width:80, editable:true, editrules:{required:false, edithidden:true}, hidden:true},
   		{name:'tele_celular',index:'tele_celular', width:80, editable:true, editrules:{required:false, edithidden:true}, hidden:true},
   		{name:'f_nacimiento',index:'f_nacimiento', width:80, editable:true, editrules:{required:false, edithidden:true, date:true}, hidden:true},
   		{name:'tipo',index:'id_tipo',  width:90, "stype":"select","searchoptions":{"value":<?php echo json_encode($tipo); ?>}, editable:true,edittype:"select" ,editoptions:{value:<?php echo json_encode(array_filter($tipo)); ?>},editrules:{ required:true, edithidden:true}, hidden:true},
   		{name:'psw',index:'psw', editable:true, editrules:{required:false, edithidden:true}, hidden:true},
  		//{name:'status',index:'status', "stype":"select","searchoptions":{"value": ":;A:Activo;I:Inactivo" }, width:70, align:'center', editable:true,edittype:"checkbox",editoptions:{value:"A:I"}}
   	],
   	editurl: '<?php echo site_url("clientes/ajax"); ?>',
   	multiselect: false,
   	caption: "Clientes",
   	jsonReader: {
		repeatitems : false,
		id: "0"
	},
   	pager: '#pager',
   	sortname: 'nombres',
   	height: "<?php echo $this->config->item('jqgrid_height'); ?>",
   	altRows: <?php echo json_encode($this->config->item('jqgrid_altrows')); ?>,
   	viewrecords: <?php echo json_encode($this->config->item('jqgrid_viewrecords')); ?>,
   	rowNum:<?php echo $this->config->item('jqgrid_rownum'); ?>,
   	autowidth:<?php echo json_encode($this->config->item('jqgrid_autowidth')); ?>,
   	rowList:<?php echo json_encode($this->config->item('jqgrid_rowlist')); ?>
}).jqGrid("navGrid", "#pager",{edit:true,add:true,del:true,view:true,search:false,excel:false,addtitle:'Agregar Usuarios'}, {height:400,resize:false, editCaption:'Modificar Usuarios'}, {height:400,resize:false,addCaption:'Agregar Usuarios'}, {},{}, {height:400,resize:false,caption:'Consultar Usuarios'})
.jqGrid("filterToolbar");
$('#btncon').click(function(){
	var gr = $("#list").jqGrid('getGridParam','selrow');
	if( gr != null ) $("#list").jqGrid('viewGridRow',gr,{height:400,resize:false, caption:'Consultar Usuarios'});
	else alert("Por favor seleccina una fila");
}).button({icons: {primary: "ui-icon-document"}});
$('#btnadd').click(function(){
	$("#list").jqGrid('editGridRow',"new",{height:400,reloadAfterSubmit:true,resize:false,addCaption:'Agregar Usuarios'});
}).button({icons: {primary: "ui-icon-plus"}});
$("#btnmod").click(function(){
	var gr = $("#list").jqGrid('getGridParam','selrow');
	if( gr != null ) $("#list").jqGrid('editGridRow',gr,{height:400,reloadAfterSubmit:false,resize:false, editCaption:'Modificar Usuarios'});
	else alert("Por favor selecciona una fila.");
}).button({icons: {primary: "ui-icon-pencil"}});
$("#btndel").click(function(){
	var gr = $("#list").jqGrid('getGridParam','selrow');
	if( gr != null ) jQuery("#list").jqGrid('delGridRow', gr);
	else alert("Por favor selecciona una fila.");
}).button({icons: {primary: "ui-icon-trash"}});
});
</script>
<div id='barra_centro'>
	<div class='portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all ui-body ui-body-b'>
		<div class='portlet-content'>
<span id='menu_bar'> 
<button id='btncon'>Consultar</button>
<button id='btnadd'>Agregar</button> 
<button id='btnmod'>Modificar</button>
<button id='btndel'>Eliminar</button> 
</span> 
<table id='list'>
</table> 
<div id='pager'></div>
</div>
	</div>
</div>
