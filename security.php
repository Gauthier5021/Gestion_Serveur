<!-- Barre de navigation -->
<?php include("nav.php"); ?>

<form class="Form" method="POST">

    <h1 class="TitreServiceAutoriser">Service Autoriser</h1><br />
    <!-- Service Autoriser Ou Refuser -->
    <select class="ConditionService" name="ConditionService">
        <option value="Autoriser">Autoriser</option>
        <option value="Refuser">Refuser</option>
    </select><br />
    <label>Ssh :<input type="checkbox" class="Ssh" name="Ssh" /></label><br />
    <label>Http :<input type="checkbox" class="Http" name="Http" /></label><br />
    <label>Https :<input type="checkbox" class="Https" name="Https" /></label><br />
    <label>Ftp :<input type="checkbox" class="FtpPareFeu" name="FtpPareFeu" /></label><br />
    <label>Sftp :<input type="checkbox" class="SftpPareFeu" name="SftpPareFeu" /></label><br />
    <label>Dns :<input type="checkbox" class="DnsPareFeu" name="DnsPareFeu" /></label><br />
    <label>Smtp :<input type="checkbox" class="Smtp" name="Smtp" /></label><br />
    <label>Pop3 :<input type="checkbox" class="Pop3" name="Pop3" /></label><br />
    <label>Imap :<input type="checkbox" class="Imap" name="Imap" /></label><br />

    <input type="submit" class="BoutonPareFeu" name="BoutonPareFeu" value="Confirmer" /><br />
    <?php echo PareFeu(); ?>

</form>