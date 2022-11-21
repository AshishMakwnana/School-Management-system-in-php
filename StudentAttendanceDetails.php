<?php
include "./includefile/header.php";
include "./includefile/navbar.php";
include "./includefile/config.php";
?>
<main>
<?php
if(isset($_POST['ViewMore'])){
    $StudentId = $_POST["ViewMore"];
    $query = "SELECT * FROM `attendance` where Roll_number='$StudentId' ";
    $query_result = mysqli_query($con,$query);
    if($query_result){
        $student = mysqli_fetch_assoc($query_result);
        $studentName = $student['student_name'];
    }
    ?>
  <div class="conatiner-fluid mt-1 table-responsive">
  <div class="card">
      <div class="card-header table-responsive bg-dark text-danger">
          <span class="fw-bold h5">Student Attendace</span>
      </div>
      <div class="card-body table-responsive">
          <h5 class="card-title">Student Name <?php echo $studentName ?></h5>
          <div class="container">
                        <form action="AttendanceData.php" method="post">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">S.no </th>
                                        <th scope="col">Date</th>
                                        <th scope="col">InTime</th>
                                        <th scope="col">Out Time</th>
                                        <th scope='col'>Attendance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                // This is for show the the studetn by batch time and Course
                                
                                    $sql = "SELECT * FROM `attendance` where Roll_number='$StudentId' ";
                                    $count =1;
                                    $result = mysqli_query($con, $sql);
                                    while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                    <tr>
                                        <th scope="row"><?php echo $count ?></th>
                                        <td scope="row"><?php echo $row['date']?></td>
                                        <td scope="row"><?php echo  $row['INTIME'] ?></td>
                                        <td scope="row"><?php echo $row['OUTTIME'] ?></td>
                                        <td scope="row"><?php echo $row['attendance'] ?></td>
                                    <?php
                                    $count+=1;
                                    }
                                ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
      </div>
  </div>
</div> 
<?php 
}
?>  
</main>
<?php
include "./includefile/footer.php" 
?>