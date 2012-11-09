</div>
		</div>
		<div data-role="footer" id='footer' data-position="fixed" class='portlet-header ui-widget-header ui-corner-all'>
		<h4> &copy; Todos los derechos reservados</h4>
		</div>
	</div>
				</div>
<div title='Login' id='login' style='display:none;'>
	<table width='100%'>
	<tr>
		<td style="width:155px;height:155px;text-align:center;" rowspan="3" id="imgLogin"></td>
		<td class='input_td'><label for='inputUser'>Usuario:</label></td>
		<td><input type='text' name='user' id='inputUser' maxlength="30" size="17" /></td>
	</tr>
	<tr><td><label for='inputPsw'>Contrase&ntilde;a:</label></td><td><input type='password' name='psw' id='inputPsw' size="17" maxlength="30" /></td></tr>
	<tr>
	<td colspan='2'>
		<div style="padding: .7em;font-size:100%;text-align:left; visibility:hidden;" class="ui-state-error ui-corner-all" id='errorLogin'>
		<span style="float: left; margin-right: .3em; " class="ui-icon ui-icon-alert"></span>
		<strong>Alerta:</strong> <span id='msj_login'>Usuario o Contrase&ntilde;a invalida.</span>
	</div>
	</td>
	</tr>
	</table>
	<center><input type='button' value='Entrar' id='btentrar' /></center>
	<div id='opciones'>
		<a href='<?php echo site_url('user/registrarse'); ?>' >&iexcl;Registrate Ahora!</a><br />
	</div>
</div>
</body>
</html>
