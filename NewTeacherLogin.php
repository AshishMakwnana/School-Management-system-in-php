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
        <div class="row g-3">
            <div class="col-md-12">
                <!-- message box -->
                <?php
            if(isset($_SESSION['LoginData'])){
                
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success Message !</strong> New Teacher Name ('.$_SESSION['LoginData'].') Login data Submitted.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
                unset($_SESSION['LoginData']);

            }elseif(isset($_SESSION['Failed'])){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error  Message !</strong> New Teacher Name ('.$_SESSION['Failed'].' Login Access Not created).
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
                unset($_SESSION['Failed']);
            }
            
            ?>
            </div>
            <div class="col-md-12">
                <a href="TechLoginDetails.php" class="btn btn-warning">Update/Delete</a>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <span class="text-danger h5 fw-bold">Login Details</span>
                    </div>
                    <div class="card-body ">
                        <h5 class="card-title text-danger">* All The field are Required
                        </h5>
                        <form action="LoginData.php" method="POST" class="was-validated row g-3">
                            <div class="col-md-12">
                                <lable for="StudentName" class="form-label">Teacher Name</lable>
                                <input type="text" class="form-control is-valid" id="StudentName"
                                    placeholder="Enter Your Full Name" name="S_name" required>
                            </div>
                            <div class="col-md-12">
                                <lable for="StudentEmail" class="form-label">Email</lable>
                                <input type="email" class="form-control is-valid" name="UserName" id="StudentEmail"
                                    placeholder="Enter Student email" required>
                            </div>
                            <div class="col-md-12">
                                <lable for="Course" class="form-label">
                                    Password
                                </lable>
                                <input type="password" class="form-control is-valid" id="password"
                                    placeholder="Set password" name="pass" required>
                                <span class="p-viewer2">
                                    <i class="bi bi-eye-slash" aria-hidden="true" id="togglePassword"> </i>
                                </span>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" name="LoginAccesstech" class="btn btn-success">submit</button>
                            </div>

                        </form>
                    </div>
                </div>
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
    const form = document.querySelector("form");
    form.addEventListener('submit', function(e) {
        e.preventDefault();
    });
    </script>
</main>
<?php
include "./includefile/footer.php";
?>