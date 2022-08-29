<head>
 <meta name="author" content="BARAS Gauthier" />
 <meta charset="utf-8" />
 <title>Autosun</title>
 <link href="Css/index.css" rel="stylesheet" />
</head>

<!-- Fichier Fonction PHP -->
<?php include("fonction.php"); ?>

<form class="FormNav" method="POST">
  <div class="NavBar">
    <ul class="Nav">
      <li><a href="index.php" class="LienNav"><img src="Icon/BarreNav/icons8-groupe-de-serveurs-80.png" class="MainIconNav" /></a></li>
      <li class="SousNav"><a href="information.php" class="LienNav">Information Systeme</a></li>
      <li class="SousNav"><a href="log.php" class="LienNav">Logs Systeme</a></li>
      <li class="SousNav"><a href="service.php" class="LienNav">Service</a></li>
      <li class="SousNav"><a href="security.php " class="LienNav">Sécurité</a></li>
      <li class="SousNav"><img src="Icon/BarreNav/icons8-chercher-50.png" class="IconSearch" /><input type="text" class="Search" name="Search" placeholder="Recherche" /></li>
    </ul>
  </div>
</form> 