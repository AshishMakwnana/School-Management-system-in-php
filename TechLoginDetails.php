<?php
include "./includefile/header.php";
include "./includefile/navbar.php";
include "./includefile/config.php";
// session_start();
?>
<main>
    <div class="container-fluid bg-light p-1">
        <div class="row g-3">
            <div class="col-md-12">
                <!-- show message -->
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </symbol>
                    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                    </symbol>
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </symbol>
                </svg>
                <?php
                    if(isset($_SESSION['Deletetech'])){
                        // Systen Already take to anoter student
                        echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            <div>
                                The Login data of the ID number ('.$_SESSION['Deletetech'].') is  Delete Successfully.
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                            </div>';
                            unset($_SESSION['Deletetech']);
                    }  
                    elseif(isset($_SESSION['techDeleteError'])) {
                        echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            <div>
                                The Login data of the ID number('.$_SESSION['techDeleteError'].') is  not Delete Successfully.
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                            </div>';
                            unset($_SESSION['techDeleteError']);

                    }elseif(isset($_SESSION['UpdataData'])){
                        echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            <div>
                                The Login data of the ID number ('.$_SESSION['UpdataData'].') is  Update Successfully.
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                            </div>';
                            unset($_SESSION['UpdataData']);

                    }elseif(isset($_SESSION['NotUpdata'])){
                        echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            <div>
                                The password of ID number ('.$_SESSION['NotUpdata'].') is  not update .
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                            </div>';
                            unset($_SESSION['NotUpdata']);
                            
                    }
                    ?>

            </div>
            <div class="col-md-12">
                <!-- Buttons -->
                <a href="NewTeacherLogin.php" class="btn btn-success">Add New</a>

            </div>
            <div class="col-md-12 mt-1">
                <!-- main content -->
                <div class="card">
                    <h5 class="card-header bg-dark text-light">Teacher Login Details </h5>
                    <div class="card-body overflow-y:hidden table-responsive">
                        <table class="table table-hover text-center">
                            <thead class="bg-dark text-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Opration</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    // fatch Student loginDetails 
                                    $query= "SELECT * FROM  teacherdata";

                                    $query_result=mysqli_query($con,$query);
                                    if($query_result){
                                        while($row = mysqli_fetch_assoc($query_result)){
                                            $rollNumber = $row['ID']
                                                ?>
                                <tr>
                                    <th scope="row"><?php echo $row['ID'] ?></td>
                                    <td><?php echo $row['Name'] ?></td>
                                    <td><?php echo $row['Email'] ?></td>
                                    <td class="hidetext"><?php echo $row['Password'].'*****' ?></td>
                                    <td>
                                        <div class="row g-1">
                                            <div class="col-md-6">
                                                <?php
                                                  $checkStatus = "SELECT Status from teacherdata where ID = '$rollNumber'";
                                                  $checkresult = mysqli_query($con,$checkStatus);
                                                  if($checkresult){
                                                      $Status = mysqli_fetch_assoc($checkresult);
                                                      if($Status['Status']!=0){
                                                        echo '<a href="LoginData.php?TDeavtivate='.$rollNumber.'" class="btn btn-success">Active</a>';
                                                      }else{
                                                          echo '<a href="LoginData.php?TActive='.$rollNumber.'" class="btn btn-danger">Deactivete</a>';
                                                      }
                                                  } 
                                                ?>
                                            </div>
                                            <div class="col-md-6">
                                                <form action="UpdateTecherLoginDetails.php" method="post">
                                                    <button type="submit" name="Update" class="btn btn-warning"
                                                        value="<?php echo $row['ID'] ?>">Update</button>
                                                </form>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                <?php
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
</main>
<?php
include "./includefile/footer.php"
?>