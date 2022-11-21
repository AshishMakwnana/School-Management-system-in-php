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
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <span class="text-danger fw-bold h5">Teacher Details</span>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Qaulification</th>
                                        <th>JoinningDate</th>
                                        <th>StartTime</th>
                                        <th>Endtime</th>
                                        <th>MobileNumber</th>
                                        <th>Salary</th>
                                        <th>Gender</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * from teacherdata"; 
                                    $result = mysqli_query($con,$query);
                                    if($result){
                                        while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                    <tr>
                                        <th><?php echo $row['ID'] ?></th>
                                        <td><?php echo $row['Name'] ?></td>
                                        <td><?php echo $row['Email'] ?></td>
                                        <td><?php echo $row['Qaulification'] ?></td>
                                        <td><?php echo $row['JoinningDate'] ?></td>
                                        <td><?php echo $row['StartTime'] ?></td>
                                        <td><?php echo $row['Endtime'] ?></td>
                                        <td><?php echo $row['MobileNumber'] ?></td>
                                        <td><?php echo $row['Salary'].'/-' ?></td>
                                        <td><?php echo $row['Gender'] ?></td>
                                        <td><?php if($row['Status']!=0){
                                        echo '<a href="LoginData.php?TDeavtivate='.$row['ID'].'" class="btn btn-success">Active</a>';
                                        }else{
                                             echo '<a href="LoginData.php?TActive='.$row['ID'].'" class="btn btn-danger">Deactivete</a>';
                                        }
                                        ?>
                                        </td>
                                        <th></th>
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
    </div>
</main>
<?php 
include "./includefile/footer.php";
?>