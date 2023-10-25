<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include("header.php");
    ?>
    <div>
        <form action="day_details.php" method="POST">
        <label for="date">Select Date</label><br>
            <input type="date" name="date"   required> <br>
            <input type="submit" name="select" value="Select">
        </form>
        <?php
          if (!empty($_SESSION['username'])){ // if user logged in, give access to resources...
            $user = $_SESSION['username'];
            $q = "SELECT * FROM `admin` WHERE adminID = '$user'";
            $r = mysqli_query($db_connection,$q);
            $isAdmin = mysqli_num_rows($r);
            if($isAdmin>0){
              echo "
              <a href=day_details_edit.php style = padding: 1rem; background-color:#049733; color:#fff; text-decoration:none; border-radius:20px;>Edit</a>";}
          }
        ?>
    </div>
    <?php
        $date = '';
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $errors=[];
            if(empty($_POST['date'])){
                $errors[]= "You have not selected a date please select one";

            }
            else{
                $date = $_POST['date'];
                $date = "$date"; // set date as a string variable so it can be passed into mysql queries
            }
            if(empty($errors)){
                $q = "SELECT * FROM `admin` WHERE adminID = '$user'"; //searches for admin using the username logged in

                $r = mysqli_query($db_connection,$q);   // runs query

                $isAdmin = mysqli_num_rows($r); // gets the number of rows that admin

                $q = "SELECT * FROM `parent` WHERE `e-mail` = '$user'";//searches for parent using the username

                $r = mysqli_query($db_connection,$q); //runs query

                $isParent = mysqli_num_rows($r); // gets number of rows that are parent
        //----------------------------------------
                $q = "SELECT * FROM `dayDetails` WHERE `Date` = '$date'";
                $r = mysqli_query($db_connection,$q);
                $dateExists = mysqli_num_rows($r); //gets number of rows on the date selected.
                if($dateExists>0){
                    if($isAdmin>0){
                        $q = "SELECT * FROM `dayDetails` WHERE `Date` = '$date'";
                        $r = mysqli_query($db_connection,$q);
                        $rows = mysqli_fetch_all($r);
                        var_dump(rows);
                        echo "<table border='1'>";
                        while ($rows = mysqli_fetch_all($r)){
                            echo"
                            <table frame='border'  cellpadding='10' cellspacing='5'>
                            <col align='left'</col>
                            <col align='left'</col>
                            <col align='left'</col>
                            <tr>
                                <th>ChildID</th>
                                <th>FirstName</th>
                                <th>LastName</th>
                                <th>Date</th>
                                <th>Attendence</th>
                                <th>Breakfast</th>
                                <th>Lunch</th>
                                <th>Activites</th>
                                <th>Temperature</th>
                            </tr>
                            ";
                            echo "<tr>";
                            foreach ($rows as $row) {
                                foreach($row as $value){
                                    echo "<td>" . $value. "</td>";
                                }
                            }//close forloop
                            echo "</tr>";
                        }// close while loop
                        echo "</table>";
                    }
                    else if($isParent>0){
                        $q = "SELECT * FROM child WHERE `Parent Email` = '$user'";
                        $r = mysqli_query($db_connection,$q);
                        $row = mysqli_fetch_assoc($r);

                        $childID = $row['ChildID'];

                        $q = "SELECT * FROM `dayDetails` WHERE  `ChildID` = '$childID' AND `Date` = '$date' ";

                        $r = mysqli_query($db_connection,$q);
                        echo "<table border='1'>";
                        while ($row = mysqli_fetch_assoc($r)){
                            echo"
                            <table frame='border'  cellpadding='10' cellspacing='5'>
                            <col align='left'</col>
                            <col align='left'</col>
                            <col align='left'</col>
                            <tr>
                                <th>ChildID</th>
                                <th>FirstName</th>
                                <th>LastName</th>
                                <th>Date</th>
                                <th>Attendence</th>
                                <th>Breakfast</th>
                                <th>Lunch</th>
                                <th>Activites</th>
                                <th>Temperature</th>
                            </tr>
                            ";
                            echo "<tr>";
                            foreach($row as $value){
                                    echo "<td>" . $value. "</td>";
                            }//close forloop
                            echo "</tr>";
                        }// close while loop
                        echo "</table>";

                    }
                }
                else{
                    echo "There are no entries under this day please select another day.";
                }
            }
            else{
                foreach($errors as $errormsg){
                    echo $errormsg; // prints out error messages
                }//close loop
            }
        }
    ?>
</body>
</html>
