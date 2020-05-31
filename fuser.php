<?php 
class Fuser{
	public $id;
	public $username;
	public $password;

	public static function verify_user($username, $password){
		global $database;
		$username = $database->escape_string($username);
		$password = $database->escape_string($password);
		$sql = "SELECT * FROM userinfo WHERE username = '{$username}' AND password = '{$password}'";
		$result = $database->query($sql);
		
		$rows = mysqli_num_rows($result);
		if ($rows == 1) {
			return $result;
		}else{
			return false;
		}

	}
	public static function find_all_users(){
		global $database;
		$sql = "SELECT * FROM userinfo";
		$result = $database->query($sql);
		return $result;
	}
	public static function my_username(){
		global $database;
		$session_id = $_SESSION['uid'];
		$sql = "SELECT username FROM userinfo WHERE id='$session_id'";
		$result = $database->query($sql);
		if (mysqli_num_rows($result) == 1) {
			$data = mysqli_fetch_assoc($result);
				return $data['username'];
			}
	}
	public static function show_users(){
		// global $database;
		// $username = self::my_username();
		// $sql1 = "SELECT f1 FROM friends WHERE f2 = '$username'";
		// $result1 = $database->query($sql1);
		// $sql2 = "SELECT f2 FROM friends WHERE f1 = '$username'";
		// $result2 = $database->query($sql2);
		// if((mysqli_num_rows($result1) == 0) & (mysqli_num_rows($result2) == 0)){
		// 		return 1;
		//}
	}
}
$user = new Fuser();


 ?>