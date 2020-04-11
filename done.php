<?php
session_start();
include 'Connection.php';
$db = new Connection();
if($_SESSION['user_id'] == null){
	header("location: login.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>done</title>
</head>
<body style="background-color: skyblue;">

	<?php
	$user_id = $_SESSION['user_id'];
	$query = "SELECT * FROM tasks WHERE user_id = '$user_id' AND status = 0;";
	$results = $db->fetch($query,null);
	
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
			<td>Checked!!</td>
		</tr>
	<?php
		}
	?>	
	</table>

</body>
</html>