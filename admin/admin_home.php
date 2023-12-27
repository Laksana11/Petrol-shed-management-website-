<?php

include '../connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- admin css file link  -->
   <link rel="stylesheet" href="../css/admin_style3.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>


<section class="dashboard">

      

<a href="admin_page.php" class="logo">Admin DashBoard</a>

   <div class="box2">
         
   </div>
   <div class="contain">
         <a href="allowedDivisions.php">Select Date</a>
   </div>
  
   <div class="box-container">
      <div class="box">
         <?php
            $pending=0;
            $p_totalLiter = mysqli_query($conn, "SELECT * FROM `analyzing_tbl` ORDER by date DESC LIMIT 1") or die('query failed');
            if(mysqli_num_rows($p_totalLiter) > 0){
               while($fetch_totalLiter = mysqli_fetch_assoc($p_totalLiter)){
                  $total=$fetch_totalLiter['total_liter_p'];       
               };
            };
         ?>
            <h3><?php echo $total; ?>l</h3>
            <p>Total Petrol</p>
      </div>

      <div class="box">
         <?php
            $pending=0;
            $p_totalLiter = mysqli_query($conn, "SELECT * FROM `analyzing_tbl` ORDER by date DESC LIMIT 1") or die('query failed');
            if(mysqli_num_rows($p_totalLiter) > 0){
               while($fetch_totalLiter = mysqli_fetch_assoc($p_totalLiter)){
                  $total=$fetch_totalLiter['total_liter_d'];        
               };
            };  
         ?>
            <h3><?php echo $total; ?>l</h3>
            <p>Total Disel</p>
      </div>

      <div class="box">
         <?php
               $total_bookings=0;
                  $select_bookings = mysqli_query($conn, "SELECT count(user_id) FROM `cur_booking`") or die('query failed');
                     if(mysqli_num_rows($select_bookings ) > 0){
                         while($fetch_bookings  = mysqli_fetch_assoc($select_bookings )){
                           // $total_token = $fetch_bookings['user_id'];
                           $total_bookings =$fetch_bookings['count(user_id)'];
               };
            };
            mysqli_query($conn,"UPDATE analyzing_tbl SET total_token='$total_bookings' WHERE date=CURDATE()") or die('query failed');
         ?>
            <h3><?php echo $total_bookings; ?></h3>
            <p>Total bookings</p>
      </div>

      <div class="box">
        <?php
            $total_liter = 0;
            $select_liter = mysqli_query($conn, "SELECT * FROM `cur_booking` where fuel_type='Petrol'") or die('query failed');
            if(mysqli_num_rows($select_liter) > 0){
               while($fetch_liter = mysqli_fetch_assoc($select_liter)){
                  $liter = $fetch_liter['liter'];
                 $total_liter += $liter;
               }; 
            };
            mysqli_query($conn,"UPDATE analyzing_tbl SET sold_p='$total_liter' Where date=CURDATE()") or die('query failed');       
         ?>
            <h3><?php echo $total_liter; ?>l</h3>
            <p>Sold Petrol</p>
      </div>
        
   

      <div class="box">
         <?php
            $total_liter = 0;
            $select_liter = mysqli_query($conn, "SELECT * FROM `cur_booking` where fuel_type='Diesel'") or die('query failed');
            if(mysqli_num_rows($select_liter) > 0){
               while($fetch_liter = mysqli_fetch_assoc($select_liter)){
                  $liter = $fetch_liter['liter'];
                 $total_liter += $liter;
               };    
            };
            mysqli_query($conn,"UPDATE analyzing_tbl SET sold_d='$total_liter' Where date =CURDATE()") or die('query failed');
         ?>
            <h3><?php echo $total_liter; ?>l</h3>
            <p>Sold Diesel</p>
      </div>
      
      <div class="box">
         <?php 
          $pending=0;
            $p_totalLiter = mysqli_query($conn, "SELECT * FROM `analyzing_tbl` where date=CURDATE()") or die('query failed');
            if(mysqli_num_rows($p_totalLiter) > 0){
               while($fetch_totalLiter = mysqli_fetch_assoc($p_totalLiter)){
                  $total=$fetch_totalLiter['total_liter_p'];
                  $sold_p=$fetch_totalLiter['sold_p'];
                  $pending=$total- $sold_p;
               };
            };
            mysqli_query($conn,"UPDATE analyzing_tbl SET pending_liter_p='$pending' Where date =CURDATE()") or die('query failed');

         ?>
         <h3><?php echo $pending; ?>l</h3>
         <p>Pending petrol</p>
      </div>

      <div class="box">
      <?php 
          $pending=0;
            $p_totalLiter = mysqli_query($conn, "SELECT * FROM `analyzing_tbl` where date=CURDATE()") or die('query failed');
            if(mysqli_num_rows($p_totalLiter) > 0){
               while($fetch_totalLiter = mysqli_fetch_assoc($p_totalLiter)){
                  $total=$fetch_totalLiter['total_liter_d'];
                  $sold_d=$fetch_totalLiter['sold_d'];
                  $pending=$total- $sold_d;
               };
            };
            mysqli_query($conn,"UPDATE analyzing_tbl SET pending_liter_d='$pending' Where date =CURDATE()") or die('query failed');

         ?>
         <h3><?php echo $pending; ?>l</h3>
         <p>Pending Diesel</p>
      </div>

      <div class="box">
         <?php
            $total_liter = 0;
            $total_price=0;
            $select_liter = mysqli_query($conn, "SELECT * FROM `cur_booking`") or die('query failed');
            if(mysqli_num_rows($select_liter) > 0){
               while($fetch_liter = mysqli_fetch_assoc($select_liter)){
                  $total_l = $fetch_liter['liter'];
                  $total_p=$fetch_liter['price'];
                  $lit=$total_l*$total_p;
                  $total_price += $lit;
               };
            };
            mysqli_query($conn,"UPDATE analyzing_tbl SET total_income='$total_price' Where date=CURDATE()") or die('query failed');
         ?>
         <h3>Rs<?php echo $total_price; ?>/-</h3>
         <p>Total income</p>
      </div> 
   </div>

      <div class="contain">
         <a href="manage_fuel.php" div="btn" >Add fuel</a>
      </div>
</section>



<!-- js file for admin panel  -->
<script src="../js/admin_script.js"></script>



</body>
</html>

<!-- CREATE VIEW `bo` AS SELECT b.`user_id`,b.`date`,b.`liter`,b.`fuel_type`,f.`price`,(f.`price` * b.`liter`) AS total FROM `bookings` AS b INNER JOIN `fuel_tbl` AS f ON f.`fuel_type` = b.`fuel_typer`; -->

<!-- CREATE VIEW `current_tbl` AS SELECT b.`user_id`,b.`date`,b.`liter`,b.`fuel_type`,f.`price`,(f.`price` * b.`liter`) AS total FROM `bookings` AS b INNER JOIN `fuel_tbl` AS f ON f.`fuel_type` = b.`fuel_type` WHERE filling_status='Filled' AND date in(SELECT distribution_date from petrol_distribution ORDER BY date DESC LIMIT 1); -->
<!-- CREATE VIEW `booked` AS SELECT b.`user_id`,b.`date`,b.`liter`,b.`fuel_type`, b.`v_code`, b.`v_num`, a.`start_time`,a.`end_time`,b.`filling_status` FROM `bookings` AS b INNER JOIN `address_tbl` AS a ON a.`ds_division` = b.`ds_division`; -->