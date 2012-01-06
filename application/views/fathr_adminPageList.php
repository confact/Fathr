    <table class="zebra-striped">
    	<thead>
    	<tr><th>Name</th><th>Headline</th><th>Actions</th></tr>
    	</thead>
    	<? 	
    	while($row = mysql_fetch_array($fathr->controller->pagelist))
		{
			?><tr><td><?=$row[1]?></td><td><?=$row[2]?></td><td><a href="<?="/".$fathr->controller->config['sitepath']."/fathr_admin/pageDelete/".$row[0]?>">Delete</a> - Edit</td></tr><?
		}?>
    	
    </table>
    <a class="btn primary" href="<?="/".$fathr->controller->config['sitepath']."/fathr_admin/pageAdd"?>">Add new Page</a>