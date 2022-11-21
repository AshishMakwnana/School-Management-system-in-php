<?php
include "./includefile/header.php";
include "./includefile/navbar.php";
include "./includefile/config.php";
?>
<main>
    <?php
    // Update Student Details
    if(isset($_POST['add'])){
        $id = $_POST['add'];
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

    <div class="container-fluid">
        <div class="container">
            <div class="row g-3">
                <div class="col-md-12">
                    <form action="ShowFees.php" method="post">
                        <button class="btn btn-warning " type="submit" name="Show" Value="<?php echo $id ?>">Show
                            </a></button>
                    </form>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-dark text-light">
                            <span class="h4">Add Fees</span>
                        </div>
                        <div class="card-header">
                            <span class="">Student Name</span><span
                                class=" fw-bold  mx-2"><?php echo $StudentName ?></span>
                        </div>
                        <div class="card-body">
                            <form method="post" action="UpdateStudent.php" enctype="multipart/form-data"
                                class="row g-3 border-5  was-validated d-flex justify-content-evenly">
                                <input type="hidden" name="StudentID" value="<?php echo $id ?>">
                                <div class="col-md-12">
                                    <label for="validationServer03" class="form-label">Recept Number</label>
                                    <input type="text" class="form-control is-invalid" name="ReceptNumber"
                                        id="validationServer03" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="validationServer04" class="form-label">Date</label>
                                    <input type="date" class="form-control is-valid" name="date" id="validationServer04"
                                        required>
                                </div>
                                <div class="col-md-12">
                                    <label for="validationServer06" class="form-label">Amount</label>
                                    <input type="phone" class="form-control is-valid" name="Amount"
                                        id="validationServer06" required>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-success" type="submit" name="AddFees"
                                        value="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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