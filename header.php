<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Home Page</title>
  </head>
  <body>
    <nav id="nav-bar">
      <div class="my_container">
        <h1><a href="index.php">ABCare</a></h1>
          <ul>
            <li><a href="rooms.php">Our Rooms
            <div class="sub-menu">
              <ul>
                <li><a href= "babies.php">Babies</a></li>
                <li><a href= "wobblers.php">Wobblers</a></li>
                <li><a href= "toddlers.php">Toddlers</a></li>
                <li><a href= "preschoolers.php">Preschoolers</a></li>
              </ul>
             </div>
            </li>
            <li><a href= "service.php">Service and Facilities</a></li>
            <li><a href= "testimonial.php">Testimonials</a></li>
            <li><a href= "contact_us.php">Contact Us</a></li>
            <?php
              require('connect.php');
              if (!empty($_SESSION['username'])){ // if user logged in, give access to resources...
                $user = $_SESSION['username'];
                $q = "SELECT * FROM `admin` WHERE adminID = '$user'";
                $r = mysqli_query($db_connection,$q);
                $isAdmin = mysqli_num_rows($r);

                $q = "SELECT * FROM `parent` WHERE `e-mail` = '$user'";
                $r = mysqli_query($db_connection,$q);
                $isParent = mysqli_num_rows($r);
                if($isAdmin>0 || $isParent>0){
                  echo '<li><a href="day_details.php"> Child Day Details</a></li>
                  <li><a href="logout.php">Logout</a></li>';
                }
              }
              else{
                echo '<li><a href="login.php">Login</a></li>';
              }
            ?>
          </ul>
       </div>
     </nav>
   </body>

 </html>
