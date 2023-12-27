
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Allowed Division</title>
   <link rel="stylesheet" href="../css/admin_style3.css">
</head>
<body>
<section class="add-detail">
   <form action="" method="post" >
         <input type="date" name="date" class="box"  required min="2022-08-01" max="2023-12-31"> <br>
         <input type="number" name="total_petrol" class="box" placeholder="Enter total petrol" required ><br> 
         <input type="number" name="total_diesel" class="box"  placeholder="Enter total diesel" required > <br>
         <input type="datetime-local" name="date1" class="box"  required > <br>
         <input type="submit" value="Select date" name="add" class="btn">
   </form>
</section>
</body>
</html>

   <?php  
      include '../connection.php';
      if(isset($_POST['add'])) {
         
         $i=1;
         $date = $_POST['date'];
         $date1 = $_POST['date1'];
         $petrol=$_POST['total_petrol'];
         $diesel=$_POST['total_diesel'];
         $sql="SELECT * from `address_tbl` where distribution_date='$date'";
         $result = mysqli_query($conn,$sql);
        
         $allowed_division[]="";
         
         while($row= mysqli_fetch_array($result)){
           
             
            $allowed_division[]  =$row['ds_division'];
        
          }
          $allowed_divisions = implode('  ', $allowed_division);
          echo $allowed_divisions;
                 mysqli_query($conn,"INSERT INTO `petrol_distribution` VALUES('$date', '$allowed_divisions','$date1')");
                 mysqli_query($conn,"INSERT INTO `analyzing_tbl`(date,total_liter_p,total_liter_d) VALUES('$date', '$petrol','$diesel')");
      }

     ?>

