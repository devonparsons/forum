<?php
   echo "testing php 2\n";
   echo "<pre>";
  try{
    $mysqli = new mysqli('localhost', 'root', '1dream', 'forum');

    print_r($mysqli);


    $insert_query = "INSERT INTO users (username, password) VALUES (user1, pass1)";
    $mysqli->query($insert_query);
    $mysqli->commit();

  } catch (exception $e) {

  }

?>