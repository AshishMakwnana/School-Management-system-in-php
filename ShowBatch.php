<?php
include "./includefile/header.php";
include "./includefile/navbar.php";
include "./includefile/config.php";
?>
<main>
    <?php
    if(isset($_SESSION['DeleteBatch'])){
        // if bath time delete 
        echo '<div class="alert alert-success table-responsive d-flex align-items-center" role="alert">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
              </svg>
              <div>
                  The Batch id ('.$_SESSION['DeleteBatch'].') is  Delete Successfully.
              </div>
            </div>';
            unset($_SESSION['DeleteBatch']);
    }  
    elseif(isset($_SESSION['BatchError'])) {
        echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
              </svg>
              <div>
                The Batch id ('.$_SESSION['BatchError'].') is  not Delete ?
              </div>
            </div>';
            unset($_SESSION['BatchError']);
    } 
    ?>
    <div class="container-fluid table-responsive">
        <div class="container-fluid bg-light">
            <!-- button section -->
            <a href="AddCourse.php" class="btn btn-warning btn-ms m-1 text-center">Add Course</a>
            <a href="AddCourse.php" class="btn btn-danger btn-ms m-1 text-center">Show Course</a>
        </div>
        <div class="container mt-2 table-responsive">
            <div class="row">
                <div class="col-md-12">
                    <!-- show Coures -->
                    <div class="card">
                        <div class="card-header bg-dark">
                            <span class="text-danger fw-bold h5">Course Table</span>
                        </div>
                        <div class="card-body table-responsive">
                            <div class="container">
                                <table class="table table-hover text-center">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Start Time</th>
                                            <th scope="col">End Time</th>
                                            <th scope="col">Opration</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            // fatch courses
                                            $cou = "SELECT * FROM bach_times";
                                            $result = mysqli_query($con,$cou);
                                            while($row = mysqli_fetch_assoc($result)){
                                                ?>
                                        <tr>
                                            <th scope="col"><?php echo $row['batch_id'] ?></th>
                                            <td><?php echo date('h:i A',strtotime($row['start_time'])) ?></td>
                                            <td><?php echo date('h:i A',strtotime($row['end_time'])) ?></td>
                                            <td>
                                                <div class="container d-flex justify-content-sm-around">
                                                    <form action="CourseData.php" method="post">
                                                        <button class="btn btn-danger" type="submit"
                                                            value="<?php echo $row['batch_id'] ?>"
                                                            name="DeleteBatch">Delete</button>
                                                        <a href="AddCourse.php"
                                                            class="btn btn-success">
                                                            Batch</a>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
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
    </div>
</main>
<?php
include "./includefile/footer.php";
?>