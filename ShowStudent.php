<?php 
include "./includefile/header.php";
include "./includefile/navbar.php";
include "./includefile/config.php";

?>
<main>
    <div class="container-fluid">
        <div class="container">
            <div class="row g-3">
                <div class="col-md-12">
                    <!-- message -->
                    <?php       
     
      //   error section and success message;
        if(isset($_SESSION['systemNumber'])){
            // Systen Already take to anoter student
            echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                  </svg>
                  <div>
                      This System Number('.$_SESSION['systemNumber'].') is allocate to another Student.
                  </div>
                </div>';
                unset($_SESSION['systemNumber']);
        }  
        elseif(isset($_SESSION['batch_time'])) {
            echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                  </svg>
                  <div>
                     In This Batch time ('.$_SESSION['batch_time'].') The Lab ('.$_SESSION['lab'].') have 20 Students.
                  </div>
                </div>';
                unset($_SESSION['batch_time']);
                unset($_SESSION['lab']);

        }elseif(isset($_SESSION['Mobilenumber'])){
            echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <div>
                '.$_SESSION['Mobilenumber'].'.
            </div>
          </div>';
          unset($_SESSION['Mobilenumber']);
        }
        elseif(isset($_SESSION['upate'])){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Update Message !</strong> '.$_SESSION['upate'].'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
                unset($_SESSION['upate']);

        }
        ?>
                </div>
                <div class="col-md-12">
                    <!-- buttons -->
                    <div class="card table-responsive mt-2">
                        <div class="card-header table-responsive  bg-warning">
                            <span class="text-danger h4"> Download Students Data</span>
                        </div>
                        <div class="card-body table-responsive">
                            <form action="exportdata.php" method="post">
                                <button class="btn btn-dark" name="export_data" value="xls" type="submit"><span
                                        class="h3"><i class="bi bi-filetype-xls"></i></span></button>
                                <button class="btn btn-success" name="export_data" value="xlsx" type="submit"><span
                                        class="h3"><i class="bi bi-filetype-xlsx"></i></span></button>
                                <button class="btn btn-warning" name="export_data" value="csv" type="submit"><span
                                        class="h3"><i class="bi bi-filetype-csv"></i></span></button>
                                <button class="btn btn-danger" name="PDFDATA" value="pdf" type="submit"><span
                                        class="h3"><i class="bi bi-filetype-pdf"></i></span></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- buttons -->
                    <div class="container d-flex justify-content start">
                        <div>
                            <a href="AddStudent.php" class="btn btn-success me-1"><span><i
                                        class="bi bi-person-plus-fill"></i></span>
                                Add
                                Student</a>
                        </div>
                        <div>
                            <button class="btn btn-danger" type="button" data-bs-toggle="collapse"
                                data-bs-target="#FilterForm" aria-expanded="false" aria-controls="FilterForm">
                                filter
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="collapse" id="FilterForm">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header bg-dark">
                                        <span class="fw-bold text-danger">Filter By Student ID</span>
                                    </div>
                                    <div class="card-body">
                                        <form action="ShowStudent.php" method="post" class="row">
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
                                        <span class="fw-bold text-danger">Filter By Course Name</span>
                                    </div>
                                    <div class="card-body">
                                        <form action="ShowStudent.php" method="post" class="row">
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
                                        <span class="fw-bold text-danger">Filter By Batch Time</span>
                                    </div>
                                    <div class="card-body">
                                        <form action="ShowStudent.php" method="post" class="row">
                                            <div class="col-md-12">
                                                <label for="Batchtime" class="form-label">Batch Time </label>
                                            </div>
                                            <div class="col-md-12">
                                                <select name="BatchFName" id="Batchtime" class="form-select">
                                                    <option value="" disabled selected>Select Batch Time</option>
                                                    <?php 
                                            // select Course list
                                            $queryFBatch = "SELECT * FROM bach_times";
                                            $BResult = mysqli_query($con,$queryFBatch);
                                            if($BResult){
                                                while($BatchTime = mysqli_fetch_assoc($BResult)){
                                                    echo '<option value="'.$BatchTime['start_time'].'To'.$BatchTime['end_time'].'">'.$BatchTime['start_time'].'To'.$BatchTime['end_time'].'</option>';
                                                }
                                            }
                                            ?>

                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" name="SFbyBTime"
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

                    <div class="card ">

                        <div class="card-header bg-dark">
                            <span class="text-danger h5 fw-bold">Students List</span>
                        </div>
                        <div class="card-body  table-responsive ">
                            <table class="table  text-center table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Roll number</th>
                                        <th scope="col">Registration number</th>
                                        <th scope="col">Student Name</th>
                                        <th scope="col">Father Name</th>
                                        <th scope="col">Mobile Number</th>
                                        <th scope="col">DOB</th>
                                        <th scope="col">Course</th>
                                        <th scope="col">
                                            Registration Date
                                        </th>
                                        <th scope="col">Batch Time</th>

                                        <th scope="col">Course Fees</th>
                                        <th scope="col">Lab</th>
                                        <th scope="col">System Number</th>
                                        <th scope="col">Opration</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- show data in table   -->
                                    <?php
                // include "connect.php";

                if(isset($_POST['FBySID'])){
                    $StudentFID = $_POST['StudentFID'];
                    $sql = "SELECT * FROM student where roll_number = '$StudentFID'";
                    $result = mysqli_query($con,$sql);
                }elseif(isset($_POST['CFbyCName'])){
                    $CourseFName = $_POST['CourseFName'];
                    $sql = "SELECT * FROM student where course= '$CourseFName'";
                    $result = mysqli_query($con,$sql);
                }elseif(isset($_POST['SFbyBTime'])){
                    $BatchFTime = $_POST['BatchFName'];
                    $sql = "SELECT * FROM student where  batch_time ='$BatchFTime'";
                    $result = mysqli_query($con,$sql);
                }
                else{
                $sql = "SELECT * FROM student";
                $result = mysqli_query($con,$sql);
                }

                while($row = mysqli_fetch_assoc($result)){
                    $batchTime = explode('To',$row['batch_time']);
                    $BatchTime = date('h:i A', strtotime($batchTime[0])).' To '.date('h:i A',strtotime($batchTime[1])); 
                    echo '<tr>
                    <th scope="row">'.$row["id"].'</th>
                    <th scope="row"><div class="container">
                    <img  class="ZoomImage" src="Studentimage/'.$row['StudentImage'].'" alt="Image">
                    </div>
                    </th>
                    <td>'.$row["roll_number"].'</td>
                    <td>'.$row["rg_number"].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row["f_name"].'</td>
                    <td>'.$row["MobileNumber"].'</td>
                    <td>'.$row["DOB"].'</td>
                    <td>'.$row["course"].'</td>
                    <td>'.$row["RG_date"].'</td>
                    <td>'.$BatchTime.'</td>
                    
                    <td>'.$row["fees"].'/-</td>
                    <td> Lab '.$row["Lab"].'</td>
                    <td>'.$row["systemNumber"].'</td>
                    <td>
                        <form action="Opration.php" method="post">
                            <button class="btn btn-success" type="submit" name="Update" Value="'.$row['roll_number'].'"><a href="" class="text-light"><i class="bi bi-person-check-fill"></i>
                            </a></button>
                            <button class="btn btn-danger mt-1" type="submit" name="Delete" value="'.$row['roll_number'].'"><a href="" class="text-light"><i class="bi bi-person-x"></i>
                            </a></button>
                        </form>
                </td>
               </tr>';
                }
            ?>


                                </tbody>
                            </table>
                        </div>
                        <!-- model  -->



                    </div>
                </div>
            </div>
        </div>
    </div>


</main>
<?php
include "./includefile/footer.php";
?>