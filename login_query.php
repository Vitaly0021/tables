<?php include "includes/db.php";?>

<?php

if(isset($_POST['login_query'])){

$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$email = mysqli_real_escape_string($connection, $email);
$username = mysqli_real_escape_string($connection, $username);
$password = mysqli_real_escape_string($connection, $password);

$query = "SELECT * FROM users WHERE email = '{$email}' ";

//brings result and assign to this variable
$select_user_query = mysqli_query($connection, $query);

if(!$select_user_query) {

        die("QUERY FAILED" . mysqli_error($connection));
}
    while ($row= mysqli_fetch_array($select_user_query)) {

        $db_email = $row['email'];
        $db_password = $row['password'];
        $db_username = $row['username'];

     
    }

     if($email === $db_email || $username === $db_username && md5($password) === $db_password) {


        $_SESSION['email'] = $db_email;
        $_SESSION['username'] = $db_username;
        $_SESSION['password'] = $db_password;

        header("Location: main.php");

    } else {
        
        header("Location: index.php");
        $message2 = "Username or password is not correct";
        
    }


}

?>