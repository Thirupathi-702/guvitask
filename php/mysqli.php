<?php
$host = "localhost";
$duname = "root";
$dpass = "";
$dbname = "test1";

$conn = new mysqli($host, $duname, $dpass, $dbname);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO registration(fname, lname, age, email, gender, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssissss", $Fname, $Lname, $age, $email, $gender, $Uname1, $pass1);
    $stmt->execute();
    echo "Registration successful....";
    $stmt->close();
    $conn->close();
}
?>
