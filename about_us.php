<?php
include 'connection.php';
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">


</head>
<body>


<section class="home">
<?php include 'header.php'; ?>
</section>

<section class="about_us">

   <div class="flex">
      <div class="content">
         <h3>about us</h3>
         <p> Our restaurant is very famous one in the hometown.Here we serve healthy advised food in healthy advised cooking manner.
            We will deliver the food items which you preferred within the time limit.You can make the pre orders for any functions for a big 
            amount of people.Join with us in your precious occations.</p>
         <a href="contact.php" class="home-btn">contact us</a>
      </div>

   </div>

</section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script>


    $(function () {
        $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text('rating :'+ rating);
            $(this).parent().find('input[name=rating]').val(rating);
        });
    });

</script>
<?php include 'footer.php'; ?>
<script src="js/script1.js"></script>

</body>
</html>