<?php
session_start();
    include "./includefile/config.php";
    if(isset($_POST['Update'])){
        $roll = $_POST['StudentID'];
        $name = $_POST["StudentName"];
        $fname = $_POST['FatherName'];
        $course = $_POST["Course"];
        $batch_time = $_POST["BatchTime"];  
        $lab = $_POST['Lab'];
        $system = $_POST['SystemNumber'];
        $MobileNumber = $_POST['MobileNumber'];
        $DOB = $_POST['DOB'];    
        $StudentImageName = $_FILES["StudentImage"]["name"];
        $StudentTemImageName = $_FILES["StudentImage"]["tmp_name"]; 
        $oldImage = $_POST['OldImage'];
        
    
        $S_fileSize = $_FILES['StudentImage']['size'];
        $fileType = $_FILES['StudentImage']['type'] ;
        $imgError = $_FILES['StudentImage']['error'];

        $imageExe = explode(".",$StudentImageName);
        $AcImageExe= strtolower(end($imageExe));

        $allowdExe = array("jpg",'jpeg','png');

        // check system in lab
        function checkSystem($roll,$lab,$system,$batch_time,$con){
            $sql1 = "SELECT count(*) FROM student where Lab='$lab' and batch_time ='$batch_time' and systemNumber='$system' and roll_number!=$roll";
            $result1 = mysqli_query($con,$sql1);

            if(mysqli_num_rows($result1)>0){
                while($r=mysqli_fetch_array($result1)){
                    $system_count = $r['count(*)'];
                 }
                 if($system_count>0){
        
                     return 1;
     
                 }else{
                     return 0;
                 }
            }

           

        }
        function AddStudent($roll,$name,$fname,$course,$batch_time,$lab,$system, $ImageNewName,$MobileNumber,$DOB,$con){
            $sql = "UPDATE `student` SET `name`='$name',`f_name`='$fname',`MobileNumber`='$MobileNumber',`DOB`='$DOB',`course`='$course',`batch_time`='$batch_time',`Lab`='$lab',`systemNumber`='$system',`StudentImage`='$ImageNewName' WHERE roll_number =".$roll."";
        
            if(mysqli_query($con,$sql)){
                // header("Location:AddStudent.php?msg= your data submited successfully");
                $_SESSION['upate']="Data updated successfully";
                header("Location:ShowStudent.php?msg= Data Updated!!");
            } else{
                echo "ERROR: Hush! Sorry $sql." 
                    . mysqli_error($con);
            }
        }
       


        function checkSystemAllocation($roll,$lab , $system , $batch_time,$con){

            $checkSystemQuery = "SELECT count(*) FROM student where Lab= $lab and batch_time ='$batch_time' ";

            $result = mysqli_query($con,$checkSystemQuery);
            $count = 0;

            while($row= mysqli_fetch_array($result)){
                $count = $row['count(*)'];
            }
            
            if($count>20){
                return  1;
            }else{
                return 0;
            }     
        }
        if(!empty($roll) or !empty($name) or !empty($fname)  or !empty($course)  or !empty($batch_time) ){
    
            $returnValue=checkSystemAllocation($roll,$lab , $system , $batch_time,$con);
            if($returnValue==0){
                $SystemCheck=checksystem($roll,$lab,$system,$batch_time,$con);
                if($SystemCheck!=0){
                    $_SESSION['systemNumber']=$system;
                     header("Location:ShowStudent.php");
                }
                else{
                    if(strlen($MobileNumber)==10 ){
                        if($_FILES["StudentImage"]["name"]!=''){
                                // update image
                                if($_FILES["StudentImage"]["name"]!=''){
                                   if(in_array($AcImageExe ,$allowdExe)){
                                    if($imgError==0){
                                        if($S_fileSize<1000000){
                                            $ImageNewName = $name.uniqid('').".".$AcImageExe;
                                            $fileDestination = "Studentimage/".$ImageNewName;
                                            if(move_uploaded_file($StudentTemImageName,$fileDestination)){
                                                unlink(".\Studentimage/".$oldImage);
                                                AddStudent($roll,$name,$fname,$course,$batch_time,$lab,$system,$ImageNewName,$MobileNumber,$DOB,$con);
                        
                                            }else{
                                                echo "Not Uplodade";
                                            }
                                        }else{
                                            echo "The file  size is  bigger";
                                        }
                                    }else{
                                        echo "Somthing Wrong";
                                    }
                                   }
                                   else{
                                    echo "This file Extention not valid";
                                    }  
                                }
                        }else{
                            // not updated image
                            $ImageNewName = $oldImage;
                            AddStudent($roll,$name,$fname,$course,$batch_time,$lab,$system,$ImageNewName,$MobileNumber,$DOB,$con);
                            }      
                    }else{
                    $_SESSION['Mobilenumber']="Mobile number Not Valid";
                        header("Location:ShowStudent.php");
                } 
            }        
        }else{
            $_SESSION['batch_time'] = $batch_time;
            $_SESSION['lab']  = $lab;
            header("Location:ShowStudent.php");
        }
    }else{

        echo "DAta not store";
    }
}

// Fees Updation
if(isset($_POST['AddFees'])){
    $roll_number = $_POST['StudentID'];
    $fees = $_POST['Amount'];
    $recept_number=$_POST['ReceptNumber'];
    $date=$_POST['date'];
    
    $sql = "SELECT * FROM student WHERE roll_number=$roll_number";
    $result = mysqli_query($con,$sql);
    if($result){
           $row=mysqli_fetch_assoc($result);
            $name = $row['name'];
            $cours = $row['course'];
            $rg_fees = $row['RG_fees'];
            $total_fees = $row['fees'];
            $save = "INSERT INTO `fess`(`id`, `Roll_number`, `name`, `course`, `Res_fees`, `Paid_fees`, `date`, `Recept_no`, `total_fees`) 
            VALUES ('','$roll_number','$name','$cours','$rg_fees','$fees','$date','$recept_number','$total_fees')";
            if(mysqli_query($con,$save)){
                $_SESSION['done']=$name;
                header("Location:FeesStatement.php?message=done");
            }
            else{
                $_SESSION['Failed']=$name;
                header("Location:FeesStatement.php?message=");
            }
    }
    else{
        $_SESSION['Student']="No Recard About the Student";
        header("Location:FeesStatement.php?message=Invalid");

    }
    // save data to database

   

    
}

?>