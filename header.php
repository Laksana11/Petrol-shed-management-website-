<?php
if(isset($messages)){
   foreach($messages as $messages){
      echo '
      <div class="message">
         <span>'.$messages.'</span>
        
      </div>
      ';
   }
}
?>


<header class="header">
   <div class="header-2">
      <div class="flex">
     
         <div class="icons">
           
            <div id="menu-btn" class="fas fa-bars"></div>
            
       <?php     
        if(isset( $_SESSION['user_id'])){
         
         ?>
          <div id="user-btn" class="fas fa-user-circle ">
            <span class="user">
            <?php echo $_SESSION['user_name']; ?>
            </span>
         </div>
         <div class="user-box">
         <a href="logout.php" class="car-btn">logout</a>
      </div>
      <?php
      }
      ?>
      </div>
      <nav class="navbar">
        
        <a href="home.php">Home</a>
        <a href="bookings2.php">Bookings</a>   
        <a href="myBookings.php">MyBookings </a>
        <!-- <a href="details.php">Help</a> -->
        <a href="about_us.php">About Us</a>
     </nav>
         
      </div>
       
       
     
   </div>
   
</header>