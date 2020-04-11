

<?php
session_start();
include 'Connection.php';
$db = new Connection();

?>


<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password?</title>
</head>
<body style="background-color: skyblue;">

	<?php
		if(isset($_POST['submit'])){
			$user = $_POST['username'];
			$query = "SELECT * FROM users WHERE username='$user'";
			$res = $db->fetch($query,null);
			if(count($res) == 1){
				foreach($res as $data){
					$t = rand(1000,9999);
					$user_id = $data['id'];
					$token_q = "INSERT INTO reset (token,user_id) VALUES('$t','$user_id')";
					$db->insert($token_q,null);
					header("location: password_reset.php");
				}

			}else{
				echo "User not found!";
			}
		}

	?>
	
	<form method="POST" action="" style="text-align: center; padding: 20px;">
		<input type="text" name="username"  placeholder="Username" style="margin-bottom: 5px; padding: 10px; border: 1px solid blue; border-radius: 10px;"><br>
		<input type="submit" name="submit"  value="Send Request" style="padding: 10px; border: 1px solid blue; border-radius: 5px;"><br>
	
	</form>

</body>
</html>