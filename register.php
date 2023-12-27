<?php

include 'connection.php';
   

if(isset($_POST['submit'])){

   $phone_no = mysqli_real_escape_string($conn, $_POST['phone_no']);
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $nic = mysqli_real_escape_string($conn, $_POST['nic']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $psw = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpsw = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
   
  
         $uppercase = preg_match('@[A-Z]@', $psw);
         $lowercase = preg_match('@[a-z]@', $psw);
         $number = preg_match('@[0-9]@', $psw);
         $specialChars = preg_match('@[^\w]@', $psw);
      ?>
   <h3>
      
      <?php

            if(preg_match('/^[a-zA-Z]$/', $user_name)) {
              
            }else{
               echo 'Your name does not consist teh correct match';
            }
            
            if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($psw) < 8) {
               
               echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
            }else{
               echo 'Strong password.';
            }
         ?>
   </h3>
         
   <?php

 $select_users = mysqli_query($conn, "SELECT * FROM `users_tbl` WHERE email = '$email' AND password = '$psw'") or die('query failed');
   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'user already exist!';
   }else{
      if($psw != $cpsw){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "INSERT INTO `users_tbl`(user_name,address,phone_No,nic_no, email, password) VALUES('$user_name','$address','$phone_no','$nic','$email','$cpsw')") or die('query failed');
         $message[] = 'registered successfully!';
         header('location:login.php');
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

  
   <link rel="stylesheet" href="css/style1.css">

</head>
<body>



<div class="form1">

   <form action="" method="post">
      <h3>register now</h3>
      <input type="text" name="user_name" placeholder="enter your name" pattern="[A-Za-z]{5,100}" required class="box">
      <input type="text" name="address" placeholder="enter your address eg: chunnakam" required class="box">
      <input type="text" name="phone_no" placeholder="enter your mobile number"  pattern="[0-9]{10}" required class="box">
      <input type="text" name="nic" placeholder="enter your NIC number" required class="box" pattern="[0-9]{9}[x|X|v|V]|[0-9]{12}">
      <input type="email" name="email" placeholder="enter your email"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required class="box">
      <input type="password" name="password" placeholder="enter your password" pattern="/^[a-zA-Z0-9!@#\$%\^\&*_=+-]{8,30}$/g"  required class="box">
      <input type="password" name="cpassword" placeholder="confirm your password" pattern="/^[a-zA-Z0-9!@#\$%\^\&*_=+-]{8,30}$/g"  required class="box">
      <input type="submit" name="submit" value="user register" class="home-btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</div>

</body>
</html>


