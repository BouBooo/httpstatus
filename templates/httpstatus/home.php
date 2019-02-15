<?php \controllers\internals\Incs::head('Httpstatus'); ?>
    <h1>Httpstatus</h1>
	<p>This is a page without arguments.</p>

	<a href="./add"><h5>Ajouter un site</h5></a>
	<?php 
		foreach($sites as $site)
		{
			echo $site['url'];
			echo '<br>';
		}






	?>

<?php \controllers\internals\Incs::footer(); ?>
