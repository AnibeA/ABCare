<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <?php
    include('header.php')
   ?>
<div>
  <form class="modal-content animate" action="" method="post">
    <div class="imgcontainer">
      <link rel="stylesheet" href="style.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <img src="images/img_avatar2.jpeg" alt="Avatar" class="avatar">
    </div>

    <div class="container1">
      <div class="row">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" id="uname"required>
    </div>

    <div class="row">
      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" id="psw"required>
    </div>
      <br>
      <button type="submit">Login</button>
    </div>

    <span class="registration">Register <a href="registeration.php">new account?</a></span>

    </div>
  </form>
</div>
<?php
$password= "";
$username= "";
//requesting the password and username from the form
	if($_SERVER['REQUEST_METHOD']=='POST'){
    $errors = [];
    if(empty($_POST['uname'])){
      $errors[] = "";
    }
    else{
      $username= pass_input($_POST['uname']);

    }
    if(empty($_POST['psw'])){
      $errors[] = "";
    }
    else{
      $password= pass_input($_POST['psw']);
    }
    require("connect.php");
    $q= "SELECT * FROM admin WHERE AdminID = '$username' AND `Password` = '$password';";
    $r = mysqli_query($db_connection,$q);
    $adminExists = mysqli_num_rows($r);
    echo $username . $password;
    $q= "SELECT * FROM parent WHERE `e-mail` = '$username' AND `Password` = '$password';";
    $r = mysqli_query($db_connection,$q);
    $parentExists = mysqli_num_rows($r);
    echo $parentExists;

    $row = mysqli_fetch_assoc($r);
    var_dump($row);
    $firstname = $row['FirstName'];
    $lastname =$row['LastName'];

    if($adminExists==0 && $parentExists == 0){
      echo "Username or Password incorrect. Please Try again. Or
      <a href = registeration.php>Sign Up </a>";
    }
    else{
      $_SESSION['username'] = $username;
      $_SESSION['firstName'] = $firstname;
      $_SESSION['lastname'] = $lastname;
      $user =  $_SESSION['username'];
      $GLOBALS['user'];
      header("Location: index.php");
    }
  }
// pass_input function - get ride of uncessary characters for example your backslashes and tags
	function pass_input($data){ //
        $data = trim($data);
        $data = strip_tags($data);
        $data = stripcslashes($data);
        $data = strtolower($data);
        $data = str_replace(' ','',$data);
        $data = str_replace('-','',$data);
        return $data;
        }
?>
</body>
</html>
