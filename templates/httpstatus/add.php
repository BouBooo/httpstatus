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
		      	<input type="text" name="name" placeholder="Name"/>
		      </td>
		      <td>
		      	<input type="text" name="url" placeholder="Url"/>
		      </td>
		      <td>
		      	<input type="submit" name="add" value="Add"/>
			  </td>
		    </tr>
		  </tbody>
		</table>
			<?php 
			if(!empty($_SESSION['add_error']))
			{
				echo $_SESSION['add_error'];
			}
			?>
</div>



	
	
	
</form>