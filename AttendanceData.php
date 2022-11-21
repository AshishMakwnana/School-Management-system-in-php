<?php
include "./includefile/config.php"; 
session_start();
if(isset($_POST['StudentAttendance'])){
    $id = $_POST["StudentAttendance"];
    $attendance=$_POST["Attendance"];
    date_default_timezone_set("Asia/kolkata");
    $intime=date("h:i:s A");
    // echo 'Student Roll Number '.$id.'Attendace'.$attandance."<br>";
    if($attendance=='P' or $attendance=='p'){
        $sql = "SELECT *  from student where id=$id";

        $result = mysqli_query($con, $sql);   
        if($row=mysqli_fetch_assoc($result)){
          $name = $row['name'];
          $roll = $row['roll_number'];
          $date=date('Y-m-d');
          // Send attendance data to the Attendance table database
          $q = "INSERT INTO attendance(roll_number, Student_name, attendance, date,INTIME) VALUES ('$roll','$name','$attendance','$date','$intime')";
          if(mysqli_query($con,$q)){
            $_SESSION['Attendance']=$roll;
            header('Location:Attendance.php?msg=success');
          }
          else{
            $_SESSION['error']=$roll;
            header('Location:Attendance.php?msg=error');
          }
        }

    }elseif($attendance=='A' or $attendance=='a'){
        $sql = "SELECT *  from student where id=$id";
        $result = mysqli_query($con, $sql);   
        if($row=mysqli_fetch_assoc($result)){
          $name = $row['name'];
          $roll = $row['roll_number'];
          $date=date('Y-m-d');
          // Send attendance data to the Attendance table database
          $q = "INSERT INTO attendance(roll_number, Student_name, attendance, date) VALUES ('$roll','$name','$attendance','$date')";
          if(mysqli_query($con,$q)){
            $_SESSION['Attendance']=$roll;
            header('Location:Attendance.php?msg=success');
          }
          else{
            $_SESSION['error']=$roll;
            header('Location:Attendance.php?msg=error');
          }
        }

    }
}
if(isset($_POST['out'])){
    // out time
        $roll = $_POST['out'];
        date_default_timezone_set("Asia/kolkata");
        $out=date("h:i:s A");
       $outTime = "  UPDATE `attendance` SET OUTTIME='$out'  WHERE Roll_number = '$roll' ";
       if(mysqli_query($con,$outTime)){
            $_SESSION['out']=$roll;
            header('Location:AttendanceShow.php?msg=Success');
       }else{
        $_SESSION['Eror']=$roll;
        header('Location:AttendanceShow.php?msg==error');
       }
}

?>