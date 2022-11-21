<?php 
  include "./includefile/config.php";

  require '../vendor/autoload.php';

  if(isset($_POST['PDFDATA'])){
    $Student_id = $_POST['PDFDATA'];
    $sql= "SELECT * FROM fess where Roll_number=$Student_id";
    $today = date("Y-M-D");
    $result= mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0){
        $studentName = mysqli_fetch_assoc($result) ;
        $Student_name = $studentName['name'];
        $html ='
            <style>
            .container{
                display:flex;
                justify-content:center;
                background:#bfbfbbf;
                padding:20px;
            }
            .StudentName{
                color:red;
            }
            span{
                margin-top:10px;
                margin-bottom:10px;
            }
            .Name{
                text-align:center;
                color:red;
            }
            // .Table{
            //     background:yellow;
            //     padding:20px;
            // }
            table,th,td{  
                border:1px solid black;
                margin-top:30px;
                text-align:center;
                border-radius:10px;
               
            }
            th,td{
                margin:20px;
                padding:20px;
            }
            </style>
            <div class="container">
                    
                    <h4 class="Name">Arncet Institute</h4>
                    <span>'.$today.'</span>
                
                <h4 class="StudentName">Student Fees Statement</h4>
                <div>
                <h4>Student Name :'.$Student_name.'</h4>
                <h4 >Student Course :'.$studentName['course'].'</h4>
            </div>

            <table>
        ';   
        $html.='<tr>
            <td>S.no</td>
            <td>Paid Fees </td>
            <td>Recept Number</td>
            <td>Date</td>
        </tr>';
        $count=1;
        while($row = mysqli_fetch_assoc($result)){
            $html.='<tr>
            <td>'.$count.'</td>
            <td>'.$row['Paid_fees'].'</td>
            <td>'.$row['Recept_no'].'</td>
            <td>'.$row['date'].'</td>
        </tr>';
        $count+=1;
        }
        $html.="</table> </div>";
    }else{
        $html = "Data not Found";
    }
    $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $file = "StudentData".date('Y-m-d').".pdf";
        $mpdf->Output($file,'I');
}
?>