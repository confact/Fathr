
        <? 
    	global $fathr;
    	?>
        <form action="/fathr/fathr_admin/doLogin/" method="post">
			<div class="clearfix">
              <div class="input-prepend">
                <span class="add-on">Site name</span>
                <input class="medium" id="sitename" name="sitename" size="16" type="text" value="<?    	global $fathr; echo $fathr->controller->settings['sitename']; ?>" />
              </div>
            </div>
            <div class="clearfix">
            <div class="input-prepend">
                <span class="add-on">url</span>
                <input class="medium" id="url" name="url" size="16" type="text" value="<?    	global $fathr; echo $fathr->controller->settings['url']; ?>" />
            </div>
            </div>
             <div class="clearfix">
            <div class="input-prepend">
                <span class="add-on">theme</span>
                <input class="medium" id="theme" name="theme" size="16" type="text" value="<?    	global $fathr; echo $fathr->controller->settings['theme']; ?>" />
            </div>
            </div>
            <input class="btn success" type="submit" name="Update" value="Update" />
            </form>