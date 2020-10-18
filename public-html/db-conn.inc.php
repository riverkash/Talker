<?php

  require('db-pswd.inc.php');

  try {
  $connection = new PDO('mysql:host=mysql;dbname=talker_db', DOCKER[0], DOCKER[1]);

  //print 'Success, connected to the talker_db database';
  }

  catch (PDOException $e) {
    print 'Error: ' . $e->getMessage() . '<br>';
    die();
  }
?>