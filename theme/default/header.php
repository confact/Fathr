<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title><?=$this->pagetitle?></title>
		<?php
		foreach($this->meta as $name => $text)
		{
		?>
		<meta name="<?php echo $name; ?>" content="<?php echo $text; ?>" />
		<?
		}
		?>
		<!-- Framework CSS -->  
    	<link rel="stylesheet" type="text/css" href="/<?=$this->sitepath?>/theme/core/bootstrap/bootstrap.min.css">
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
		<script src="/<?=$this->sitepath?>/theme/core/bootstrap/js/bootstrap-alerts.js"></script>
    	<?php if($this->stylesheet) {
    	?><link rel="stylesheet" href="/<?=$this->sitepath?>/theme/<?=$this->theme?>/<?=$this->stylesheet?>.css" type="text/css" media="screen, projection" /><?
    	}
    	?>
	</head>
	<body>
	
	<div class="topbar">
      <div class="fill">
        <div class="container">
          <a class="brand" href="/<?=$this->sitepath?>"><?=$this->pagetitle?></a>

		<?php
			if(isset($this->menu))
			{
				?>          <ul class="nav"><?
				foreach($this->menu as $name => $href)
				{
				?>
					<li><a href="<? echo $href?>"><? echo $name?></a></li>
				<?
				}
				?></ul><?
				}
				?>
        </div>
      </div>

    </div>
    
	<div class="container">
	<div class="content">
	<div class="page-header">
          <h1><? echo $this->pageheadertitle; ?></h1>
        </div>