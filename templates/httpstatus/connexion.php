<?php \controllers\internals\Incs::head('Httpstatus'); ?>
<?php \controllers\internals\Incs::nav('Httpstatus'); ?>


<div class="container">
		<a href="./" class="btn btn-dark">Retour</a>
	    <br>
	    <br>
	<form method="POST" action="">

		<table class="table table-striped">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">Email</th>
		      <th scope="col">Password</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr>
		      <td>
		      	<input type="text" name="email" placeholder="Email"/>
		      </td>
		      <td>
		      	<input type="password" name="password" placeholder="Password"/>
		      </td>
		      <td>
		      	<input type="submit" name="connect" value="Connexion"/>
			  </td>
		    </tr>
		  </tbody>
		</table>
	<?php
	if($_SESSION['log_error'])
	{
		echo $_SESSION['log_error'];
	}
	?>
</div>
