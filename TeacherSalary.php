<?php 
include "./includefile/header.php";
include "./includefile/navbar.php";
include "./includefile/config.php";

?>
<main>
    <div class="container-fluid">
        <div class="container">
            <div class="row g-3">
                <div class="card">
                    <div class="card-header bg-dark">
                        <span class="text-danger fw-bold h5">Teacher Salary</span>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Teacher ID</th>
                                    <th>Teacher Name</th>
                                    <th>Date</th>
                                    <th>Salary</th>
                                    <th>Days</th>
                                    <th>Paid Salary </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $days  = cal_days_in_month(CAL_GREGORIAN,07,2022);
                                $count=1;
                                $sundays=0;
                                function getWednesdays($y, $m)
                                    {
                                        return new DatePeriod(
                                            new DateTime("first sunday of $y-$m"),
                                            DateInterval::createFromDateString('next sunday'),
                                            new DateTime("last day of $y-$m")
                                        );
                                    }
                                foreach (getWednesdays(date('Y'), date('m')) as $wednesday) {
                                    $sundays +=1;
                                }
                                
                                // echo $sundays;
                                // echo $days;
                                $query = "SELECT * FROM teacherdata ";
                                $result = mysqli_query($con,$query);

                                if($result){
                                    while($info = mysqli_fetch_assoc($result)){
                                        $salary = $info['Salary'];
                                        $id = $info['ID'];
                                        $name = $info['Name'];
                                        $pDS = $salary/$days;        
                                        $FDate = '1-'.date('m-Y');
                                        $lastDate = $days.'-'.date('m-Y');
                                    $att = "SELECT Count(*) FROM teacherattendance WHERE TeacherID = '$id' and Date between'$FDate' and '$lastDate'";
                                    //  echo $att;
                                    
                                    $at_query = mysqli_query($con,$att);

                                    while($attend = mysqli_fetch_array($at_query)){
                                        $total_attendace = $attend['Count(*)'];
                                        $total_Salary = $pDS*($total_attendace+$sundays);
                                    }
                                    ?>


                                <tr>
                                    <th><?php echo $count ?></th>
                                    <td><?php echo $id ?></td>
                                    <td><?php echo $name ?></td>
                                    <td><?php echo date('M-Y') ?></td>
                                    <td><?php echo $salary ?></td>
                                    <td><?php echo $total_attendace  ?></td>
                                    <td><?php echo round($total_Salary)."/-"  ?></td>

                                </tr>
                                <?php 
                                    $count +=1;
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
include "./includefile/footer.php";
?>