    <table class="zebra-striped">
    	<thead>
    	<tr><th>Name</th><th>Headline</th><th>Added</th><th>Actions</th></tr>
    	</thead>
    	<? 	
    	foreach($fathr->controller->pagelist->getArray() as $row)
		{
			?><tr><td><?=$row["title"]?></td><td><?=$row["headline"]?></td><td><? echo date('Y-m-d h:m:s', $row["date"]); ?></td><td><a href="<?="/".$fathr->controller->config['sitepath']."fathr_admin/doPageDelete/".$row["id"]?>">Delete</a> - <a href="<?="/".$fathr->controller->config['sitepath']."fathr_admin/pageEdit/".$row["id"]?>">Edit</a></td></tr><?
		}?>
    	
    </table>
    <a class="btn primary" href="<?="/".$fathr->controller->config['sitepath']."fathr_admin/pageAdd"?>">Add new Page</a>