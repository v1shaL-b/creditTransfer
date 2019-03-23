
<?php
	include 'db.php';

	$senderid = $_GET["senderID"];
	$receiverid = $_GET["receiverID"];
	$credit = $_GET["credit"];

	$sql1 = "SELECT currentCredit FROM credit WHERE ID='$senderid'";
	$result1 = mysqli_query($conn,$sql1);
	$row = mysqli_fetch_assoc($result1);

	$sql2 = "SELECT ID FROM credit WHERE ID='$receiverid'";
	$result2 = mysqli_query($conn,$sql2);

	if(mysqli_num_rows($result2) == 0)
		echo "Invalid Sender ID";
	
	else if($row["currentCredit"] < $credit)
		echo "Insufficient balance";	

	else
	{
		mysqli_query($conn,"SET AUTOCOMMIT=0");
		mysqli_query($conn,"START TRANSACTION");

		
		$q1 = mysqli_query($conn,"UPDATE credit SET currentCredit=currentCredit-$credit WHERE ID='$senderid'");
		$q2 = mysqli_query($conn,"UPDATE credit SET currentCredit=currentCredit+$credit WHERE ID='$receiverid'");
		$q3 = mysqli_query($conn,"INSERT INTO transactions VALUES('$senderid','$receiverid','$credit')");

		if($q1 && $q2 && $q3)
		{
			mysqli_query($conn,"COMMIT");
			echo "Transaction successfull";
		}
		else
		{
			echo "Transaction unsuccessfull";
			mysqli_query($conn,"ROLLBACK");
		}

		mysqli_query($conn,"SET AUTOCOMMIT=1");
	}
    echo "<script>
		setTimeout(function(){window.location='index.php';},1000);
		</script>";
    mysqli_close($conn);
?>