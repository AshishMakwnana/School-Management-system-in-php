<?php
include "./includefile/header.php";
include "./includefile/navbar.php";
include "./includefile/config.php";

?>
<main>
    <div class="container-fluid p-0 m-0">
        <div class="container">
            <div class="row g-3">
                <div class="col-sm-12">
                    <button class="btn btn-danger" type="button" data-bs-toggle="collapse"
                        data-bs-target="#FilterAttendance" aria-expanded="false" aria-controls="FilterAttendance">
                        Filter
                    </button>
                </div>
                <div class="col-sm-12">
                    <div class="collapse" id="FilterAttendance">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-header bg-dark">
                                        <span class="fw-bold text-danger h5">Filter Teacher Attendance By Date</span>
                                    </div>
                                    <div class="card-body">
                                        <form method="get" class="row g-3">

                                            <div class="col-sm-12">
                                                <label for="DateFirst" class="form-label">From</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="date" id="DateFirst" name="DateFirst" class="form-control">
                                            </div>

                                            <div class="col-sm-12">
                                                <label for=" Datesacand" class="form-label">To</label>
                                                <input type="date" id="Datesacand" name="Datesacand"
                                                    class="form-control">
                                            </div>
                                            <div class="col-sm-12">
                                                <button type="submit" name="FBySID"
                                                    class="btn btn-success mt-1">Filter</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-header bg-dark">
                                        <span class="text-danger fw-bold h5">Filter By Teacher ID</span>
                                    </div>
                                    <div class="card-body">

                                        <form method="get" class="row g-3">
                                            <div class="col-md-12">
                                                <label for="TeacherId" class="form-label">Teacher Id</label>
                                                <input type="text" id="TeacherId" name="TeacherId" class="form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" name="FBTID"
                                                    class="btn btn-success mt-1">Filter</button>
                                            </div>
                                        </form>
                                        <div class="col-md-12">
                                            <a href="TeacherAttendance.php?all='$$'?" class="btn btn-warning mt-2">All
                                                Attendace</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <span class="text-danger fw-bold h5">
                            Teacher Attendance
                        </span>

                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Teacher ID</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Attendance</th>
                                    <th>InTime</th>
                                    <th>OutTime</th>
                                    <th>Opration</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $count =1;
                                      if(isset($_GET['FBySID'])){
                                        $firstDate = $_GET['DateFirst'];
                                        $secandDate = $_GET['Datesacand'];
                                        $Query = "SELECT * FROM teacherattendance WHERE  Date BETWEEN '$firstDate' and '$secandDate' ";
                                    }elseif(isset($_GET['all'])){
                                        $Query = "SELECT * FROM teacherattendance";
                                    }elseif(isset($_GET['FBTID'])){
                                        $TeacherId = $_GET['TeacherId'];
                                        $Query = "SELECT * FROM teacherattendance WHERE TeacherID = '$TeacherId' ";
                                    }
                                    else{
                                        $date = date('Y-m-d');
                                        $Query = "SELECT * FROM teacherattendance WHERE   Date ='$date'";
                                    }
                                            $result = mysqli_query($con,$Query);
                                            if($result){
                                                while($row=mysqli_fetch_assoc($result)){
                                                    ?>
                                <tr>
                                    <th><?php echo $count ?></th>
                                    <td><?php echo $row['TeacherID'] ?></td>
                                    <td><?php echo $row['TeacherName'] ?></td>
                                    <td><?php echo $row['Date'] ?></td>
                                    <td><?php echo $row['Attendance'] ?></td>
                                    <td><?php echo $row['InTime'] ?></td>
                                    <td><?php echo $row['OutTime'] ?></td>
                                    <td><a href="Teachershow.php?show=<?php echo $row['TeacherID'] ?>"
                                            class="btn btn-warning">Show More</a></td>
                                </tr>
                                <?php
                                    $count+=1;
                                                }
                                            }
                                        ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>

<?php
include "./includefile/footer.php"; 
?>