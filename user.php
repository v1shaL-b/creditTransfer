<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div>
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user.php">Users</a>
            </li>
        </ul>
    </div>
    <br>
    <br>

    <form action="user.php">
        <div class="container">
            <label>Enter UserID to view Details:</label>
            <input type="text" placeholder=" Enter User ID" name="userid">
            <input type="submit">
        </div>
    </form>
    <br>
    <br>
</body>
</html>


<?php
    error_reporting(0);
	
	include 'db.php';
	$userid = $_GET["userid"];
	
	$sql = "SELECT * FROM credit WHERE ID='$userid'";
	$result = $conn->query($sql);
	
	$row = mysqli_fetch_assoc($result);
	$userid = $row['ID'];
	$name = $row["Name"];
	$email = $row["Email"];
	$credit = $row["currentCredit"];
    
    echo "<div class=col-md-12>";
	echo "  <div class=container col-md-6>
                <h4>User Id: $userid</h4>
                <h4>Name: $name</h4>
                <h4>Email: $email</h4>
                <h4>Current credit: $credit</h4>
            </div>";

	echo "<br><br>
	<div class=container>
		<h2>Transfer credits:</h2>
		<form action='transfer.php' method='get'>
        <table>
        
            <td><label>Sender Id: </label></td>
            <td><input type='text' value='$userid' name='senderID' readonly></input></td><br>
        
            <td><label>Reciever Id: </label></td>
            <td><input type='text' name='receiverID'></input></td>
            
            <td><label>Credit: </label></td>
            <td><input type='text' name='credit'></input></td>
            
            <td><input value='Transfer' type='submit'></td>
        <table>
        </form>
        
	</div>";
    
    echo "</div>";
?>