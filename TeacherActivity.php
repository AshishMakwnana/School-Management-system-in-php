<?php 
include "./Includefile/header.php";
include "./Includefile/navbar.php";
include "./Includefile/config.php";

?>
<main>
    <div class="container-fluid">
        <div class="container ">
            <div class="row g-3">
                <div class="col-md-12">
                    <!-- button -->
                    <button class="btn btn-warning" type="button" data-bs-toggle="collapse" data-bs-target="#FilterForm"
                        aria-expanded="false" aria-controls="FilterForm">
                        filter
                    </button>
                </div>
                <div class="col-md-12">
                    <div class="collapse" id="FilterForm">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-header bg-dark">
                                        <span class="fw-bold text-danger">Filter By Date</span>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" class="row">
                                            <div class="col-md-6">
                                                <label for="DataF" class="form-label">From</label>

                                                <input type="date" id="DateF" name="Fdate" class="form-control"
                                                    placeholder="Enter Student ID">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="DataS" class="form-label">To</label>

                                                <input type="date" id="DateS" name="Sdate" class="form-control"
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
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-header bg-dark">
                                        <span class="fw-bold text-danger">Filter By Course Name</span>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" class="row">
                                            <div class="col-md-12">
                                                <label for="CourseName" class="form-label">Course Name</label>
                                            </div>
                                            <div class="col-md-12">
                                                <select name="CourseFName" id="CourseName" class="form-select">
                                                    <option value="" disabled selected>Select Course</option>
                                                    <?php 
                                            // select Course list
                                            $queryFCourse = "SELECT * FROM course";
                                            $CResult = mysqli_query($con,$queryFCourse);
                                            if($CResult){
                                                while($CourseName = mysqli_fetch_assoc($CResult)){
                                                    echo '<option value="'.$CourseName['course_name'].'">'.$CourseName['course_name'].'</option>';
                                                }
                                            }
                                            ?>

                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" name="CFbyCName"
                                                    class="btn btn-warning mt-1">Filter</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-header bg-dark">
                                        <span class="fw-bold text-danger">Filter By Subject Name</span>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" class="row">
                                            <div class="col-md-12">
                                                <label for="Subject" class="form-label">Subject Name </label>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="text" name="Subject" id="Subject" class="form-control"
                                                    placeholder="Enter Subject Name">
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" name="Fsubject"
                                                    class="btn btn-info mt-1">Filter</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-header bg-dark">
                                        <span class="fw-bold text-danger">Filter By topic Name</span>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" class="row">
                                            <div class="col-md-12">
                                                <label for="Topic" class="form-label">Topic Name </label>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="text" name="Topic" id="Topic" class="form-control"
                                                    placeholder="Enter Topic Name">
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" name="FTopic"
                                                    class="btn btn-primary mt-1">Filter</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <!-- table -->
                    <div class="card">
                        <div class="card-header bg-dark">
                            <span class="text-danger fw-bold h5">
                                Teacher Works
                            </span>
                        </div>
                        <div class="card-body table-responsive">
                            <?php
                       if(isset($_POST['FBySID'])){
                        $Fdate = $_POST['Fdate'];
                        $Sdate = $_POST['Sdate'];
                        $query = "SELECT * FROM teacherwork WHERE date between '$Fdate' and '$Sdate'";
                        
                    }elseif(isset($_POST['CFbyCName'])){
                        $CourseFName = $_POST['CourseFName'];
                        $query = "SELECT * FROM teacherwork WHERE  Course='$CourseFName'";
                        
                    }elseif(isset($_POST['Fsubject'])){
                        $Fsubject = $_POST['Subject'];
                        $query = "SELECT * FROM teacherwork WHERE  and SubjectName='$Fsubject'";
                    
                    }elseif(isset($_POST['FTopic'])){
                        $FTopic = $_POST['Topic'];
                        $query = "SELECT * FROM teacherwork WHERE TopicName='$FTopic'";

                    }
                    else{
                        $query = "SELECT * FROM teacherwork";
                    }
                           
                        $result = mysqli_query($con,$query);  
                    ?>
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>S.no </th>
                                        <th>Teacher Id</th>
                                        <th>Course Name</th>
                                        <th>Subject Name</th>
                                        <th>Topic Name</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                $count=1;
                                    if($result){
                                        while($row= mysqli_fetch_assoc($result)){
                                            ?>
                                    <tr>
                                        <th><?php echo $count ?></th>
                                        <th><?php echo $row['TeacherID'] ?></th>
                                        <td><?php echo $row['Course'] ?></td>
                                        <td><?php echo $row['SubjectName'] ?></td>
                                        <td><?php echo $row['TopicName'] ?></td>
                                        <td><?php echo $row['date'] ?></td>
                                    </tr>
                                    <?php
                                        }
                                        $count+=1;
                                    }else{
                                        echo mysqli_error($con);
                                        echo "<h4>No Record Found</h4>";
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
include "./Includefile/footer.php"; 
?>