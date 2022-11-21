<?php 
include "./includefile/header.php";
include "./includefile/navbar.php";
include "./includefile/config.php";
?>
<main>
    <div class="container-fluid">
        <div class="cantainer">
            <div class="card">
                <div class="card-header bg-dark">
                    <span class="text-danger fw-bold h5">Quiz Result</span>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover table-strip text-center">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th>Roll Number</th>
                                <th>Student Name</th>
                                <th>Course</th>
                                <th>Total Attempt </th>
                                <th>Right Answer</th>
                                <th>Wrong Answer</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                        $COUNT =1;
                        $query = "SELECT * From quizeresult";
                        $result = mysqli_query($con,$query);
                        if(mysqli_num_rows($result)==0){
                            echo "<h5 class='text-center'>No Records Found</h5>";
                        }else{
                            while($row = mysqli_fetch_assoc($result)){
                                ?>
                            <tr>
                                <th>
                                    <?PHP ECHO $COUNT ?>
                                </th>
                                <td>
                                    <?PHP ECHO $row['SId']; ?>
                                </td>
                                <td>
                                    <?PHP ECHO $row['Name']; ?>
                                </td>
                                <td>
                                    <?PHP ECHO $row['Course']; ?>
                                </td>
                                <td>
                                    <?PHP ECHO $row['TotalAttempQus']; ?>
                                </td>
                                <td>
                                    <?PHP ECHO $row['RightAns']; ?>
                                </td>
                                <td>
                                    <?PHP ECHO $row['WrongAns']; ?>
                                </td>
                                <td>
                                    <?PHP ECHO $row['DataTime']; ?>
                                </td>
                            </tr>

                            <?php 
                            $COUNT++;
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?php 
include "./includefile/footer.php";
?>