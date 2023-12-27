<?php

include '../connection.php';

if(isset($_POST['submit'])){

   $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
   $phone_no = mysqli_real_escape_string($conn, $_POST['phone_no']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $psw = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpsw = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   
 

   $select_user = mysqli_query($conn, "SELECT * FROM `admin_tbl` WHERE admin_name = '$user_name' AND admin_psw= '$psw'") or die('query failed');

   if(mysqli_num_rows($select_user) > 0){
      $message[] = 'user already exist!';
   }else{
      if($psw != $cpsw){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "INSERT INTO `admin_tbl`(admin_name,admin_psw,admin_phoneNo, admin_mail) VALUES('$user_name','$cpsw', '$phone_no', '$email') ") or die('query failed');
         $message[] = 'registered successfully!';
         header('location:../login.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style3.css">
   <link rel="stylesheet" href="../css/style1.css">

</head>
<body>



<div class="form1">

   <form action="" method="post">
      <h3>register now</h3>
      <input type="text" name="user_name" placeholder="enter your name" required class="box">
      <input type="text" name="phone_no" placeholder="enter your mobile number" required class="box">
      <input type="email" name="email" placeholder="enter your email" required class="box">
      <input type="password" name="password" placeholder="enter your password" required class="box">
      <input type="password" name="cpassword" placeholder="confirm your password" required class="box">
      <input type="submit" name="submit" value="admin register" class="home-btn">
      <p>already have an account? <a href="../login.php">login now</a></p>
   </form>

</div>

</body>
</html>