
<?php
session_start();
include 'Connection.php';
$db = new Connection();
if(isset($_SESSION['user_id'])){
	header("location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log in to My Phonebook</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>


<body>

    <?php
    if(isset($_POST['submit'])){
        $user = $_POST['username'];
        $pass = md5($_POST['password']);
        $query = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
        $result = $db->fetch($query,null);
        if(count($result)==1){
            session_start();
            foreach ($result as $data){
                $_SESSION['user_id'] = $data['id'];
                $_SESSION['user_name'] = $data['username'];     
            }
            header("location: index.php");
        }else{
            echo "<p style='color: maroon;'>Credential Does not Match</p>";
        }
        
        
    }

    ?>
  
    
    <div class="phonebook-body">

        <div class="container">
        	
            <h1>My Phonebook</h1>

            <form method="POST" action="">

                <div class="login1">
                    <input type="text" name="username" placeholder="Username">
                    <input type="password" name="password" placeholder="Password">
                </div>
                <br>
                <div class="login2">
                    <input type="submit" name="submit" value="Log in">
                    <a href="forgot.php">Forgot password?</a>
                </div>
                
            </form>

            

             <div class="login3">

                <p>New to My Phonebook? <a href="register.php">Register now>></a></p>
              
            </div>
            <br>
            <br>
            <br>

         
        </div>
        
    </div>
    

    
</body>
</html>



