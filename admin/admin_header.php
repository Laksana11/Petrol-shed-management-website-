<header class="header">

   <div class="flex">
   <a><img src="../images/download.png" height="80" width="100"></a>
      <nav class="navbar">
         <a href="admin_home.php">Home</a>
         <a href="manage_address.php">Divisions</a>
         <a href="manage_jobs.php">Occupation</a>
         <a href="manage_filling.php">Bookings</a>
         <a href="manage_users.php">Users</a>
        
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user-circle">
         <span class="user">
            <?php echo $_SESSION['admin_name']; ?>
            </span>
         </div> 
      </div>

      <div class="account-box">
         <a href="../logout.php" class="delete-btn">logout</a>
      </div>

   </div>

</header>