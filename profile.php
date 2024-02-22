<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
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
<div class="container">

   <div class="profile">
      <?php
         $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['image'] == ''){
            echo '<img src="eduford_img/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['image'].'">';
         }
      ?>
      <h3><?php echo $fetch['name']; ?></h3>
      <a href="update_profile.php" class="btn">Update Profile</a>
      <a href="index.php?logout=<?php echo $user_id; ?>" class="delete-btn">Logout</a>
      <br>
      <br>
      <p><a href="Login.php">Login with another account</a> <br> or <a href="Create_account.php"><br>Register for another account</a></p>
   </div>
</div>
</body>
</html>