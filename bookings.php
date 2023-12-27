<?php

include 'connection.php';

session_start();

$user_id = $_SESSION['user_id']; 

if(!isset($user_id)){
   header('location:../login.php');
};

if(isset($_POST['add_details'])){

   $name =$_SESSION['user_name'];
   $address=  $_SESSION['address'];
   $date=$_POST['date'];
   $phone_num = $_SESSION['phone_no'];
   $nic=$_SESSION['nic_no'];
   $ds_division=$_POST['ds_division'];
   $group=$_POST['group'];
   $work=$_POST['work'];
   $type=$_POST['type'];
   $fuel=$_POST['fuel'];
   $v_code=$_POST['v_code'];
   $v_num=$_POST['v_num'];
   $Chassis_num=$_POST['Chassis_num'];
   $liter=$_POST['max_liter'];
   $image1=$_POST['image1'];
   $image3=$_POST['image3'];


      $add_details = mysqli_query($conn, "INSERT INTO `bookings`(`user_id`,`user_name`, `address`,`date`, `phone_no`, `nic_no`, `ds_division`,`group_value`,`work_type`,`selected_vehicle`,`fuel_type`,`v_code`,`v_num`,`chassis_No`,`liter`, `nic_photo`, `electricity_bill_photo`) VALUES('$user_id','$name', '$address', '$date','$phone_num', '$nic', '$ds_division','$group','$work','$type','$fuel','$v_code','$v_num','$Chassis_num','$liter','$image1','$image3')") or die('query failed3');
      mysqli_query($conn, "SET @row_number=0");
      $token=mysqli_query($conn, "SELECT *,(@row_number:=@row_number + 1) AS rnk FROM `bookings` where date='$date' AND group_value='$group'  ORDER BY group_value ASC;")or die('query failed2');
            if(mysqli_num_rows($token) > 0){
               while($fetch_token=mysqli_fetch_assoc($token)){
                  if($fetch_token['user_id']==$user_id){
                     $token_id=$fetch_token['rnk'];
               
      $select_time = mysqli_query($conn, "SELECT * FROM `address_tbl` WHERE grouping='$group' AND distribution_date='$date'") or die('query failed1');
      if(mysqli_num_rows($select_time) > 0){
         while($fetch_time = mysqli_fetch_assoc($select_time)){
               $startTime=$fetch_time['start_time'];
               $endTime=$fetch_time['end_time'];
               mysqli_query($conn,"UPDATE `bookings` SET token_no = '$token_id' WHERE user_id='$user_id' and date='$date'") or die('query failed');
               }
            }
         }
      }
   }
   ?>
  
   <p class="p1"><?php echo "Your token number is :" .$token_id.'<br>'?>
   <?php echo "You can fill during ".$startTime." to ".$endTime?></p>;
   <?php
   $message[] = 'Print successfully';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Bookings</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style1.css">
 
</head>
<body>
   
<section class="home">
<?php include 'header.php'; ?>
</section>


<section class="bookings">
   
        <h3 class="caption">Alredy booked</h3>
        <div class="box-container">
           <form action="" method="post" class="box"> 
        
 
                
              <?php
                $select_divisions=mysqli_query($conn, "SELECT allowed_divisions FROM `petrol_distribution` ORDER BY `distribution_date` DESC LIMIT 1") or die('query failed1');
                if(mysqli_num_rows($select_divisions) > 0){
                while($fetch_us=mysqli_fetch_assoc($select_divisions)){
                    $row=$fetch_us['allowed_divisions'];
                    $rest = explode(" ",$row);
                    foreach ($rest as $res) {  
                           
                           ?>
                    <input type="hidden" name="count[]" value="<?php echo $res?>">
                    <?php
                        
                     }
                  }
               }
               

                    ?>
                               Enter your ds division   :<br><br>
                               <input type="text" name="ds" value="" size="20"><br><br>
                               <input type="submit" class="btn" name="division" value="Submit">                      
               </form>
            </div>
               <?php 
               if(isset($_POST['division'])){
                 $select_ds = $_POST['ds']; 
                 $select_count = $_POST['count'];  
              
                 
                  $count=count($_POST['count']);
              for($i=0;$i<=$count;$i++){
                 if($i<$count){
                  if($select_count[$i]==$select_ds){
                
        ?>
               <div class="box-container">
                    <form action="" method="post" class="box"> 
                    <input type="hidden" name="divi" value="<?php echo $select_ds?>">
                    Vechile Code: <input type="text" name="vCode" value="">
                    Vechile Number: <input type="text" name="vNum" value="">

                    <input type="submit" class="btn" name="submit" value="Submit">                        
                     </form>
            
                     </div>
                     <?php
                     break;
                     }
                   }else{
                     ?>
                     <p class="p3">Sorry you cannot booked because your division is not selected yet</p>
                     <?php
                  } 
               }
            }   
            ?>
                 
      
</section>

<!-- customize section -->

<section >
<?php
   $select_date = mysqli_query($conn, "SELECT distribution_date from `petrol_distribution` ORDER BY distribution_date DESC LIMIT 1") or die('query failed');
   if(mysqli_num_rows($select_date) > 0){
    while($fetch_date= mysqli_fetch_assoc($select_date)){
       $date=$fetch_date['distribution_date'];

      if(isset($_POST['submit'])){
         $vCode= $_POST['vCode'];  
         $Vnum= $_POST['vNum'];  
         $ds_div=$_POST['divi'];
         $select_jobs = mysqli_query($conn, "SELECT * FROM `bookings` WHERE v_code = '$vCode' and v_num='$Vnum' AND ds_division='$ds_div' ORDER BY date DESC LIMIT 1") or die('query failed');
         
         if(mysqli_num_rows($select_jobs) > 0){
            while($fetch_jobs = mysqli_fetch_assoc($select_jobs)){
                $Vehicle=$fetch_jobs['selected_vehicle'];
                $Work=$fetch_jobs['work_type'];
                ?>
                <div class="box-container"><?php
            
                       $vdate=$fetch_jobs['valid_date'];
                       if($date>$vdate){
                        if($fetch_jobs['filling_status']=='Filled'){
                        
                        
              
            
   ?>
 <section  class="edit-form" >  
<form action="" method="post" enctype="multipart/form-data">
 <br></br>   
<h4>Welcome again <?php echo $_SESSION['user_name']?> !!!</h4>
      <input type="hidden" name="user_name" class="box" value="<?php echo $_SESSION['user_name']?> " readonly>
      <input type="hidden" name="address" class="box" value="<?php echo $_SESSION['address']?> " required>
      <input type="hidden" name="phone_num" class="box" value="<?php echo $_SESSION['phone_no']?> " readonly>
      <input type="hidden" name="nic" class="box" value="<?php echo $_SESSION['nic_no']?> "readonly>
      <input type="hidden" name="ds_division" class="box" value="<?php echo $fetch_jobs['ds_division']?>" readonly><br>
      <?php
      $select_group = mysqli_query($conn, "SELECT * FROM `address_tbl` where ds_division='$ds_div'") or die('query failed');
         if(mysqli_num_rows($select_group) > 0){
            while($fetch_group = mysqli_fetch_assoc($select_group)){
               ?>
        <input type="hidden" name="group" class="box" value="<?php echo $fetch_group['grouping']?>" readonly >
      <?php
            }
         }
         ?>
      <input type="hidden" name="v_code" class="box" value="<?php echo $vCode?>" readonly>
      <input type="hidden" name="v_num" class="box"  value="<?php echo $Vnum?>"readonly><br>

      <input type="hidden" name="Chassis_num" class="box" value="<?php echo $fetch_jobs['chassis_No']?> " readonly>
      <?php
      $select_query = mysqli_query($conn, "SELECT distribution_date FROM `petrol_distribution` ORDER BY distribution_date DESC Limit 1") or die('query failed');
         if(mysqli_num_rows($select_query) > 0){
            while($fetch_value = mysqli_fetch_assoc($select_query)){
               ?>
        <Lable>Petrol can be refilled on the date mentioned below</Lable><br>
        <input type="date" name="date" class="box" value="<?php echo $fetch_value['distribution_date']?>" required max="<?php echo $fetch_value['distribution_date']?>">
      <?php
            }
         }
      ?>
      <input type="hidden" name="work" class="box"value="<?php echo $fetch_jobs['work_type']?> " readonly>
      <input type="hidden" name="type" class="box"value="<?php echo $fetch_jobs['selected_vehicle']?> " readonly>
      <?php
      $query=mysqli_query($conn, "SELECT * FROM `occupation_tbl` where vehicle='$Vehicle' and category_work='$Work'") or die('query failed');
      if(mysqli_num_rows($query) > 0){
         while($fetch_query = mysqli_fetch_assoc($query)){
          
     ?><br>
      <Lable>Specify how many liters you are going to fill</Lable><br>
      <input type="number" name="max_liter" class="box" placeholder="You can fill max <?php echo $fetch_query ['max_literPetrol']?>" min="1" max="<?php echo $fetch_query ['max_literPetrol']?>" step="0.1"  required><br>
      
      <Lable>Select the fuel type</Lable><br>
      <select name="fuel" class="box" >
         <option value="" hidden>Select the fuel type </option>
         <?php
          if($fetch_query['vehicle']=='Bike' || $fetch_query['vehicle']=='Auto' ){
            ?>
     
         <option value="Petrol">Petrol</option>
            <?php
         }else if($fetch_query['vehicle']=='Car/Van')
           {
         ?>
         <option value="Petrol">Petrol </option>
         <option value="Diesel">Diesel </option>
         <?php
           }else if($fetch_query['vehicle']=='Heavy vehicles'){
           ?>
             <option value="Diesel">Diesel </option>
             <?php
           }
         ?>

         </select></br>
         <?php
            }
        }  
     ?>

      <input type="hidden " name="image1" accept="image/jpg, image/jpeg, image/png" class="box" readonly value="<?php echo $fetch_jobs['nic_photo']?>"> <br>
    
      <input type="hidden " name="image3" accept="image/jpg, image/jpeg, image/png"  class="box" readonly value="<?php echo $fetch_jobs['electricity_bill_photo']?>"> <br><br><br>
     
      <input type="submit" value="Add details" name="add_details" class="btn"><br><br>
      <h4>---------------- * * * ----------------</h4><br>
   </form>
      </section>
   <?php
     }
     else{
        ?>
       <h4><a href="myBookings.php" style="text-decoration:underline;">cancel the booking which not filled yet</a></h4>
        <?php
   }
   }
else{
    ?>
    <p class="p3">Sorry Your valid time is not exceeed this</p2>
    <?php
}
            }
 }else{
   ?>
    <p class="p3">Sorry this vechile number or Vechile code is not exist <br> OR<br> Your ds division incorrect</p>
    <?php
 }
}
         }
        }
      else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>


</section>


<?php include 'footer.php'; ?>


<script src="js/script2.js"></script>
<script>
   document.querySelector('#close-customize').onclick = () =>{
   document.querySelector('.edit-product-form').style.display = 'none';
   window.location.href = 'orders2.php';
}
</script>

 
 
</body>
</html>