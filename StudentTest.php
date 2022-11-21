<?php 
include "./includefile/header.php";
include "./includefile/config.php";
include "./includefile/navbar.php";
?>

<main>
    <div class="container-fluid">
        <div class="container">
            <div class="row-g-3">
                <div class="col-md-12">
                    <!--Filter Button-->
                    <div>
                        <button class="btn btn-danger" type="button" data-bs-toggle="collapse"
                            data-bs-target="#FilterForm" aria-expanded="false" aria-controls="FilterForm">
                            filter
                        </button>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="collapse" id="FilterForm">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header bg-dark">
                                        <span class="fw-bold text-danger">Filter By Student ID</span>
                                    </div>
                                    <div class="card-body">
                                        <form  method="GET" class="row">
                                            <div class="col-md-12">
                                                <label for="StudentID" class="form-label">Student ID</label>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="text" id="StudentID" name="StudentFID" class="form-control"
                                                    placeholder="Enter Student ID">
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" name="FBySID"
                                                    class="btn btn-success mt-1">Filter</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header bg-dark">
                                        <span class="fw-bold text-danger">Filter By Subject Name</span>
                                    </div>
                                    <div class="card-body">
                                        <form  method="GET" class="row">
                                            <div class="col-md-12">
                                                <label for="SubjectName" class="form-label">Subject  Name</label>
                                            </div>
                                            <div class="col-md-12">
                                             <input type="text" name="SubjectName" id="SubjectName" class="form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" name="CFbySubject"
                                                    class="btn btn-success mt-1">Filter</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header bg-dark">
                                        <span class="fw-bold text-danger">Filter By Date</span>
                                    </div>
                                    <div class="card-body">
                                        <form method="GET" class="row">
                                            <div class="col-md-12">
                                                <label for="date" class="form-label">Date</label>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="date" name="date" id="date" class="form-control" placeholder="Enter Subject Name">
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" name="FbDate"
                                                    class="btn btn-success mt-1">Filter</button>
                                            </div>
                                        </form>
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
                                Student Test Details
                            </span>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Student ID</th>
                                        <th>Student Name</th>
                                        <th>Subject Name</th>
                                        <th>Marks</th>
                                        <th>Total Marks</th>
                                        <th>Status</th>
                                        <th>Reason</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $count=1;
                                        if(isset($_GET['FBySID'])){
                                            $StudentFID = $_GET['StudentFID'];
                                            $query = "SELECT * FROM test where RollNumber ='$StudentFID'";
                                        }elseif(isset($_GET['CFbySubject'])){
                                            $SubjectName = $_GET['SubjectName'];
                                            $query = "SELECT * FROM test where SubjectName ='$SubjectName'";
                                        }elseif(isset($_GET['FbDate'])){
                                            $date = $_GET['date'];
                                            $query = "SELECT * FROM test where Date ='$date'";
                                        }else{
                                            $query = "SELECT * FROM test";
                                        }
                                        $result = mysqli_query($con,$query);

                                        if($query){
                                            while($row = mysqli_fetch_assoc($result)){
                                                $roll = $row['RollNumber'];
                                                $name = "SELECT name FROM student where roll_number='$roll'";
                                                $Student = mysqli_query($con,$name);
                                                if($Student){
                                                    $StudentInfo = mysqli_fetch_assoc($Student);

                                                    ?>
                                    <tr>
                                        <th><?php echo $count  ?></th>
                                        <td><?php echo $row['RollNumber'] ?></td>
                                        <td><?php echo $StudentInfo['name'] ?></td>
                                        <td><?php echo $row['SubjectName'] ?></td>
                                        <td><?php echo $row['Marks'] ?></td>
                                        <td><?php echo $row['TotalMarks'] ?></td>
                                        <td><?php echo $row['Status'] ?></td>
                                        <td><?php echo $row['Reason'] ?></td>
                                        <td><?php echo $row['Date'] ?></td>
                                    </tr>
                                    <?php 
                                                }
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