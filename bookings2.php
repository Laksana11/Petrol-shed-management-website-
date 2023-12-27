<?php

include 'connection.php';

session_start();

$user_id = $_SESSION['user_id']; 

if(!isset($user_id)){
   header('location:../login.php');
};

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




<section class="products">  
   <h1 class="caption">Select any option suitables to you </h1>
         
                  <table class="table">
                     <tr>
                        <td> <a href="bookings5.php">Filling Up Petrol In a New Vehicle</a></td>  
                        <td><a href="bookings.php">Filling Up Petrol For An Already Filled Vehicle</a></td>
                     </tr>
                  </table>                                 
</section>

<?php include 'footer.php'; ?>

<script src="js/script2.js"></script>
 
</body>
</html>