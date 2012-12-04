<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/ui.jqgrid.css" />
<script src="<?php echo base_url(); ?>js/grid.locale-es.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/jquery.jqGrid.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
$("#list").jqGrid({
	url: '<?php echo site_url("productos/ajax"); ?>',
	datatype: "json",
	mtype: 'post',
   	colNames:['id','Código', 'Producto','Precio','Marca','Modelo','Tipo','Genero','Color','Manufactura'],
   	colModel:[
   		{name:'id',index:'producto.id', hidden:true, width:60, sorttype:"int"},
   		{name:'codigo',index:'codigo', width:50,"searchrules":{integer:true, number:true}, align:'center',editable:true, editrules:{ required:true}},
   		{name:'nombre',index:'nombre', width:200, editable:true, editrules:{required:true}},
   		{name:'precio',index:'precio', width:80, editable:true, editrules:{required:true}},
   		{name:'marca',index:'id_marca', width:80, "stype":"select","searchoptions":{"value":<?php echo json_encode($marca); ?>}, editable:true,edittype:"select",editoptions:{value:<?php echo json_encode($marca); ?>},editrules:{ required:true}},
   		{name:'modelo',index:'id_modelo',  width:90, "stype":"select","searchoptions":{"value":<?php echo json_encode($modelo); ?>}, editable:true,edittype:"select" ,editoptions:{value:<?php echo json_encode($modelo); ?>},editrules:{ required:true}},
   		{name:'tipo',index:'id_tipo',  width:90, "stype":"select","searchoptions":{"value":<?php echo json_encode($tipo); ?>}, editable:true,edittype:"select" ,editoptions:{value:<?php echo json_encode($tipo); ?>},editrules:{ required:true}},
   		{name:'genero',index:'id_genero',  width:70, "stype":"select","searchoptions":{"value":<?php echo json_encode($genero); ?>}, editable:true,edittype:"select" ,editoptions:{value:<?php echo json_encode($genero); ?>},editrules:{ required:true}},
   		{name:'color',index:'color',editable:true, editrules:{edithidden:true}, hidden:true},
   		{name:'manufactura',index:'manufactura',editable:true, editrules:{ edithidden:true}, hidden:true}
  		//{name:'status',index:'status', "stype":"select","searchoptions":{"value": ":;A:Activo;I:Inactivo" }, width:70, align:'center', editable:true,edittype:"checkbox",editoptions:{value:"A:I"}}
   	],
   	editurl: '<?php echo site_url("productos/ajax"); ?>',
   	multiselect: false,
   	caption: "Productos",
   	jsonReader: {
		repeatitems : false,
		id: "0"
	},
   	pager: '#pager',
   	sortname: 'nombre',
   	height: "<?php echo $this->config->item('jqgrid_height'); ?>",
   	altRows: <?php echo json_encode($this->config->item('jqgrid_altrows')); ?>,
   	viewrecords: <?php echo json_encode($this->config->item('jqgrid_viewrecords')); ?>,
   	rowNum:<?php echo $this->config->item('jqgrid_rownum'); ?>,
   	autowidth:<?php echo json_encode($this->config->item('jqgrid_autowidth')); ?>,
   	rowList:<?php echo json_encode($this->config->item('jqgrid_rowlist')); ?>
}).jqGrid("navGrid", "#pager",{edit:true,add:true,del:true,view:true,search:false,excel:false,addtitle:'Agregar Producto'}, {resize:false, editCaption:'Modificar Producto'}, {resize:false,addCaption:'Agregar Producto'}, {},{}, {resize:false,caption:'Consultar Producto'})
.jqGrid("filterToolbar");
$('#btncon').click(function(){
	var gr = $("#list").jqGrid('getGridParam','selrow');
	if( gr != null ) $("#list").jqGrid('viewGridRow',gr,{height:280,resize:false, caption:'Consultar Producto'});
	else alert("Por favor seleccina una fila");
}).button({icons: {primary: "ui-icon-document"}});
$('#btnadd').click(function(){
	$("#list").jqGrid('editGridRow',"new",{height:280,reloadAfterSubmit:true,resize:false,addCaption:'Agregar Producto'});
}).button({icons: {primary: "ui-icon-plus"}});
$("#btnmod").click(function(){
	var gr = $("#list").jqGrid('getGridParam','selrow');
	if( gr != null ) $("#list").jqGrid('editGridRow',gr,{height:280,reloadAfterSubmit:false,resize:false, editCaption:'Modificar Producto'});
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
