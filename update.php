<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
</head>
<body style="background-color: skyblue;">

	<?php
	include 'Connection.php';
	$db = new Connection();


	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$getNote = $db->getNote($_GET['id']);	
	}
	
	if(isset($_POST['submit'])){
		$db->update($_POST['name'],$_POST['mobnumber'],$_POST['address'],$id);
		header("location: index.php");
	}

	?>


	<?php
		// var_dump($getNote);
		foreach($getNote as $data){	
	?>

	<form method="POST" action="" style="text-align: center; padding: 20px;">
		<input type="text" name="name"  placeholder="Name" value="<?php echo $data['name'];?>" style="margin-bottom: 5px; padding: 10px; border: 1px solid blue; border-radius: 10px;"><br>
		<input type="text" name="mobnumber"  placeholder="Mobile number" value="<?php echo $data['mobnumber'];?>" style="margin-bottom: 5px; padding: 10px; border: 1px solid blue; border-radius: 10px;"><br>
		<textarea name="address" placeholder="Address" style="margin-bottom: 5px; padding: 10px; border: 1px solid blue; border-radius: 10px;"><?php echo $data['address'];?></textarea><br>
		<input type="submit" name="submit"  value="Update" style="padding: 10px; border: 1px solid blue; border-radius: 5px;"><br>
		
	</form>

<?php
	}
?>

</body>
</html>