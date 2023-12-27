<?php

include 'connection.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `bookings` WHERE b_id = '$delete_id'") or die('query failed');
   header('location:details.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>mybookings</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style1.css">

</head>
<body>
   
<section class="home">
   <?php include 'header.php'; ?>
</section>


<section class="mybookings">

<h1 class="caption">My Bookings</h1>
   <div class="box-container">
    <?php
   $booking_querys = mysqli_query($conn, "SELECT * FROM `booked` WHERE user_id = '$user_id' order by date DESC") or die('query failed');
   ?>
      <div class="myview">
      <table>
           <tr>
           <th>Booking Id</th>
           <th>User ID</th>
            <th>Date</th>
            <th>Valid Date</th>
            <th>Token No</th>
            <th>Start Time</th>
            <th>End time</th>
            <th>Amount of Petrol</th>
            <th>Vehicle Code</th>
            <th>Vehicle Number</th>
            <th>Fuel Type</th>
            <th>Filling Status</th>
            <th>Cancel Bookings</th>
           
           </tr>
           <?php
       
         if(mysqli_num_rows($booking_querys) > 0){
            while($fetch_bookings = mysqli_fetch_assoc($booking_querys)){
         ?>
           <tr> 
           <td><span><?php echo $fetch_bookings['b_id']; ?></span></td> 
           <td><span><?php echo $fetch_bookings['user_id']; ?></span></td>          
            <td><span><?php echo  $fetch_bookings['date']; ?></span></td>
            <td><spab><?php echo  $fetch_bookings['valid_date']; ?></span></td>
            <td><span><?php echo  $fetch_bookings['token_no']; ?></span></td>
            <td><span><?php echo  $fetch_bookings['start_time']; ?></span> </td>
            <td><span><?php echo  $fetch_bookings['end_time']; ?></span> </td>
            <td><span><?php echo  $fetch_bookings['liter']; ?></span> </td>
            <td><span><?php echo  $fetch_bookings['fuel_type']; ?></span> </td>
            <td><?php echo  $fetch_bookings['v_code']; ?></span> </td>
            <td><span><?php echo  $fetch_bookings['v_num'];?></span> </td>
          
            <td>
               <?php
                  if($fetch_bookings['filling_status'] =='Filled'){
                     
               ?>
                     <b style ="color:green; <?php echo "Filled";?>">Filled</b>

               <?php
                        }else
               {?>
                     <b style="color:orange; <?php echo "Not Filles";?>">Not Filled</b>
               <?php
                        }
             
               ?>
           </td>
            <input type="hidden" name="b_id" value="<?php echo $fetch_bookings['b_id']; ?>">
            <td>
               <!-- <a href="cart.php " class ="home-btn <?php echo ($fetch_orders['order_taken'] =='No')?'':'disabled'; ?>">Replace</a>  -->
               <a href="bookings2.php?delete=<?php echo $fetch_bookings['b_id']; ?>" class = "delete-btn <?php echo ($fetch_bookings['filling_status'] =='Not Filled')?'':'disabled'; ?>"onclick="return confirm('Confirm cancel bookings?');">Cancel</a>  
            </td>
            
           </tr>
       
      <?php
       }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
      
      </table> 
   </div>
  

</section>


<?php include 'footer.php'; ?>
<script src="js/script1.js"></script>

</body>
</html>