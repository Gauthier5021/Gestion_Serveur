<!-- Barre de navigation -->
<?php include("nav.php"); ?>

<form class="Form" method="POST">

  <input type="submit" class="Tst" name="Tst" value="Upgrade" />

  <?php //echo Upgrade(); ?>

  <?php

  //$Connect = ssh2_connect('');

  // Display Error
  ini_set('display_error', 1);
  ini_set('display_startup_error', 1);
  error_reporting(E_ALL);

  $connection = ssh2_connect('192.168.159.172', 22);
  ssh2_auth_password($connection, 'root', 'root');

  $stream = ssh2_exec($connection, 'cat /etc/log/syslog');
  stream_set_blocking($stream, true);
  $stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
  echo stream_get_contents($stream_out);
  
  ?>

</form>