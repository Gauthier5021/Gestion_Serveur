<head>
 <meta name="author" content="BARAS Gauthier" />
 <meta charset="utf-8" />
 <title>Autosun</title>
 <link href="Css/index.css" rel="stylesheet" />
</head>

<!-- Fichier Fonction PHP -->
<?php include("fonction.php"); ?>

<div class="sidebar">
  <ul class="NavBar">
    <li>
      <form method="POST" class="SearchNav">
        <img src="Icon/BarreNav/search-alt-2-regular-24.png" class="IconNavLien" />
        <input type="text" class="SearchNav" name="SearchNav" placeholder="rechercher" />
      </form>
    </li>
    <li>
      <a href="index.php">
        <img src="Icon/BarreNav/dashboard-solid-24.png" class="IconNavLien" />
        <span class="links_name">Dashboard</span>
      </a>
    </li>
    <li>
      <a href="information.php">
        <img src="Icon/BarreNav/desktop-regular-24.png" class="IconNavLien" />
        <span class="links_name">Information Systeme</span>
      </a>
    </li>
    <li>
      <a href="log.php">
        <img src="Icon/BarreNav/notepad-regular-24.png" class="IconNavLien" />
        <span class="links_name">Logs Systeme</span>
      </a>
    </li>
    <li>
      <a href="service.php">
        <img src="Icon/BarreNav/server-regular-24.png" class="IconNavLien" />
        <span class="links_name">Service</span>
      </a>
    </li>
    <li>
      <a href="security.php">
        <img src="Icon/BarreNav/lock-alt-regular-24.png" class="IconNavLien" />
        <span class="links_name">Sécurité</span>
      </a>
    </li>
  </ul>
</div>