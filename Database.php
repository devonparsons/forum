<?php

class Database {

  static protected $mysqli;

  static function init(){
     self::$mysqli = new mysqli('localhost', 'root', 'dbpass', 'forum');
  }

/*  static function get_instance() {
    echon("function: Database->get_instance");
      static $instance = null;
      if (null === $instance) {
          $instance = new static();
      }

      return $instance;
  }*/

  static function get_row($table, $conditions){
    echon("function: Database->get_row");
    $rows = Database::get_rows($table, $conditions);

    if (sizeof($rows) != 1) {
      echon("failed to return exactly 1 row");
    } else {
      return $rows[0];
    }
  }

  static function get_rows($table, $conditions){
    echon("function: Database->get_rows");
    if (sizeof($conditions) > 0) {

      $query_string = "SELECT * FROM " . $table . " WHERE ";
      foreach($conditions as $column => $value){
        $query_string .= $column . "='" . $value . "' AND ";
      }
       $query_string = substr($query_string, 0, -5);
       echon("query string is: $query_string");

       $rows_statement = self::$mysqli->prepare($query_string);
       $rows_statement->execute();
       $result = $rows_statement->get_result();
       $rows = [];
       foreach ($result as $row){
        $rows[] = $row;
       }
       return $rows;

      } else {
        echon("No conditions passed; consider using get_table");
      }
  }

  static function set_fields($table, $values, $conditions){
    echon("function: Database->set_field");

    $query_string = "UPDATE " . $table . " SET ";

    foreach($values as $column => $value){
      $query_string .= $column . "='" . $value . "', ";
    }
    $query_string = substr($query_string, 0, -2);
    $query_string .= " WHERE ";
    foreach($conditions as $column => $value){
      $query_string .= $column . "='" . $value . "' AND ";
    }
    $query_string = substr($query_string, 0, -5);
    echon("query string is : $query_string");

    $update_statement = self::$mysqli->prepare($query_string);
    $update_statement->execute();
  }

  static function close_connection(){
    echon("function: Database->close_connection");
    echon("testing new print_rn");
    print_rn(self::$mysqli);
    self::$mysqli->close();
  }

  static function delete_row($table, $conditions){
    echon("function: Database->delete_row");
    $query_string = "DELETE FROM " . $table . " WHERE ";
    foreach($conditions as $column => $value){
      $query_string .= $column . "='" . $value . "' AND ";
    }
    $query_string = substr($query_string, 0, -5);
    echon("query string is : $query_string");

    $delete_statement = self::$mysql->prepare($query_string);
    $delete_statement->execute();
  }

  static function insert_row($table, $values){
    echon("function: Database->insert_row");
    $query_string = "INSERT INTO " . $table . " VALUES ";
    foreach($values as $column => $value){
      $query_string .= $column . "='" . $value . "', ";
    }
    $query_string = substr($query_string, 0, -2);

    $insert_statement = self::$mysqli->prepare($query_string);
    $insert_statement->execute();

  }
}
Database::init();