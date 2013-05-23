	<? 	
    foreach($fathr->controller->menulistmodal->getArray() as $row)
	{?>
	<div id="modal-update<?=$row[0]?>" class="modal hide fade">
            <div class="modal-header">
              <a href="#" class="close">&times;</a>
              <h3>Edit menu item</h3>
            </div>
            <div class="modal-body">
			<form action="/" method="post" id="modal-update-form<?=$row[0]?>">
			<div class="clearfix">
              <div class="input-prepend">
                <span class="add-on">name</span>
                <input class="medium" id="name<?=$row[0]?>" name="name" size="16" type="text" value="<?=$row[1]?>" />
              </div>
            </div>
            <div class="clearfix">
            <div class="input-prepend">
                <span class="add-on">url</span>
                <input class="medium" id="url<?=$row[0]?>" name="url" size="16" type="text" value="<?=$row[2]?>" />
            </div>
            </div>
				
            </div>
            <div class="modal-footer">
              <input class="btn success" type="submit" name="edit" id="modal-submit<?=$row[0]?>" value="Edit" />
            </div>
            </form>
    </div>
    <script>
  	$("#modal-update-form<?=$row[0]?>").submit(function(event) {
  			event.preventDefault();
  			var name = $("#name<?=$row[0]?>").val();
			var url = $("#url<?=$row[0]?>").val();
			var dataString = 'name='+ name + '&url=' + url;
			$.ajax({
			type: "POST",
			url: "<?='/'.$fathr->controller->config['sitepath'].'fathr_admin/doMenuUpdate/'.$row[0]?>",
			data: dataString,
			success: function(){
  				$('#modal-update<?=$row[0]?>').modal('hide');
  				    $('#modal-update<?=$row[0]?>').bind('hidden', function () {
    					location.reload();
    				})
			}});
		});
    </script>
    <?
    }
    ?>
    <table class="zebra-striped">
    	<thead>
    	<tr><th>Name</th><th>URL</th><th>Actions</th></tr>
    	</thead>
    	<? 	
    	foreach($fathr->controller->menulist->getArray() as $row)
		{
			?><tr><td><?=$row["names"]?></td><td><?=$row["url"]?></td><td><a href="<?="/".$fathr->controller->config['sitepath']."fathr_admin/doMenuDelete/".$row["id"]?>">Delete</a> - <a href="#" data-controls-modal="modal-update<?=$row[0]?>" data-backdrop="true" data-keyboard="true">Update</a></td></tr><?
		}?>
    	
    </table>