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
    	<link rel="stylesheet" type="text/css" href="/<?=$this->sitepath?>/theme/core/bootstrap/bootstrap.min.css">
    	<?php if($this->stylesheet) {
    	?><link rel="stylesheet" href="/<?=$this->sitepath?>/theme/<?=$this->theme?>/<?=$this->stylesheet?>.css" type="text/css" media="screen, projection" /><?
    	}
    	?>
	</head>
	<body>
	<div class="container">
		<div id="header" class="span16">
			<h1><?=$this->pageheadertitle?></h1>
			<nav id="menu" class="span16">
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
