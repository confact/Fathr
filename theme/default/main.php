<? 
if(isset($this->sidebar["left"]) AND isset($this->sidebar["right"])) {
?>
<div class="row">
<div class="span3 left">
<? echo $this->sidebar["left"];
?>
</div>
<div class="span7">
<?php
$this->getMainContent();
?>
</div>
<div class="span3 right">
<? echo $this->sidebar["right"];
?>
</div>
</div>
<?
}
else if(isset($this->sidebar["left"]) AND !isset($this->sidebar["right"])) {
?>
<div class="row"><div class="span4 left">
<? echo $this->sidebar["left"];
?>
</div>
<div class="span10">
<?php
$this->getMainContent();
?>
</div>
</div>
<?
}
 else if(isset($this->sidebar["right"]) AND !isset($this->sidebar["left"])) {
?>
<div class="row">
<div class="span10">
<?php
$this->getMainContent();
?>
</div>
<div class="span4 right">
<? echo $this->sidebar["right"];
?>
</div>
</div>
<?
}
else {
?>
<?php
$this->getMainContent();
?>
<?
}
?>