<?php 
include "./Includefile/config.php";
session_start();
if(isset($_POST['Admininfo'])){
    $id = $_SESSION['ID'];
    $name = $_POST['name'];
    $Email = $_POST['Email'];
    $Oldpassword = $_POST['OldPassword'];
    $NewPassword = $_POST['password'];
    $oldImage = $_POST['oldImage'];
    $ImageName = $_FILES["Image"]["name"];
    $Temp = $_FILES["Image"]["tmp_name"];

    $exten = explode('.',$ImageName);
    $AEx = strtolower(end($exten));

    $validEx = array("jpg","png","jpeg");



    if($_FILES["Image"]["name"]!=''){

        if(in_array($AEx,$validEx)){
            $ImageNewName = $name.uniqid(true).".".$AEx;
            $fileDestination = "AdminImage/".$ImageNewName;

            if($NewPassword != ''){

                $query = "UPDATE adminlogin SET `Username`='$Email',`Password`='$NewPassword',`name`='$name',`image`='$ImageNewName' WHERE id = $id";
                if(mysqli_query($con,$query)){
                    move_uploaded_file($Temp,$fileDestination);
                    $_SESSION['Success_update']="Data Update Successfully";
                    header("location:UpdateProfile.php");
                }else{
                    $_SESSION["Failed"]="Somthing wrong";
                    header("location:UpdateProfile.php");
                }

            }else{
                $query = "UPDATE adminlogin SET `Username`='$Email',`Password`='$Oldpassword',`name`='$name',`image`='$ImageName' WHERE id = $id";
                if(mysqli_query($con,$query)){
                    $_SESSION['Success_update']="Data Update Successfully";
                    header("location:UpdateProfile.php");
                }else{
                    $_SESSION["Failed"]="Somthing wrong";
                    header("location:UpdateProfile.php");
                }
            }           
            

        }else{
            $_SESSION['ImageError']="Image Not Valid";
            header("location:UpdateProfile.php");

        }

    }else{
        $query = "UPDATE adminlogin SET `Username`='$Email',`Password`='$NewPassword',`name`='$name',`image`='$oldImage' WHERE id = $id";
        if(mysqli_query($con,$query)){
            $_SESSION['Success_update']="Data Update Successfully";
             header("location:UpdateProfile.php");
        }else{
            $_SESSION["Failed"]="Somthing wrong";
            header("location:UpdateProfile.php");
        }

    }



}

?>