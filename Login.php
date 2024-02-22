<?php
include 'config.php';
session_start();
if(isset($_POST['submit'])){
    
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $pass=mysqli_real_escape_string($conn,md5($_POST['password']));
    

    $select=mysqli_query($conn,"SELECT * FROM `user_form` WHERE email='$email' AND password='$pass'") or die('query failed');
    if(mysqli_num_rows($select) > 0){
        $row = mysqli_fetch_assoc($select);
        $_SESSION['user_id'] = $row['id'];
        header('location:profile.php');
    }else{
        $message[] = 'Incorrect email or password'; 
    }
  
}
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="with=device-width,initial-scale=1.0">
    <title>Home</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="form-container">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="logo">
            <img src="eduford_img/Logo4.png" alt=""></a>
        </div>
        <h3>Login</h3>
        <h4>Welcome Back!</h4>
        <?php
        if(isset($message)){
            foreach($message as $message){
                echo '<div class= "message">'.$message.'</div>';
            }
            
        }
        ?>
        <input type="email" name="email" placeholder="Enter your email" class="box" required>
        <input type="password" name="password" placeholder="Enter your password" class="box" required>
        <input type="submit" name="submit" value="Login" class="btn">
        <p>Don't have an account? <a href="Create_account.php">Register now</a></p>
    </form>

</div>
</body>
</html>
