<? 
if(isset($this->sidebar["left"]) AND isset($this->sidebar["right"])) {
?>
<div class="row">
<div class="span3">
<? echo $this->sidebar["left"];
?>
</div>
<div class="span8">
<?php
echo $this->main;
?>
</div>
<div class="span3">
<? echo $this->sidebar["right"];
?>
</div>
</div>
<?
}
else if(isset($this->sidebar["left"]) AND !isset($this->sidebar["right"])) {
?>
<div class="row"><div class="span4">
<? echo $this->sidebar["left"];
?>
</div>
<div class="span10">
<?php
echo $this->main;
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
echo $this->main;
?>
</div>
<div class="span4">
<? echo $this->sidebar["right"];
?>
</div>
</div>
<?
}
else {
?>
<?php
echo $this->main;
?>
<?
}
?>