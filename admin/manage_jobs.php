<?php

include '../connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:../login.php');
};


if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `occupation_tbl` WHERE `o_id` = '$delete_id'") or die('query failed');
   header('location:manage_jobs.php');
}
if(isset($_POST['add_jobs'])){

   $occupation =$_POST['occupation'];
   $vehicle = $_POST['vehicle'];
   $liter = $_POST['liter'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'images/'.$image;

       $add_details=mysqli_query($conn, "INSERT INTO `occupation_tbl`(`category_work`, `vehicle`,`max_literPetrol`,`image`) VALUES('$occupation', '$vehicle','$liter','$image')") or die('query failed');
 
       if($add_details){ 

         if($image_size > 2000000){
            $message[] = 'image size is too large';
         }else{
            move_uploaded_file($image_tmp_name, $image1_folder);
         }
      }else
      {
         $message[] = 'photo could not be added!';
      }
}


if(isset($_POST['update_jobs'])){

   $update_id= $_POST['update_id'];
   $update_job = $_POST['update_occupation'];
   $update_vehicle = $_POST['update_vehicle'];
   $update_liter = $_POST['update_liter'];
   $image = $_POST['update_image'];

   

   $add_details= mysqli_query($conn, "UPDATE `occupation_tbl` SET `category_work` = '$update_job', `vehicle` = '$update_vehicle',`max_literPetrol` = '$update_liter' ,`image`='$image' WHERE `o_id` = '$update_id'") or die('query failed');
   if($add_details){ 

      if($image_size > 2000000){
         $message[] = 'image size is too large';
      }else{
         move_uploaded_file($image_tmp_name, $image1_folder);
      }
   }else
   {
      $message[] = 'photo could not be added!';
   }
   header('location:manage_jobs.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>jobs</title>

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



<h1 class="title">Work Type</h1>
<section class="add-detail">


   <form action="" method="post" >
      <h3>Details</h3>
      <input type="text" name="occupation" class="box" placeholder="eg . category" required>
      <input type="text" name="vehicle" class="box" placeholder="enter vehicle name" required>
      <input type="number" name="liter" class="box" placeholder="enter max liter" step="0.1" max="40" min="2"required>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <!-- <input type="time" name="s_time" class="box"  min="07:30" max="20:00"  required>
      <input type="time" name="e_time" class="box"  min="07:30" max="20:00"  required> -->

      <input type="submit" value="Add jobs" name="add_jobs" class="btn">
   </form>

</section>





<!-- show foods  section -->
<section class="show-products">
    
<table>
<tr>
    <th>Occupation Id</th>
    <th>Occupation</th>
    <th>Vehicle</th>
    <th>Max Liter</th>
    <th>Image</th>
    <th>Update Image</th>
    <th>Update</th>
    <th>Delete</th>

</tr>

      
      <?php
         $select_occ= mysqli_query($conn, "SELECT * FROM `occupation_tbl`") or die('query failed');
         if(mysqli_num_rows($select_occ) > 0){
         while($fetch_jobs = mysqli_fetch_assoc($select_occ)){
        ?>
        
      <div class="box">
      <form action="" method="POST">
      <tr>
      <td><input type="text" name="update_id" value="<?php echo $fetch_jobs['o_id']; ?>" ></td>
      <td><input type="text" name="update_occupation" value="<?php echo $fetch_jobs['category_work']; ?>" ></td>
      <td><input type="text" name="update_vehicle" value="<?php echo $fetch_jobs['vehicle']; ?>" ></td>
      <td><input type="number" name="update_liter" value="<?php echo $fetch_jobs['max_literPetrol']; ?>" step="0.1" min="2" max="40"></td>
      <td><img src="../images/<?php echo $fetch_jobs['image']; ?>" alt="" height="100" width="80"></td>
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_jobs['image']; ?>">
      <td><input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box" required></td>
      <td><input type="submit" value="update" name="update_jobs" class="option-btn">
      
      <!-- <td><input type="reset" name="delete" value="delete" id="close-update" class="delete-btn"> </td> -->
      <td><a href="manage_jobs.php?delete=<?php echo $fetch_jobs['o_id']; ?>" class="delete-btn" onclick="return confirm('Confirm delete?');">delete</a></td>
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