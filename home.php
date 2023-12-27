<?php

include 'connection.php';

session_start();

if(isset( $_SESSION['user_id'])){
   $user_id = $_SESSION['user_id']; 
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style1.css">

</head>
<body>
 

<div class="logi">

   <p>
      <a href="login.php">login</a> 
      <a href="register.php">register</a> 
   </p>

</div>

<section class="home">
   <?php include 'header.php'; ?>
</section>

   <h3 class="caption">Distribution of petrol for divisions</h3>

<Section class="distribution">
   <section class="home-add">   
      <div class="box-container">

         <?php
   
            $select_divisions= mysqli_query($conn, "SELECT * FROM `petrol_distribution`ORDER BY distribution_date DESC Limit 1") or die('query failed');
              if(mysqli_num_rows($select_divisions) > 0){   
                   while($fetch_division=mysqli_fetch_assoc($select_divisions)){
               
         ?>
               <div class="box">
                  <h3><?php echo "Distribution Date is :".$fetch_division['distribution_date'].'<br>'?></h3>
                  <p><?php echo "Selected divisions are : ".'<br>'?></p>
         <?php
                      $row=$fetch_division['allowed_divisions'];
                      $rest = explode(" ",$row);
                        foreach ($rest as $res) {
                           $select_address= mysqli_query($conn, "SELECT * FROM `address_tbl`") or die('query failed');
                              if(mysqli_num_rows($select_address) > 0){   
                                  while($fetch_address=mysqli_fetch_assoc($select_address)){
                                       $address=$fetch_address['address'];
                                       $division=$fetch_address['ds_division'];
                                           if($division==$res){
          ?>
                                             <p>  <?php  echo $address." (".$res.") ".'<br>'?></p>
            
         <?php
                                           }
                                  }
                               }
                         }
               }
            }
            // $user_names= explode(',',$row[0]);
         ?>
                     <p class="p3">Only above mentioned divisions are allowed</p>
               </div>
      </div>
   </section>


   <section class="fuel">
      <div class="box-container">
         <div class="box">
            <h3>Current price of fuel</h3>
            <p>Available fuels in our station and their prices</p>
   <?php
               $select_fuel=mysqli_query($conn, "SELECT * FROM fuel_tbl") or die('query failed');
                  if(mysqli_num_rows($select_fuel) > 0){   
                     while($fetch_fuel=mysqli_fetch_assoc($select_fuel)){
                        $fuel_type=$fetch_fuel['fuel_type'];
                        $fuel_price=$fetch_fuel['price'];
                        $available =$fetch_fuel['available_vehicle'];
           
    ?>
            <p > <?php  echo $fuel_type." - ".$fuel_price ?></p>
   <?php
                     }
                  }
   ?>
         </div>
      </div>
   </section>
</section>
      



<?php include 'footer.php'; ?>


<script src="js/script.js"></script>

</body>
</html>