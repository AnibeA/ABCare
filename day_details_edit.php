<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <?php
        include("header.php");
        ?>
        <div class="form_pages">
        <div class="form2">
        <form action="day_details_edit.php" method = 'POST'>
            <h3>Fill in the appropriate fields.</h3>
            <label for="childID">ChildID</label>
            <input type="text" name = "childID" class="form-control" required> <br>

            <label for="date">Date:</label>
            <input type="date" name="date" class="form-control" required> <br>

            <p>Attendence</p>
            <input type="radio" name="attendence" value="Abscent"# required>
            <label for="attendence">Abscent</label><br>
            <input type="radio" name="attendence" value="Present" required>
            <label for="attendence">Present</label><br>

            <br>
            <label for="breakfast">Breakfast</label>
            <input type="text" name = "breakfast" class="form-control"> <br>

            <label for="lunch">Lunch</label>
            <input type="text" name = "lunch" class="form-control"><br>

          <div class="form-group"
            <p>Select Activities</p>
            <input type="hidden" name="activity1" value=" ">
            <input type="checkBox" name="activity1" value="Sand">
            <label for="activity1">Indoor play-time</label><br>

            <input type="hidden" name="activity2" value=" ">
            <input type="checkBox" name = "activity2" value="Water Play">
            <label for="activity2">Nursery Rhymes</label><br>

            <input type="hidden" name="activity3" value=" ">
            <input type="checkBox" name = "activity3" value="Puzzle">
            <label for="activity3">Puzzle</label><br>

            <input type="hidden" name="activity4" value=" ">
            <input type="checkBox" name = "activity4" value="Dress Up">
            <label for="activity4">Dress Up</label><br>

            <input type="hidden" name="activity5" value=" ">
            <input type="checkBox" name = "activity5" value="Playground">
            <label for="activity5">Play Ground</label><br>

            <input type="hidden" name="activity6" value=" ">
            <input type="checkBox" name = "activity6" value="Art">
            <label for="activity6">Art</label><br>


            <input type="hidden" name="activity7" value=" ">
            <input type="checkBox" name = "activity7" value="Blocks and Shapes">
            <label for="activity7">Story time</label><br>
            <br>
          </div>
          <div class="form-group">
            <label for="temperature">Temperature</label>
            <input type="number" id="temperature" name="temperature" min="35" max="40" step = "0.1"><br>
          </div>
          <br>
            <input type="submit" name="submit" value="submit" style = 'padding: 0.25rem; background-color:#049733; color:#fff; text-decoration:none; border-radius: 1.25rem;'>
        </form>
    </div>
    <div>
        <?php
            $childID = '';
            $childfn = '';
            $childln = '';
            $date = '';
            $attendence = '';
            $breakfast = '';
            $lunch = '';
            $activity1 = '';
            $activity2 = '';
            $activity3 = '';
            $activity4 = '';
            $activity5 = '';
            $activity6 = '';
            $activity7 = '';
            $temperature = '';

            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $errors = [];
                if(empty($_POST['childID'])){
                    $errors[] = "Please enter Child ID";
                }
                else{
                    $childID = validate_input($_POST['childID']);
                }
                if(empty($_POST['date'])){
                    $errors[] = "Please enter the date";
                }
                else{
                    $date = validate_input($_POST['date']);
                }
                if(empty($_POST['attendence'])){
                    $errors[] = "Please Select attendence";
                }
                else{
                    $attendence = validate_input($_POST['attendence']);
                }

                $breakfast = validate_input($_POST['breakfast']);

                $lunch = validate_input($_POST['lunch']);

                $activity1 = validate_input($_POST['activity1']);

                $activity2 = validate_input($_POST['activity2']);

                $activity3 = validate_input($_POST['activity3']);

                $activity4 = validate_input($_POST['activity4']);

                $activity5 = validate_input($_POST['activity5']);

                $activity6 = validate_input($_POST['activity6']);

                $activity7 = validate_input($_POST['activity7']);

                $temperature = validate_input($_POST['temperature']);

                if(empty($errors)){ // check there are no errors
                    $q = "SELECT * FROM child WHERE ChildID = '$childID'"; // get child information based on ChildId

                    $r = mysqli_query($db_connection, $q); // run query

                    $row = mysqli_fetch_assoc($r); // fetch row values as an array

                    if(mysqli_num_rows($r)==0){
                        echo "<h3 style = color:red >This Child Does not exist Try Again <h3>";
                    }
                    else{
                        $childfn = $row['FirstName']; // get childfn value from the row

                        $childln = $row['LastName']; // get childln value from the row

                        $activities = $activity1 .", ". $activity2 .", ". $activity3 .", ". $activity4 .", ". $activity5 .", ". $activity6 .", ". $activity7;  // concatincate activities into one field

                        // check attendence and insert into table where fields are neccessary;
                        if($attendence == "Present"){
                            $q = "INSERT INTO dayDetails(`ChildID`,`FirstName` , `LastName`, `Date`,`Attendence`, `BreakFast` , `Lunch` ,`Activities`, `Temperature`) VALUES('$childID', '$childfn', '$childln', '$date','$attendence','$breakfast', '$lunch', '$activities','$temperature')";
                            $r = mysqli_query($db_connection, $q);
                            if($r){
                                echo "Details have been inserted sucessfully";
                            }
                            else{
                                echo "<h2>ERROR!</h2" . mysqli_error($db_connection);
                            }
                        } //close if
                        else{
                            $q = "INSERT INTO dayDetails(`ChildID`,`FirstName` , `LastName`, `Date`,`Attendence`) VALUES('$childID', '$childfn', '$childln', '$date','$attendence')";

                            $r = mysqli_query($db_connection, $q);
                            if($r){
                                echo "Details have been inserted sucessfully";
                            }
                            else{
                                echo "<h2>ERROR!</h2" . mysqli_error($db_connection);
                            }
                        } //close else
                    } //close else
                } //close if
                else{
                    foreach($errors as $errormsg){
                        echo $errormsg; // prints out error messages
                    }//close loop
                }
            }// close main if

            // validates input
            function validate_input($input){
                $input = trim($input); //removes white spaces
                $input = strip_tags($input); //removes any html tags
                $data = stripcslashes($input);

                return $input;
            }
        ?>
    </div>
  </div>
</div>
</body>
</html>
