<?php 
session_start();
require_once "finit.php";
// echo $_SESSION['uid'];
if (isset($_POST['submit'])) {
	global $database;
	 $sender = $user::my_username();
	 $receiver = $_POST['submit'];
	// echo $sender." hello bhai";
	//echo " m tera pyaara bhai ".$_POST['submit'];
	$sql = "INSERT INTO friendrequest (sender, reciever) VALUES ('$sender', '$receiver')";
	$result = $database->query($sql);
	if ($result == true) {
        	header('location:index.php?RequestSent');
	}else{
		echo "Error in inserting data";
	}
}
if (isset($_POST['receivedrequests'])) {
	global $database;
	$sender = $user::my_username();
	?><h2><?php echo $sender; ?></h2><hr>
	<form action="index.php" method="POST"><input type="submit" value="Home"> </form><hr><?php
	$sql = "SELECT sender FROM friendrequest WHERE reciever = '$sender'";
	$result = $database->query($sql);
	if (mysqli_num_rows($result)>0) {
		while ($row = mysqli_fetch_assoc($result)) {
			?><form action="friendrequest.php" method="POST"><input type="submit" value="<?php echo $row['sender']; ?>" name="acceptrequest"> </form><br><?php
		}
	}else{
		echo "No friend Requests";
	}
}
if (isset($_POST['sentrequests'])) {
	global $database;
	$sender = $user::my_username();
	?><h2><?php echo $sender; ?></h2><hr>
	<form action="index.php" method="POST"><input type="submit" value="Home"> </form>
	<h3>click to cancel requests:</h3><hr>
	<?php
	$sql = "SELECT reciever FROM friendrequest WHERE sender = '$sender'";
	$result = $database->query($sql);
	if (mysqli_num_rows($result)>0) {
		while ($row = mysqli_fetch_assoc($result)) {
			?><form action="friendrequest.php" method="POST"><input type="submit" value="<?php echo $row['reciever']; ?>" name="cancelrequest"> </form><br><?php
		}
	}else{
		echo "No Sent Requests";
	}
}
?>
<?php 
if (isset($_POST['cancelrequest'])) {
	$reciever = $_POST['cancelrequest'];
	$sql = "DELETE FROM friendrequest WHERE reciever = '$reciever'";
	$result = $database->query($sql);
	if ($result == true) {
		?><form action="index.php" method="POST"><input type="submit" value="Home"> </form><?php
		echo "Request Cancelled Successfully";
	}else{
		echo "Error occurs";
	}
}
if (isset($_POST['acceptrequest'])) {
	global $database;
	$sender = $user::my_username();
	$receiver = $_POST['acceptrequest'];
	$sql = "INSERT INTO friends (f1, f2) VALUES ('$sender', '$receiver')";
	$result = $database->query($sql);
	if ($result == true) {
		$sql = "DELETE FROM friendrequest WHERE sender = '$receiver'";
		$result = $database->query($sql);
		if ($result == true) {
			?><form action="index.php" method="POST"><input type="submit" value="Home"> </form><?php
			echo "Request Accepted";
		}
	}else{
		echo "Error occurs";
	}
}
if (isset($_POST['myfriends'])) {
	global $database;
	$sender = $user::my_username();
	?><form action="index.php" method="POST"><input type="submit" value="Home"> </form><?php
	$sql1 = "SELECT f1 FROM friends WHERE f2= '$sender'";
	$sql2 = "SELECT f2 FROM friends WHERE f1= '$sender'";
	$result1 = $database->query($sql1);
	$result2 = $database->query($sql2);
	$count = 0;
	if (mysqli_num_rows($result1)>0) {
		while ($data = mysqli_fetch_assoc($result1)) {
			echo $data['f1']."<br>";
		}
		$count++;
	}
	if (mysqli_num_rows($result2)>0) {
		while ($data = mysqli_fetch_assoc($result2)) {
			echo $data['f2']."<br>";
		}
		$count++;
	}
	if ($count == 0) {
		echo "No Friends Available";
	}

}


?>