<?php
session_start();
include 'Connection.php';
$db = new Connection();

?>



<!DOCTYPE html>
<html>
<head>
	<title>password reset</title>
</head>
<body style="background-color: skyblue;">

	<?php
		if(isset($_POST['submit'])){

			$token = $_POST['token'];
			$chk_t = "SELECT * FROM reset WHERE token= '$token'";
			$res = $db->fetch($chk_t,null);
			if(count($res) == 1 && $_POST['password'] == $_POST['confirm_password']){
				$del_q = "DELETE FROM reset WHERE token= '$token'";
				$db->insert($del_q,null);
					foreach($res as $data){
						$p = md5($_POST['password']);
						$user_id = $data['user_id'];
						$update_q = "UPDATE users SET password = '$p' WHERE id = '$user_id'";
						$db->insert($update_q,null);
					}
					echo "Password Updated";
					header("location: login.php");
			}else{
				echo "Token doesn't match/Confirm Password not matched!";
			}
				
			
		}

	?>
	<form method="POST" action="" style="text-align: center; padding: 20px;">
		<input type="text" name="token"  placeholder="Token" style="margin-bottom: 5px; padding: 10px; border: 1px solid blue; border-radius: 10px;"><br>
		<input type="password" name="password"  placeholder="New Password" style="margin-bottom: 5px; padding: 10px; border: 1px solid blue; border-radius: 10px;"><br>
		<input type="password" name="confirm_password"  placeholder="Confirm Password" style="margin-bottom: 5px; padding: 10px; border: 1px solid blue; border-radius: 10px;"><br>
		<input type="submit" name="submit"  value="Change Password" style="padding: 10px; border: 1px solid blue; border-radius: 5px;"><br>
		
	</form>

</body>
</html>