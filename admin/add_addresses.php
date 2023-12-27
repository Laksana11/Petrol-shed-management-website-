<?php

include '../connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:../login.php');
};

if(isset($_POST['add_details'])){
   $id =$_POST['id'];
   $address =$_POST['address'];
   $division = $_POST['dsDivision'];
   $distance= $_POST['max'];
   $group=$_POST['group'];
   $start=$_POST['stime'];
   $end=$_POST['etime'];
   $date=$_POST['date'];

   $select_address = mysqli_query($conn, "SELECT address FROM `address_tbl` WHERE add_id = '$id'") or die('query failed');

   if(mysqli_num_rows($select_address) > 0){
      $message[] = 'address name already added';
   }else{
       mysqli_query($conn, "INSERT INTO `address_tbl`(`address`, `ds_division`, `max_distance`, `grouping`, `start_time`, `end_time`,`date`) VALUES('$address', '$division', '$distance', '$group', '$start', '$end','date')") or die('query failed');
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Address</title>

   <!-- font awesome link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!--  css file link  -->
   <link rel="stylesheet" href="../css/admin_style3.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>



<h1 class="title">Add divisions</h1>

<section class="add-detail">


   <form action="" method="post" >
      <h3>Details</h3>
      <input type="hidden" name="id" class="box" required >
      <input type="text" name="address" class="box" placeholder="eg . Chunnakam" required size="100">
      <input type="text" name="dsDivision" class="box" placeholder="eg: J/197" required>
      <input type="number" name="max" class="box" placeholder="max distance" step="0.1" min="0.1" max="20.1" required>
      <input type="text" name="group" class="box"  placeholder="group" required>
      <input type="date" name="date" class="box"  required min="2022-08-01" max="2023-12-31">
      <input type="time" name="stime" class="box"  min="07:30" max="20:00" placeholder="Start time : " required>
      <input type="time" name="etime" class="box"  min="07:30" max="20:00" placeholder="End time : " required>
 

      <input type="submit" value="Add details" name="add_details" class="btn">
   </form>

</section>




<!-- custom admin js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>