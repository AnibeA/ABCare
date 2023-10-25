<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registeration</title>
</head>
<body>

    <!----------------------------------PHP------------------------------------------>
    <div>
        <?php
            //--- child varibales ---//
            $idNum;
            $childID = '';
            $typeOfChild = '';
            $childFN = '';
            $childLN = '';
            $dob = '';
            $gender = '';
            $schedule ='';
            $numberOfDays = '';
            //--- parent variables ---//
            $parentFN = '';
            $parentLN = '';
            $address = '';
            $street1 = '';
            $street2 = '';
            $city = '';
            $postalCode = '';
            $email = '';
            $pass1 = '';
            $fees = 0; // fee variable

            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $errors = []; // intialising errors array
                if(empty($_POST['childType'])){
                    $errors[] = "Please fill in the category your child falls under"; // adds a message to the error array
                }
                else{
                    $typeOfChild = validate_input($_POST['childType']);
                }
                if(empty($_POST['childFN'])){
                    $errors[] = "Please fill in your childs first name"; // adds a message to the error array
                }
                else{
                    $childFN = validate_input($_POST['childFN']);

                }
                if(empty($_POST['childLN'])){
                    $errors[] = "Please fill in your childs last name"; // adds a message to the error array
                }
                else{
                    $childLN = validate_input($_POST['childLN']);

                }
                if(empty($_POST['dob'])){
                    $errors[] = "Please fill in your childs last name"; // adds a message to the error array
                }
                else{
                    $dob = validate_input($_POST['dob']);
                }

                if(empty($_POST['gender'])){
                    $errors[] = "Please fill in your childs gender"; // adds a message to the error array
                }
                else{
                    $gender = validate_input($_POST['gender']);

                }
                if(empty($_POST['schedule'])){
                    $errors[] = "Please select a schedule"; // adds a message to the error array
                }
                else{
                    $schedule = validate_input($_POST['schedule']);

                }
                if(empty($_POST['days'])){
                    $errors[] = "Please select the number days your child attend"; // adds a message to the error array
                }
                else{
                    $numberOfDays = validate_input($_POST['days']);

                }
                if(empty($_POST['parentFN'])){
                    $errors[] = "Please fill in your  first name"; // adds a message to the error array
                }
                else{
                    $parentFN = validate_input($_POST['parentFN']);

                }
                if(empty($_POST['parentLN'])){
                    $errors[] = "Please fill in your  last name"; // adds a message to the error array
                }
                else{
                    $parentLN = validate_input($_POST['parentLN']);

                }

                if(empty($_POST['street'])){
                    $errors[] = "Please fiil your address"; // adds a message to the error array
                }
                else{
                    $street1 = validate_input($_POST['street']);
                }

                if(empty($_POST['city'])){
                    $errors[] = "Please fill the city field"; // adds a message to the error array
                }
                else{
                    $city = validate_input($_POST['city']);
                }
                if(empty($_POST['postalCode'])){
                    $errors[] = "Please fill the postal code"; // adds a message to the error array
                }
                else{
                    $postalCode = validate_input($_POST['postalCode']);
                }
                if(empty($_POST['phoneNumber'])){
                    $errors[] = "Please fill in your phone number"; // adds a message to the error array
                }
                else{
                    $phone = validate_input($_POST['phoneNumber']);

                }
                if(empty($_POST['email'])){
                    $errors[] = "Please confirm your password"; // adds a message to the error array
                }
                else{
                    $email = validate_input($_POST['email']);
                }
                if(!empty($_POST['pass1'])){
                    if($_POST['pass1']!=$_POST['pass2']){
                        $errors[] = "These Passwords don't match";
                    }
                    else{
                        $pass1 = validate_input($_POST['pass1']);
                    }
                }
                else {
                    $errors[] = "Please fill in your password"; // adds a message to the error array
                }


                $address = $street1 . " " . $street2 . " " . $city; // setting address from values inputted


                // -- calculate fees based on schedule --
                if($schedule=="Full day"){
                    $fees = 50 * $numberOfDays * 4; // calculates a monthly fee for full day schedules;
                }
                else if($schedule=='Morning Hours'|| $schedule == 'Afternoon Hours'){
                    $fees = 35 * $numberOfDays * 4; // caculates a monthly fee for half day schedule
                }
                if(empty($errors)){
                    require('home/s3054933/connect.php'); //connect to database
                    //inserts data into parent table
                    $q = "INSERT INTO parent(`e-mail`,`FirstName`, `LastName`, `Address`, `PostalCode`, `Phone`,`Password`) Values('$email','$parentFN','$parentLN', '$address','$postalCode','$phone','$pass1');";

                    $r= mysqli_query($db_connection,$q); // run query

                    //insert data into child table
                    $q = "INSERT INTO child(`FirstName`, `LastName`, `Gender`, `DOB`, `Type`, `Parent Email`) Values('$childFN','$childLN', '$gender','$dob','$typeOfChild','$email');";

                    $r= mysqli_query($db_connection,$q);// run query

                    //---- fees tables ----//

                    $q="SELECT * FROM child WHERE `Parent Email` = '$email';"; //select row from child table based on email

                    $r = mysqli_query($db_connection,$q); // run query

                    $row = mysqli_fetch_assoc($r); // fetch row values as an array

                    $childID = $row['ChildID']; // get childID value from the row

                    // insert data into fees table
                    $q = "INSERT INTO fees(`ChildID`,`FirstName`, `LastName`, `Schedule`, `Days`, `Fees`) Values('$childID','$childFN','$childLN', '$schedule','$numberOfDays','$fees');";

                    $r = mysqli_query($db_connection,$q); //run query

                    //insert into service
                    // $q = "SELECT * from child WHERE `Type` = '$typeOfChild'";

                    // $r = mysqli_query($db_connection,$q); // run query

                    // $row = mysqli_fetch_assoc($r); // fetch row values as an array

                    // $childID = $row['ChildID']; // get childID value from the row

                    // $q = "SELECT * FROM `service` WHERE `room` = '$typeOfChild' ";

                    // $r = mysqli_query($db_connection,$q); // run query

                    // $row = mysqli_fetch_assoc($r); // fetch row values as an array

                    // $members = $row['members']; // get members value from the row

                    // $updatedMembers = $members . $childID .", "; //add child to members

                    // $q = "UPDATE `service` SET `members` = '$updatedMembers' WHERE `room` = '$typeOfChild'";

                    // $r = mysqli_query($db_connection,$q); // run query

                    //include footer and quit script;
                    // include('includes/footer.html');
                    echo "You have been successfully registered
                    <p>Click to retrurn to <a href=index.php style = text-decoration:none;>Home Page</a></p>";
                    exit();
                }
                else{
                    foreach($errors as $errormsg){
                        echo $errormsg; // prints out error messages
                    }//close loop
                }  // close else
            }
            // validates input
            function validate_input($input){
                $input = trim($input); //removes white spaces
                $input = strip_tags($input); //removes any html tags
                $data = stripcslashes($input);

                return $input;
            }
        ?>
    </div>

    <!-- Registeration Form  html-->
    <div>
    <?php include('header.php');?>
        <form action="registeration.php" method="POST">
            <h1>Registeration</h1>
            <div id="childInfo">
                <h3>Child Information</h3>
                <label for="childType">Please Select the category your child falls under</label>
                <select name="childType" id="childType">
                    <option value = "" disabled selected>Select Category</option>
                    <option value="Babies"<?php if(isset($POST['childType'])&&($_POST['childType'] =='Babies')){ echo 'selected="selected"';} ?>>Babies</option>
                    <option value="Wobblers"<?php if(isset($POST['childType'])&&($_POST['childType'] =='Wobblers')){ echo 'selected="selected"';} ?>>Wobblers</option>
                    <option value="Toddlers"<?php if(isset($POST['childType'])&&($_POST['childType'] =='Toddlers')){ echo 'selected="selected"';} ?>>Toddlers</option>
                    <option value="PreSchoolers"<?php if(isset($POST['childType'])&&($_POST['childType'] =='Preschoolers')){ echo 'selected="selected"';} ?>>Preschoolers</option>
                </select><br>

                <label for="childFN">First Name</label>
                <input type="text" name="childFN"   value="<?php if (isset($_POST['childFN'])){print htmlspecialchars($_POST ['childFN']);}?>" required>

                <label for="childLN">Last Name</label>
                <input type="text" name="childLN"  value="<?php if (isset($_POST['childLN'])){print htmlspecialchars($_POST ['childLN']); }?>" required>

                <label for="dob">Date of Birth</label>
                <input type="date" name="dob"  value="<?php if (isset($_POST['dob'])){print htmlspecialchars($_POST ['dob']); }?>" required> <br>

                <p>Please Select your childs geneder.</p>
                <input type="radio" name="gender" value="Male"<?php if (isset($_POST['gender'])&& $_POST['gender'] == 'Male') echo 'checked';?> required>
                <label for="gender">Male</label><br>
                <input type="radio" name="gender" value="Female" <?php if (isset($_POST['gender'])&& $_POST['gender'] == 'Female') echo 'checked';?> required>
               <label for="gender">Female</label><br>
            </div>
            <div id="schedule">
                <p>Please select the hours of child care</p>
                <input type="radio" name="schedule" value="Full day" <?php if (isset($_POST['schedule'])&& $_POST['schedule'] == 'Full day') echo 'checked';?> required>
                <label for="fullday">Full Day</label><br>
                <input type="radio" name="schedule" value="Morning Hours"<?php if (isset($_POST['schedule'])&& $_POST['schedule'] == 'MorningHours') echo 'checked';?> required>
                <label for="morningHours">Half Day (Morning)</label><br>
                <input type="radio" name="schedule" value="Afternoon Hours"<?php if (isset($_POST['schedule'])&& $_POST['schedule'] == 'AfternoonHours') echo 'checked';?> required>
                <label for="afternoonHours">Half Day (Afternoon)</label><br>

                <label for="days">Number of Days a week (between 1 and 5):</label>
                <input type="number" id="days" name="days" value="<?php if (isset($_POST['days'])){print htmlspecialchars($_POST ['days']);}?>" min="1" max="5">
            </div>

            <div id="parentInfo">
                <h3>Parent Information</h3>
                <label for="parentFN">First Name</label>
                <input type="text" name="parentFN"  value="<?php if (isset($_POST['parentFN'])){print htmlspecialchars($_POST ['parentFN']);}?>" required>

                <label for="parentLN">Last Name</label>
                <input type="text" name="parentLN" value="<?php if (isset($_POST['parentLN'])){print htmlspecialchars($_POST ['parentLN']);}?>" required><br>


                <p>Address</p>
                <label for="street"> Street Address</label>
                <input type="text" name="street" value="<?php if (isset($_POST['street'])){print htmlspecialchars($_POST ['street']);}?>" required>

                <label for="street2"> Street Address Line 2</label>
                <input type="text" name="street2" value="<?php if (isset($_POST['street2'])){print htmlspecialchars($_POST ['street2']);}?>"><br>

                <label for="city"> City</label>
                <input type="text" name="city" value="<?php if (isset($_POST['city'])){print htmlspecialchars($_POST ['city']);}?>" required>

                <label for="postalCode"> Postal Code</label>
                <input type="text" name="postalCode" value="<?php if (isset($_POST['postalCode'])){print htmlspecialchars($_POST ['postalCode']);}?>" required><br>

                <label for="phoneNumber">Phone Number</label>
                <input type="tel" name="phoneNumber" placeholder="000-000-0000" value="<?php if (isset($_POST['phoneNumber'])){print htmlspecialchars($_POST ['phoneNumber']);}?>" required><br>

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="myname@example.com" value="<?php if (isset($_POST['email'])){print htmlspecialchars($_POST ['email']);}?>" required><br>

                <label for="pass1">Password</label>
                <input type="password" name="pass1" required><br>


                <label for="pass2">Confirm Password</label>
                <input type="password" name="pass2" required><br>
            </div>
            <input type="submit" name="register" value="Register">
        </form>
    </div>
</body>
</html>
