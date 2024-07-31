<?php
$firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "youtube";

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
  die('Connect Error ('. $conn->connect_errno .') '.$conn->connect_error);
} else {
  $stmt = $conn->prepare("INSERT INTO account (firstname, username, password) VALUES(?, ?, ?)");

  if ($stmt === false) {
    die('Prepare failed: ' . $conn->error);
  }

  $stmt->bind_param("sss", $firstname, $username, $password);

  if ($stmt->execute()) {
    echo "You have succefully registered";
  } else {
    echo "Error; " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
}
?>