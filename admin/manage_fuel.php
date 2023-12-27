<?php

include '../connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:../login.php');
};

if(isset($_POST['add_fuel'])){

   $fuel =$_POST['fuel'];
   $vehicle = $_POST['vehicles'];
   $price = $_POST['price'];
   $availability = $_POST['availability'];


   $select_jobs = mysqli_query($conn, "SELECT fuel_type FROM `fuel_tbl` WHERE `fuel_type` = '$fuel'") or die('query failed');

   if(mysqli_num_rows($select_jobs) > 0){
      $message[] = 'fuel already added';
   }else{
       mysqli_query($conn, "INSERT INTO `fuel_tbl`(`fuel_type`, `available_vehicle`,`price`,`availability`) VALUES('$fuel', '$vehicle','$price','$availability')") or die('query failed');
   }
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `fuel_tbl` WHERE `f_id` = '$delete_id'") or die('query failed');
    header('location:manage_fuel.php');
 }


 if(isset($_POST['update_fuels'])){

    $update_id= $_POST['update_id'];
    $update_fuel = $_POST['update_fuel'];
    $update_vehicles = $_POST['update_vehicles'];
    $update_price = $_POST['update_price'];
    $update_availability=$_POST['available'];
    // $update_etime=$_POST['update_etime'];
 
    mysqli_query($conn, "UPDATE `fuel_tbl` SET `fuel_type` = '$update_fuel', `available_vehicle` = ' $update_vehicles',`price` = ' $update_price', `availability`='$update_availability' WHERE `f_id` = '$update_id'") or die('query failed');
 
    header('location:manage_fuel.php');
 
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!--  css file link  -->
   <link rel="stylesheet" href="../css/admin_style3.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>



<h1 class="title">Fuel </h1>

<section class="add-detail">


   <form action="" method="post" >
      <h3>Details</h3>
      <input type="text" name="fuel" class="box" placeholder="Enter the fuel type" required>
      <input type="text" name="vehicles" class="box" placeholder="Enter the vehicle" required> 
      <input type="number" min="0" name="price" class="box" placeholder="Enter fuel price" required>
      <label class="lbl">Availability:
         <input type="radio" name="availability" value="Yes" class="rdo" required />YES
         <input type="radio" name="availability" value="No" class="rdo" required />No
      </label>


      <input type="submit" value="Add fuel" name="add_fuel" class="btn">
   </form>

</section>

<section class="show-products">
    
<table>
<tr>
    <th>Fuel Id</th>
    <th>Fuel Type</th>
    <th>Available Vehicles</th>
    <th>Price</th>
    <th>Availability</th>
    <th>Update</th>
    <th>Delete</th>

</tr>

      
      <?php
         $select_fuel= mysqli_query($conn, "SELECT * FROM `fuel_tbl`") or die('query failed');
         if(mysqli_num_rows($select_fuel) > 0){
         while($fetch_fuel = mysqli_fetch_assoc($select_fuel)){
        ?>
        
      <div class="box">
      <form action="" method="POST">
      <tr>
      <td><input type="text" name="update_id" value="<?php echo $fetch_fuel['f_id']; ?>" ></td>
      <td><input type="text" name="update_fuel" value="<?php echo $fetch_fuel['fuel_type']; ?>" ></td>
      <td><input type="text" name="update_vehicles" value="<?php echo $fetch_fuel['available_vehicle']; ?>" ></td>
      <td><input type="number" name="update_price" value="<?php echo $fetch_fuel['price']; ?>" step="0.1" min="0" ></td>
      <td><input type="text" name="available" value="<?php echo $fetch_fuel['availability']; ?>"></td>
      <td><input type="submit" value="update" name="update_fuels" class="option-btn">
      
      <!-- <td><input type="reset" name="delete" value="delete" id="close-update" class="delete-btn"> </td> -->
      <td><a href="manage_jobs.php?delete=<?php echo $fetch_fuel['f_id']; ?>" class="delete-btn" onclick="return confirm('Confirm delete?');">delete</a></td>
      </tr>
         </form>
      </div>
      <?php
            }
        }
     ?>
                      
     
   

</table>
</section>


<!-- custom admin js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>