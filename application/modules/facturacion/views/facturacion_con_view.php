<style>
.eliminar{cursor:pointer;}
table{border-collapse:collapse;}
#factura{width:100%;float:left;}
#precios .ui-widget-header{padding:5px;}
#forma_pago{width:90%; padding:10px;}
#forma_pago .ui-widget-header{padding:5px;}
#factura-table td{padding:10px; border-collapse:collapse; border-bottom: 1px solid white;}
#factura-table th{padding:10px; border-collapse:collapse; border:0px;}
#factura-table{padding:10px;}
.ui-autocomplete-loading { background: white url('<?php echo base_url(); ?>/css/img/loading2.gif') right center no-repeat; }
</style>
<div id='barra_total'>
	<div class='portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all ui-body ui-body-b'>
		<div class='portlet-content'>
<?php
if($productos): ?>

<div id='factura' >
	<a href="<?php echo site_url('facturacion'); ?>" class='button'>Volver...</a>
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
			<th>Total</th>
			</tr>
		</thead>
		<tbody>
			<?php
			//var_dump($productos);
			//var_dump($contenido);
			$total = 0;
			$ganancia = 0;
			if($contenido != false):
				foreach($contenido as $key => $value):
					$total += $productos[$value]['precio']*$cantidad[$key];
				?>
				<tr id='prc<?php echo $value; ?>'  class="item-productos">
					<td class='codigo'><?php echo $productos[$value]['codigo']; ?></td>
					<td class='nombre'><?php echo $productos[$value]['nombre']; ?></td>
					<td><?php echo $cantidad[$key]; ?></td>
					<td class='precio'><?php echo $productos[$value]['precio']; ?></td>
					<td align='right'><?php echo $cantidad[$key]*$productos[$value]['precio']; ?></td>
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
	</table>
	<div id='forma_pago' class='portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all ui-body ui-body-b'>
	<div class="ui-widget-header">Formas de pago</div>
		<div class='portlet-content'>
		<?php echo $pedido['status']; ?>
		</div>
	</div>
	<br><br>
	</form>
</div>

<?php endif; ?>
</div>
</div>
</div>
