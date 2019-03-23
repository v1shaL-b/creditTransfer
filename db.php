<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "login";

$conn = mysqli_connect($host, $user, $pass, $db);

if(mysqli_connect_errno($conn))
{
	echo "Error";
}

?>
