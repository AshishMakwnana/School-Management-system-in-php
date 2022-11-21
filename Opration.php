<?php
include "./includefile/header.php";
include "./includefile/navbar.php";
include "./includefile/config.php";
?>
<main>
    <?php
    // Update Student Details
    if(isset($_POST['Update'])){
        $id = $_POST['Update'];
        $sql = "SELECT * FROM student where roll_number=$id";
        $result = mysqli_query($con,$sql);
        if($result){
            $row = mysqli_fetch_assoc($result);
            $StudentName = $row['name'];
            $FatherName = $row['f_name'];
            $Course = $row['course'];
            $mobile= $row['MobileNumber'];
            $DOB = $row['DOB'];
            $BatchTime = $row['batch_time'];
            $lab = $row['Lab'];
            $system = $row['systemNumber'];
            $StudentImage = $row['StudentImage'];
        }else{
            die($con).mysqli_errno($con);
        }
        ?>
    <div class="container">
        <a href="AddStudent.php" class="btn btn-danger">Add Student</a>
        <a href="ShowStudent.php" class="btn btn-warning">Show Students</a>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark text-light">
                <span class="h4">Update Student Details</span>
            </div>
            <div class="card-body">
                <form method="post" action="UpdateStudent.php" enctype="multipart/form-data"
                    class="row g-3 border-5  was-validated d-flex justify-content-evenly">
                    <input type="hidden" name="StudentID" value="<?php echo $id ?>">
                    <div class="col-md-6">
                        <label for="validationServer03" class="form-label">Student Name</label>
                        <input type="text" class="form-control is-invalid" value="<?php echo $StudentName ?>"
                            name="StudentName" id="validationServer03" required>
                    </div>
                    <div class="col-md-6">
                        <label for="validationServer04" class="form-label">Father Name</label>
                        <input type="text" class="form-control is-valid" value="<?php echo $FatherName ?>"
                            name="FatherName" id="validationServer04" required>
                    </div>
                    <div class="col-md-6">
                        <label for="validationServer06" class="form-label">Mobile Number</label>
                        <input type="phone" class="form-control is-valid" value="<?php echo $mobile ?>"
                            name="MobileNumber" id="validationServer06" placeholder="Enter your mobile Number" required>
                    </div>
                    <div class="col-md-6">
                        <label for="validationServer14" class="form-label">DOB</label>
                        <input type="date" class="form-control is-valid" value="<?php echo $DOB ?>" name="DOB"
                            id="validationServer14" required>
                    </div>
                    <div class="col-md-6">
                        <label for="validationServer05" class="form-label">Batch start
                            time</label>
                        <select class="form-select is-invalid" id="validationServer05" name="BatchTime"
                            aria-describedby="validationServer05Feedback" required>
                            <option selected value="<?php echo $BatchTime?>"><?php echo $BatchTime?></option>
                            <?php 
                                $sql = "SELECT * FROM  bach_times";
                                $re = mysqli_query($con,$sql);
                                while($row1 = mysqli_fetch_assoc($re)){
                               echo '<option value='.$row1['start_time'].'To'.$row1['end_time'].'>'.$row1['start_time'].' To '.$row1['end_time'].'</option>';
                                
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="validationServer08" class="form-label">Course</label>
                        <select class="form-select is-invalid" id="validationServer08" name="Course"
                            aria-describedby="validationServer04Feedback" required>
                            <option selected value="<?php echo $Course?>"><?php echo $Course?></option>
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
                        <label for="validationServer11" class="form-label">Add Lab</label>
                        <select class="form-select is-invalid" id="validationServer11" name="Lab"
                            aria-describedby="validationServer04Feedback" required>
                            <option value="<?php echo $lab ?>"><?php echo $lab?></option>
                            <option value="1">Lab1</option>
                            <option value="2">Lab2</option>
                            <option value="3">Lab3</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="validationServer12" class="form-label">Select System Number</label>
                        <select class="form-select is-invalid" id="validationServer12" name="SystemNumber"
                            aria-describedby="validationServer04Feedback" required>
                            <option value="<?php echo $system  ?>"><?php echo $system ?></option>
                            <option value="1">1</option>
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
                        <label for="validationServer13"  class="form-label">Add Student Image</label>
                        <input type="text" hidden name="OldImage" value="<?php echo $StudentImage ?>">
                        <input type="file" class="form-control is-invalid" name="StudentImage" id="validationServer13"
                            accept="image/x-png,image/jpg,image/jpeg" />

                    </div>

                    <div class="col-12">
                        <button class="btn btn-success" type="submit" name="Update" value="submit">Submit form</button>
                    </div>
                </form>
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