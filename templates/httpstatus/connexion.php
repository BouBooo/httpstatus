<form action="" method="POST">
	<input type="text" name="email" placeholder="Email">
	<input type="password" name="password" placeholder="Password">

	<input type="submit" name="connect" value="Connexion">

	<?php
	if($_SESSION['log_error'])
	{
		echo $log_error;
	}
	?>



</form>