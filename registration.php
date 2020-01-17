<?php include "includes/db.php";?>
<?php include "includes/header.php"; ?>


<?php 

if(isset($_POST['submit'])) {
    $name    = trim($_POST['name']);
    $middle_name    = trim($_POST['middle_name']);
    $surname    = trim($_POST['surname']);
    $email    = trim($_POST['email']);
    $password = md5(trim($_POST['password']));

    if(!empty($name) && !empty($surname) && !empty($email) && !empty($password)) {
        $name       = mysqli_real_escape_string($connection, $name);
        $middle_name    = mysqli_real_escape_string($connection, $middle_name);
        $surname    = mysqli_real_escape_string($connection, $surname);
        $email    = mysqli_real_escape_string($connection, $email);
        $password    = mysqli_real_escape_string($connection, $password);

        $query = "INSERT INTO users (name, middle_name, surname, email, password) ";
        $query .="VALUES ('{$name}', '{$middle_name}', '{$surname}' , '{$email}', '{$password}')";
        $register_user_query = mysqli_query($connection, $query);

        if(!$register_user_query) {
            die("QUERY FAILED ". mysqli_error($connection) . ' ' .
            mysqli_errno($connection));
        }
        $message = "Your Registration has been submitted";
    } else {
        $message = "Fields can not be empty!";
    }
} else {
    $message = "";
}




?>


<style>
body {background-color:#c9d6df !important;}
</style>

<section id="loginf">
<div class="simple-login-container">
    <h2>Registration</h2>
    <div class="row">
        <div class="col-md-12 form-group">
        <form action="registration.php" method="post">

        <h6><?php echo $message; ?> </h6>

            <input name="name" type="text" class="form-control" placeholder="Name">
        </div>
        <div class="col-md-12 form-group">
            <input name="middle_name" type="text" class="form-control" placeholder="Middle name">
        </div>
        <div class="col-md-12 form-group">
            <input name="surname" type="text" class="form-control" placeholder="Surname">
        </div>
        <div class="col-md-12 form-group">
            <input name="email" type="email" class="form-control" placeholder="somebody@example.com">
        </div>
        <div class="col-md-12 form-group">
            <input name="password" type="password" placeholder="Password" class="form-control">
        </div>
        <div class="col-md-12 form-group">
            <input type="submit" name="submit" class="btn btn-block btn-success" name="registration" value="Register" min="7" max="25">
            
        </div>
        <div class="col-md-12 form-group">
          <!-- <p class="registartion">Do not have an account?</p> -->

          <span class="register btn btn-secondary btn-sm btn-login " onclick="window.location.href = 'index.php'">Back to Login</span> 

        <!-- <form action="registration.php" method="post">
          <input type="submit" class="btn btn-secondary btn-sm btn-success register" name="registration" value="Registration"> 
        </form> -->
        </div>
    </form>
        <div class="col-md-12">
    </div>
</div>


</section>
</body>
</html>