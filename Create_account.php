<?php
include 'config.php';

if(isset($_POST['submit'])){
    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $pass=mysqli_real_escape_string($conn,md5($_POST['password']));
    $cpass=mysqli_real_escape_string($conn,md5($_POST['cpassword']));
    $image=$_FILES['image']['name'];
    $image_size=$_FILES['image']['size'];
    $image_tmp_name=$_FILES['image']['tmp_name'];
    $image_folder='uploaded_img/'.$image;

    $select=mysqli_query($conn,"SELECT * FROM `user_form` WHERE email='$email' AND password='$pass'") or die('query failed');
    if(mysqli_num_rows($select) > 0){
        $message[] = 'User already exist'; 
    }else{
        if($pass != $cpass){
           $message[] = 'Confirm password not matched!';
        }elseif($image_size > 2000000){
           $message[] = 'Image size is too large!';
        }else{
           $insert = mysqli_query($conn, "INSERT INTO `user_form`(name, email, password, image) VALUES('$name', '$email', '$pass', '$image')") or die('query failed');
  
           if($insert){
              move_uploaded_file($image_tmp_name, $image_folder);
              $message[] = 'Registered successfully!';
              header('location:login.php');
           }else{
              $message[] = 'Registeration failed!';
           }
        }
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
        <h3>Create an account</h3>
        <h4>Start your journey with us!</h4>
        <?php
        if(isset($message)){
            foreach($message as $message){
                echo '<div class= "message">'.$message.'</div>';
            }
            
        }
        ?>
        <input type="text" name="name" placeholder="Enter your username" class="box" required>
        <input type="email" name="email" placeholder="Enter your email" class="box" required>
        <input type="password" name="password" placeholder="Enter your password" class="box" required>
        <input type="password" name="cpassword" placeholder="Confirm your password" class="box" required>
        <input type="file" name="image" class="box" accept="image/jpg,image/jpeg,image/png">
        <input type="submit" name="submit" value="Sign Up" class="btn">
        <p>Already have an account? <a href="Login.php">Login now</a></p>
    </form>

</div>
</body>
</html>
