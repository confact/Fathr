<?
if($this->error != "")
{
?>
    <div class="alert-message error fade in" data-alert="alert" >
    <a class="close" href="#">×</a>
    <p><strong>ERROR!</strong> <?php echo $this->error; ?></p>
    </div>
<?
}?>
<?=$fathr->controller->pagequery['text']?>