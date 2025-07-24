<?php


$name = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["message"];

$link = mysqli_connect("localhost", "root", "");
mysqli_select_db($link, "itsmyproject");

$sql = "INSERT INTO messege(name, email, message1) VALUES ('$name', '$email', '$message')";
$result=mysqli_query($link, $sql);

header("Location: ".$_SERVER["HTTP_REFERER"]); 
exit;

?>