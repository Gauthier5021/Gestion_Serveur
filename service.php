<!-- Barre de navigation -->
<?php include("nav.php"); ?>

<form class="Form" method="POST">

  <!-- Mise à jour Systeme -->
  <h1 class="TitreMiseAJourSystem">Mise à jour</h1>
    <input type="submit" class="MiseAJour" name="MiseAJour" value="Mettre à jour" /><br />
    <?php echo Upgrade(); ?>

  <!-- Installation Programms -->
  <h1 class="TitreInstallationProgramme">Installations des programmes</h1><br />
    <label>Installer Tous Les Programmes :<input type="checkbox" name="AllPackages" class="AllPackages" /></label><br />
    <label>Moniteur Systemes :<input type="checkbox" name="Htop" class="Htop" /></label><br />
    <label>Décompresseur ZIP :<input type="checkbox" name="Unzip" class="Unzip" /></label><br />
    <label>FTP :<input type="checkbox" name="Ftp" class="Ftp" /></label><br />
    <label>Pare Feu :<input type="checkbox" name="PareFeu" class="PareFeu" /></label><br />
    <label>Récuperateur de lien Fichier :<input type="checkbox" name="Curl" class="Curl" /></label><br />
    <input type="submit" name="InstallerProg" class="InstallerProg" value="Installer" /><br />
    <?php echo InstallProgrammBasic(); ?>


</form>