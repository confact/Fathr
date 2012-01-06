
    <table class="zebra-striped">
    	<thead>
    	<tr><th>Name</th><th>URL</th><th>Actions</th></tr>
    	</thead>
    	<? 	
    	while($row = mysql_fetch_array($fathr->controller->menulist))
		{
			?><tr><td><?=$row[1]?></td><td><?=$row[2]?></td><td><a href="<?="/".$fathr->controller->config['sitepath']."/fathr_admin/doMenuDelete/".$row[0]?>">Delete</a> - Update</td></tr><?
		}?>
    	
    </table>