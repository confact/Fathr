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

            <label id="optionsCheckboxes">Show it in index?</label>
            <div class="input">
              <ul class="inputs-list">
                <li>
                  <label>
                    <input type="checkbox" name="indexed" id="indexed" value="true" />
                  </label>
                </li>
              </ul>
            </div>
</div>
<div class="clearfix">

            <label id="optionsCheckboxes">Add date to page?</label>
            <div class="input">
              <ul class="inputs-list">
                <li>
                  <label>
                    <input type="checkbox" name="dated" id="dated" value="true" />
                  </label>
                </li>
              </ul>
            </div>
</div>
<div class="clearfix">
	<label for="textarea">Text</label>
	<div class="input">
		<? 
		$config['toolbar'] = array(
		array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
		array( 'Image', 'Link', 'Unlink', 'Anchor' )
		);
		$this->editor->editor("text", "", $config); ?>
		<span class="help-block">
			This can be in html or raw text.
		</span>
	</div>
</div>

<input class="btn success" type="submit" name="add" value="Add" />
</form>