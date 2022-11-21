<?php
    include "./includefile/config.php";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM adminlogin where Username='".$username."' And Password = '".$password."'";

        $result = mysqli_query($con,$sql);
       if(mysqli_fetch_row($result)>0)
       {    
        session_start();
        $_SESSION['UserName'] = $username;
        header("Location:Dashbord.php");
       }else{
           header("Location:index.php?error=error");
       }
 
}

?>