<?php
session_start();
    include "./includefile/config.php";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $roll = $_POST["Rollnumber"];
        $name = $_POST["StudentName"];
        $name=  strtoupper($name);
        $fname = $_POST['FatherName'];
        $fname = strtoupper($fname);
        $fees = $_POST["Fess"];
        $course = $_POST["Course"];
        $r_numm = $_POST["R_num"];
        $batch_time = $_POST["BatchTime"];  
        // $batch_end =$_POST['Batch_end'] ;
        $rg_date = $_POST['Rg_date'];
        $rg_fees = $_POST['RG_fees'];
        $lab = $_POST['Lab'];
        $system = $_POST['SystemNumber'];
        $MobileNumber = $_POST['MobileNumber'];
        $DOB = $_POST['DOB']; 
        $ReceptNumber = $_POST['FeesRecept'];
              
        $StudentImageName = $_FILES["StudentImage"]["name"];

        $StudentTemImageName = $_FILES["StudentImage"]["tmp_name"]; 
    
        $S_fileSize = $_FILES['StudentImage']['size'];
        $fileType = $_FILES['StudentImage']['type'] ;
        $imgError = $_FILES['StudentImage']['error'];

        $imageExe = explode(".",$StudentImageName);
        $AcImageExe= strtolower(end($imageExe));

        $allowdExe = array("jpg",'jpeg','png');

        // send Fees Details to Fees Table 
        function AddFees($roll,$name,$course,$rg_fees,$rg_date,$ReceptNumber,$fees,$con){
            $paidFees = "INSERT INTO `fess`(`id`, `Roll_number`, `name`, `course`, `Res_fees`, `Paid_fees`, `date`, `Recept_no`, `total_fees`) VALUES ('','$roll','$name','$course','$rg_fees','$rg_fees','$rg_date','$ReceptNumber','$fees')";
            
            if(mysqli_query($con,$paidFees)){
                return 0;
            }else{
                return 1;
            }
        }


        // check system in lab
        function checkSystem($lab,$system,$con,$batch_time){
            $sql1 = "SELECT count(*) FROM student where Lab= $lab and batch_time ='$batch_time' and systemNumber=$system";

            $result1 = mysqli_query($con,$sql1);

            while($r=mysqli_fetch_array($result1)){
               $system_count = $r['count(*)'];
            }
            if($system_count>=1){
                return 1;
            }else{
                return 0;
            }
        }
        function AddStudent($roll,$name,$fname,$fees,$course,$batch_time,$rg_fees,$rg_date,$r_numm,$lab,$system, $ImageNewName,$MobileNumber,$DOB,$con){
            $sql = "INSERT INTO student(roll_number, rg_number,name,f_name,MobileNumber,DOB,course,batch_time,RG_fees,RG_date,fees,Lab,systemNumber,StudentImage) VALUES('$roll','$r_numm','$name','$fname','$MobileNumber','$DOB','$course','$batch_time','$rg_fees','$rg_date','$fees','$lab','$system','$ImageNewName')";
            echo "All set";
        
            if(mysqli_query($con,$sql)){
                // header("Location:AddStudent.php?msg= your data submited successfully");
                header("Location:AddStudent.php?msg= your data submited successfully");
            } else{
                echo "ERROR: Hush! Sorry $sql." 
                    . mysqli_error($con);
            }
        }
       


        function checkSystemAllocation($lab , $system , $batch_time,$con){

            $checkSystemQuery = "SELECT count(*) FROM student where Lab= $lab and batch_time ='$batch_time'";

            $result = mysqli_query($con,$checkSystemQuery);
            $count = 0;

            while($row= mysqli_fetch_array($result)){
                $count = $row['count(*)'];
            }
            
            if($count>20){
                return 0;                
            }
        }
        if(!empty($roll) or !empty($name) or !empty($fname) or !empty($fees) or !empty($course) or !empty($r_numm) or !empty($batch_time) or !empty($rg_date)  or !empty($rg_fees) ){
    
            $returnValue=checkSystemAllocation($lab , $system , $batch_time,$con); 
            //Check system Allocation by the batch time and and system number and lab number
            if($returnValue==0){
                // if true
                $SystemCheck=checksystem($lab,$system,$con,$batch_time);    
                // Check this system number not allocate to the another student
                if($SystemCheck==1){
                    // $_SESSION['systemError']=$system_count;
                    $_SESSION['systemError']=$system;
                    header("Location:AddStudent.php?message=SystemInfo");
                }else{
                    if($returnValue==0){
                        $check = "SELECT * FROM student where roll_number=".$roll."";
                        $check_result = mysqli_query($con,$check);
                        if(mysqli_num_rows($check_result)>0){
                            $_SESSION['StudentExist']=$roll;
                            header("Location:AddStudent.php");
                        }else{
                            // this is for check image is valid or not by extention
                                if(in_array($AcImageExe ,$allowdExe)){
                                    if($imgError==0){
                                        if($S_fileSize<1000000){
                                            $ImageNewName = uniqid('',true).".".$AcImageExe;
                                            $fileDestination = "StudentImage/".$ImageNewName;
                                            if(move_uploaded_file($StudentTemImageName,$fileDestination)){
                                                echo "File uploded";
                        
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
                            if(strlen($MobileNumber)==10 ){
                                    $AddfeesReturnValue =AddFees($roll,$name,$course,$rg_fees,$rg_date,$ReceptNumber,$fees,$con);
                                    if($AddfeesReturnValue==0){
                                         AddStudent($roll,$name,$fname,$fees,$course,$batch_time,$rg_fees,$rg_date,$r_numm,$lab,$system,$ImageNewName,$MobileNumber,$DOB,$con);
                                    }else{
                                        $_SESSION['Faild']="Student Not Submited";
                                    }
                        }else{
                            $_SESSION['Mobilenumber']="Mobile number Not Valid";
                                header("Location:AddStudent.php");
                        }       
                    }
                }else{
        
                    echo "DAta not store";
                }
                    
                }
            }else{
                $_SESSION['batch_error'] = $batch_time;
                $_SESSION['lab']  = $lab;
                header("Location:AddStudent.php?SystemAllocation");
            }
    }
    }
?>