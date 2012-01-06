<form action="<? echo '/'.$fathr->controller->config['sitepath'].'/fathr_admin/doPageAdd'; ?>" method="post">
<div class="clearfix">
	<label for="title">Page's Title</label>
	<div class="input">
		<input class="xlarge" id="title" name="title" size="30" type="text" />
	</div>
</div>
<div class="clearfix">
	<label for="title">Page's Headline</label>
	<div class="input">
		<input class="xlarge" id="headline" name="headline" size="30" type="text" />
	</div>
</div>
<div class="clearfix">
	<label for="textarea">Text</label>
	<div class="input">
		<textarea class="xxlarge" id="text" name="text" rows="3"></textarea>
		<span class="help-block">
			This can be in html or raw text.
		</span>
	</div>
</div>
<input class="btn success" type="submit" name="add" value="Add" />
</form>