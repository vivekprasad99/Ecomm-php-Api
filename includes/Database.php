<?php

define('HOST', 'localhost');
define('USER_NAME', 'root');
define('PASSWORD', '');
define('DB_NAME', 'better_buys');

// class DB start
class Database
{
  private $connection;

  public function __construct()
  {
    $this->open_db_connection();
  }
  // Creating connection with db
  public function open_db_connection()
  {
    $this->connection = mysqli_connect(HOST, USER_NAME, PASSWORD, DB_NAME);

    if (mysqli_connect_error()) {
      die('Connection Error: ' . mysqli_connect_error());
    }
  }

   // Running SQL query on db
  public function query($sql)
  {
    $result = $this->connection->query($sql);
    if(!$result)
    {
      die('Query Fails :'.$sql);
    }
    return $result;
  }

  public function fetch_array($result)
  {
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc())
      {
        $result_array[] = $row;
      }
      return $result_array;
    }
  }

  // Getting only 1 row
  public function fetch_row($result)
  {
      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          return $row;
      }
  }

  // Checking if string is in proper format
  public function escape_value($value)
  {
      $value = $this->connection->real_escape_string($value);
      return $value;
  }

  public function close_connection()
  {
      $this->connection->close();
  }
}

$database = new Database();