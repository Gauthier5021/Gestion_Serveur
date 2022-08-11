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
    $Memory = "Memory : " . shell_exec("free -g | grep Mem | cut -c 20");
    $HardDiskSpaceFree = "Space Free Disk : " . shell_exec("df -h /dev/sda1 | grep /dev/sda1 | cut -c 18-20");
    $HardDiskUse = "Use Space Disk : " . shell_exec("df -h /dev/sda1 | grep /dev/sda1 | cut -c 35-37");
    $BackLine = "<br />";
    $Result = $Hostname . $BackLine . $Uptime . $BackLine . $IpHost . $BackLine . $IpDiff . $BackLine . $Os . $BackLine . $Memory . $BackLine . $HardDiskSpaceFree . $BackLine . $HardDiskUse;
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

// Installation Programme
function Upgrade()
{
    $Upgrade = shell_exec("apt-get upgrade");
}

function InstallationProgramme()
{
    $PareFeu = "ufw";
    $Ftp = "Proftpd";
    $InstallCommande = shell_exec("apt-get -y install $PareFeu");
    
    if ($_POST["Tst"])
    {
        return $InstallCommande;
    }
}

// Log
function LogInfo()
{
    $UserConnect = shell_exec("w | grep up") . "<br />" . shell_exec("w | grep pts");
    $Log = shell_exec("ps -ef");
    $Result = "<h2>Connection Utilisateur</h2><br />" . $UserConnect . "<h2>Activité Précédentes</h2><br />" . "$Log" . "<br />";
    return $Result; 
}

?>