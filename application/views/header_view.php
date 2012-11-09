<!DOCTYPE html>
<html>
<head>
	<meta http-equiv='content-type' content='text/html; charset=utf-8' />
	<title><?php echo $this->tema->_tema['title']; ?> <?php if(!empty($this->tema->_tema['page'])){ echo "- ".$this->tema->_tema['page']; } ?></title>
	<meta name='robots' content='index, follow' />  
	<meta name='keywords' content="<?php echo $this->tema->_tema['keywords']; ?>" />
	<meta name='description' content="<?php echo $this->tema->_tema['description']; ?>" />
	<link rel='stylesheet' type='text/css' href="<?php echo base_url(); ?>css/index.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css" type="text/css" media="screen" /> 
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.6.4.min.js"></script>
	<script type='text/javascript' src="<?php echo base_url(); ?>js/jquery-ui-1.8.14.custom.min.js"></script>
	<script type='text/javascript' src="<?php echo base_url(); ?>js/index.js"></script>
	<script type="text/javascript">
	var URL_S ='<?php echo base_url();if( index_page()!=''){echo index_page()."/";}?>';
	var URL = "<?php echo base_url(); ?>";
	</script>
	<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
	<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
	  {lang: 'es'}
	</script>
	<script src="http://connect.facebook.net/en_US/all.js#appId=237013892999895&amp;xfbml=1"></script>
	</head>
<body>
	<div id="fb-root"></div>
	<div id='global' data-role='page'>
		<div id='header' data-role="header" >
						<div id='titulo'>
			<h2 id='title'><?php echo $this->tema->_tema['title']; ?></h2>
			<span id='rif' class='ui-button ui-widget ui-state-default ui-button-text-only' >RIF: j222222287</span>
			</div>
						<div id='social_plugins'>
			<g:plusone size="tall"></g:plusone>
			<fb:like href="publisnet.com" send="false" layout="box_count"  show_faces="false" font=""></fb:like>
			<a href="http://twitter.com/share" class="twitter-share-button" data-count="vertical" data-via="publisnet" data-related='sosinformatico:sdsdsd'>Tweet</a>
			</div>
						<a data-role='button' data-iconpos="notext" data-icon='home' href='inicio.html'></a>
		</div>
		<div id='content' class='portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-top'>
			<div id="bar" class='portlet-header ui-widget-header ui-corner-all' data-role="navbar">
				<ul id="menu">
					<li><a href="<?php echo site_url('index'); ?>">Home</a></li>
					<li><a href="<?php echo site_url('contactenos'); ?>">Contactenos</a></li>
					<?php foreach($this->users->menu_top() as $value): ?>
					<li><a href="<?php echo site_url($value['url']); ?>"><?php echo $value['titulo']; ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class='portlet-content' data-role="content">
