<?php

// Information System
function SystemGen()
{
    $Hostname = "Name Server : " . shell_exec("hostname");
    $Uptime = "Time Running : " . shell_exec("uptime | cut -c 13-18");
    $IpHost = "Ip System : " . shell_exec("ip a | grep ens18 | grep inet | cut -c 10-27");
    /* $IpNetwork = "Ip Network : "  shell_exec("") <- En attente d'une commande shell ; */
    $IpDiff = "Ip Diffusion : " . shell_exec("ip a | grep ens18 | grep inet | cut -c 33-48");
    $Os = "Os : " . shell_exec("uname -a | cut -c 38-55");
    $CpuModel = "Name CPU  : " . shell_exec("lscpu | grep Model | grep name | cut -c 34-60");
    $Core = "Core : " . shell_exec("lscpu | grep Core | cut -c 34");
    $Memory = "Memory : " . shell_exec("free -g | grep Mem | cut -c 20");
    $HardDiskSpaceFree = "Space Free Disk : " . shell_exec("df -h /dev/sda1 | grep /dev/sda1 | cut -c 18-20");
    $HardDiskUse = "Use Space Disk : " . shell_exec("df -h /dev/sda1 | grep /dev/sda1 | cut -c 35-37");
    $BackLine = "<br />";
    $Result = $Hostname . $BackLine . $Uptime . $BackLine . $IpHost . $BackLine . $IpDiff . $BackLine . $Os . $BackLine . $CpuModel . $BackLine . $Core . $Memory . $BackLine . $HardDiskSpaceFree . $BackLine . $HardDiskUse;
    return $Result;
}
function Cpu()
{
    $CpuModel = "Name CPU  : " . shell_exec("lscpu | grep Model | grep name | cut -c 34-60");
    $Architecture = "Architecture : " . shell_exec("lscpu | grep Architecture | cut -c 34-40");
    $Bits = "Bits : " . shell_exec("lscpu | grep CPU | grep op-mode | cut -c 34-47");
    $Ghz = "Ghz : " . shell_exec("lscpu | grep CPU | grep MHz | cut -c 34-45");
    $Core = "Core : " . shell_exec("lscpu | grep Core | cut -c 34");
    $Threads = "Threads : " . shell_exec("lscpu | grep Thread | cut -c 34");
    $Socket = "Socket : " . shell_exec("lscpu | grep Socket | cut -c 34");
    $BackLine = "<br />";
    $Result = $CpuModel . $BackLine . $Architecture . $BackLine . $Bits . $BackLine . $Ghz . $BackLine . $Core . $BackLine . $Threads . $BackLine . $Socket;
    return $Result;
}

// Seuil d'utilisation du CPU et mémoire
function MemorySeuil()
{
    $UseMem = shell_exec("free -m | grep Mem | cut -c 28-35");
    $Memory = round($UseMem);
    
    if ($Memory > 2000)
    {
        return "You are exceed the size memory";
    }
}
function CpuSeuil()
{
    $Task = shell_exec("cat /proc/stat | grep processes | cut -c 11-1000");
    #$Utime = shell_exec("cat /proc/uptime | cut -c 1-9");
    #$Stime = shell_exec("cat /proc/uptime | cut -c 10-30");
}

// Ping vers les FAI et Hebergements Serveurs
function PingFai()
{
    $Orange = shell_exec("ping -c 1 193.252.117.145 | grep 64 | cut -c 15-150");
    $Free = shell_exec("ping -c 1 212.27.48.10 | grep 64 | cut -c 15-150");
    $Sfr = shell_exec("ping -c 1 80.125.163.172 | grep 64 | cut -c 15-150");
    $Bouygues = shell_exec("ping -c 1 194.158.122.212 | grep 64 | cut -c 15-150");

    if ($_POST["Operateur"] == "Orange" && $_POST["PingOp"])
    {
        $Result = "<br />" . $Orange;
        return $Result;
    }
    elseif ($_POST["Operateur"] == "Free" && $_POST["PingOp"])
    {
        $Result = "<br />" . $Free;
        return $Result;
    }
    elseif ($_POST["Operateur"] == "Sfr" && $_POST["PingOp"])
    {
        $Result = "<br />" . $Sfr;
        return $Result;
    }
    elseif ($_POST["Operateur"] == "Bouygues" && $_POST["PingOp"])
    {
        $Result = "<br />" . $Bouygues;
        return $Result;
    }
}
function PingHbg()
{
    $Ovh = shell_exec("ping -c 1 ovhcloud.com | grep 64 | cut -c 26-150");
    $Hostinger = shell_exec("ping -c 1 hostinger.fr | grep 64 | cut -c 29-150");
    $Informaniak = shell_exec("ping -c 1 infomaniak.com | grep 64 | cut -c 48-150");
    $GoDaddy = shell_exec("ping -c 1 godaddy.com | grep 64 | cut -c 53-150");

    if ($_POST["Hebergeur"] == "Ovh" && $_POST["PingHbg"])
    {
        $Result = "<br />" . $Ovh;
        return $Result;
    }
    elseif ($_POST["Hebergeur"] == "Hostinger" && $_POST["PingHbg"])
    {
        $Result = "<br />" . $Hostinger;
        return $Result;
    }
    elseif ($_POST["Hebergeur"] == "Informaniak" && $_POST["PingHbg"])
    {
        $Result = "<br />" . $Informaniak;
        return $Result;
    }
    elseif ($_POST["Hebergeur"] == "GoDaddy" && $_POST["PingHbg"])
    {
        $Result = "<br />" . $GoDaddy;
        return $Result;
    }
}

function PingPersoIpEtDomaine()
{
    // Text Saisie
    $Ip = $_POST["IpText"];
    $Domaine = $_POST["DomaineText"];
    
    // Commande Linux
    $PingIp = shell_exec("ping -c 1 $Ip | grep 64 | cut -c 15-150");
    $PingDomaine = shell_exec("ping -c 1 $Domaine | grep 64");

    // Condition
    if ($_POST["PingPersoIp"])
    {
        $Result = "<br />" . $PingIp;
        return $Result;
    }
    elseif ($_POST["PingPersoDomaine"])
    {
        $Result = "<br />" . $PingDomaine;
        return $Result;
    }
}

// Mise à jour et Installation Programme
function Upgrade()
{
    // Connection SSH
    $Connect = ssh2_connect('192.168.159.172', 22);
    ssh2_auth_password($Connect, 'root', 'root');

    // Mise à jour
    if ($_POST['MiseAJour'])
    {
        $Commande = 'apt upgrade';
        $Upgrade = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Upgrade, true);
        $Result = ssh2_fetch_stream($Upgrade, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
}
function InstallProgrammBasic()
{
    // Connection SSH
    $Connect = ssh2_connect('192.168.159.172', 22);
    ssh2_auth_password($Connect, 'root', 'root');

    // Installation Programme
    if ($_POST['InstallerProg'] && $_POST['AllPackages'])
    {
        $Programme = 'htop unzip proftpd ufw curl';
        $PortFtp = 'ufw allow 21';
        $Commande = "apt install -y htop $Programme && $PortFtp";
        $Install = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Install, true);
        $Result = ssh2_fetch_stream($Install, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['InstallerProg'] && $_POST['Htop'] && $_POST['Unzip'] && $_POST['Ftp'] && $_POST['PareFeu'] && $_POST['Curl'])
    {
        $Programme = 'htop unzip proftpd ufw curl';
        $PortFtp = 'ufw allow 21';
        $Commande = "apt install -y $Programme && $PortFtp";
        $Install = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Install, true);
        $Result = ssh2_fetch_stream($Install, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['InstallerProg'] && $_POST['Htop'] && $_POST['Unzip'] && $_POST['Ftp'] && $_POST['PareFeu'])
    {
        $Programme = 'htop unzip proftpd ufw';
        $PortFtp = 'ufw allow 21';
        $Commande = "apt install -y $Programme && $PortFtp";
        $Install = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Install, true);
        $Result = ssh2_fetch_stream($Install, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['InstallerProg'] && $_POST['Htop'] && $_POST['Unzip'] && $_POST['Ftp'])
    {
        $Programme = 'htop unzip proftpd';
        $Commande = "apt install -y $Programme";
        $Install = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Install, true);
        $Result = ssh2_fetch_stream($Install, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['InstallerProg'] && $_POST['Htop'] && $_POST['Unzip'])
    {
        $Programme = 'htop unzip';
        $Commande = "apt install -y $Programme";
        $Install = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Install, true);
        $Result = ssh2_fetch_stream($Install, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['InstallerProg'] && $_POST['Htop'])
    {
        $Programme = 'htop';
        $Commande = "apt install -y $Programme";
        $Install = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Install, true);
        $Result = ssh2_fetch_stream($Install, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['InstallerProg'] && $_POST['Unzip'])
    {
        $Programme = 'unzip';
        $Commande = "apt install -y $Programme";
        $Install = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Install, true);
        $Result = ssh2_fetch_stream($Install, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['InstallerProg'] && $_POST['Ftp'])
    {
        $Programme = 'proftpd';
        $Commande = "apt install -y $Programme";
        $Install = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Install, true);
        $Result = ssh2_fetch_stream($Install, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['InstallerProg'] && $_POST['PareFeu'])
    {
        $Programme = 'ufw';
        $Commande = "apt install -y $Programme";
        $Install = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Install, true);
        $Result = ssh2_fetch_stream($Install, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['InstallerProg'] && $_POST['Curl'])
    {
        $Programme = 'curl';
        $Commande = "apt install -y $Programme";
        $Install = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Install, true);
        $Result = ssh2_fetch_stream($Install, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
}
function LAMPP()
{
    // Connection SSH
    $Connect = ssh2_connect('192.168.159.172', 22);
    ssh2_auth_password($Connect, 'root', 'root');
    
    // Les dépendences
    $Apache2 = 'apache2';
    //$Mysql = 'maria-server'; -> A changer le SGBD en MYSQL
    $PHP = 'php';
    $ModulePhp = 'libapache2-mod-php';
    $PareFeu = 'ufw';
    $PortWeb_Http = "ufw allow 80";
    $PortWeb_Https = "ufw allow 443";
    $ExtensionPhp = 'php-mysql php-curl php-gd php-mbstring php-xml php-xmlrpc php-soap php-intl php-zip';
    $ConditionPareFeu = $_POST['ConditionPareFeuHttp'];
    
    if ($ConditionPareFeu == "Oui" && $_POST['InstallerLampp'])
    {
        $Commande = "apt install -y $Apache2 $PHP $ModulePhp $PareFeu $ExtensionPhp && $PortWeb_Http && $PortWeb_Https";
        $Lampp = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Lampp, true);
        $Result = ssh2_fetch_stream($Lampp, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display; 
    }
    elseif ($ConditionPareFeu == "Non" && $_POST['InstallerLampp'])
    {
        $Commande = "apt install -y $Apache2 $PHP $ModulePhp $PareFeu $ExtensionPhp";
        $Lampp = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Lampp, true);
        $Result = ssh2_fetch_stream($Lampp, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display; 
    }
}

// Log
function LogInfoUser()
{
    $UserConnect = shell_exec("w | grep up") . "<br />" . shell_exec("w | grep pts");
    $Result = "<h2>Connection Utilisateur</h2><br />" . $UserConnect;
    return $Result;  
}
function LogInfoSystem()
{
    $InfoSystem = shell_exec("ps -ef");
    $Result = "<h2>Taches Précédentes</h2><br />" . "<br />" . $InfoSystem;
    return $Result;  
}

// La sécurité
function DisplayPareFeu()
{
    //Connection Ssh
    $Connect = ssh2_connect('192.168.159.172', 22);
    ssh2_auth_password($Connect, 'root', 'root');

    if ($_POST['BoutonDisplayPareFeu'])
    {
        $Commande = "ufw status verbose";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
}
function PareFeuServiceYes()
{
    //Connection Ssh
    $Connect = ssh2_connect('192.168.159.172', 22);
    ssh2_auth_password($Connect, 'root', 'root');
    
    // Port De Communication Autoriser
    $Ssh = "22";
    $Http = "80";
    $Https = "443";
    $Ftp = "21";
    $Sftp = "115";
    $Dns = "53";
    $Smtp = "25";
    $Pop3 = "110";
    $Imap = "143";
    $Ldap = "389";
    $Mysql = "3306";

    // Condition pour le parefeu
    if ($_POST['ConditionPareFeu'] == "Autoriser" && $_POST['Ssh'] && $_POST['BoutonPareFeuAdd'])
    {
        $Commande = "ufw allow $Ssh";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['ConditionPareFeu'] == "Autoriser" && $_POST['Http'] && $_POST['BoutonPareFeuAdd'])
    {
        $Commande = "ufw allow $Http";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['ConditionPareFeu'] == "Autoriser" && $_POST['Https'] && $_POST['BoutonPareFeuAdd'])
    {
        $Commande = "ufw allow $Https";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['ConditionPareFeu'] == "Autoriser" && $_POST['FtpPareFeu'] && $_POST['BoutonPareFeuAdd'])
    {
        $Commande = "ufw allow $Ftp";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['ConditionPareFeu'] == "Autoriser" && $_POST['SftpPareFeu'] && $_POST['BoutonPareFeuAdd'])
    {
        $Commande = "ufw allow $Sftp";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['ConditionPareFeu'] == "Autoriser" && $_POST['DnsPareFeu'] && $_POST['BoutonPareFeuAdd'])
    {
        $Commande = "ufw allow $Dns";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['ConditionPareFeu'] == "Autoriser" && $_POST['Smtp'] && $_POST['BoutonPareFeuAdd'])
    {
        $Commande = "ufw allow $Smtp";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['ConditionPareFeu'] == "Autoriser" && $_POST['Pop3'] && $_POST['BoutonPareFeuAdd'])
    {
        $Commande = "ufw allow $Pop3";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['ConditionPareFeu'] == "Autoriser" && $_POST['Imap'] && $_POST['BoutonPareFeuAdd'])
    {
        $Commande = "ufw allow $Imap";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['ConditionPareFeu'] == "Autoriser" && $_POST['Ldap'] && $_POST['BoutonPareFeuAdd'])
    {
        $Commande = "ufw allow $Ldap";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['ConditionPareFeu'] == "Autoriser" && $_POST['Mysql'] && $_POST['BoutonPareFeuAdd'])
    {
        $Commande = "ufw allow $Mysql";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
}
function PareFeuServiceNo()
{
    //Connection Ssh
    $Connect = ssh2_connect('192.168.159.172', 22);
    ssh2_auth_password($Connect, 'root', 'root');
    
    // Port De Communication Autoriser
    $Ssh = "22";
    $Http = "80";
    $Https = "443";
    $Ftp = "21";
    $Sftp = "115";
    $Dns = "53";
    $Smtp = "25";
    $Pop3 = "110";
    $Imap = "143";
    $Ldap = "389";
    $Mysql = "3306";

    // Condition pour le parefeu
    if ($_POST['ConditionPareFeu'] == "Refuser" && $_POST['Ssh'] && $_POST['BoutonPareFeuAdd'])
    {
        $Commande = "ufw deny $Ssh";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['ConditionPareFeu'] == "Refuser" && $_POST['Http'] && $_POST['BoutonPareFeuAdd'])
    {
        $Commande = "ufw deny $Http";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['ConditionPareFeu'] == "Refuser" && $_POST['Https'] && $_POST['BoutonPareFeuAdd'])
    {
        $Commande = "ufw deny $Https";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['ConditionPareFeu'] == "Refuser" && $_POST['FtpPareFeu'] && $_POST['BoutonPareFeuAdd'])
    {
        $Commande = "ufw deny $Ftp";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['ConditionPareFeu'] == "Refuser" && $_POST['SftpPareFeu'] && $_POST['BoutonPareFeuAdd'])
    {
        $Commande = "ufw deny $Sftp";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['ConditionPareFeu'] == "Refuser" && $_POST['DnsPareFeu'] && $_POST['BoutonPareFeuAdd'])
    {
        $Commande = "ufw deny $Dns";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['ConditionPareFeu'] == "Refuser" && $_POST['Smtp'] && $_POST['BoutonPareFeuAdd'])
    {
        $Commande = "ufw deny $Smtp";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['ConditionPareFeu'] == "Refuser" && $_POST['Pop3'] && $_POST['BoutonPareFeuAdd'])
    {
        $Commande = "ufw deny $Pop3";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['ConditionPareFeu'] == "Refuser" && $_POST['Imap'] && $_POST['BoutonPareFeuAdd'])
    {
        $Commande = "ufw deny $Imap";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['ConditionPareFeu'] == "Refuser" && $_POST['Ldap'] && $_POST['BoutonPareFeuAdd'])
    {
        $Commande = "ufw deny $Ldap";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['ConditionPareFeu'] == "Refuser" && $_POST['Mysql'] && $_POST['BoutonPareFeuAdd'])
    {
        $Commande = "ufw deny $Mysql";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
}
function PareFeuIpYes()
{
    // Connection Ssh
    $Connect = ssh2_connect('192.168.159.172', 22);
    ssh2_auth_password($Connect, 'root', 'root');

    // Adresse IPV4 Privées Full Class Sous Réseaux
    $TypeA = "10.0.0.0/8";
    $TypeB1 = "172.16.0.0/16";
    $TypeB2 = "172.31.0.0/16";
    $TypeC = "192.168.1.0/24";

    // Condition
    if ($_POST['ConditionPareFeu'] == "Autoriser" && $_POST['IpTypeA'])
    {
        $Commande = "ufw allow from $TypeA";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['ConditionPareFeu'] == "Autoriser" && $_POST['IpTypeB1'])
    {
        $Commande = "ufw allow from $TypeB1";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['ConditionPareFeu'] == "Autoriser" && $_POST['IpTypeB2'])
    {
        $Commande = "ufw allow from $TypeB2";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['ConditionPareFeu'] == "Autoriser" && $_POST['IpTypeC'])
    {
        $Commande = "ufw allow from $TypeC";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
}
function PareFeuIpNo()
{
    // Connection Ssh
    $Connect = ssh2_connect('192.168.159.172', 22);
    ssh2_auth_password($Connect, 'root', 'root');

    // Adresse IPV4 Privées Full Class Sous Réseaux
    $TypeA = "10.0.0.0/8";
    $TypeB1 = "172.16.0.0/16";
    $TypeB2 = "172.31.0.0/16";
    $TypeC = "192.168.1.0/24";

    // Condition
    if ($_POST['ConditionPareFeu'] == "Refuser" && $_POST['IpTypeA'])
    {
        $Commande = "ufw deny from $TypeA";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['ConditionPareFeu'] == "Refuser" && $_POST['IpTypeB1'])
    {
        $Commande = "ufw deny from $TypeB1";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['ConditionPareFeu'] == "Refuser" && $_POST['IpTypeB2'])
    {
        $Commande = "ufw deny from $TypeB2";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
    elseif ($_POST['ConditionPareFeu'] == "Refuser" && $_POST['IpTypeC'])
    {
        $Commande = "ufw deny from $TypeC";
        $Ufw = ssh2_exec($Connect, $Commande);
        stream_set_blocking($Ufw, true);
        $Result = ssh2_fetch_stream($Ufw, SSH2_STREAM_STDIO);
        $Display = "<br />" . stream_get_contents($Result);
        return $Display;
    }
}
dzq

?>