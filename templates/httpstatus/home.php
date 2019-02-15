<?php \controllers\internals\Incs::head('Httpstatus'); ?>
    <h1>Httpstatus</h1>
	<p>This is a page without arguments.</p>
	<?php 
		foreach($sites as $site)
		{
			echo $site['url'];
		}






	?>

<?php \controllers\internals\Incs::footer(); ?>
