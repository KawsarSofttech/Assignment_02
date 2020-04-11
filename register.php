<?php
include 'Connection.php';
$db = new Connection();
?>



<!DOCTYPE html>
<html>
<head>
	<title>register</title>
</head>
<body style="background-color: skyblue;">
	<?php
	
	if(isset($_POST['submit'])){
		$user = $_POST['username'];
		$pass = md5($_POST['password']);
		$chk_u = "SELECT * FROM users WHERE username= '$user'";
		$res = $db->fetch($chk_u,null);
		if(count($res) != 1 && $_POST['username'] != $data['username']){
			$query = "INSERT INTO users (username,password) VALUES ('$user','$pass');";
			$db->insert($query,null);
			echo "Registered!";
			header("location: login.php");
	 	}else{
	 		echo "Invalid user";
	 	}
	
	}

	?>
	<form method="POST" action="" style="text-align: center; padding: 20px;">
		<input type="text" name="username"  placeholder="Username" style="margin-bottom: 5px; padding: 10px; border: 1px solid blue; border-radius: 10px;"><br>
		<input type="password" name="password"  placeholder="Password" style="margin-bottom: 5px; padding: 10px; border: 1px solid blue; border-radius: 10px;"><br>
		<input type="submit" name="submit"  value="Register" style="padding: 10px; border: 1px solid blue; border-radius: 5px;"><br>
		
	</form>

</body>
</html>