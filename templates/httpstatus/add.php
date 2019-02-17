<?php \controllers\internals\Incs::head('Httpstatus'); ?>
<?php \controllers\internals\Incs::nav('Httpstatus'); ?>

    <h1>Httpstatus</h1>

    <a href="./">Retour</a>

<form method="POST" action="">

	<input type="text" name="name" placeholder="Name"/>
	<input type="text" name="url" placeholder="Url"/>
	<input type="submit" name="add" value="Add" />
</form>

	<?php 
	if(!empty($_SESSION['add_error']))
	{
		echo $_SESSION['add_error'];
	}
	?>

