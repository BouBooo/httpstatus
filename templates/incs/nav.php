<style>
#conteneur
{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    flex-wrap: wrap;
}
.element {
	width: 33%;
	padding: 10px;
}
a {
	color: white;
}
</style>

<?php
    if(!empty($_SESSION['admin']))
    {
        $nav_connect = '    <ul class="nav navbar-nav">
                                <li class="active"><a href="./admin">Admin Dashboard</a></li>
                            </ul>
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="./deconnexion">Deconnexion</a></li>
                            </ul>';
    }
    else
    {
        $nav_connect = '    <ul class="nav navbar-nav">
                                <li class="active"><a href="./connexion">Connexion</a></li>
                            </ul>';
    }




?>

<!-- NAV -->

 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="./">Httpstatus</a>
    </div>
    <?= $nav_connect; ?>

  </div>
</nav> 

