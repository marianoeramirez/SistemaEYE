$(document).ready(function(){
	$( "button, input:submit, input:button, input:reset, .button" ).button();
	$('#menu').buttonset();
	$(".cerrar_msj").live('click',function(){
		$(this).parents('div:first').fadeOut("slow");
	});
	$('#login').dialog({
		autoOpen:false,
		open:function(){
			$('#imgLogin').css({'background-image':'url('+URL+'css/img/icon_key.png)'});
			$('#errorLogin').css({'visibility':'hidden'});
		},
		close: function(){
			$('#inputUser, #inputPsw').val('');
			$('#btentrar').attr('disabled','');
			$('#btentrar').val('Entrar');
		},
		modal: true,
		width: 450,
		height: 260,
		resizable: false
	});
	$('#login a').click(function(){$('#login').dialog("close");});
	$('#btlogin').click(function(){
		$('#login').dialog("open");
	});
	$('#inputUser, #inputPsw').keyup(function(event){
		if(event.keyCode == '13'){
			$('#btentrar').click();
		}
	});
	$('#btentrar').click(function(){
		$('#imgLogin').css({'background-image':'url('+URL+'css/img/loading3.gif)'});
		$(this).attr('disabled','disabled');
		$(this).val('Cargando...');
		$.ajax({
			url: URL_S+'user/login',
			dataType: 'json',
			type: "POST",
			data: {user:$('#inputUser').val(),psw:$('#inputPsw').val()},
			success: function(data){
				if(data['login']==false){
					$('#msj_login').html(data['msj']);
					$('#errorLogin').css({'visibility':'visible'});
					$('#imgLogin').css({'background-image':'url('+URL+'css/img/aspa.png)'});
					$('#btentrar').removeAttr('disabled');
					$('#btentrar').val('Entrar');
				}else{
					$('#errorLogin').css({'visibility':'hidden'});
					$('#imgLogin').css({'background-image':'url('+URL+'css/img/ok.png)'});
					setTimeout("window.location.href='"+URL+"';",1500);
				}
			}
		});
	});

});
