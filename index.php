<?php include "includes/db.php";?>
<?php include "includes/header.php"; ?>


<?php

if(isset($_POST['index'])){


$username = isset($_POST['username']) ? $_POST['username'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';


$username = mysqli_real_escape_string($connection, $username);
$email = mysqli_real_escape_string($connection, $email);
$password = mysqli_real_escape_string($connection, $password);

$query = "SELECT * FROM users WHERE email = '{$email}' ";

//brings result and assign to this variable
$select_user_query = mysqli_query($connection, $query);

if(!$select_user_query) {

        die("QUERY FAILED" . mysqli_error($connection));
}
    while ($row= mysqli_fetch_array($select_user_query)) {

        $db_password = $row['password'];
        $db_username = $row['username'];
        $db_email = $row['email'];
     
    }

    $message2 = "Email or password is not correct";
    if(isset($db_email) && $email === $db_email && md5($password) === $db_password) {
        $_SESSION['username'] = $db_username;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $db_password;
        $message2 = '';
        header("Location: main.php");
        }
}

?>


<style>
body {background-color:#c9d6df !important;}
</style>

<section id="loginf">
<div class="simple-login-container">
    <h2>Autorizācija</h2>
    <div class="row">
        <div class="col-md-12 form-group">

       <h6> <?= isset($message2) ? $message2 : ''  ?> </h6> 

        <form action="index.php" method="post">

     

            <input name="email" type="text" class="form-control" placeholder="Email">
        </div>
        <div class="col-md-12 form-group">
            <input name="password" type="password" placeholder="Enter your Password" class="form-control">
            <!-- <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span> -->
        </div>
        <div class="col-md-12 form-group">
            <input type="submit" class="btn btn-block btn-login" name="index" value="Login">
        </div>
        <div class="col-md-12 form-group">
          <!-- <p class="registartion">Do not have an account?</p> -->

          <span>Do not have an account? <a href="registration.php" class="register btn btn-secondary btn-sm btn-success">   Registartion</a> </span> 

        <!-- <form action="registration.php" method="post">
          <input type="submit" class="btn btn-secondary btn-sm btn-success register" name="registration" value="Registration"> 
        </form> -->
        </div>
       
    </form>
  
        <!-- <div class="col-md-12">
<span>Are you new user? <a href="registration.php" class="register btn btn-secondary btn-sm btn-success">   Registartion</a> </span> 
    </div> -->
</div>


</section>
</body>
</html>