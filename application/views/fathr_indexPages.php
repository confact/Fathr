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
foreach($fathr->controller->pagequery->getArray() as $row)
{
?>
<h2><a href="<? echo '/'.$fathr->controller->config['sitepath'].'fathr_page/page/'.$row['id']; ?>"><?=$row['headline']?></a> <? if($row['dated'])
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