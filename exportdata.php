<?php
    include "./includefile/config.php";

    require '../vendor/autoload.php';


    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Writer\Xls;
    use PhpOffice\PhpSpreadsheet\Writer\csv;

    if(isset($_POST['export_data'])){
        
        $file_extention_name  = $_POST['export_data'];
        echo $file_extention_name;
        

        $sql= "SELECT * FROM student";

        $result= mysqli_query($con,$sql);

        if(mysqli_num_rows($result)>0){
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'ID');
            $sheet->setCellValue('B1', 'Roll Number');
            $sheet->setCellValue('C1', 'Registration Number');
            $sheet->setCellValue('D1', 'Student Name');
            $sheet->setCellValue('E1', 'Father Name');
            $sheet->setCellValue('F1', 'Mobile Number');
            $sheet->setCellValue('G1', 'DOB');
            $sheet->setCellValue('H1', 'Course');
            $sheet->setCellValue('I1', 'Batch_time');
            $sheet->setCellValue('J1', 'Registration Fees');
            $sheet->setCellValue('K1', 'Registration Date');
            $sheet->setCellValue('L1', 'Total Fees');
            $sheet->setCellValue('M1', 'Lab Number');
            $sheet->setCellValue('N1', 'System Number');
            $sheet->setCellValue('O1', 'Student Image');
            
            
            $rowCount =2;
            foreach($result as $row){
                $sheet->setCellValue('A'.$rowCount, $row['id']);
                $sheet->setCellValue('B'.$rowCount, $row['roll_number']);
                $sheet->setCellValue('C'.$rowCount, $row['rg_number']);
                $sheet->setCellValue('D'.$rowCount, $row['name']);
                $sheet->setCellValue('E'.$rowCount, $row['f_name']);
                $sheet->setCellValue('F'.$rowCount, $row['MobileNumber']);
                $sheet->setCellValue('G'.$rowCount, $row['DOB']);
                $sheet->setCellValue('H'.$rowCount, $row['course']);
                $sheet->setCellValue('I'.$rowCount, $row['batch_time']);
                $sheet->setCellValue('J'.$rowCount, $row['RG_fees']);
                $sheet->setCellValue('K'.$rowCount, $row['RG_date']);
                $sheet->setCellValue('L'.$rowCount, $row['fees']);
                $sheet->setCellValue('M'.$rowCount, $row['Lab']);
                $sheet->setCellValue('N'.$rowCount, $row['systemNumber']);
                $sheet->setCellValue('O'.$rowCount, "D:\XAMPP\htdocs\insttitute\admin\StudentImage\"".$row['StudentImage']."");
                $rowCount+=1;
            }

            if($file_extention_name =="xlsx"){
                $writer = new Xlsx($spreadsheet);
                $fileName = "StudentData.xlsx";
            }
            elseif($file_extention_name =="xls"){
                $writer = new Xls($spreadsheet);
                $fileName = "StudentData.xls";
            }
            elseif($file_extention_name == "csv"){
                $writer = new csv($spreadsheet);
                $fileName = "StudentData.csv";
            }
            // // $uriter->save($final_filename);
            header ('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header ('Content-Disposition: attactment; filename='.urlencode($fileName).'');
            $writer->save('php://output');
           
        }else{
            echo "No Student in the database";
        }

    }
    if(isset($_POST['PDFDATA'])){
        $fileName = $_POST['PDFDATA'];
        $sql= "SELECT * FROM student";
        $today = date("Y-M-D");
        $result= mysqli_query($con,$sql);
        if(mysqli_num_rows($result)>0){
            $html ='
                <style>
                span{
                    margin-top:10px;
                    margin-bottom:10px;
                }
                .Name{
                    text-align:center;
                    color:green;
                }
                table,th,td{
                    background-color:light;  
                    border:1px solid black;
                    margin-top:30px;
                    text-align:center;
                    border-radius:10px;
                   
                }
                td{
                    margin:10px;
                    padding:10px;
                }
                </style>
                <div class="container">
                    <div class="date">
                    <span>'.$today.'</span>
                 
                    </div>
                    <div>
                    <span class="Name">Arncet Institute</span>
                    </div>
                </div>
                <span>Student Data</span>
                <table class"table" >
            ';   
            $html.='<tr class="head">
                <td>S.no</td>
                <td>Roll Number</td>
                <td>Registration No.</td>
                <td>Student Name</td>
                <td>Father Name </td>
                <td>Course</td>
                <td>Mobile Number</td>
                <td>DOB</td>
                <td>Batch Time</td>
                <td>Fees</td>
                <td>Lab</td>
                <td>System</td>
                <td>Registration Date</td>
            </tr>';
            while($row = mysqli_fetch_assoc($result)){
                $html.='<tr>
                <td>'.$row['id'].'</td>
                <td>'.$row['roll_number'].'</td>
                <td>'.$row['rg_number'].'</td>
                <td>'.$row['name'].'</td>
                <td>'.$row['f_name'].'</td>
                <td>'.$row['course'].'</td>
                <td>'.$row['MobileNumber'].'</td>
                <td>'.$row['DOB'].'</td>
                <td>'.$row['batch_time'].'</td>
                <td>'.$row['fees'].'</td>
                <td>'.$row['Lab'].'</td>
                <td>'.$row['systemNumber'].'</td>
                <td>'.$row['RG_date'].'</td>
            </tr>';
            }
            $html.="</table>";
        }else{
            $html = "Data not Found";
        }
        $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($html);
            $file = "StudentData".date('Y-m-d').".pdf";
            $mpdf->Output($file,'I');
    }
?>