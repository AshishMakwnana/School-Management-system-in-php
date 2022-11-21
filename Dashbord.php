<?php 
include "./includefile/header.php";
include "./includefile/navbar.php";
include "./includefile/config.php"
?>
<main  class="mt-5 pt-3 addStudent">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-12 fw-bold fs-3">Dashboard</div>
            <div class="col-md-12 ">
                <span class="text-success">Welcome <?php echo $_SESSION['UserName'] ?></span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card text-white bg-danger h-100">
                    <div class="card-header"><span class="me-2"><i class="bi bi-easel-fill"></i>
                        </span>
                        <span>Course</span>
                    </div>
                    <div class="card-body text-center">
                        <?php 
                            // fatch All Course from database 
                            $couse = "SELECT * FROM `course` ";
                            $cResult = mysqli_query($con,$couse);
                            $row = mysqli_num_rows($cResult);
                            $Batch = "SELECT * FROM `bach_times` ";
                            $BResult = mysqli_query($con,$Batch);
                            $row1 = mysqli_num_rows($BResult);
                        ?>
                        <h5 class="card-title">Course Details</h5>
                        <p class="card-text">Total Course <?php echo $row ?></p>
                        <p class="card-text">Total Batch <?php echo $row1?></p>

                        <div class="my-4">
                            <hr class="dropdown-divider" />
                        </div>
                        <a href="ShowCourse.php" class="btn btn-light ">View</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-white bg-secondary h-100">
                    <div class="card-header">
                        <span class="me-2"> <i class="bi bi-pen"></i>
                        </span>
                        <span>Students</span>
                    </div>
                    <?php 
                            // fatch All Course from database 
                            $Students = "SELECT * FROM `student`";
                            $Active = "SELECT * FROM `student` where status ='1'";
                            $unactive = "SELECT * FROM `student` where status ='0'";
                            $ActiveResult = mysqli_query($con,$Active);
                            $unResult=mysqli_query($con, $unactive);
                            $sResult = mysqli_query($con,$Students);
                            $noOFStudents = mysqli_num_rows($sResult);
                        ?>
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Student are <?php echo $noOFStudents ?> </h5>
                        <p class="card-text">Active Student : <?php echo mysqli_num_rows($ActiveResult) ?></p>
                        <p class="card-text">UnActive Student : <?php echo mysqli_num_rows($unResult) ?></p>
                        <p class="card-text">View All Student</p>
                        <div class="my-4">
                            <hr class="dropdown-divider" />
                        </div>
                        <a href="ShowStudent.php" class="btn btn-light ">View</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <?php 
                $query = "SELECT COUNT(*) FROM teacherdata";

                $result = mysqli_query($con,$query);
                if($query){
                    while($Tch = mysqli_fetch_array($result)){
                        $Total = $Tch['COUNT(*)'];
                    }
                }
                ?>
                <div class="card text-white bg-dark  h-100">
                    <div class="card-header"><span class="me-2"><i class="bi bi-person-lines-fill"></i>
                        </span>
                        <span>Facalties</span>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">Teachers are <?php  echo $Total ?></h5>
                        <p class="card-text">View All Teacher</p>
                        <div class="my-4">
                            <hr class="dropdown-divider" />
                        </div>
                        <a href="ShowTeacher.php" class="btn btn-light ">View</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
            <?php
                $DATE = date('Y-m-d');
                $checkAttendance = "SELECT COUNT(*) FROM attendance WHERE date='$DATE'";
                $checkResult = mysqli_query($con,$checkAttendance);
                if($checkResult){
                    while($check= mysqli_fetch_array($checkResult)){
                        $todayPersent = $check['COUNT(*)'];
                    }
                }
                ?>
                <div class="card text-white bg-warning h-100 ">
                    <div class="card-header"><span class="me-2"><i class="bi bi-layout-text-window-reverse"></i>
                        </span>
                        <span>Attendance</span>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">Today Present Student are <?php echo $todayPersent ?></h5>
                        <p class="card-text">Check Attendance</p>
                        <div class="my-4 bg-danger">
                            <hr class="dropdown-divider" />
                        </div>
                        <a href="AttendanceShow.php" class="btn btn-light ">View</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card text-white bg-primary h-100">
                    <div class="card-header">
                        <span class="me-2"><i class="bi bi-paypal"></i>
                        </span>
                        <span>Fees</span>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">View Fees</h5>
                        <p class="card-text">View Student Fees Statement</p>
                        <div class="my-4">
                            <hr class="dropdown-divider" />
                        </div>
                        <a href="FeesStatement.php" class="btn btn-light ">View</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
            <?php 
                $TotalBook = '';
                $isuBook ='';
                    $BookQuery = "SELECT COUNT(*) FROM allbook";
                    $issubook = "SELECT COUNT(*) FROM issubooks";
                    $issubookResult = mysqli_query($con,$issubook);
                    $bookResult = mysqli_query($con,$BookQuery);

                    if($bookResult){
                        while($books = mysqli_fetch_array($bookResult)){
                            $TotalBook = $books['COUNT(*)'];
                        }
                    }
                    if($issubookResult){
                        while($issubook = mysqli_fetch_array($issubookResult)){
                            $isuBook=$issubook['COUNT(*)'];
                        }
                    }
                ?>
                <div class="card text-white bg-success h-100">
                    <div class="card-header">
                    <span class="me-2"><i class="bi bi-book"></i>
                        </span>
                        <span>Librarie</span>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">Librarie details</h5>
                        <p class="card-text">Total book <?php echo $TotalBook ?></p>
                        <p class="card-text">Issue Books <?php echo $isuBook ?></p>
                        <div class="my-4">
                            <hr class="dropdown-divider" />
                        </div>
                        <a href="lib.php" class="btn btn-light ">View</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3 ">
                <div class="card text-dark bg-light  h-100">
                    <div class="card-header"> <span class="me-2"><i class="bi bi-bookmark-heart"></i>
                        </span>
                        <span>Marksheet</span>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">Marksheet Details</h5>
                        <p class="card-text">View Your Result of test and exams</p>
                        <div class="my-4">
                            <hr class="dropdown-divider" />
                        </div>
                        <a href="StudentMarkSheet.php" class="btn btn-light ">View</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-white bg-info h-100 ">
                    <div class="card-header"><span class="me-2"><i class="bi bi-flag-fill"></i>
                        </span>
                        <span>Teacher Salary</span>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">Reports</h5>
                        <p class="card-text">Teacher Salary reports</p>
                        <div class="my-4 bg-danger">
                            <hr class="dropdown-divider" />
                        </div>
                        <a href="TeacherSalary.php" class="btn btn-light ">View</a>
                    </div>
                </div>
            </div>
        </div>
</main>
<?php
include "./includefile/footer.php"
?>