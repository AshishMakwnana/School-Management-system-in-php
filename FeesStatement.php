<?php
include "./includefile/header.php";
include "./includefile/navbar.php";
include "./includefile/config.php";
?>
<main>
    <div class="card mt-3 table-responsive">
        <div class="col-md-12">
            <!-- messages -->
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
                if(isset($_SESSION['done'])){
                    echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                      Student Name '.$_SESSION['done'].' fees is Add successfully. 
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  ';
                    unset($_SESSION['done']);
                }elseif(isset($_SESSION['Failed'])){
                    echo '<div class="alert alert-danger d-flex align-items-center  alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                      Student Name '.$_SESSION['Failed'].' Fees Not Add .
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                    unset($_SESSION['Failed']);
                }
            ?>
        </div>
        <div class="card-header bg-warning">
            <span class="text-danger h4"> Download Students Data</span>
        </div>
        <div class="card-body">
            <form action="exportdata.php" method="post">
                <button class="btn btn-dark" name="export_data" value="xls" type="submit"><span class="h3"><i
                            class="bi bi-filetype-xls"></i></span></button>
                <button class="btn btn-success" name="export_data" value="xlsx" type="submit"><span class="h3"><i
                            class="bi bi-filetype-xlsx"></i></span></button>
                <button class="btn btn-warning" name="export_data" value="csv" type="submit"><span class="h3"><i
                            class="bi bi-filetype-csv"></i></span></button>
                <button class="btn btn-danger" name="PDFDATA" value="pdf" type="submit"><span class="h3"><i
                            class="bi bi-filetype-pdf"></i></span></button>
            </form>
        </div>
    </div>
    <div class="card mt-3 table-responsive">
        <div class="card-header bg-dark">
            <span class="text-danger h5 fw-bold">Students Fees List</span>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col table-responsive">
                    <table class="table table-striped table-hover  text-center">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">id</th>

                                <th scope="col">Roll number</th>

                                <th scope="col">Student Name</th>

                                <th scope="col">Course</th>
                                <th scope="col">
                                    Registration Fees
                                </th>
                                <th scope="col">Paid Fees</th>
                                <th scope="col">Total Fees</th>
                                <th scope="col">Opration</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- show data in table   -->
                            <?php

                            $student = "SELECT * FROM student";

                            $StudentResult = mysqli_query($con,$student);

                            if($StudentResult){
                                while($Rcd = mysqli_fetch_assoc($StudentResult)){
                                    $TotalFeesPaid=0;
                                    $id = $Rcd['roll_number'];
                                    $sql = "SELECT Paid_fees  FROM fess where Roll_number=$id";
                                    $result = mysqli_query($con,$sql);
                                    while($TotalFess = mysqli_fetch_assoc($result)){
                                        $TotalFeesPaid = $TotalFeesPaid+$TotalFess['Paid_fees'];
                                    }
                                    echo '<tr>
                                    <th scope="row">'.$Rcd["id"].'</th>
                                    <td>'.$Rcd["roll_number"].'</td>
                                    <td>'.$Rcd['name'].'</td>
                                    <td>'.$Rcd["course"].'</td>
                                    <td>'.$Rcd["RG_fees"].'/-</td>
                                    <td>'.$TotalFeesPaid.'/-</td>
                                    <td>'.$Rcd["fees"].'/-</td>
                                    <td>
                                    <div class="d-flex justify-content-around">
                                        <div class="from1">
                                            <form action="AddFees.php" method="post">
                                                <button class="btn btn-success" type="submit" name="add"
                                                    Value="'.$Rcd['roll_number'].'">Add
                                                </a></button>
                                            </form>
                                        </div>
                                        <div class="form2">
                                            <form action="ShowFees.php" method="post">
                                                <button class="btn btn-warning " type="submit" name="Show"
                                                    Value="'.$Rcd['roll_number'].'">Show
                                                    </a></button>
                                            </form>
                                        </div>
                                    </div>
                           
                                    </td>
        
                                </tr>';
                                }

                                }
                        // include "connect.php";

                        // $sql = "SELECT * FROM fess";
                        // $result = mysqli_query($con,$sql);

                        // while($row = mysqli_fetch_assoc($result)){
                        //     echo '<tr>
                        //     <th scope="row">'.$row["id"].'</th>
                        //     <td>'.$row["Roll_number"].'</td>
                        //     <td>'.$row['name'].'</td>
                        //     <td>'.$row["course"].'</td>
                        //     <td>'.$row["Res_fees"].'</td>
                        //     <td>'.$row["Paid_fees"].'</td>
                        //     <td>'.$row["date"].'</td>
                        //     <td>'.$row["Recept_no"].'</td>
                        //     <td>'.$row["total_fees"].'</td>
                        //     <td>
                        //     <form action="AddFees.php" method="post">
                        //             <button class="btn btn-success" type="submit" name="add" Value="'.$row['Roll_number'].'">Add
                        //             </a></button>
                        //             <button class="btn btn-warning " type="submit" name="Show" Value="'.$row['Roll_number'].'">Show
                        //             </a></button>
                        //         </form>
                        //     </td>

                        // </tr>';
                    
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