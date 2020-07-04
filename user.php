<?php

include "Crud.php";
include "authenticator.php";
include_once "DBConnector.php";
include_once "fileUpload.php";

class User implements Crud, Authenticator{
    private $userid; 
    private $firstname;
    private $lastname;
    private $cityname;

//new Variables to be used during the login process
    private $username;
    private $password;

   //timestamps and time offsets
   private $timeoffset;
   private $timestamp;
    function __construct(){
        
       
}
//Setters and Getters for the timestamp
public function setTimeOffset($timeoffset){
    $this->offset = $timeoffset;
}

public function getOffSet(){
    return $this->offset;
}

public static function create(){
    
    $instance = new self();
    return $instance;
}

    public function setUserid($userid){
        $this->userid = $userid;
    }

    public function getUserid(){
        return $this->userid;
    }


//Getters and setter for first name
    public function setFirstname($firstname){
        $this->firstname = $firstname;
    }

    public function getFirstname(){
        return $this->firstname;
    }



    
    public function setLastname($lastname){
        $this->lastname = $lastname;
    }

    public function getLastname(){
        return $this->lastname;
    }


    //Getters and setters for the last cityname
    public function setCityname($cityname){
        $this->cityname = $cityname;

    }

    public function getCityname(){
        return $this->cityname;
    }


//LOGIN CREDENTIALS

    //Setters and Getters for the username
    public function setUsername($username){
        $this->username = $username;
    }

    public function getUsername(){
        return $this->username;
    }



//Setters and Getters for the password
    public function setPassword($password){
        $this->password = $password;
    }

    public function getPassword(){
        return $this->password;
    }





    public function save(){

           // $uploading = new fileUpload();

        $db = mysqli_connect("localhost", "root", "", "btc3205");

    $fn = $this->firstname;
     $ln = $this->lastname;
    $city = $this->cityname;
    $uname = $this->username;

    $this->hashPassword();
    $pass = $this->password;

    $image = time() .  '_' . $_FILES['filetoUpload']['name'];

    
    //$temp = mysqli_query($db,"INSERT INTO user(first_name,last_name,user_city,file,username,password) VALUES ('$fn', '$ln', '$city','$image', $uname', '$pass')") or die("Error:" . mysqli_error());
    var_dump($fn);
    var_dump($ln);
    var_dump($city);
    var_dump($uname);
    var_dump($pass);
    var_dump($image);
    

    $temp = mysqli_query($db,"INSERT INTO users(first_name,last_name,user_city,username,password) VALUES ('$fn', '$ln', '$city','$uname', '$pass')") or die("Error:" . mysqli_error());

    return $temp; 

   

    }

    
public function readAll(){
    return null;

}

public function readUnique(){
    return null;
}

public function search(){
    return null;
}

public function update(){
    return null;
}

public function removeOne(){
    return null;
}


public function removeAll(){
    return null;
}



public function validateForm(){
    $fn = $this->firstname;
    $ln = $this->lastname;
    $city = $this->cityname;

    if($fn=="" || $ln=="" || $city==""){
        return false;
    }
    return true;

}


public function createFormErrorSessions(){
    $_SESSION['form_errors'] = "All fields are required";
}




public function isPasswordCorrect(){
    $db = mysqli_connect("localhost", "root", "", "btc3205");
    $con = new DBConnector;
$found = false;


$res = mysqli_query($db,"SELECT * FROM  users") or die("Error:" . mysqli_error());
if(mysqli_num_rows($res) > 0 ){
while($row = mysqli_fetch_array($res)){
    if(password_verify($this->getPassword() , $row['password']) && $this->getUsername() == $row['username']){
        $found = true;
    }
}
}

//$con->closeDatabase();
return $found;
}

public function login(){
    if($this->isPasswordCorrect()){
        header("Location:privatePage.php");
    }
   
  
  }

public function logout(){
        session_start();
        unset($_SESSION['username']);
        session_destroy();
        header("Location: login.php");
        //echo "You have been logged out!!!";

}

public function hashPassword(){
    $this->password = password_hash($this->password, PASSWORD_DEFAULT);
}

public function createUserSession(){
    session_start();

    $_SESSION['username'] = $this->getUsername();

}
}

?>