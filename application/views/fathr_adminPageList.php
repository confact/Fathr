    <table class="zebra-striped">
    	<thead>
    	<tr><th>Name</th><th>Headline</th><th>Added</th><th>Actions</th></tr>
    	</thead>
    	<? 	
    	while($row = mysql_fetch_array($fathr->controller->pagelist))
		{
			?><tr><td><?=$row[1]?></td><td><?=$row[2]?></td><td><? echo date('Y-m-d h:m:s', $row[6]); ?></td><td><a href="<?="/".$fathr->controller->config['sitepath']."fathr_admin/doPageDelete/".$row[0]?>">Delete</a> - <a href="<?="/".$fathr->controller->config['sitepath']."fathr_admin/pageEdit/".$row[0]?>">Edit</a></td></tr><?
		}?>
    	
    </table>
    <a class="btn primary" href="<?="/".$fathr->controller->config['sitepath']."fathr_admin/pageAdd"?>">Add new Page</a>