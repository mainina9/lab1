<?php
//Create login codes here
include_once "user.php";

include_once "DBConnector.php";


//connectto database
$connection = new DBConnector();



if(isset($_POST['btn-login']))

{

    $username = $_POST['username'];

    $password = $_POST['password'];

    
    $instance = User::create();
    
    $instance->setPassword($password);
    $instance->setUsername($username);


    if($instance->isPasswordCorrect()){
        $instance->login();

         //closes the database connection
        //$con->closeDatabase();

        //next, create a user session
        $instance->createUserSession();

        echo "You have successfully logged in";
        
    }
    else{
        //$con->closeDatabase();
        header("Location:login.php");

       //echo "This password is not correct... Enter the correct password";
    }
}


?>



<!doctype html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"

          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Login</title>

    <script type="text/javascript" src="validate.js"></script>

    <link rel="stylesheet" type="text/css" href="validate.css">

</head>

<body>

    <form method="post" name="login" id="login" action="<?=$_SERVER['PHP_SELF']?>">

        <table align="center">

            <tr>

                <td><input type="text" name="username" id="uname" required placeholder="Username"></td>

            </tr>

            <tr>

                <td><input type="password" name="password" id="pass" required placeholder="Password"></td>

            </tr>

            <tr>

                <td><button type="submit" name="btn-login"><strong>LOGIN</strong></button></td>

            </tr>

        </table>

    </form>

</body>

</html>