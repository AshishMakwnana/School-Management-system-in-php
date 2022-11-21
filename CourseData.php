<?php
// include "./includefile/header.php";
// include "./includefile/navbar.php";
include "./includefile/config.php";  
session_start();
if(isset($_POST['AddCourse'])){
    $course = $_POST['Course'];
    $course = strtoupper($course);
    $check = "SELECT * FROM course WHERE course_name='$course'";
    echo $check;
    $checkResult=mysqli_query($con,$check);
    $CourseExist = mysqli_num_rows($checkResult);
    if($CourseExist>0){
        echo $row['course_name'];
        $_SESSION['CourseError']="Course Already exist";
        header("Location:AddCourse.php?error");
    }else{
      
        $sql = "INSERT INTO `course`(`course_id`, `course_name`) VALUES ('','$course')";

        if(mysqli_query($con,$sql)){
            $_SESSION['Success']=$course;
            echo header("Location:AddCourse.php?msg=Success");
        } else{
            echo "ERROR: Hush! Sorry $sql." 
                . mysqli_error($con);
        }
    }
   
}elseif(isset($_POST['AddBatch'])){
    $Start_time = $_POST['Batch-start-time'];
    $endtime = $_POST['Batch-end-time'];
     // check 
    echo $Start_time;
    echo $endtime;
    $chekBatch = "SELECT * FROM bach_times WHERE start_time='$Start_time' and  end_time='$endtime'";
    $resultbatch = mysqli_query($con,$chekBatch);
    $Batches = mysqli_num_rows($resultbatch);
    if($Batches>0){
            $_SESSION['BatchError']=$Start_time." To ".$endtime;
            echo header("Location:AddCourse.php?msg=error");
    }else{
        $sql = "INSERT INTO `bach_times`(`batch_id`, `start_time`, `end_time`) VALUES ('','$Start_time','$endtime')";

        if(mysqli_query($con,$sql)){
            $_SESSION['SuccessBatch']=$Start_time." To ".$endtime;
            echo header("Location:AddCourse.php?msg=success");
        } else{
            echo "ERROR: Hush! Sorry $sql." 
                . mysqli_error($con);
        }
    }
   
}elseif(isset($_POST['DeleteCourse'])){
    $courseID = $_POST['DeleteCourse'];
    $DeleteQuery = "DELETE FROM `course` WHERE course_id ='$courseID'";
    if(mysqli_query($con,$DeleteQuery)){
        $_SESSION['DeleteCourse']=$courseID;
        header("Location:ShowCourse.php");
    }else{
        $_SESSION['CourseError']=$courseID;
        header("Location:ShowCourse.php");
    }
}elseif(isset($_POST['DeleteBatch'])){
    $BatchID = $_POST['DeleteBatch'];
    $DeleteBatch = "DELETE FROM `bach_times` WHERE batch_id ='$BatchID'";
    if(mysqli_query($con,$DeleteBatch)){
        $_SESSION['DeleteBatch']=$BatchID;
        header("Location:ShowBatch.php");
    }else{
        $_SESSION['BatchError']=$BatchID;
        header("Location:ShowBatch.php");
    }
}elseif(isset($_GET['activate'])){
    $id = $_GET['activate'];
    $query = "UPDATE `teachercourses` SET Status='1' where TeacherID='$id'";
    if(mysqli_query($con,$query)){
        header("location:ActiveCourse.php");
    }else{
        header("location:ActiveCourse.php");
    }
}elseif(isset($_GET['deactivate'])){
    $id = $_GET['deactivate'];
    $query = "UPDATE `teachercourses` SET Status='0' where TeacherID='$id'";
    if(mysqli_query($con,$query)){
        header("location:ActiveCourse.php");
    }else{
        header("location:ActiveCourse.php");
    }
}
?>