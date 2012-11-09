<div id='barra_izq'>
	<?php if($this->users->is_login()): ?>
	<div class='portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'>
		<div class='portlet-header ui-widget-header ui-corner-all'><h3>Menu</h3></div>
		<div class='portlet-content'>
			<?php if($this->users->get_tipo() == 1): ?>
			<a href="<?php echo site_url('productos'); ?>" class="full button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button"><span class="ui-button-text">Productos</span></a>
			<a href="<?php echo site_url('clientes'); ?>" class="full button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button"><span class="ui-button-text">Clientes</span></a>
			<a href="<?php echo site_url('facturacion'); ?>" class="full button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button"><span class="ui-button-text">Facturacion</span></a>
			<a href="<?php echo site_url('historial'); ?>" class="full button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button"><span class="ui-button-text">Historial Medico</span></a>
			<?php endif; ?>
			<a href="<?php echo site_url('user/logout'); ?>" class="full button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button"><span class="ui-button-text">Desconectarse</span></a>
		</div>
	</div>
	<?php else: ?>
	<div class='portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'>
		<div class='portlet-header ui-widget-header ui-corner-all' id='btlogin'><h4 style="margin:5px 0px;">Login</h4></div>
	</div>
	<?php endif; ?>
	<div class='portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'>
		<div class='portlet-header ui-widget-header ui-corner-all'><h4>Ubicación</h4></div>
		<div class='portlet-content'>
			<img alt='empressa de prueba' src='http://maps.google.com/maps/api/staticmap?zoom=13&size=265x300&sensor=false&markers=color:red|10.546569,-66.874146'/>
		</div>
	</div>
</div>
