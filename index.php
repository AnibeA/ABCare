<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Home Page</title>
  </head>
  <body>
    <?php
      include("header.php");
      $q = "SELECT * FROM indexpage WHERE sectionID = 1";
      $r = mysqli_query($db_connection,$q);
      $row = mysqli_fetch_assoc($r); // fetch row values as an array
      $section1Header = $row['header']; // gets header for section one
      $section1Content =$row['content']; // gets content for section 1

      $q = "SELECT * FROM indexpage WHERE sectionID = 2";
      $r = mysqli_query($db_connection,$q);
      $row = mysqli_fetch_assoc($r); // fetch row values as an array
      $section2Header = $row['header']; // gets header for section one
      $section2Content =$row['content']; // gets content for section 1


      $q = "SELECT * FROM indexpage WHERE sectionID = 3";
      $r = mysqli_query($db_connection,$q);
      $row = mysqli_fetch_assoc($r); // fetch row values as an array
      $section3Header = $row['header']; // gets header for section one
      $section3Content =$row['content']; // gets content for section 1

  ?>
       <div id="poster">
         <div id="postertext">
          <p>ABCare</p>
          <h2>Best day care in Dublin!</h2>
          <p><a href="contact_us.php">Read More</a></p>
        </div>
      </div>

      <div id="moreinfo">
            <div class="infobox1">
              <h3><?php echo $section1Header?></h3>
              <p><?php echo $section1Content?></p>
            </div>
            <div class="infobox2">
            <h3><?php echo $section2Header?></h3>
              <p><?php echo $section2Content?></p>
            </div>
            <div class="infobox3">
            <h3><?php echo $section3Header?></h3>
              <p><?php echo $section3Content?></p>
              <p><img src="images/option4.jpeg" style="float:right;width:120px;height:120px;">
            </div>
        </div>
        <?php
          if (!empty($_SESSION['username'])){ // if user logged in, give access to resources...
            $user = $_SESSION['username'];
            $q = "SELECT * FROM `admin` WHERE adminID = '$user'";
            $r = mysqli_query($db_connection,$q);
            $isAdmin = mysqli_num_rows($r);
            if($isAdmin>0){
              echo "
              <a href=index_edit.php style = padding: 1rem; background-color:#049733; color:#fff; text-decoration:none; border-radius:20px;>Edit</a>";}
          }
        ?>
  </body>
  <?php
    include("footer.php");
    ?>
</html>
