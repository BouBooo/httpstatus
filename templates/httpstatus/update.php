<?php \controllers\internals\Incs::head('Httpstatus'); ?>
<?php \controllers\internals\Incs::nav('Httpstatus'); ?>







<div class="container">
	    <a href="./admin" class="btn btn-dark">Retour</a>
	    <br>
	    <br>

	<form method="POST" action="">

		<table class="table table-striped">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">Nom</th>
		      <th scope="col">Url</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr>
		      <td>
		      	<input type="text" name="name" placeholder="Name" value="<?php 
		      	if(!empty($_POST['update']))
		      	{
		      		echo $_POST['name'];
		      	} 
		      	else
		      	{
		      		echo $name;
		      	} 
		      	?>"/>
		      </td>
		      <td>
		      	<input type="text" name="url" placeholder="Url" value="<?php 
		      	if(!empty($_POST['update']))
		      	{
		      		echo $_POST['url'];
		      	} 
		      	else
		      	{
		      		echo $url;
		      	} 
		      	?>"/>
		      </td>
		      <td>
		      	<input type="submit" name="update" value="Modifier"/>
			  </td>
		    </tr>
		  </tbody>
		</table>
			<?php 
			if(!empty($_SESSION['update_error']))
			{
				echo $_SESSION['update_error'];
			}
			?>

</div>

	
	
</form>