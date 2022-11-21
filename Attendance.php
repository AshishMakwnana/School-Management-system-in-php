<?php
include "./includefile/header.php";
include "./includefile/navbar.php";
include "./includefile/config.php";
?>
<main>
    <div class="container-fluid bg-light ">
        <div class="container mt-1">
            <!-- message Show  -->
            <?php 
                if(isset($_SESSION['Attendance'])){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Attendace Message!</strong> Roll Number  '.$_SESSION['Attendance'].' attendance submit Successfully 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                  unset($_SESSION['Attendance']);
                }elseif(isset($_SESSION['error'])){
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Attendace Message!</strong> Roll Number  '.$_SESSION['error'].' attendance submit(In) not Successfully 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                  unset($_SESSION['error']);
                }
            ?>
        </div>
        <div class="container filterForm mt-1">
            <div class="row table-responsive ">
                <div class="col-md-6 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Filter By Course</h5>
                            <form method="post" class="was-validated">
                                <label for="validationServer08" class="form-label">Course</label>
                                <select class="form-select is-invalid" id="validationServer08" name="CourseName"
                                    aria-describedby="validationServer04Feedback" required>
                                    <option selected disabled value="">Select</option>
                                    <?php 
                                        // fetch Course from databases
                                        $sql = "SELECT * FROM  course";
                                        $re = mysqli_query($con,$sql);
                                        while($row = mysqli_fetch_assoc($re)){
                                    echo '<option value='.$row['course_name'].'>'.$row['course_name'].'</option>';
                                
                            }
                            ?>
                                </select>
                                <button class="btn btn-danger mt-1" type="submit" name="Course">Filter</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Filter By Batch Time</h5>
                            <form action="" class="was-validated" method="post">
                                <label for="validationServer01" class="form-label">Batch</label>
                                <select class="form-select is-invalid" id="validationServer01" name="BatchTimeResult"
                                    aria-describedby="validationServer04Feedback" required>
                                    <option selected disabled value="">Select</option>
                                    <?php 
                                // fetch Course from databases
                                       $Batch = "SELECT * FROM bach_times";
                                        $BatchResult = mysqli_query($con,$Batch);
                                        while($BRS = mysqli_fetch_assoc($BatchResult)){
                                            ?>
                                    <option value="<?php echo $BRS['start_time'].'To'.$BRS['end_time'] ?>">
                                        <?php echo $BRS['start_time'].' To '.$BRS['end_time'] ?></option>

                                    <?php
                                        }
                                   ?>
                                </select>
                                <button class="btn btn-danger mt-1" type="submit" name="BatchTime">Filter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="conatainer mt-2 p-2 table-responsive ">
            <!-- Show Attendce by Filter Course table -->
            <?php 
            if(isset($_POST['Course'])){
                $Course= $_POST['CourseName'];
                $sql = "SELECT * FROM `student` where course='$Course' ";
            }elseif(isset($_POST['BatchTime'])){
                $Batch = $_POST['BatchTimeResult'];
                $sql = "SELECT * FROM `student` where batch_time='$Batch' ";
            }else{
                $sql = "SELECT * FROM `student`";
            }
            ?>
            <div class="card">
                <div class="card-header table-responsive bg-dark text-light">
                    <span class="text-danger h4">Attendace Table</span>
                </div>
                <div class="card-body table-responsive">
                    <div class="container">
                        <form action="AttendanceData.php" method="post">
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">S.no </th>
                                        <th scope="col">Roll Number</th>
                                        <th scope="col">Student Name</th>
                                        <th scope="col">Course Name</th>
                                        <th scope="col">Batch Time</th>
                                        <th scope='col'>Attendance</th>
                                        <th scope='col'>Submit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                // This is for show the the studetn by batch time    
                                    $count =1;
                                    $result = mysqli_query($con, $sql);
                                    while($row = mysqli_fetch_assoc($result)){
                                        $batchTime = explode('To',$row['batch_time']);
                                        $BatchTime = date('h:i A', strtotime($batchTime[0])).' To '.date('h:i A',strtotime($batchTime[1])); 
                                        ?>
                                    <tr>
                                        <th scope="row"><?php echo $count ?></th>
                                        <td scope="row"><?php echo $row['roll_number']?></td>
                                        <td scope="row"><?php echo  $row['name'] ?></td>
                                        <td scope="row"><?php echo $row['course'] ?></td>
                                        <td scope="row"><?php echo $BatchTime ?></td>
                                        <td scope="row">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="Attendance"
                                                    id="<?php echo "inlineRadio".$count ?>" value="P">
                                                <label class="form-check-label"
                                                    for="<?php echo "inlineRadio".$count ?>">P</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="Attendance"
                                                    id="<?php echo "inlineRadio".$count+1 ?>" value="A">
                                                <label class="form-check-label"
                                                    for="<?php echo "inlineRadio".$count+1 ?>">A</label>
                                            </div>
                                        </td>
                                        <td scope="row"><button type="submit" class="btn btn-danger"
                                                name="StudentAttendance"
                                                value='<?php echo $row['id'] ?>'>Submit</button></td>
                                    </tr>
                                    <?php
                                    $count+=1;
                                    }
                                ?>
                                </tbody>
                            </table>
                        </form>
                    </div>

                </div>
            </div>
        </div>


</main>
<?php
include "./includefile/footer.php";
?>