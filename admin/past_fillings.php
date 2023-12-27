<?php

include '../connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
   header('location:../login.php');
}



if(isset($_POST['update_details'])){
   $booking_id = $_POST['b_id'];
   $update_status = $_POST['update_status'];
   $date=$_POST['date'];
   $valid_date= date('Y-m-d', strtotime($date. ' + 7 days'));  
   // $update_delivery_status=$_POST['update_delivery_status'];
   mysqli_query($conn, "UPDATE `bookings` SET filling_status = '$update_status',  valid_date=' $valid_date' WHERE b_id = '$booking_id '") or die('query failed');
   $message[] = 'payment status has been updated!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `bookings` WHERE b_id = '$delete_id'") or die('query failed');
   header('location:manage_filling.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Past fillings</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="../css/admin_style3.css">
   <!-- <style>
      .option-btn{
         background-color:#7fa047;
         
      }
      
   </style> -->

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="orders">

   
   <h1 class="title">Bookings</h1>
   <table>
      <tr>
         <th>Booking</th>
         <th>User Id</th>
         <th>Date</th>
         <th>Valid Date</th>
         <th>NIC Number</th>
         <th>Ds Division</th>
         <th>Work</th>
         <th>Vehicle</th>
         <th>Vehicle Code</th>
         <th>Vehicle No</th>
         <th>Chassis No</th>
         <th>Fuel</th>
         <th>Liter</th>
         <th>NIC Photo</th>
         <th>Electicity Pic</th>
         <th>Filling Status</th>
         <th>Update</th>
         <th>Delete</th>
      </tr>
      <?php
      $select_date = mysqli_query($conn, "SELECT distribution_date FROM `petrol_distribution` ORDER BY distribution_date DESC LIMIT 1") or die('query failed');
        if(mysqli_num_rows($select_date) > 0){
          while($fetch_date = mysqli_fetch_assoc($select_date)){
            $date=$fetch_date['distribution_date'];

      $select_bookings = mysqli_query($conn, "SELECT * FROM `bookings` Where date < '$date' ORDER BY filling_status DESC") or die('query failed');

      // $select_orders = mysqli_query($conn, "SELECT * FROM `order_tbl` WHERE order_date LIKE '$cur_date%  ORDER BY order_taken") or die('query failed');
      if(mysqli_num_rows($select_bookings) > 0){
         while($fetch_details = mysqli_fetch_assoc($select_bookings)){
      ?>
      <tr>
         <td><?php echo $fetch_details['b_id']; ?></td>
         <td><?php echo $fetch_details['user_id']; ?></td>
         <td><?php echo $fetch_details['date']; ?></td>
         <td><?php echo $fetch_details['valid_date']; ?></td>
         <td><?php echo $fetch_details['nic_no']; ?></td>
         <td><?php echo $fetch_details['ds_division']; ?></td>
         <td><?php echo $fetch_details['work_type']; ?></td>
         <td><?php echo $fetch_details['selected_vehicle']; ?></td>
         <td><?php echo $fetch_details['v_code']; ?></td>
         <td><?php echo $fetch_details['v_num']; ?></td>
         <td><?php echo $fetch_details['chassis_No']; ?></td>
         <td><?php echo $fetch_details['fuel_type']; ?></td>
         <td><?php echo $fetch_details['liter']; ?></td>
         <td><img src="../images/<?php echo $fetch_details['nic_photo']; ?>" alt="" height="100" width="80"></td>
         <td><img src="../images/<?php echo $fetch_details['electricity_bill_photo']; ?>" alt="" height="100" width="80"></td>
   
         
      

         <td><form action="" method="post">
            <input type="hidden" name="b_id" value="<?php echo $fetch_details['b_id']; ?>">
            <input type="hidden" name="date" value="<?php echo $fetch_details['date']; ?>">
            <select class="selecting" name="update_status">
            <option value="<?php echo $fetch_details['filling_status']; ?>" hidden><?php echo $fetch_details['filling_status']; ?></option>
            <option value="Not Filled">Not Filled</option>   
            <option value="Filled">Filled</option>
            </select>
         </td>
       
         <td><input type="submit" value="Update"  name="update_details" class="option-btn"> </td>
         <td> <a href="manage_fillings.php?delete=<?php echo  $fetch_details['b_id']; ?>" onclick="return confirm('delete this order?');" class="delete-btn">Delete</a> </td>
         </form>
        
       
      </tr>
      <?php
         }
      }
   }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
   
   </table>
      
</section>



<!-- custom admin js file link  -->
<script src="../js/admin_script.js"></script>



</body>
</html>