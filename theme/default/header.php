<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title><?=$this->pagetitle?></title>
		<?php
		foreach($this->meta as $name => $text)
		{
		?>
		
		<?
		}
		?>
		<!-- Framework CSS -->  
    	<link rel="stylesheet" href="/<?=$this->sitepath?>/theme/core/blueprint/screen.css" type="text/css" media="screen, projection" />  
    	<link rel="stylesheet" href="/<?=$this->sitepath?>/theme/core/blueprint/print.css" type="text/css" media="print" />  
    	<!--[if IE]><link rel="stylesheet" href="/<?=$this->sitepath?>/theme/core/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->  
  
    	<!-- Import fancy-type plugin. -->  
    	<link rel="stylesheet" href="/<?=$this->sitepath?>/theme/core/blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection" />
    	<?php if($this->stylesheet) {
    	?><link rel="stylesheet" href="/<?=$this->sitepath?>/theme/<?=$this->theme?>/<?=$this->stylesheet?>.css" type="text/css" media="screen, projection" /><?
    	}
    	?>
	</head>
	<body>
	<div class="container">
		<div id="header" class="span-24 last">
			<h1><?=$this->pageheadertitle?></h1>
			<nav id="menu" class="span-24 last">
			<?php
			if(is_array($this->menu))
			{
				?><ul><?
				foreach($this->menu as $name => $href)
				{
				?>
					<li><a href="<?=$href?>"><?=$name?></a></li>
				<?
				}
				?></ul><?
				}
				?>
			</nav>
        	<hr />
		</div>
