<?php
session_start();
include 'Connection.php';
$db = new Connection();

if($_SESSION['user_id'] == null){
	header("location: login.php");
}




?>

<!DOCTYPE html>
<head>
	<title>Add Details</title>
<html>
</head>

<body style="background-color: skyblue;">

	<div class="logout" style=" background-color: cadetblue; padding: 1px; margin-left: 0px;">
		<p style="margin-left: 90%;">(<?php echo $_SESSION['user_name'];?>)<a href="logout.php">Log Out</a></p>
	</div>
	


	<div class="Container" style="text-align: center; width: 95%; margin: auto;">

		<h2 style="text-align: center; font-size: 30px; color: green;">Add Details</h2>
		<?php

			if(isset($_POST['submit'])){
				if(!empty($_POST['name']) && !empty($_POST['mobnumber']) && !empty($_POST['address'])){
					$img_name = uniqid().".jpg";
					$db->addNote($_POST['name'],$_POST['mobnumber'],$_POST['address'],$_SESSION['user_id'],$img_name);
					$tmp = $_FILES['image']['tmp_name'];
					
					move_uploaded_file($tmp,"assets/photos/".$img_name);
					echo "Details Added!";

				}else{
					echo "All fields must required";
			
				}
			}

			// mark as archive
			if(isset($_GET['mark_id'])){
				$id = $_GET['mark_id'];
				$query = "UPDATE tasks SET status=0 WHERE id='$id'";
				$db->insert($query,null);
				header("location: index.php");
			}

		?>
		<form method="POST" action="" enctype="multipart/form-data" style="text-align: center; padding: 20px;">
			<input type="text" name="name"  placeholder="Name" style="margin-bottom: 5px; padding: 10px; border: 1px solid blue; border-radius: 10px;"><br>
			<input type="text" name="mobnumber"  placeholder="Mobile Number" style="margin-bottom: 5px; padding: 10px; border: 1px solid blue; border-radius: 10px;"><br>
			<textarea name="address" placeholder="Address" style="margin-bottom: 5px; padding: 10px; border: 1px solid blue; border-radius: 10px;"></textarea><br>
			<input type="file" name="image" accept="image/*" style="margin-left: 400px;"><br>
			<input type="submit" name="submit"  value="Add" style="padding: 10px; margin-bottom: 15px; border: 1px solid blue; border-radius: 5px;"><br>
			<a href="done.php" style="padding: 8px; color: black; background-color:#F0F0F0; text-decoration: none; border: 1px solid black; border-radius: 5px;">Checked</a>
			
		</form>
		
		<hr>
		<?php

			$results = $db->getAllnotes($_SESSION['user_id']);
			
		?>
		<table border="1px">
			<tr>
				<th>Name</th>
				<th>Mobile Number</th>
				<th>Address</th>
				<th>Image</th>
				<th>Action</th>
			</tr>
		<?php
			foreach ($results as $data) {

		?>	
			<tr>
				<td><?php echo $data['name']; ?></td>
				<td><?php echo $data['mobnumber']; ?></td>
				<td><?php echo $data['address']; ?></td>
				<td>
					<?php
						if($data['image'] != null){
					?>
					<img width="50px" height="30px" src="assets/photos/<?php echo $data['image']; ?>">
					<?php
						}else{
							echo "No Image";
						}
					?>



				</td>
				<td><a href="update.php?id=<?php echo $data['id']; ?>">View</a> | <a onclick="return confirm('Are you sure?');" href="delete.php?id=<?php echo $data['id']; ?>">Delete</a> || 
					<?php
						if($data['status'] == 1){
					?>
					
					<a href="?mark_id=<?php echo $data['id']; ?>">New entry</a>
					<?php 

						}else{
							echo "Checked!!";
						}
					?>



				</td>
			</tr>
		<?php
			}
		?>	
		</table>
		


		
	</div>
	
	



</body>
</html>
