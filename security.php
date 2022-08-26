<!-- Barre de navigation -->
<?php include("nav.php"); ?>

<form class="Form" method="POST">

    <h1 class="TitreAffichagePareFeu">Règle Disponible</h1><br />
    <input type="submit" class="BoutonDisplayPareFeu" name="BoutonDisplayPareFeu" value="Afficher" /><br />
    <?php echo DisplayPareFeu(); ?><br />

    <!-- Service Autoriser Ou Refuser -->
    <h1 class="TitreServiceAutoriser">Service</h1><br />
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
    <label>Ldap :<input type="checkbox" class="Ldap" name="Ldap" /></label><br />
    <label>Mysql :<input type="checkbox" class="Mysql" name="Mysql" /></label><br />

    <h2 class="SousTitrePareFeuIp">Adresse Ip</h2><br />
    <select class="ConditionIp" name="ConditionIp">
        <option value="Autoriser">Autoriser</option>
        <option value="Refuser">Refuser</option>
    </select><br />
    <h3 class="SousTitreAdresseIpLan">Ip Privées</h3><br />
    <label>10.0.0.0 à 10.255.255.255 :<input type="checkbox" class="IpTypeA" name="IpTypeA" /></label><br />
    <label>172.16.0.0 à 172.31.255.255 :<input type="checkbox" class="IpTypeB" name="IpTypeB" /></label><br />
    <label>192.168.1.0 à 192.168.255.255 :<input type="checkbox" class="IpTypeC" name="IpTypeC" /></label><br />

    <input type="submit" class="BoutonPareFeuAdd" name="BoutonPareFeuAdd" value="Ajouter Cette Règle" /><br />
    
    <!-- Autorisation Service -->
    <?php echo PareFeuServiceYes(); ?>
    
    <!-- Refus -->
    <?php echo PareFeuServiceNo(); ?>

</form>