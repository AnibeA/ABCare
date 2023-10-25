<?php
        include("header.php");

        if(isset($_POST['access'])){
            if (!empty($_SESSION['username'])){ // if user logged in,
                header("Location:daily_activities.php"); //redirect to faily activites pages
                die; // kill header
            }
         else{ // if not logged in
            header("Location:login.php"); //redirect to login page
            die;
          }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <title>Document</title>
</head>
<body>
  <main>

      <div id="rooms">

          <div class="box">
              <h3> Babies Room</h3>
                  <ul style="list-style-type: none;" >
                      <li> Times:8am - 6pm</li>
                      <li>Age: 3 Months - 1 Year Old </li>
                      <li>Class Size: 12</li>
                      <li>Half Day Rate €35</li>
                      <li>Full Day Day Rate €35</li>
                      <li>
                          <a href="babies.php">
                              <i style='font-size:24px' class='fas'>&#xf105;</i>
                          </a>
                      </li>
                  </ul>
          </div>
          <div class="box">
              <h3> Wobblers Room</h3>
                  <ul style="list-style-type: none;" >
                      <li> Times:8am - 6pm</li>
                      <li>Age: 1 - 2 Year Old </li>
                      <li>Class Size: 12</li>
                      <li>Half Day Rate €35</li>
                      <li>Full Day Day Rate €35</li>
                      <li>
                          <a href="wobblers.php">
                              <i style='font-size:24px' class='fas'>&#xf105;</i>
                          </a>
                      </li>
                  </ul>
          </div>
          <div class="box">
              <h3> Toddlers Room</h3>
                  <ul style="list-style-type: none;" >
                      <li> Times:8am - 6pm</li>
                      <li>Age: 2 - 3 Year Old </li>
                      <li>Class Size: 12</li>
                      <li>Half Day Rate €35</li>
                      <li>Full Day Day Rate €35</li>
                      <li>
                          <a href="toddlers.php">
                              <i style='font-size:24px' class='fas'>&#xf105;</i>
                          </a>
                      </li>
                  </ul>
          </div>
          <div class="box">
              <h3> Pre-Schoolers Room</h3>
                  <ul style="list-style-type: none;" >
                      <li> Times:8am - 6pm</li>
                      <li>Age: 3 - 5 Year Old </li>
                      <li>Class Size: 12</li>
                      <li>Half Day Rate €35</li>
                      <li>Full Day Day Rate €35</li>
                      <li>
                          <a href="preschoolers.php">
                              <i style='font-size:24px' class='fas'>&#xf105;</i>
                          </a>
                      </li>
                  </ul>
          </div>
      </div>
  </main>
</body>
<?php
  include ('footer.php');
 ?>
</html>
