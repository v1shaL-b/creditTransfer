<html>

<head>
	<title>Credit Management System</title>
	<script>
		function click(x)
		{
			document.getElementById("userid").value = x;
			document.getElementById("myform").submit();

		}
	</script>
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
    <h1>Credit Management System</h1>
	<article>Click on the username to direct transfer</article>
	<table border=1 cellpadding=15 class="container">
		<tr>
			<th>User Id</th>
			<th>Name</th>
			<th>Email Id</th>
			<th>Credit</th>
		</tr>
<?php
	include 'db.php';
	
	$sql = "SELECT * FROM credit";
    $result = $conn->query($sql);

	while($row = mysqli_fetch_assoc($result))
    {	
    	$userid = $row['ID'];
        $name = $row['Name'];
        $email = $row['Email'];
        $credit = $row['currentCredit'];
        
        echo "<tr><td>$userid</td><td><a href=javascript:click($userid)>$name</a></td><td>$email</td><td>$credit</td></tr>";

        //To use a button instead on anchor tag: <input type='button' onclick='click($userid)' value='Proceed'></input>

    }
	mysqli_close($conn);
?>
	</table>
	<form id="myform" action="user.php" method="get" style="display:none">
		<input type="text" id="userid" name="userid">
	</form> <!-- invisible form containing a text box to send information to other  page -->

</body>
</html>
