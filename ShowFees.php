<?php
include "./includefile/header.php";
include "./includefile/navbar.php";
include "./includefile/config.php";
?>
<main>
    <?php
        if(isset($_POST['Show'])){
            $id = $_POST['Show'];
            $Studet = "SELECT name FROM student where roll_number=$id";
            $result = mysqli_query($con,$Studet);
            if($result){
                $s = mysqli_fetch_assoc($result);
                $studentName = $s['name'];
            }
?>
    <div class="container-fluid">
        <div class="container">
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="container d-flex justify-content-between">

                        <form method="post" action="AddFees.php">
                            <button class="btn btn-danger" type="submit" name="add" value="<?php echo $id ?>">Add
                                Fees</button>
                        </form>
                        <!-- this botton use for print out the fees Statement of the students -->
                        <form action="PrintFeesStament.php" method="post">
                            <button type="submit" name="PDFDATA" value="<?php echo $id; ?>" class="btn btn-success">
                                Print
                            </button>
                        </form>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <h5 class="card-header bg-warning"><span class="fw-bold">Student Fees Statement</span></h5>
                        <div class="card-body table-responsive">
                            <h5 class="card-title"><span>Student Name :</span> <?php echo $studentName ?></h5>
                            <?php
                                $q2 = "SELECT * FROM fess WHERE roll_number=$id";
                                $studentResult = mysqli_query($con,$q2);
                                }
                            ?>
                            <table class="table caption-top text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Paid fees</th>
                                        <th scope="col">Recept Number</th>
                                    </tr>
                                </thead>
                                <?php
                            $count=0;
                            $totalFees=0;
                            $studentResult = mysqli_query($con,$q2);
                            while($ro = mysqli_fetch_assoc($studentResult)){
                            $count=$count+1;
                            $totalFees = $totalFees+$ro['Paid_fees'] ;
                            ?>
                                <tbody>
                                    <tr>
                                        <th scope="row"><?php echo $count ?></th>
                                        <td> <?php echo $ro['date'] ?></td>
                                        <td><?php echo $ro['Paid_fees'].'/-'?></td>
                                        <td><?php echo $ro['Recept_no']?></td>
                                    </tr>
                                    <?php 
                                }
                                $count += 1;
                            ?>
                                    <tr>
                                        <th scope="row"><?php echo $count ?></th>
                                        <th scope="row" class="text-danger">Total Paid Fees </th>
                                        <th scope="row" class="text-danger">
                                            <?php echo  $totalFees.'/-' ?></th>
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-2">

    </div>



</main>
<?php
include "./includefile/footer.php";
?>