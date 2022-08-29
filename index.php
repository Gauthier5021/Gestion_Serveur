<!DOCTYPE html>

    <html lang="fr">

      <body>
      
      <!-- Barre de navigation -->
      <?php include("Nav/nav.php"); ?>

        <div class="InformationSysteme">
          <h2 class="TitreInfoSysGen">Information Systeme Generale</h2><br />
          <?php echo SystemGen(); ?>
        </div>

        <div class="PingSystem">
          <form class="Form" method="POST">
            <h2 class="TitrePing">Vérification de communication</h2><br />
              <h3 class="TitreOperateur">Opérateur</h3>
                <select class="Operateur" name="Operateur">
                  <option value="Orange">Orange</option>
                  <option value="Free">Free</option>
                  <option value="Sfr">Sfr</option>
                  <option value="Bouygues">Bouygues</option>
                </select><br />
                <input type="submit" class="PingOp" name="PingOp" value="Verifier l'opérateur" /><br />
                  <?php echo PingFai(); ?>
              <h3 class="TitreHebergeurServ">Hebergeur</h3><br />
                <select class="Hebergeur" name="Hebergeur">
                  <option value="Ovh">Ovh</option>
                  <option value="Hostinger">Hostniger</option>
                  <option value="Informaniak">Informaniak</option>
                  <option value="GoDaddy">GoDaddy</option>
                </select><br />
                <input type="submit" class="PingHbg" name="PingHbg" value="Verifier L'hebergeur" /><br />
                  <?php echo PingHbg(); ?>
              <h3 class="TitrePingPerso">Personnaliser</h3><br />
                <input type="text" class="IpText" name="IpText" placeholder="ex : 192.168.1.1" /><br />
                <input type="submit" class="PingPersoIp" name="PingPersoIp" value="Verifier L'IP" />
                  <p class="ParagrapheOu">Ou</p>
                <input type="text" class="DomaineText" name="DomaineText" placeholder="ex : example.com" /><br />
                <input type="submit" class="PingPersoDomaine" name="PingPersoDomaine" value="Verifier Le Domaine" />
                  <?php echo PingPersoIpEtDomaine(); ?>
          </form>
        </div>

        <h1 class="Test">Test</h1>

        <!-- Le Fichier JS -->
        <script src="index.js"></script>

      </body>

    </html>