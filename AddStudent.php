<?php 
include "./includefile/header.php";
include "./includefile/navbar.php";
include "./includefile/config.php";
?>
<main>
<?php
// show message when Student Add successfully
  $msg = " ";
  if(!empty($_GET["msg"])){
      echo '<div class="alert alert-warning alert-dismissible  show" role="alert">
      <strong>Update Message</strong> '.$_GET["msg"].'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
?>
<?php      
        //   error section
        if(isset($_SESSION['batch_error'])){
            echo '<div class="alert alert-primary d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <div>
              The given lab '.$_SESSION['lab'].' have 20 student in the '.$_SESSION['batch_error'].' batch  time ,  Please Change Batch Time..
            </div>
          </div>';
          unset($_SESSION['lab']);
          unset($_SESSION['batch_error']);

        }if(isset($_SESSION['systemError'])){
            echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <div>
                This System Number('.$_SESSION['systemError'].') is allocate to another Student.
            </div>
          </div>';
          unset($_SESSION['systemError']);
        }
        if(isset($_SESSION['StudentExist'])){
            echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                  </svg>
                  <div>
                    Student Roll Number('.$_SESSION['StudentExist'].') is already exist.!!
                  </div>
                </div>';
                unset($_SESSION['StudentExist']);
        }
         ?>
    <div class="container  text-center bg-warning fw-bold ">
        <span class="h3">New Student Registration Form</span>
    </div>
    <div class="row m-2">
        <div class="col">
            <form method="post" action="StudentData.php" enctype="multipart/form-data"
                class="row g-3 border-5  was-validated d-flex justify-content-evenly">
                <div class="col-md-6">
                    <label for="validationServer01" class="form-label">Roll Number</label>
                    <input type="text" class="form-control is-invalid" name="Rollnumber" id="validationServer01"
                        required>
                </div>
                <div class="col-md-6">
                    <label for="validaionServer02" class="form-label">Registration Number</label>
                    <input type="text" class="form-control is-invalid" name="R_num" id="validationServer02" required>
                </div>
                <div class="col-md-6">
                    <label for="validationServer03" class="form-label">Student Name</label>
                    <input type="text" class="form-control is-invalid" name="StudentName" id="validationServer03"
                        required>
                </div>
                <div class="col-md-6">
                    <label for="validationServer04" class="form-label">Father Name</label>
                    <input type="text" class="form-control is-valid" name="FatherName" id="validationServer04" required>
                </div>
                <div class="col-md-6">
                    <label for="validationServer06" class="form-label">Mobile Number</label>
                    <input type="phone" class="form-control is-valid" name="MobileNumber" id="validationServer06"
                        placeholder="Enter your mobile Number" required>
                </div>
                <div class="col-md-6">
                    <label for="validationServer14" class="form-label">DOB</label>
                    <input type="date" class="form-control is-valid" name="DOB" id="validationServer14" required>
                </div>
                <div class="col-md-6">
                    <label for="validationServer05" class="form-label" placeholder="set Time">Batch
                        time</label>
                    <select class="form-select is-invalid" id="validationServer05" name="BatchTime"
                        aria-describedby="validationServer05Feedback" required>
                        <option selected disabled value="">Select</option>
                        <?php 
                                $sql = "SELECT * FROM  bach_times";
                                $re = mysqli_query($con,$sql);
                                while($row = mysqli_fetch_assoc($re)){
                               echo ' <option value='.$row['start_time'].'To'.$row['end_time'].'>'.$row['start_time'].' To '.$row['end_time'].'</option>';
                                
                            }
                            ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="validationServer07" class="form-label">Fess</label>
                    <input type="text" class="form-control is-invalid" name="Fess" id="validationServer07" required>

                </div>
                <div class="col-md-6">
                    <label for="validationServer08" class="form-label">Course</label>
                    <select class="form-select is-invalid" id="validationServer08" name="Course"
                        aria-describedby="validationServer04Feedback" required>
                        <option selected disabled value="">Select</option>
                        <?php 
                                $sql = "SELECT * FROM  course";
                                $re = mysqli_query($con,$sql);
                                while($row = mysqli_fetch_assoc($re)){
                               echo ' <option value='.$row['course_name'].'>'.$row['course_name'].'</option>';
                                
                            }
                            ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="validationServer09" class="form-label">Registration fess</label>
                    <input type="text" class="form-control is-invalid" name="RG_fees" id="validationServer09" required>
                </div>
                <div class="col-md-6">
                    <label for="validationServer15" class="form-label">Registration fess Recept Number</label>
                    <input type="text" class="form-control is-invalid" name="FeesRecept" id="validationServer15"
                        required>
                </div>
                <div class="col-md-6">
                    <label for="validationServer10" class="form-label">Registration Date</label>
                    <input type="date" class="form-control is-invalid" name="Rg_date" id="validationServer10" required>

                </div>
                <div class="col-md-6">
                    <label for="validationServer11" class="form-label">Add Lab</label>
                    <select class="form-select is-invalid" id="validationServer11" name="Lab"
                        aria-describedby="validationServer04Feedback" required>
                        <option disabled>Select</option>
                        <option selected value="1">Lab1</option>
                        <option value="2">Lab2</option>
                        <option value="3">Lab3</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="validationServer12" class="form-label">Select System Number</label>
                    <select class="form-select is-invalid" id="validationServer12" name="SystemNumber"
                        aria-describedby="validationServer04Feedback" required>
                        <option disabled>Select</option>
                        <option selected value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4 </option>
                        <option value="5">5 </option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>

                    </select>
                </div>
                <div class="col-md-12">
                    <label for="validationServer13" class="form-label">Add Student Image</label>
                    <input type="file" class="form-control is-invalid" name="StudentImage" id="validationServer13"
                        required>

                </div>

                <div class="col-12">
                    <button class="btn btn-success" type="submit" value="submit">Submit form</button>
                </div>
            </form>
        </div>
    </div>
</main>
<?php
include "./includefile/footer.php";
?>