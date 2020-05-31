<?php 
session_start();
if(!isset($_SESSION['uid']))
{
    header('location:login.php');
}
require_once "finit.php";
 ?>
 
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 	<?php 
	 	global $database;
		$user = $user::my_username();
	 ?>
	 <h2><?php echo $user; ?></h2><hr>
 	<form style="float:right;" action="index.php" align="center" method="POST">
 		<input type="submit" value="logout"  name="logout">
 	</form>
 	<?php $data = Fuser::find_all_users(); ?>
 	<h4>Other Users:</h4><hr>
 	<table align="center" style="padding:20px; border-collapse: collapse; font-size:20px;" border="1">
 		<tr style="padding:20px;">
 			<th>id</th>
 			<th>Username</th>
 		</tr>
 		<?php 
 			while ($row = mysqli_fetch_assoc($data)) {
 				?>
 				<form action="friendrequest.php" align="center" method="POST">
	 				<?php if ($row['username'] == $user) {
	 					
	 				}




	 				else{ ?>
	 				<?php global $database;
						$sql1 = "SELECT f1 FROM friends WHERE f2 = '$user'";
						$result1 = $database->query($sql1);
						$sql2 = "SELECT f2 FROM friends WHERE f1 = '$user'";
						$result2 = $database->query($sql2);
						if (mysqli_num_rows($result1)>0) {
							while ($data1 = mysqli_fetch_assoc($result1)) {
								if ($data1['f1'] == $row['username']) {
									# code...
								}else{
									?><tr><td><?php echo $row['id'] ?></td>
	 								<td><input type="submit" value="<?php echo $row['username'] ?>" name="submit">  </td><?php
								}
							}
						}elseif (mysqli_num_rows($result2)>0) {
							while ($data2 = mysqli_fetch_assoc($result2)) {
								if ($data2['f2'] == $row['username']) {
									# code...
								}else{
									?><tr><td><?php echo $row['id'] ?></td>
	 								<td><input type="submit" value="<?php echo $row['username'] ?>" name="submit">  </td><?php
								}
							}
						}else{
							?><tr><td><?php echo $row['id'] ?></td>
	 								<td><input type="submit" value="<?php echo $row['username'] ?>" name="submit">  </td><?php
						}
	 				 ?>
					<?php } ?>















	 				</tr>
	 			</form>
 			<?php }
 		 ?>
 	</table>
 	<hr>
 	<form action="friendrequest.php" align="center" method="POST">
 		<input type="submit" value="Received Requests" name="receivedrequests">
 		<input type="submit" value="Sent Requests" name="sentrequests">
 		<input type="submit" value="My Friends" name="myfriends">

 	</form>
 	<!-- <h3><a href="receivedrequests.php">Received Requests</a><br><br><a href="sentrequests.php">Sent Requests</a></h3> -->

 </body>
 </html>
 <?php 
 if (isset($_POST['logout'])) {
 	unset($_SESSION['uid']);
	header('location:login.php');
 }