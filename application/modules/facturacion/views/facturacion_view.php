<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/ui.jqgrid.css" />
<script src="<?php echo base_url(); ?>js/grid.locale-es.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/jquery.jqGrid.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
$("#list").jqGrid({
	url: '<?php echo site_url("facturacion/ajax"); ?>',
	datatype: "json",
	mtype: 'post',
   	colNames:['ID de pedido','Fecha', 'Cliente','Total','Status'],
   	colModel:[
   		{name:'id',index:'cedula', width:50,"searchrules":{integer:true, number:true}, align:'center',editable:false},
   		{name:'fecha',index:'fecha', width:80, editable:true, editrules:{required:true}},
   		{name:'id_cliente',index:'id_cliente', width:80, "searchrules":{integer:true, number:true}, editable:true, editrules:{required:true}},
   		{name:'total',index:'total', width:80, search:false, editable:true, editrules:{required:true, edithidden:true}, hidden:false},
   		{name:'status',index:'id_status',  width:90, "stype":"select","searchoptions":{"value":<?php echo json_encode($status); ?>}, editable:true,edittype:"select" ,editoptions:{value:<?php echo json_encode($status); ?>},editrules:{ required:true}}
   	],
   	editurl: '<?php echo site_url("facturacion/ajax"); ?>',
   	multiselect: false,
   	caption: "Usuarios",
   	jsonReader: {
		repeatitems : false,
		id: "0"
	},
   	pager: '#pager',
   	sortname: 'fecha',
   	height: "<?php echo $this->config->item('jqgrid_height'); ?>",
   	altRows: <?php echo json_encode($this->config->item('jqgrid_altrows')); ?>,
   	viewrecords: <?php echo json_encode($this->config->item('jqgrid_viewrecords')); ?>,
   	rowNum:<?php echo $this->config->item('jqgrid_rownum'); ?>,
   	autowidth:<?php echo json_encode($this->config->item('jqgrid_autowidth')); ?>,
   	rowList:<?php echo json_encode($this->config->item('jqgrid_rowlist')); ?>
}).jqGrid("navGrid", "#pager",{edit:false,add:false,del:false,view:false,search:false,excel:false,addtitle:'Agregar Factura'}, {resize:false, editCaption:'Modificar Factura'}, {resize:false,addCaption:'Agregar Factura'}, {},{}, {resize:false,caption:'Consultar Factura'})
.jqGrid("filterToolbar");
$('#btncon').click(function(){
	var gr = $("#list").jqGrid('getGridParam','selrow');
	if( gr != null ) window.location.href=URL_S+'facturacion/con/'+gr;
	else alert("Por favor seleccina una fila");
}).button({icons: {primary: "ui-icon-document"}});
$('#btnadd').click(function(){
	window.location.href=URL_S+'facturacion/add';
}).button({icons: {primary: "ui-icon-plus"}});
$("#btnmod").click(function(){
	var gr = $("#list").jqGrid('getGridParam','selrow');
	if( gr != null ) window.location.href=URL_S+'facturacion/mod/'+gr;
	else alert("Por favor selecciona una fila.");
}).button({icons: {primary: "ui-icon-pencil"}});
});
</script>
<div id='barra_centro'>
	<div class='portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all ui-body ui-body-b'>
		<div class='portlet-content'>
<span id='menu_bar'> 
<button id='btncon'>Consultar</button>
<button id='btnadd'>Agregar</button> 
<button id='btnmod'>Modificar</button> 
</span> 
<table id='list'>
</table> 
<div id='pager'></div>
</div>
	</div>
</div>
