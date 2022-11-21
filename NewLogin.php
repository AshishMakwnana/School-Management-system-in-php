<?php
include "./includefile/header.php";
include "./includefile/navbar.php";
include "./includefile/config.php";
// session_start();
?>
<main>
    <style>
    .p-viewer,
    .p-viewer2 {
        float: right;
        margin-top: -32px;
        margin-right: 30px;
        position: relative;
        z-index: 1;
        cursor: pointer;


    }

    .fa-eye {
        color: #000;
    }

    @media screen and (max-width:767px) {

        .p-viewer {
            position: relative;
            margin: -32px 10px;
            float: right;
        }

        .fa-eye {
            color: #000;
        }
    }
    </style>
 
    <div class="container-fluid">
        <div class="row g-2">
            <div class="col-md-12">
                <!-- message -->
            </div>
            <div class="col-md-12">
                <!-- botton  -->

            </div>
            <div class="col-md-12">
                <!-- main content -->
                <?php
                    if(isset($_POST['Update'])){
                        $StudentID = $_POST['Update'];

                        // select Student 
                        $query = "SELECT * FROM student WHERE roll_number='$StudentID'";

                        $result = mysqli_query($con,$query);

                        if($result){
                            $data = mysqli_fetch_assoc($result);

                            $StudentName = $data['name'];
                            $UserName = $data['Email'];
                            $password = $data['Password'];
    
                        }
                        ?>
                <!-- Update Student Login Details Form -->
                <div class="card">
                    <div class="card-header  bd-dark ">
                        <span class="text-danger fw-bold">UPDATE</span>
                    </div>
                    <div class="card-body">
                        <form action="LoginData.php" class=" row g-2 was-valideted updateForm" method="post">
                            <input type="text" hidden name="StudentId" value="<?php echo $StudentID; ?>">
                            <div class="col-md-6">
                                <label for="StudentName" class="form-label">Student Name</label>
                                <input type="text" disabled class="form-control is-valid" id="StudentName"
                                    value="<?php echo $StudentName ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="UserName" class="form-label">User Name</label>
                                <input type="text" class="form-control is-valid" id="UserName"
                                    value="<?php echo $UserName ?>" name="Username" required>
                            </div>
                            <div class="col-md-6">
                                <label for="OldPassword" class="form-label"> Old Password</label>
                                <input type="password" disabled class="form-control is-valid" id="OldPassword"
                                    value="<?php echo $password ?>" name="OldPass" required />
                            </div>
                            <div class="col-md-6">
                                <label for="NewPassword" class="form-label"> New Password</label>
                                <input type="password" class="form-control is-valid" name="NewPass" id="password"
                                    required>
                                <span class="p-viewer2">
                                    <i class="bi bi-eye-slash" aria-hidden="true" id="togglePassword"> </i>
                                </span>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" name="Update" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                    }
                ?>

            </div>
        </div>
    </div>
    <script>
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");
    // const newPassword = document.querySelector("NewPassword")

    togglePassword.addEventListener("click", function() {
        // toggle the type attribute
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);
        // toggle the icon
        this.classList.toggle("bi-eye");
    });

    // prevent form submit
    // const form = document.querySelector("form");
    // form.addEventListener('submit', function(e) {
    //     e.preventDefault();
    // });
    </script>
</main>
<?php 
include "./includefile/footer.php";

?>