<style>
<?php if($this->tema->_tema['mobile']): ?>
#ubicacion{text-align:center;}
<?php endif; ?>
</style>
<?php if(isset($mensaje)): ?>
<script>alert('<?php echo $mensaje ?>');</script>
<?php endif; ?>
<div id='barra_total'>
	<div class='portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'>
		<div class='portlet-header ui-widget-header ui-corner-all'><h3>Contactenos.</h2></div>
		<div class='portlet-content'>
			<div id='ubicacion' class='portlet ui-widget ui-widget-content ui-body ui-body-<?php echo $this->tema->_tema['tema_celular']; ?> ui-helper-clearfix ui-corner-all'>
			<div class='portlet-header ui-widget-header ui-corner-all'><h3>Ubicacion</h3></div>
			<div class='portlet-content' >
				<img alt="<?php echo $this->tema->_tema['title']; ?>" src="<?php echo "http://maps.google.com/maps/api/staticmap?zoom={$this->tema->_tema['map_zoom']}&size=265x300&sensor=false&markers=color:red|{$this->tema->_tema['map_lat']},{$this->tema->_tema['map_lng']}"; ?>"/>
			</div>
			</div>
			<ul  data-role="listview"  data-inset="true" id='lista_contactenos'>
			<li data-role="list-divider">Informacion de contacto</li> 
			<li>Email: <?php echo $this->tema->_tema['email']; ?></li> 
			<li>Direccion: <?php echo $this->tema->_tema['direccion']; ?></li>
			<li data-role="list-divider">Telefonos</li>
			<li><a href="tel:<?php echo $this->tema->_tema['tel_local']; ?>"><?php echo $this->tema->_tema['tel_local']; ?></a></li>
			<li><a href="tel:<?php echo $this->tema->_tema['tel_cel']; ?>"><?php echo $this->tema->_tema['tel_cel']; ?></a></li>
			</ul> 
			<div id='form_contacto' class='portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'>
			<div class='portlet-content'>
			<?php echo form_open('/contactenos');?>
				<ul data-role="listview" data-inset="true" id='form_contact' >
				<li data-role="list-divider" class='portlet-header ui-widget-header ui-corner-all' ><h3>Informacion de contacto de <?php echo $this->tema->_tema['title']; ?>:</h3></li> 
				<li><label for='asunto'>Asunto: </label><input type='text' name='asunto' id='asunto' size='50' value="<?php echo set_value('asunto'); ?>"><?php echo form_error('asunto'); ?></li> 
				<li><label for='nombre'>Nombre: </label><input type='text' name='nombre' id='nombre' size='50' value="<?php echo set_value('nombre'); ?>"><?php echo form_error('nombre'); ?></li> 
				<li><label for='correo'>Email: </label><input type='email' name='correo' id='correo' size='50' value="<?php echo set_value('correo'); ?>"><?php echo form_error('correo'); ?></li> 
				<?php if($this->tema->_tema['mobile']): ?>
				<li><label for='mensaje'>Mensaje: </label><textarea name='mensaje' id='mensaje'><?php echo set_value('mensaje'); ?></textarea><?php echo form_error('mensaje'); ?></li>
				<?php else: ?>
				<li><label for='mensaje'>Mensaje: </label><textarea cols='50' rows='10' name='mensaje' id='mensaje'><?php echo set_value('mensaje'); ?></textarea><?php echo form_error('mensaje'); ?></li>
				<?php endif; ?>
				</ul>
				<div class="ui-body ui-body-<?php echo $this->tema->_tema['tema_celular']; ?> ui-corner-all" >
		        <fieldset class="ui-grid-a" id='form_buttons'>
				<div class='ui-block-a'><input type='submit' value='Enviar' ></div>
				<div class='ui-block-b'><input type='reset' value='Reiniciar'></div>
				</fieldset>
				</div>
			</form>
			</div>
			</div>
		</div>
	</div>
</div>
