<?php

include "./includefile/header.php";
include "./includefile/navbar.php";
include "./includefile/config.php";
?>
<main>
    <div class="container-fluid">
        <div class="container">
            <div class="row g-3">
                <div class="col-sm-12">
                    <!-- filter option -->
                    <div>
                        <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Filter Teacher Data">
                            <button class="btn btn-danger" type="button" data-bs-toggle="collapse"
                                data-bs-target="#FilterForm" aria-expanded="false" aria-controls="FilterForm">
                                filter
                            </button>
                        </span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="collapse" id="FilterForm">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header bg-dark">
                                        <span class="fw-bold text-danger">Filter By Teacher ID</span>
                                    </div>
                                    <div class="card-body">
                                        <form  method="post" class="row">
                                            <div class="col-md-12">
                                                <label for="TeacherID" class="form-label">Teacher ID</label>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="text" id="TeacherID" name="TeacherID" class="form-control"
                                                    placeholder="Enter Teacher ID">
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
                                        <form  method="post" class="row">
                                            <div class="col-md-12">
                                                <label for="SubjectName" class="form-label">Subject Name </label>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="text" name="SubjectName" id="SubjectName"
                                                    class="form-control " placeholder="Enter Subject Name"
                                                >
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" name="SFbySubject"
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
                            <span class="text-danger fw-bold h5">Active Courses</span>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Teacher ID</th>
                                        <th>Teacher Name</th>
                                        <th>Course</th>
                                        <th>Subject</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count =1;
                                // Course Datails fetch
                                if(isset($_POST['FBySID'])){
                                    $TeacherFID = $_POST['TeacherID'];
                                    $query = "SELECT * FROM teachercourses where TeacherID='$TeacherFID'";
                                }elseif(isset($_POST['CFbyCName'])){
                                    $CourseFName = $_POST['CourseFName'];
                                    $query = "SELECT * FROM teachercourses where CourseName='$CourseFName'";
                                }elseif(isset($_POST['SFbySubject'])){
                                    $SubjectFTime = $_POST['SubjectName'];
                                    $query = "SELECT * FROM teachercourses where SubjectName='$SubjectFTime'";
                                }
                                else{
                                    $query = "SELECT * FROM teachercourses";
                                }
                                $result = mysqli_query($con,$query);
                                if($result){
                                    while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                    <tr>
                                        <td><?php echo $count ?></td>
                                        <td><?php echo $row['TeacherID'] ?></td>
                                        <td><?php echo $row['TeacherName'] ?></td>
                                        <td><?php echo $row['CourseName'] ?></td>
                                        <td><?php echo $row['SubjectName'] ?></td>
                                        <td><?php echo $row['StartDate'] ?></td>
                                        <td><?php echo $row['EndDate'] ?></td>
                                        <td>
                                            <?php 
                                                if($row['Status']==0){
                                                    ?>
                                            <a href="CourseData.php?activate=<?php echo $row['TeacherID'] ?>"
                                                class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Active This Course">
                                                DeActivate
                                            </a>
                                            <?php
                                                }else{
                                                    ?>
                                            <div class="container">
                                                <a href="CourseData.php?deactivate=<?php echo $row['TeacherID'] ?>"
                                                    class="btn btn-success" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="DeActivate This Course">
                                                    Active
                                                </a>

                                            </div>
                                            <?php
                                                }
                                            ?>
                                        </td>
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