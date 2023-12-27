<?php

include '../connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:../login.php');
};


if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `address_tbl` WHERE `add_id` = '$delete_id'") or die('query failed');
   header('location:manage_address.php');
}

if(isset($_POST['update_details'])){

   $update_id= $_POST['update_id'];
   $update_address= $_POST['update_address'];
   $update_division = $_POST['update_division'];
   $update_distance = $_POST['update_distance'];
   $update_group=$_POST['update_group'];
   $update_stime=$_POST['update_stime'];
   $update_etime=$_POST['update_etime'];
   $update_date=$_POST['update_date'];


   mysqli_query($conn, "UPDATE `address_tbl` SET `address` = '$update_address', `ds_division` = '$update_division',`max_distance` = '$update_distance', `grouping`= '$update_group', `start_time`= '$update_stime', `end_time`= '$update_etime',`distribution_date`= '$update_date' WHERE `add_id` = '$update_id'") or die('query failed');

   header('location:manage_address.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Address</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="../css/admin_style3.css">
   <style>
      .caption{
         text-align: center;
         text-transform:capitalize;
         font-size: 40px;
         margin: 40px;
      }
   </style>
</head>
<body>
   
<?php include 'admin_header.php'; ?>



<h1 class="title">Division details</h1>



<section class="contain">
   <a href="add_addresses.php" div="btn" >Add division</a>
</section>


<!-- show foods  section -->
<section class="show-products">
    
<table>
<tr>
    <th>Add Id</th>
    <th>Address</th>
    <th>DS Divivsion</th>
    <th>Distance</th>
    <th>Group</th>
    <th>Start time</th>
    <th>End Time</th>
    <th>Date</th>
    <th>Update</th>
    <th>Delete</th>

</tr>

      
      <?php
         $select_address= mysqli_query($conn, "SELECT * FROM `address_tbl` ORDER BY distribution_date DESC") or die('query failed');
         if(mysqli_num_rows($select_address) > 0){
         while($fetch_details = mysqli_fetch_assoc($select_address)){
        ?>
        
      <div class="box">
      <form action="" method="POST">
      <tr>
      <td><input type="text" name="update_id" value="<?php echo $fetch_details['add_id']; ?>" ></td>
      <td><input type="text" name="update_address" value="<?php echo $fetch_details['address']; ?>" ></td>
      <td><input type="text" name="update_division" value="<?php echo $fetch_details['ds_division']; ?>" ></td>
      <td><input type="number" name="update_distance" value="<?php echo $fetch_details['max_distance']; ?>" step="0.1" min="0.1" max="20.2"></td>
      <td><input type="text" name="update_group" value="<?php echo $fetch_details['grouping']; ?>" ></td>
      <td><input type="time" name="update_stime" value="<?php echo $fetch_details['start_time']; ?>" min="07:30" max="20:00" ></td>
      <td> <input type="time" name="update_etime" value="<?php echo $fetch_details['end_time']; ?>" min="07:30" max="20:00" ></td>
      <td><input type="date"  name="update_date" value="<?php echo $fetch_details['distribution_date']; ?>" min="2022-08-01" max="2022-12-31"></td>


      <td><input type="submit" value="update" name="update_details" class="option-btn">
      
      <!-- <td><input type="reset" name="delete" value="delete" id="close-update" class="delete-btn"> </td> -->
      <td><a href="manage_address.php?delete=<?php echo $fetch_details['add_id']; ?>" class="delete-btn" onclick="return confirm('Confirm delete?');">delete</a></td>
      </tr>
         </form>
      </div>
      <?php
            }
        }
     ?>
                      
     
   

</table>
</section>

<!-- edit food section -->


<!-- JS file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>