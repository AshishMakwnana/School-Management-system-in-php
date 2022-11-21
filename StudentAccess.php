<?php 
    include "./includefile/header.php";
    include "./includefile/navbar.php";
    include "./includefile/config.php";
    // session_start();
?>
<main>
    <div class="container-fluid">
        <div class="row g-3">
        <div class="col-md-12">
            <!-- message box -->
            <?php
            if(isset($_SESSION['LoginData'])){
                
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success Message !</strong> Student Roll Number('.$_SESSION['LoginData'].') Login data Submitted.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
                unset($_SESSION['LoginData']);

            }elseif(isset($_SESSION['Failed'])){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error  Message !</strong> Student Roll Number('.$_SESSION['Failed'].' Login Access Not created).
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
                unset($_SESSION['Failed']);
            }elseif(isset($_SESSION['notValid'])){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error  Message !</strong> Student Roll Number('.$_SESSION['notValid'].' Login Access Not created).
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
                unset($_SESSION['notValid']);
            }
            ?>
        </div>
        <div class="col-md-12">
           <a href="StudentLoginDetails.php" class="btn btn-warning">Login Access</a>
        </div>
        <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-dark">
                <span class="text-danger h5 fw-bold">Login Details</span>
            </div>
            <div class="card-body ">
                <h5 class="card-title text-danger">* All The field are Required
                </h5>
                <form action="LoginData.php" method="POST" class="was-validated row g-3">
                    <div class="col-md-12">
                        <label for="RollNumber" class="form-label">Roll Number</label>
                        <input type="text" id="RollNumber" class="form-control is-valid"
                            placeholder="Enter your Roll Number" name="S_roll" required>
                    </div>
                    <div class="col-md-12">
                        <lable for="StudentName" class="form-label">Student Name</lable>
                        <input type="text" class="form-control is-valid" id="StudentName"
                            placeholder="Enter Your Full Name" name="S_name" required>
                    </div>
                    <div class="col-md-12">
                        <lable for="StudentEmail" class="form-label">Email</lable>
                        <input type="email" class="form-control is-valid"  name="UserName" id="StudentEmail"
                            placeholder="Enter Student email" required>
                    </div>
                    <div class="col-md-12">
                        <lable for="Course" class="form-label">
                            Password
                        </lable>
                        <input type="password" class="form-control is-valid" id="Course" placeholder="Set password" name="pass"
                            required>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" name="LoginAccessStudent" class="btn btn-success">submit</button>
                    </div>

                </form>
            </div>
        </div>
        </div>
        </div>
        
      
        
    </div>
</main>
<?php
include "./includefile/footer.php";
?>