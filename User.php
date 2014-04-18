<?php

class User {

  function attempt_login($username, $plaintext_password, $connection) {
    echon("function: User->attempt_login");

    $user = $this->get_user_from_db($username, $connection);
    $verified = $this->verify_user($user, $plaintext_password);

    if ($verified) {
      echon("User verified! Logging in.");
      $_SESSION['logged_in'] = true;
    } else {
      echon("User not verified! Not logging in.");
      $_SESSION['logged_in'] = false;
    }
  }

  function get_user_from_db($username){

    echon("function: User->get_user_from_db");

    $user_statement = $connection->prepare("SELECT * FROM users WHERE username=?");
    $user_statement->bind_param('s', $username);
    $user_statement->execute();
    $result = $user_statement->get_result();
    $user = $result->fetch_assoc();

    return $user;

  }

/*  function get_secured_password($username){

    $connection = Database::get_database();
    echon("function: User->get_secured_password");
    echon("username to retrieve password of: $username");

    $password_statement = $connection->prepare("SELECT password FROM users WHERE username=?");
    $password_statement->bind_param('s', $username);
    $password_statement->execute();
    $password_statement->bind_result($secure_password);
    $password_statement->fetch();

    echon("password: " . $secure_password );
    }*/

  function verify_user($user, $plaintext_password){
    echon("function: User->verify_user");

    $secure_password = $user['password'];
    $verified = password_verify($plaintext_password, $secure_password);
    return $verified;
  }

  function set_password($username, $plaintext_password){
    echon("function: User->set_password");
    echon("username to update is " . $username);

    $secure_password = $this->encrypt_password($plaintext_password);
    Database::set_field("users", array("password"=>$secure_password),array("username"=>$username));

    $this->get_secured_password($username, $connection);
  }

  function encrypt_password($plaintext_password){
    echon("function: User->encrypt_password");

    $hash = password_hash($plaintext_password, PASSWORD_DEFAULT);
    echon("hashed password: " . $hash );
    return $hash;
  }
}
