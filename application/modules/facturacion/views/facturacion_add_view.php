<style>
.eliminar{cursor:pointer;}
table{border-collapse:collapse;}
#factura{width:65%;float:left;}
#precios{width:30%; float:right; padding:10px; height:300px; overflow-y:scroll; margin-bottom:20px;}
#precios .ui-widget-header{padding:5px;}
#forma_pago{width:100%; padding:10px;}
#forma_pago .ui-widget-header{padding:5px;}
#factura-table td{padding:10px; border-collapse:collapse; border-bottom: 1px solid white;}
#factura-table th{padding:10px; border-collapse:collapse; border:0px;}
#factura-table{padding:10px;}
.ui-autocomplete-loading { background: white url('<?php echo base_url(); ?>/css/img/loading2.gif') right center no-repeat; }
</style>
<script type="text/javascript">
var productos = <?php echo json_encode($productos); ?>;
$(document).ready(function() {
	//$("#productos > li:even").css("background-color","yellow");
	$(".elemento").click(function(event){
		event.preventDefault();
		var id=$(this).attr('id');
		var tr = $(this).parents('tr:first');
		if( $('#form-productos input[id*="'+id+'"]').length == 0 ){
			$("#vacio").hide();
			var el = $('#template').clone();
			el.appendTo('#factura-table tbody').attr('id','prc'+id).addClass('item-productos').show();
			el.find('.nombre').text(tr.find('.pr_nombre').text());
			el.find('.precio').text(tr.find('.pr_precio').text());
			el.find('.codigo').text($(this).text());
			el.find('.eliminar').attr('ids',id);
			el.find('.cantidad').attr('name','cnt[]');
			$("<input type='hidden' name='id[]' value='"+id+"' id='"+id+"' >").appendTo('#form-productos');
			total();
		}
	});
	$('.eliminar').live('click', function(event){
		event.preventDefault();
		var id = $(this).attr('ids');
		$(this).parents('tr:first').remove();
		$('#form-productos input').each(function(){
				if($(this).attr('id')==id){$(this).remove();}
		});
		if( $("#factura-table tbody tr:visible").length == 0){
			$("#vacio").show();
		}
		total();
	});
	$('.cantidad').live('change',function(){total()});
	$("#cliente").autocomplete({
		source: function( request, response ) {
				$.ajax({
					type: "POST",
					url: "<?php echo site_url("facturacion/clientes"); ?>",
					dataType: "json",
					data: {
						term: request.term
					},
					success: function( data ) {
						response(data);
					}
				});
			},
		minLength: 2,
		select: function(event,ui){
			$("#id_cliente").val(ui.item.cedula);
		}
	});

	function total(){
	var total = 0;
		$('.precio').each(function(){
			var tr = $(this).parents('tr:first');
			var precio = parseFloat($(this).text());
			var cnt = parseFloat(tr.find('.cantidad').val());
			if(!isNaN(precio) && !isNaN(cnt))
				total += precio*cnt;
			else
				tr.find('.cantidad').val('0');
		});
		$('#total').text(Math.round(total*100)/100);
	}
	<?php if($contenido != false): ?>
	total();
	<?php endif; ?>
});
</script>
<div id='barra_total'>
	<div class='portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all ui-body ui-body-b'>
		<div class='portlet-content'>
<?php
if(isset($pedido['id_pedido'])){$id="/$pedido[id_pedido]";}else{$id="";}
if($productos): ?>

<div id='factura' >
	<a href="<?php echo site_url('facturacion'); ?>" class='button'>Volver...</a>
	<?php echo form_open('facturacion/'.$action.$id, "id='form-productos'"); ?>
	<table width='100%'><tr>
	<td width='260px' ><?php if(!isset($pedido['id_cliente'])): ?>Cliente: <input id='cliente' size='27' value='<?php echo set_value('id_cliente'); ?>'><input id='id_cliente' type='hidden' value="<?php echo set_value('id_cliente'); ?>" name='id_cliente'><?php else: ?><h3><?php echo $pedido['id_cliente']; ?></h3><input id='id_cliente' type='hidden' value="<?php echo $pedido['id_cliente']; ?>" name='id_cliente'><?php endif; ?> <?php echo form_error('id_cliente'); ?><td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
	<td  width='100%'>
	<div id='factura-table'  class='portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all ui-body ui-body-b'>
	<table width='100%' >
		<thead  class="ui-widget-header">
			<tr>
			<th>Codigo</th>
			<th width='200px'>Descripcion</th>
			<th>Cantidad</th>
			<th>Precio</th>
			<th>Opciones</th>
			</tr>
		</thead>
		<tbody>
			<tr id='template' style='display:none;'>
				<td class='codigo'></td>
				<td class='nombre'></td>
				<td ><input type='text' class='cantidad'></td>
				<td class='precio'></td>
				<td><a ids='' class='ui-icon ui-icon-closethick info-tooltip eliminar' title="Eliminar" width='30px' src='<?php echo base_url()."img/error/error.jpg"; ?>'></a></td>
			</tr>
			<?php
			//var_dump($productos);
			//var_dump($contenido);
			$total = 0;
			$ganancia = 0;
			if($contenido != false):
				foreach($contenido as $key => $value):
					$total += $productos[$value]['precio'];
				?>
				<tr id='prc<?php echo $value; ?>'  class="item-productos">
					<td class='codigo'><?php echo $productos[$value]['codigo']; ?></td>
					<td class='nombre'><?php echo $productos[$value]['nombre']; ?></td>
					<td><input type='text' class='cantidad' name='cnt[]' value="<?php echo $cantidad[$key]; ?>"></td>
					<td class='precio'><?php echo $productos[$value]['precio']; ?></td>
					<td><a ids='<?php echo $value; ?>' class='ui-icon ui-icon-closethick info-tooltip eliminar' title="Eliminar"></a></td>
				</tr>
				<tr id='vacio' style='display:none;'>
					<td colspan='5' align='center'>Vacio el carrito</td>
				</tr>
			<?php endforeach;
			else: ?>
			<tr id='vacio'>
				<td colspan='5' align='center'>Vacio el carrito</td>
			</tr>
			<?php endif; ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan='4' style='border:0px;'>&nbsp;</td>
				<td align='right'>Total:<span id='total'><?php echo $total; ?></span></td>
			</tr>
		</tfoot>
	</table>
	</div>
	</td>
	</tr>
	<tr>
	<td><?php echo form_error('id[]'); ?></td>
	</tr>
	</table>
	<div id='forma_pago' class='portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all ui-body ui-body-b'>
	<div class="ui-widget-header">Formas de pago</div>
		<div class='portlet-content'>
		<?php foreach($pagos as $key => $value): ?>
		<input type='radio' name='id_status' value="<?php echo $key; ?>" <?php echo set_radio('id_status', $key,isset($pedido['id_status']) && $key == $pedido['id_status']); ?>> <?php echo $value; ?>
		<?php endforeach; ?>
		<?php echo form_error('id_status'); ?>
		</div>
	</div>
	<br><br>
	<input type='hidden' name='nempresa' id='nempresa'>
	<input type='submit' value='<?php if($action=="mod"){echo "Modificar";}else{echo "Comprar";} ?>'>
	<?php if($contenido != false): ?>
		<?php foreach($contenido as $value): ?>
		<input type='hidden' name='id[]' value='<?php echo $value; ?>' id='<?php echo $value; ?>' >
		<?php endforeach; ?>
	<?php endif; ?>
	</form>
</div>
<div id='precios'  class='portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all ui-body ui-body-b'>
	<div class="ui-widget-header">Productos</div>
	<div class='portlet-content'>
<table id='productos'>
<tr>
	<th>Codigo:</th>
	<th>Nombre:</th>
	<th>Precio:</th>
</tr>
<?php foreach($productos as $key => $value): ?>
<tr >
	<td><a href='#' id="<?php echo $value['id'] ?>" class='elemento'><?php echo $value['codigo'] ?></a></td>
	<td class='pr_nombre'><?php echo $value['nombre'] ?></td>
	<td class='pr_precio'><?php echo $value['precio'] ?></td>
</tr>
<?php endforeach;?>
</table>
</div>
</div>

<?php endif; ?>
</div>
</div>
</div>
