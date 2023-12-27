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
   $image1 = $_FILES['image1']['name'];
   $image1_size = $_FILES['image1']['size'];
   $image1_tmp_name = $_FILES['image1']['tmp_name'];
   $image1_folder = 'images/'.$image1;


   $image3 = $_FILES['image3']['name'];
   $image3_size = $_FILES['image3']['size'];
   $image3_tmp_name = $_FILES['image3']['tmp_name'];
   $image3_folder = 'images/'.$image3;

   $select_num=mysqli_query($conn,"SELECT * FROM `bookings` where v_code='$v_code' OR v_num='$v_num' OR chassis_No='$Chassis_num'")or die('query failed1');
      if(mysqli_num_rows($select_num)>0){
?>
         <h4>The vehicle number or vehice code or chassis number already exist. Please check again</h4>
<?php
      }else{

         $add_details = mysqli_query($conn, "INSERT INTO `bookings`(`user_id`,`user_name`, `address`,`date`, `phone_no`, `nic_no`, `ds_division`,`group_value`,`work_type`,`selected_vehicle`,`fuel_type`,`v_code`,`v_num`,`chassis_No`,`liter`, `nic_photo`, `electricity_bill_photo`) VALUES('$user_id','$name', '$address', '$date','$phone_num', '$nic', '$ds_division','$group','$work','$type','$fuel','$v_code','$v_num','$Chassis_num','$liter','$image1','$image3')") or die('query failed3');

            if($add_details){ 

               if($image1_size > 2000000 && $image2_size>20000 && $image3_size>20000 ){
                  $message[] = 'image size is too large';
               }else{
                  move_uploaded_file($image1_tmp_name, $image1_folder);
                  move_uploaded_file($image3_tmp_name, $image3_folder);
               }

            }else
            {
               $message[] = 'photo could not be added!';
            }


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
     
      }
         
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
   <!-- <link rel="stylesheet" href="css/admin_style8.css"> -->
</head>
<body>


<section class="home">
<?php include 'header.php'; ?>
</section>


<section class="bookings">

   <h1 class="caption">New Bookings</h1>
   <div class="box-container">
      <form action="" method="post" class="box"> 
        
           

            <?php
           $select_divisions=mysqli_query($conn, "SELECT * FROM `petrol_distribution` ORDER BY `distribution_date` DESC LIMIT 1") or die('query failed1');
               if(mysqli_num_rows($select_divisions) > 0){
                  while($fetch_us=mysqli_fetch_assoc($select_divisions)){
                    $row=$fetch_us['allowed_divisions'];
                    $dis_date=$fetch_us['distribution_date'];
                    $until=$fetch_us['available_until'];
                    $rest = explode(" ",$row);
                        foreach ($rest as $res) {  
                           
         ?>
                    <input type="hidden" name="count[]" value="<?php echo $res?>">
         <?php
                        
                         }
                       if($until>date("Y-m-d H:i:s")){
                           $select_data=mysqli_query($conn,"SELECT * FROM `bookings` where user_id='$user_id' and date='$dis_date' ")or die('query failed1');
                              if(mysqli_num_rows($select_data)>0){
         ?>
                                 <h3>You have booked already so cannot book</h3>
         <?php
                              }else
                              {
         ?>
                     
                               Enter your ds division   :<br><br>
                               <input type="text" name="ds" value="" size="20"><br><br>
                               <input type="submit" class="btn" name="division" value="Submit"> 
                                
                             
      </form>
                  </div>
         <?php 
                              }
                              }else{
          ?>
                                 <p class="p3">Booking time is closed. Please try another date </p>
         <?php
                          }
                     }
               }
    
          if(isset($_POST['division'])){
            $select_ds = $_POST['ds']; 
            $select_count = $_POST['count'];  
            $count=count($_POST['count']);
          
               for($i=0;$i<=$count;$i++){
                   if($i<$count){
                     if($select_count[$i]==$select_ds){
                        $select_category = mysqli_query($conn, "SELECT DISTINCT(category_work) FROM `occupation_tbl` ") or die('query failed');
                           if(mysqli_num_rows($select_category) > 0){
                              ?>
                              <h4>Select the form according to your work</h4>
                           <?php
                              while($fetch_category = mysqli_fetch_assoc($select_category)){
                                $category=$fetch_category['category_work'];
            ?>
                               <h3 class="caption"><?php echo $category; ?></h3>
                               <div class="box-container">
           
            <?php
                        $select_id = mysqli_query($conn, "SELECT * FROM `occupation_tbl` WHERE category_work='$category' ") or die('query failed');
                           if(mysqli_num_rows($select_id) > 0){
                              while($fetch_id = mysqli_fetch_assoc($select_id)){
                         
            ?>
                     
                    <form action="" method="post" class="box">   
                           <img class="image" src="images/<?php echo $fetch_id['image']; ?>" alt="" >
                           <input type="hidden" name="divi" value="<?php echo $select_ds?>">
                           <input type="hidden" name="id" value="<?php echo $fetch_id['o_id']; ?>">
                           <input type="submit" name="select" class="car-btn"  value="<?php echo $fetch_id['category_work']." For ".$fetch_id['vehicle']; ?>" >                                     
                     </form>
            <?php
                              }
                           } 
            ?>
                                 </div>
            <?php
                         }
                     }
                     break;
                  }
               }else{
            ?>
                     <p class="p3" >Sorry you cannot booked because your division is not selected yet</p>
            <?php
               } 
         }
      }   
   ?>
      
</section>

<!-- customize section -->

<section class="edit-form">
   <?php
       if(isset($_POST['select'])){
         $select_id = $_POST['id'];    
         $ds_div=$_POST['divi'];
         $select_job = mysqli_query($conn, "SELECT * FROM `occupation_tbl` WHERE o_id = '$select_id'") or die('query failed');
         
         if(mysqli_num_rows($select_job) > 0){
            while($fetch_job = mysqli_fetch_assoc($select_job)){
            
   ?>
   
<form action="bookings5.php" method="post" enctype="multipart/form-data">
      <h4>Collect Details</h4>

      <input type="text" name="user_name" class="box" value="<?php echo $_SESSION['user_name']?> " readonly>
      <input type="hidden" name="address" class="box" value="<?php echo $_SESSION['address']?> " readonly>
      <input type="text" name="phone_num" class="box"value="<?php echo $_SESSION['phone_no']?> " readonly>
      <input type="text" name="nic" class="box" value="<?php echo $_SESSION['nic_no']?> " readonly>
      <input type="text" name="ds_division" class="box" value="<?php echo $ds_div?>" readonly>

   <?php
         $select_group = mysqli_query($conn, "SELECT * FROM `address_tbl` where ds_division='$ds_div'") or die('query failed');
            if(mysqli_num_rows($select_group) > 0){
               while($fetch_group = mysqli_fetch_assoc($select_group)){
    ?>

      <input type="hidden" name="group" class="box" value="<?php echo $fetch_group['grouping']?>" required >

   <?php
               }
            }
    ?>
             
      <input type="text" name="v_code" class="box" placeholder="eg : BHD" required>
      <input type="text" name="v_num" class="box" placeholder="eg : 7648" required><br>
      <input type="text" name="Chassis_num" class="box" placeholder="eg : ME4KC23AFJ8058840" required>
   <?php
         $select_query = mysqli_query($conn, "SELECT distribution_date FROM `petrol_distribution` ORDER BY distribution_date DESC Limit 1") or die('query failed');
            if(mysqli_num_rows($select_query) > 0){
               while($fetch_value = mysqli_fetch_assoc($select_query)){
   ?>
      <input type="date" name="date" class="box" value="<?php echo $fetch_value['distribution_date']?>" required max="<?php echo $fetch_value['distribution_date']?>">
   <?php
               }
            }
   ?><br>

      <input type="text" name="work" class="box"value="<?php echo $fetch_job['category_work']?> " readonly>
      <input type="text" name="type" class="box"value="<?php echo $fetch_job['vehicle']?> "readonly><br>
      <input type="number" name="max_liter" class="box" placeholder="You can fill max:<?php echo $fetch_job['max_literPetrol']?>" min="1" max="<?php echo $fetch_job['max_literPetrol']?>" step="0.1"  required>
      
      <select name="fuel" class="box" >
         <option value="" hidden>Select the fuel type </option>
   <?php
            if($fetch_job['vehicle']=='Bike' || $fetch_job['vehicle']=='Auto' ){
   ?>
        
               <option value="Petrol">Petrol</option>
   <?php
         }
            else if($fetch_job['vehicle']=='Car/Van')
         {
   ?>
               <option value="Petrol">Petrol </option>
               <option value="Diesel">Diesel </option>
   <?php
         }  
            else if($fetch_job['vehicle']=='Heavy vehicles')
         {
   ?>
               <option value="Diesel">Diesel </option>
   <?php
              }
    ?>
      </select>
   <br>

    <?php
            if($fetch_job['category_work']=='Government Staffs'){
    ?>
               <Lable>Job ID:</Lable><br>
     <?php
            }else{
      ?>
               <Lable>Nic Photo :</Lable><br>
      <?php
           }
    ?>
    
         <input type="file" name="image1" accept="image/jpg, image/jpeg, image/png" class="box" required><br>
     <Lable> Letter from GS to confirm your ds division:</Lable><br>
         <input type="file" name="image3" accept="image/jpg, image/jpeg, image/png" class="box" required>
     <br>
         <input type="submit" value="Add details" name="add_details" class="btn" >
     <p class="p2">Note this :<br>Any detail you mentioned above are incorrect then your booking will be cancelled.</p>
   </form>

   <?php
         }
      }
   }
      else{
         echo '<script>document.querySelector(".edit-form").style.display = "none";</script>';
      }
   ?>


</section>

<section>
   
</section>





<?php include 'footer.php'; ?>

<script src="js/script2.js"></script>

 
 
</body>
</html>