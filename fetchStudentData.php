<?php
  header('Access-Control-Allow-Origin: *'); 
  header('Content-Type: application/json');

  $sname = "localhost";
  $uname = "root";
  $password = "";
  $db_name = "sdp_database";

  $conn = mysqli_connect($sname, $uname, $password, $db_name);

  if(!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
  }

  $sql = "SELECT * FROM student"; 
  $result = $conn->query($sql);

  $users = array();
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $users[] = $row;
    }
    echo json_encode($users);
  } else {
    echo "0 results";
  }

  $conn->close();
?>