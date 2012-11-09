<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/ui.jqgrid.css" />
<script src="<?php echo base_url(); ?>js/grid.locale-es.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/jquery.jqGrid.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/jquery.tools.min.js" type="text/javascript"></script>
<script>
function range_elem(value, options){
	var el = $(document.createElement("input"));
	el.attr('type','range');
	el.type="range";
	el.value = value;
	el.className = 'rango';
	el.rangeinput();
	//var el = $("<input type='range' class='rango'>").rangeinput();
	return el;
}
function range_value(){

}
function prueba(){
	alert("hola");
}
$(document).ready(function(){
$("#list").jqGrid({
	url: '<?php echo site_url("historial/ajax"); ?>',
	datatype: "json",
	mtype: 'post',
   	colNames:['Codigo','Cliente','Fecha','Astigmatismo OD','Astigmatismo OI','Hipermetropia OD','Hipermetropia OI','Presbicia OD','Presbicia OI','Miopia OD','Miopia OI','Observaciones'],
   	colModel:[
   		{name:'id',index:'id', width:50,"searchrules":{integer:true, number:true}, align:'center',editable:false},
   		{name:'id_cliente',index:'id_cliente', width:80, editable:true, editrules:{required:true}},
   		{name:'fecha',index:'fecha', width:80, editable:false, editrules:{required:false, edithidden:true}, hidden:false, search:true},
   		{name:'astigmatismo_od',index:'astigmatismo_od', width:80, editable:true, editrules:{required:false, edithidden:true}, edittype:'custom', editoptions:{custom_element: range_elem, custom_value:range_value}, hidden:true},
   		{name:'astigmatismo_oi',index:'astigmatismo_oi', width:80, editable:true, editrules:{required:false, edithidden:true}, edittype:'custom', editoptions:{custom_element: range_elem, custom_value:range_value}, hidden:true},
   		{name:'hipermetropia_od',index:'hipermetropia_od', width:80, editable:true, editrules:{required:false, edithidden:true}, edittype:'custom', editoptions:{custom_element: range_elem, custom_value:range_value}, hidden:true},
   		{name:'hipermetropia_oi',index:'hipermetropia_oi', width:80, editable:true, editrules:{required:false, edithidden:true}, edittype:'custom', editoptions:{custom_element: range_elem, custom_value:range_value}, hidden:true},
   		{name:'presbicia_od',index:'presbicia_od', width:80, editable:true, editrules:{required:false, edithidden:true}, edittype:'custom', editoptions:{custom_element: range_elem, custom_value:range_value}, hidden:true},
   		{name:'presbicia_oi',index:'presbicia_oi', width:80, editable:true, editrules:{required:false, edithidden:true}, edittype:'custom', editoptions:{custom_element: range_elem, custom_value:range_value}, hidden:true},
   		{name:'miopia_od',index:'miopia_od', width:80, editable:true, editrules:{required:false, edithidden:true}, edittype:'custom', editoptions:{custom_element: range_elem, custom_value:range_value}, hidden:true},
   		{name:'miopia_oi',index:'miopia_oi', width:80, editable:true, editrules:{required:false, edithidden:true}, edittype:'custom', editoptions:{custom_element: range_elem, custom_value:range_value}, hidden:true},
   		{name:'info',index:'info', width:80, editable:true, edittype:"textarea", editrules:{required:false, edithidden:true, maxValue:255}, hidden:true},
   	],
   	editurl: '<?php echo site_url("historial/ajax"); ?>',
   	multiselect: false,
   	caption: "Historial",
   	jsonReader: {
		repeatitems : false,
		id: "0"
	},
   	pager: '#pager',
   	sortname: 'id',
   	height: "<?php echo $this->config->item('jqgrid_height'); ?>",
   	altRows: <?php echo json_encode($this->config->item('jqgrid_altrows')); ?>,
   	viewrecords: <?php echo json_encode($this->config->item('jqgrid_viewrecords')); ?>,
   	rowNum:<?php echo $this->config->item('jqgrid_rownum'); ?>,
   	autowidth:<?php echo json_encode($this->config->item('jqgrid_autowidth')); ?>,
   	rowList:<?php echo json_encode($this->config->item('jqgrid_rowlist')); ?>
}).jqGrid("navGrid", "#pager",{edit:true,add:true,del:false,view:true,search:false,excel:false,addtitle:'Agregar Historial'}, {resize:true, editCaption:'Modificar Historial', width:500}, {resize:true,addCaption:'Agregar Historial'}, {},{}, {resize:false,caption:'Consultar Historial'})
.jqGrid("filterToolbar");
$('#btncon').click(function(){
	var gr = $("#list").jqGrid('getGridParam','selrow');
	if( gr != null ) $("#list").jqGrid('viewGridRow',gr,{height:400, width: 400, resize:false, caption:'Consultar Historial'});
	else alert("Por favor seleccina una fila");
}).button({icons: {primary: "ui-icon-document"}});
$('#btnadd').click(function(){
	$("#list").jqGrid('editGridRow',"new",{height:400,width: 400,reloadAfterSubmit:true,resize:false,addCaption:'Agregar Historial'});

}).button({icons: {primary: "ui-icon-plus"}});
$("#btnmod").click(function(){
	var gr = $("#list").jqGrid('getGridParam','selrow');
	if( gr != null ) $("#list").jqGrid('editGridRow',gr,{height:400,reloadAfterSubmit:false,resize:false, editCaption:'Modificar Historial'});
	else alert("Por favor selecciona una fila.");
}).button({icons: {primary: "ui-icon-pencil"}});

$(".rango").rangeinput();
$('#editmodlist').dialog('open');
});
</script>
<div id='barra_centro'>
	<div class='portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all ui-body ui-body-b'>
		<div class='portlet-content'>
<!--		<input type='range' class='rango'>-->
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
