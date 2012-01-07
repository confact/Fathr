<?
if($this->error != "")
{
?>
    <div class="alert-message error fade in" data-alert="alert" >
    <a class="close" href="#">×</a>
    <p><strong>ERROR!</strong> <?php echo $this->error; ?></p>
    </div>
<?
}
if($fathr->controller->settings['blogyindex']) {
while($row = mysql_fetch_array($fathr->controller->pagequery))
{
?>
<h2><?=$row['headline']?> <? if($row['date'])
{
	echo "<small>".date('l j F Y', $row['date'])."</small>";
}?>
 </h2>
<?
echo $row['text'];
?>
<hr />
<?
}
}
else {
	echo $fathr->controller->page['text'];
}
?>