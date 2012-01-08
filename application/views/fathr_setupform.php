<p>This will setup your database with required data for the Fathr CMS</p>
<form action="<? echo '/'.$fathr->controller->config['sitepath']; ?>fathr_setup/db_setup" method="post">
<fieldset>
<legend>General settings</legend>
<div class="clearfix">
	<label for="title">sitename</label>
	<div class="input">
		<input class="xlarge" id="sitename" name="sitename" size="30" type="text" />
	</div>
</div>
<div class="clearfix">
	<label for="title">url</label>
	<div class="input">
		<input class="xlarge" id="url" name="url" size="30" type="text" />
	</div>
</div>
<div class="clearfix">
	<label for="title">theme</label>
	<div class="input">
		<input class="xlarge" id="theme" name="theme" size="30" type="text" />
	</div>
</div>
<div class="clearfix">
	<label for="title">blogy index</label>
	<div class="input">
		<input type="checkbox" name="blogy" value="true" />
	</div>
</div>
</fieldset>
<fieldset>
<legend>Admin login</legend>
<div class="clearfix">
	<label for="title">Username</label>
	<div class="input">
		<input class="xlarge" id="username" name="username" size="30" type="text" />
	</div>
</div>
<div class="clearfix">
	<label for="title">password</label>
	<div class="input">
		<input class="xlarge" id="password" name="password" size="30" type="text" />
	</div>
</div>
</fieldset>
<input class="btn success" type="submit" name="setup" value="Setup the database" />
</form>