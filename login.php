<?php
session_start();
if(isset($_SESSION['uid']))
{
    header('location:index.php');
}
?>
<?php require_once "finit.php"; ?>


<!DOCTYPE html>
<html>
<head>
	<title>friendRequest</title>
</head>
<body>

	<form action="login.php" method="POST" align="center" style="margin-top: 70px;">
		Username:<input type="text" name="username"><br><br>
		Password:<input type="password" name="password"><br><br>
		<input type="submit" value="Login" name="submit">
	</form>

</body>
</html>

<?php 
	global $user;
	if (isset($_POST['submit'])) {

		$username = trim($_POST['username']);
		$password = trim($_POST['password']);

		$user_found = Fuser::verify_user($username, $password);

		if ($user_found) {
			$data = mysqli_fetch_assoc($user_found);
			$user->id = $data['id'];
			$_SESSION['uid'] = $user->id;
			header('location:index.php');
		}else{
			?><script>alert('Invalid Username or Password');</script><?php
		}
			
		}


?>