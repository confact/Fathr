
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
			<form action="<? echo '/'.$fathr->controller->config['sitepath']; ?>fathr_admin/doLogin/" method="post">
			<div class="clearfix">
              <div class="input-prepend">
                <span class="add-on">username</span>
                <input class="medium" id="username" name="username" size="16" type="text" />
              </div>
            </div>
            <div class="clearfix">
            <div class="input-prepend">
                <span class="add-on">password</span>
                <input class="medium" id="password" name="password" size="16" type="password" />
            </div>
            </div>
            <input class="btn success" type="submit" name="Login" value="Login" />
            </form>