<?php
include 'include.php';

echon("<pre>");

include 'User.php';
$user = new User();
$mysqli = new mysqli('localhost', 'root', 'dbpass', 'forum');

if ($mysqli->connect_errno) {
    printf("Connect failed: %s", $mysqli->connect_error);
    exit();
}


if (isset($_POST['username']) && (strlen($_POST['username']) > 0) ){
  if (isset($_POST['new_password']) && (strlen($_POST['new_password']) > 0)){
    echon("Setting a new password");
    echon("password to set is " . $_POST['new_password']);
    $user->set_password($_POST['username'], $_POST['new_password'], $mysqli);
  } else {
    $user->attempt_login($_POST['username'], $_POST['password'], $mysqli);
  }
} else {
  echon("username must have been unset or empty: " . $_POST['username']);
  include 'login-form.html';
}