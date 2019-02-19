<?php \controllers\internals\Incs::head('Httpstatus'); ?>
<?php \controllers\internals\Incs::nav('Httpstatus'); ?>




<!-- CONTENT -->


<div class="container">
<div class="head" style="text-align:center">

	<h1> Home page </h1>





	<h3> Votre site de monitoring en ligne </h3>

		<a href="./add" class="btn btn-dark"><h5>Ajouter un site</h5></a>

</div>


<div id="conteneur">

	<?php 
		foreach($sites as $site)
		{
			echo '<div class="element">';
			echo '<div class="card  bg-success  text-white mb-3 website-card">';
			echo '<div class="card-header website-card-title">';
			echo '<h4>' . $site["name"] . '</h4>';
			echo '<h5><a target="_blank" href="'.$site["url"].'">'.$site["url"].'</a></h5>';
			echo '<div class="card-body">';
			echo '<div class="website-card-code">HTTP : '.$site['code'].'</div>';
			echo '<div class="website-card-icon">';
			echo '</div>';
			echo '</div>';
			echo '</div>';
			echo '<div class="card-footer">';
			echo '<a class="btn btn-lg btn-white" href="./view/'.$site['id'].'">Voir la fiche</a>
				  <a class="btn btn-lg btn-white" href="./update/'.$site['id'].'">Modifier</a>
				  <a class="btn btn-lg btn-white" href="./delete/'.$site['id'].'">Supprimer</a>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}






	?>

</div>

<?php \controllers\internals\Incs::footer(); ?>