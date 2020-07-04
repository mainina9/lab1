<?php
include_once 'DBConnector.php';
include_once 'user.php';
include_once 'lab1.php';


 $con = new DBConnector;
class fileUpload{


//Directory of where the files should be
private static $directory = "uploads/";

//limit of the file size
private static $file_limit = 50000;


//name of the temporary file
private $final_file_name;



//boolean that checks whether the file has been uploaded or not and it returns false
private $uploadOk = false;

//file type should be an image type
private $file_type;


//name of the originl file that is being uploaded.
private $file_original_name;



//size of the files
private $file_size;



//private $targetFilePath = $directory . $file_original_name;

public function setFinalFileName($name){
    $this->final_file_name = $name;
}

public function getFinalFileName(){
    return $this->final_file_name;
}



public function setFileSize($size){
    $this->file_size = $size;
}

public function getFileSize(){
    return $this->file_size;
}


public function setFileType($type){
    $this->file_type = $type;
}

public function getFileType(){
    return $this->file_type;
}


public function setOriginalFileName($original_name){
    $this->file_original_name = $original_name;
}

public function getOriginalFileName(){
    return $this->file_original_name;
}




public function uploadFile() {


    if(isset($_POST['submit'])){

        $file_original_name = $_FILES['filetoUpload']['name'];

        $filetarget = self::$directory . $file_original_name;


        $this->saveFilePathTo();
       // $this->moveFile();

        $this->fileAlreadyExists();
       $this->fileSizeIsCorrect();
        $this->fileTypeIsCorrect();
       $this->fileWasSelected();




        return true;


    }

}


public function fileAlreadyExists() {

    $file_original_name = $_FILES['filetoUpload']['name'];

        $target_file = self::$directory . $file_original_name;


    if(file_exists($target_file)){

        //echo "<pre>", print_r($_FILES['filetoUpload']['name']), "</pre>";

        echo "I'm sorry but the file already exists";
        $uploadOk = false;

}

else{
    echo "Successful upload";
}

}


public function saveFilePathTo() {

//where you want your images to be stored

$myprofileimage = $_FILES['filetoUpload']['name'];

$target = self::$directory . $myprofileimage;

if(move_uploaded_file($_FILES['filetoUpload']['tmp_name'], $target)){

}

else{
    $uploadOk = false;
}

}


public function moveFile() {

return self::$directory;

}


public function fileSizeIsCorrect() {

    //checks whether the file size is correct

    if ($_FILES['filetoUpload']["size"] > self::$file_limit) {


        echo "Sorry, your file is too large.";
        $uploadOk = false;

      }

}




public function fileTypeIsCorrect() {

//create an array of accepted file inputs
$file_original_name = $_FILES['filetoUpload']['name'];

        $targetfile = self::$directory . $file_original_name;

$filetype = strtolower(pathinfo($targetfile,PATHINFO_EXTENSION));
$extensions_arr = array("jpg","jpeg","png","gif");


if(!in_array($filetype,$extensions_arr) ) {
  echo "Sorry but you have to upload either jpeg, jpg,png or gif";
  $uploadOk = false;
}

}



public function fileWasSelected() {

    $file_original_name = $_FILES['filetoUpload']['name'];

    $mytargetfile = self::$directory . $file_original_name;

    $uploadOk = false;





    if (!$uploadOk && move_uploaded_file($_FILES['filetoUpload']['tmp_name'], $mytargetfile)) {


            echo "You have successfully uploaded your file";
      } 

        else {
          echo "Sorry, there was an error uploading your file.";
        }




}




}






?> 