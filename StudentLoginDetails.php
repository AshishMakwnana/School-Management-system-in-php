<?php
include "./includefile/header.php";
include "./includefile/navbar.php";
include "./includefile/config.php";
// session_start();
?>
<main>
    <div class="container-fluid bg-light p-1">
        <div class="row m-1">
            <div class="col">
                <!-- show message -->
                <?php
                    if(isset($_SESSION['Delete'])){
                        // Systen Already take to anoter student
                        echo '<div class="alert alert-success d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            <div>
                                The Login data of the roll number ('.$_SESSION['Delete'].') is  Delete Successfully.
                            </div>
                            </div>';
                            unset($_SESSION['Delete']);
                    }  
                    elseif(isset($_SESSION['DeleteError'])) {
                        echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            <div>
                                The Login data of the roll number('.$_SESSION['DeleteError'].') is  not Delete Successfully.
                            </div>
                            </div>';
                            unset($_SESSION['DeleteError']);

                    }elseif(isset($_SESSION['UpdataData'])){
                        echo '<div class="alert alert-success d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            <div>
                                The Login data of the roll number ('.$_SESSION['UpdataData'].') is  Update Successfully.
                            </div>
                            </div>';
                            unset($_SESSION['UpdataData']);

                    }elseif(isset($_SESSION['NotUpdata'])){
                        echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            <div>
                                The password of roll number ('.$_SESSION['NotUpdata'].') is  not update .
                            </div>
                            </div>';
                            unset($_SESSION['NotUpdata']);
                            
                    }
                    ?>

            </div>
            <div class="col-md-12">
                <!-- Buttons -->
                <a href="StudentAccess.php" class="btn btn-success">Add New</a>

            </div>
            <div class="col-md-12 mt-1">
                <!-- main content -->
                <div class="card">
                    <h5 class="card-header bg-dark text-light">Student Login Details </h5>
                    <div class="card-body overflow-y:hidden table-responsive">
                        <table class="table table-hover text-center">
                            <thead class="bg-dark text-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Roll Number</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Course</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Opration</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    // fatch Student loginDetails 
                                    $query= "SELECT * FROM student where Email !='' and Password !=''";

                                    $query_result=mysqli_query($con,$query);
                                    $count =1;
                                    if($query_result){
                                        while($row = mysqli_fetch_assoc($query_result)){
                                            $rollNumber = $row['roll_number'];
                                                ?>
                                <tr>
                                    <th scope="row"><?php echo $count ?></td>
                                    <td><?php echo $row['roll_number'] ?></td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['course'] ?></td>
                                    <td><?php echo $row['Email'] ?></td>
                                    <td class="hidetext"><?php echo $row['Password'] ?></td>
                                    <td>
                                        <div class="row g-1">
                                            <div class="col-md-6">
                                                <?php 
                                                    $checkStatus = "SELECT Status from student where roll_number = '$rollNumber'";
                                                    $checkresult = mysqli_query($con,$checkStatus);
                                                    if($checkresult){
                                                        $Status = mysqli_fetch_assoc($checkresult);
                                                        if($Status['Status']!=0){
                                                          echo '<a href="LoginData.php?Deavtivate='.$rollNumber.'" class="btn btn-success">Active</a>';
                                                        }else{
                                                            echo '<a href="LoginData.php?Active='.$rollNumber.'" class="btn btn-danger">Deactivete</a>';
                                                        }
                                                    }
                                                ?>
                                               
                                            </div>

                                            <div class="col-md-6">
                                                <form action="NewLogin.php" method="post">
                                                    <button type="submit" name="Update" class="btn btn-warning"
                                                        value="<?php echo $row['roll_number'] ?>">Update</button>
                                                </form>
                                            </div>

                                        </div>
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
<?php 


?>
</main>
<?php
include "./includefile/footer.php"
?>