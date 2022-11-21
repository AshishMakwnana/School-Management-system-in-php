<?php
include "./includefile/header.php";
include "./includefile/navbar.php";
include "./includefile/config.php";
?>
<main>
    <?php
      if(isset($_GET['show'])){
        $TecherID = $_GET['show'];
        if(isset($_GET['FBySID'])){
            $firstDate = $_GET['DateFirst'];
            $secandDate = $_GET['Datesacand'];
            $Query = "SELECT * FROM teacherattendance WHERE TeacherID = '$TecherID' and Date BETWEEN '$firstDate' and '$secandDate' ";
        }elseif(isset($_GET['all'])){
            $Query = "SELECT * FROM teacherattendance WHERE TeacherID = '$TecherID'";
        }
        else{
            $Query = "SELECT * FROM teacherattendance WHERE TeacherID = '$TecherID'";
        }                                      

?>
    <div class="container-fluid">
        <div class="container">
            <div class="row g-3">
                <div class="col-md-12">
                    <a href="TeacherAttendance.php" class="btn btn-warning">All Attendance</a>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header  bg-dark">
                            <span class="text-danger fw-bold h5">Teacher Attendance Information</span>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover caption-top text-center">
                                <caption>
                                    Teacher Name
                                    <?php
                                $result = mysqli_query($con,$Query);
                                $name = mysqli_fetch_assoc($result);
                                $Tname = $name['TeacherName'];
                                 
                                ?>
                                    <span class="text-muted fw-bold h5"><?php echo $Tname ?></span>
                                </caption>
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Date</th>
                                        <th>Attendance</th>
                                        <th>Intime</th>
                                        <th>Out Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $QueryResult = mysqli_query($con,$Query);
                                        $count =1;
                                        if($QueryResult){
                                            while($data=mysqli_fetch_assoc($QueryResult)){
                                                ?>
                                    <tr>
                                        <th><?php echo $count ?></th>
                                        <td><?php echo $data['Date'] ?></td>
                                        <td><?php echo $data['Attendance'] ?></< /td>
                                        <td><?php echo $data['InTime'] ?></< /td>
                                        <td><?php echo $data['OutTime'] ?></< /td>
                                    </tr>
                                    <?php
                                    $count+=1;
                                            }
                                            // total attendance
                                            $TotalAttendac ="SELECT COUNT(Attendance) FROM `teacherattendance` where TeacherID = '$TecherID' and Attendance = 'P' ";
        
                                            $TotalResult = mysqli_query($con,$TotalAttendac);
                                            while($Row = mysqli_fetch_array($TotalResult)){
                                                $Total = $Row['COUNT(Attendance)'];
                                            }
                                    }
                                    
                                ?>
                                    <tr>
                                        <th>Total Attendandance</th>
                                        <td>
                                            <span class="text-danger fw-bold h5">
                                                <?PHP echo $Total; ?>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
                        
     }
?>
</main>
<?php
include "./includefile/footer.php"; 
?>