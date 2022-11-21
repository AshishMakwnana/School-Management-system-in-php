<?php
include "./includefile/header.php";
include "./includefile/navbar.php";
include "./includefile/config.php";
// sesstion already start
?>
<main>
    <div class="container-fluid">
        <div class="container ">
            <!-- message show -->
            <?php
            if(isset($_SESSION['CourseError'])){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Course Update Message!</strong> '.$_SESSION['CourseError'].'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
              unset($_SESSION['CourseError']);
            }elseif(isset($_SESSION['Success'])){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Course Update Message!</strong> Course Name '.$_SESSION['Success'].' add Successfully
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
              unset($_SESSION['Success']);
            }
            elseif(isset($_SESSION['SuccessBatch'])){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Batch Update Message!</strong> Batch Time '.$_SESSION['SuccessBatch'].' add Successfully
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
              unset($_SESSION['SuccessBatch']);
            }
            elseif(isset($_SESSION['BatchError'])){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Batch update Message!</strong> Batch time '.$_SESSION['BatchError'].' already exist.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
              unset($_SESSION['BatchError']);
            }
            ?>
        </div>
        <div class="container bg-dark">
            <!-- button section -->
            <a href="ShowCourse.php" class="btn btn-warning m-1 text-center">Show Course</a>
            <a href="ShowBatch.php" class="btn btn-danger m-1 text-center">Show Batchs</a>
        </div>
        <div class="row mt-3">
            <!-- form section -->
            <div class="col-md-6 mb-3">
                <div class="card h-100">
                    <div class="card-header bg-dark text-light">
                        <span class="text-danger fw-bold h5">Course</span>
                    </div>
                    <div class="card-body">
                        <form method="post" action="CourseData.php"
                            class="row g-3  was-validated d-flex justify-content-evenly">
                            <div class="col-md-12">
                                <label for="validationServer01" class="form-label">Course Name</label>
                                <input type="text" class="form-control is-invalid" name="Course" id="validationServer01"
                                    required>
                                <div class="col-12 mt-3">
                                    <button class="btn btn-success btn-ms" name="AddCourse" type="submit">Add
                                        Course</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3 ">
                <div class="card h-100">
                    <div class="card-header bg-dark text-light">
                        <span class="text-danger fw-bold h5">Batch</span>
                    </div>
                    <div class="card-body">
                        <form method="post" action="CourseData.php"
                            class="row g-3 border-5  was-validated d-flex justify-content-evenly">
                            <div class="col-md-6 mt-2 mb-2">
                                <label for="validationServer01" class="form-label">Batch-Start Time</label>
                                <input type="time" class="form-control is-invalid" name="Batch-start-time"
                                    id="validationServer01" required>
                            </div>
                            <div class="col-md-6 mt-2 mb-2">
                                <label for="validationServer02" class="form-label">Batch_end Time</label>
                                <input type="time" class="form-control is-invalid" name="Batch-end-time"
                                    id="validationServer02" required>
                            </div>
                            <div class="col-12 mt-3">
                                <button class="btn btn-success btn-ms" name="AddBatch" type="submit">Add Batch
                                    Time</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</main>
<?php
include "./includefile/footer.php";
?>