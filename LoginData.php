<?php
include "./includefile/config.php";
session_start();
?>
<main>
    <!-- delete Student Login Details -->
    <?php
   if(isset($_GET['Deavtivate'])){
      $id = $_GET['Deavtivate'];
  
      $StatusUpdate = "UPDATE student set Status='0' where roll_number ='$id'";
  
      if(mysqli_query($con,$StatusUpdate)){
          header("Location:StudentLoginDetails.php");
      }
  
  }elseif(isset($_GET['Active'])){
      $id = $_GET['Active'];
  
      $StatusUpdate = "UPDATE student set Status='1' where roll_number ='$id'";
  
      if(mysqli_query($con,$StatusUpdate)){
          unset($_GET['Active']);
          header("Location:StudentLoginDetails.php");
      }
    }elseif(isset($_POST['Update'])){
      $SID = $_POST['StudentId'];
      $oldPass = $_POST['OldPass'];
      $newPass = $_POST['NewPass'];
      $userName = $_POST['Username'];
         // update login data of the student 
         $updata = "UPDATE `student` SET`Email`='$userName',`Password`='$newPass' WHERE roll_number ='$SID'";
         if(mysqli_query($con,$updata)){
            $_SESSION['UpdataData'] = $SID;
            header("Location:StudentLoginDetails.php?Success");
         }else{
            $_SESSION['NotUpdata']=$SID;
            header("Location:StudentLoginDetails.php?error?");

         }
   }elseif(isset($_POST['LoginAccessStudent'])){
      $SRoll = $_POST['S_roll'];
      $s_name = $_POST['S_name'];
      $s_email = $_POST['UserName'];
      $pass = $_POST['pass'];
      // echo $s_name;
      
      // check Student Exist or not 

      $checkQuery = "SELECT * FROM `student` WHERE roll_number ='$SRoll' and name='$s_name'";
     echo $checkQuery;
      $queryResult = mysqli_query($con,$checkQuery);
      if($queryResult){
         $Student = mysqli_fetch_assoc($queryResult);
         $course = $Student['course'];

         // insert data into Studetn login details table
         $insertData = "UPDATE `student` SET Email='$s_email',Password ='$pass' where roll_number='$SRoll'";

         if(mysqli_query($con,$insertData)){
            $_SESSION['LoginData'] =$SRoll;
            header("Location:StudentAccess.php?success");
         }else{
            $_SESSION['Failed'] =$SRoll;
            header("Location:StudentAccess.php?error");
         }
      }else{
         $_SESSION['notValid'] =$SRoll;
         header("Location:StudentAccess.php?NotValid");
      }
   }elseif(isset($_GET['TDeavtivate'])){
      $id = $_GET['TDeavtivate'];
  
      $StatusUpdate = "UPDATE teacherdata set Status='0' where ID ='$id'";
  
      if(mysqli_query($con,$StatusUpdate)){
          header("Location:ShowTeacher.php");
      }
  
  }elseif(isset($_GET['TActive'])){
      $id = $_GET['TActive'];
  
      $StatusUpdate = "UPDATE teacherdata set Status='1' where ID ='$id'";
  
      if(mysqli_query($con,$StatusUpdate)){
          unset($_GET['Active']);
          header("Location:ShowTeacher.php");
      }
   }elseif(isset($_POST['LoginAccesstech'])){
      $s_name = $_POST['S_name'];
      $s_email = $_POST['UserName'];
      $pass = $_POST['pass'];
      // echo $s_name;
      
     $insertData = "INSERT INTO teacherdata(`ID`, `Name`, `Email`, `Password`) VALUES ('','$s_name','$s_email','$pass')";

      if(mysqli_query($con,$insertData)){
         $_SESSION['LoginData'] =$s_name;
         header("Location:NewTeacherLogin.php?success");
      }else{
         $_SESSION['Failed'] =$s_name;
         header("Location:NewTeacherLogin.php?error");
      }
   }elseif(isset($_POST['TechUpdate'])){
      $SID = $_POST['StudentId'];
      $oldPass = $_POST['OldPass'];
      $newPass = $_POST['NewPass'];
      $userName = $_POST['Username'];
         // update login data of the student 
         $updata = "UPDATE `teacherdata` SET `Email`='$userName',`Password`='$newPass' WHERE ID =$SID";
         if(mysqli_query($con,$updata)){
            $_SESSION['UpdataData'] = $SID;
            header("Location:TechLoginDetails.php?Success");
         }else{
            $_SESSION['NotUpdata']=$SID;
            // header("Location:TechLoginDetails.php?error");

         }
   }
   
   
?>
</main>
<?php 
include "./includefile/footer.php";
?>