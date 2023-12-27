<?php

include 'connection.php';
session_start();

if(isset($_POST['submit'])){

   $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
   $psw = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select_users = mysqli_query($conn, "SELECT * FROM `users_tbl` WHERE user_name = '$user_name' AND password = '$psw'") or die('query failed');

   $select_admin = mysqli_query($conn, "SELECT * FROM `admin_tbl` WHERE admin_name = '$user_name' AND admin_psw = '$psw'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);

         $_SESSION['user_name'] = $row['user_name'];
         $_SESSION['nic_no'] = $row['nic_no'];
         $_SESSION['address']=$row['address'];
         $_SESSION['user_id'] = $row['user_id'];
         $_SESSION['phone_no']=$row['phone_No'];
         $_SESSION['email']=$row['email'];
         header('location:home.php');
      
   }else if(mysqli_num_rows($select_admin) > 0){
      $row = mysqli_fetch_assoc($select_admin);

         $_SESSION['admin_name'] = $row['admin_name'];
         $_SESSION['email'] = $row['email'];
         $_SESSION['admin_id'] = $row['admin_id'];
         $_SESSION['phone_no']=$row['admin_phoneNo'];
         header('location:admin/admin_home.php');
       
   
   }else{
      $message[] = 'incorrect email or password!';
   }

   }


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style1.css">

</head>
<body>

<div class="form1">

   <form action="" method="post">
      <h3>login now</h3>
      <input type="text" name="user_name" placeholder="enter your name" required class="box" pattern="[A-Za-z]{5,100}">
      <input type="password" name="password" placeholder="enter your password" required class="box"  pattern="/^[a-zA-Z0-9!@#\$%\^\&*_=+-]{8,30}$/g">
      <input type="submit" name="submit" value="login now" class="home-btn">
      <p>Don't have an account? <a href="register.php">register now</a></p>
   </form>

</div>

</body>
</html>