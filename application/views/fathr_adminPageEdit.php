<form action="<? echo '/'.$fathr->controller->config['sitepath'].'/fathr_admin/doPageUpdate/'.$fathr->controller->page['id']; ?>" method="post">
<div class="clearfix">
	<label for="title">Page's Title</label>
	<div class="input">
		<input class="xlarge" id="title" name="title" size="30" type="text" value="<?=$fathr->controller->page['title']?>" />
	</div>
</div>
<div class="clearfix">
	<label for="title">Page's Headline</label>
	<div class="input">
		<input class="xlarge" id="headline" name="headline" size="30" type="text" value="<?=$fathr->controller->page['headline']?>" />
	</div>
</div>
<div class="clearfix">

            <label id="optionsCheckboxes">Show it in index?</label>
            <div class="input">
              <ul class="inputs-list">
                <li>
                  <label>
                    <input type="checkbox" name="indexed" id="indexed" value="true" <? if($fathr->controller->page['indexed']) {echo 'checked="checked"';} ?> />
                  </label>
                </li>
              </ul>
            </div>
</div>
<div class="clearfix">

            <label id="optionsCheckboxes">Show posted date?</label>
            <div class="input">
              <ul class="inputs-list">
                <li>
                  <label>
                    <input type="checkbox" name="dated" id="dated" value="true" <? if($fathr->controller->page['dated']) {echo 'checked="checked"';} ?> />
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
		$this->editor->editor("text", $fathr->controller->page['text'], $config); ?>
		<span class="help-block">
			This can be in html or raw text.
		</span>
	</div>
</div>

<input class="btn success" type="submit" name="update" value="Update" />
</form>