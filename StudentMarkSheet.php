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
                    <div class="card">
                        <div class="card-header bg-dark">
                            <span class="text-danger fw-bold h5">
                                Student Marksheet Details
                            </span>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Student ID</th>
                                        <th>Student Name</th>
                                        <th>Course</th>
                                        <th>Marksheet Number</th>
                                        <th>Otp</th>
                                        <th>Marksheet Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $count =1;
                                    $query = "SELECT * FROM `marksheet`";
                                    $result =mysqli_query($con,$query);
                                    if($result){
                                        while($row =mysqli_fetch_assoc($result)){
                                            ?>
                                    <tr>
                                        <th><?php echo $count ?></th>
                                        <td><?php echo $row['RollNumber'] ?></td>
                                        <td><?php echo $row['Name'] ?></td>
                                        <td><?php echo $row['Course'] ?></td>
                                        <td><?php echo $row['MarksheetNumber'] ?></td>
                                        <td><?php echo $row['OTP'] ?></td>
                                        <td>
                                            <div class="container">
                                                <img class="ZoomImage" src="../TeacherPanal/<?php echo $row['Image']?>"
                                                    alt="Image">
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
    </div>

</main>

<?php 
include "./includefile/footer.php";
?>