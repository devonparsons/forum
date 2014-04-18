<?php
session_start();

include 'include.php';
include 'User.php';
include 'Database.php';
include 'header.html';

echon("<pre>");


$user = new User();
//$database = new Database();

$user1 = Database::get_row("users", array("username" => "user1"));


echon("\nlength of user1 is: " . sizeof($user1));


Database::set_fields("users",
  array( "firstname" => "test",
         "lastname"  => "testerson",
         "birthdate" => "1670-06-20"),
  array( "username"  => "user2"));

/*
if(isset($_POST['logout']) && $_POST['logout'] == true){
  session_destroy();
}

print_set_pre("Session logged in is: ", $_SESSION['logged_in']);

if(!isset($_SESSION['logged_in']) || ($_SESSION['logged_in'] != true)){

  if (isset($_POST['username']) && (strlen($_POST['username']) > 0) ){

    if (isset($_POST['new_password']) && (strlen($_POST['new_password']) > 0)){

      echon("Setting a new password");
      echon("password to set is " . $_POST['new_password']);
      $user->set_password($_POST['username'], $_POST['new_password']);
    } else {
      $user->attempt_login($_POST['username'], $_POST['password']);
    }
  } else {
    include 'login-form.html';
  }
} else {
  echon("You are already logged in");
  include 'logout-form.html';
}*/

Database::close_connection();