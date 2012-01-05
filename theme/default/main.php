<? 
if(isset($this->sidebar["left"]) AND isset($this->sidebar["right"])) {
?>
<div class="row">
<div class="span2">
<? echo $this->sidebar["left"];
?>
</div>
<div class="span8">
<?php
echo $this->main;
?>
</div>
<div class="span2">
<? echo $this->sidebar["right"];
?>
</div>
</div>
<?
}
else if(isset($this->sidebar["left"]) AND !isset($this->sidebar["right"])) {
?>
<div class="row"><div class="span5">
<? echo $this->sidebar["left"];
?>
</div>
<div class="span11">
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
<div class="span11">
<?php
echo $this->main;
?>
</div>
<div class="span5">
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