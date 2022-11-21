<?php
include "./includefile/header.php";
include "./includefile/navbar.php";
include "./includefile/config.php";
?>
<main>
    <div class="container-fluid">
        <div class="container">
            <!-- message filed -->
            <?php
                if(isset($_SESSION['out'])){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Attendace Message!</strong> Roll Number  '.$_SESSION['out'].' Out Successfully 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                  unset($_SESSION['out']);
                }
                elseif(isset($_SESSION['AttendanceError'])){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Attendace Message!</strong> Roll Number  '.$_SESSION['AttendanceError'].' not Out. 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                  unset($_SESSION['AttendanceError']);
                }
            ?>
        </div>
        <div class="container">
            <!-- filter data by date -->
            <div class="card">
                <div class="card-header bg-dark">
                    <span class="text-danger h5">Filter</span>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Filter by Date</h5>
                    <form action="" class="was-validated" method="post">
                        <label for="filter" class="form-label">Select Date</label>
                        <input type="date" class="form-control is-valid" name="date" required>
                        <button type="submit" class="btn btn-success mt-1" name="Filter">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <?php 
        
        ?>
        <div class="container mt-1">

            <div class="card table-responsive">
                <div class="card-header table-responsive bg-dark text-light">
                    <span class="text-danger h5">Student Attendace</span>
                </div>
                <div class="card-body table-responsive">

                    <table class="table table-hover  mt-4 text-center">
                        <thead>
                            <tr>
                                <th scope="col">S No</th>
                                <th scope="col">Roll number</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Attendace</th>
                                <th scope="col">In Time</th>
                                <th scope="col">Out Time </th>
                                <th scope="col">Opration</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- show data in table   -->
                            <?php
                        // check filter button is active or not
                                if(isset($_POST['Filter'])){
                                    $filterDate = $_POST['date'];
                                    $c = 1;
                                    $FilterQuery = "SELECT * FROM attendance where date ='$filterDate'";
                                    $FilterResult = mysqli_query($con,$FilterQuery);
                                    while($FilterData = mysqli_fetch_assoc($FilterResult)){
                                            ?>
                            <tr>
                                <th scope="row"><?php echo $c ?></th>
                                <td><?php echo $FilterData['Roll_number'] ?></td>
                                <td><?php echo $FilterData['student_name'] ?></td>
                                <td><?php echo $FilterData['date'] ?></td>
                                <td><?php echo $FilterData['attendance'] ?></td>
                                <td><?php echo $FilterData['INTIME'] ?></td>
                                <td><?php echo $FilterData['OUTTIME'] ?></td>
                                <td>
                                    <div class="container d-flex justify-content-evenly">
                                        <form action="AttendanceData.php" method="post">
                                            <button type="submit" name="out"
                                                value="<?php echo $FilterData['Roll_number']?>"
                                                class="btn btn-danger">Out</button>
                                        </form>
                                        <form action="StudentAttendanceDetails.php" method="post">
                                            <button type="submit" name="ViewMore"
                                                value="<?php echo $FilterData['Roll_number']?>"
                                                class="btn btn-success">View</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <?php
                                 $c+=1;
                                    }
                                }
                                else{
                                $date = date("Y-m-d");
                                $sql = "SELECT * FROM attendance where date = '$date'";

                                $result = mysqli_query($con,$sql);

                                $myarray = array();


                                while($row = mysqli_fetch_assoc($result)){
                                
                                    $roll = $row['Roll_number'];
                                    $id = $row['id'];
                                    $name = $row['student_name'];
                                    if(in_array($roll,$myarray)){

                                        echo "";
                                    }
                                    else{
                                        array_push($myarray , $roll);
                                    }
                                    
                                }
                                // this is using for id
                                $count =0;
                                foreach($myarray as $i){
                                    $count = $count+1;
                                    $q1 = 'SELECT count(*) FROM `attendance`  WHERE roll_number='.$i.' AND attendance="P"';
                                    $r1 = $con->query($q1);
                                    
                                    // Display data on web page
                                    while($row = mysqli_fetch_array($r1)) {
                                        $total_p = $row['count(*)'];
                
                                    }
                                    // this is calculate Absent of studetn attendance;
                                    $q2 = 'SELECT count(*) FROM `attendance`  WHERE roll_number='.$i.' AND attendance="A"';
                                    $r2 = $con->query($q2);
                                    
                                    // Display data on web page
                                    while($row = mysqli_fetch_array($r2)) {
                                        $total_A = $row['count(*)'];
                
                                    }
                                    $q3 = 'SELECT * FROM attendance WHERE roll_number='.$i.'';
                                    $r3 = mysqli_query($con,$q3);
                                    while($r = mysqli_fetch_assoc($r3)){
                                        $s_roll = $r['Roll_number'];
                                        $s_name =$r['student_name'];
                                        $StudentDate = $r['date'];
                                        $Attendace=$r['attendance'];
                                        $inTime = $r['INTIME'];
                                        $outTime = $r['OUTTIME'];
                                    }
                                    echo '<tr>
                                        <th scope="row">'.$count.'</th>
                                        <td>'.$s_roll.'</td>
                                        <td>'.$s_name.'</td>
                                        <td>'.$StudentDate.'</td>
                                        <td>'.$Attendace.'</td>
                                        <td>'.$inTime.'</td>
                                        <td>'.$outTime.'</td>
                                        <td>
                                        <div class="container d-flex justify-content-evenly">
                                        <form action="AttendanceData.php" method="post">
                                            <button type="submit" name="out" value='.$s_roll.' class="btn btn-danger">Out</button>
                                        </form>
                                        <form action="StudentAttendanceDetails.php" method="post">
                                            <button type="submit" name="ViewMore" value='.$s_roll.' class="btn btn-success">View</button>
                                        </form>
                                        </div>
                                        </td>
                                    </tr>';
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include "./includefile/footer.php";
?>