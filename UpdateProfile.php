<?php 
include "./includefile/header.php";
include "./includefile/navbar.php";
include "./includefile/config.php";
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
        <?php 
     $name = $_SESSION['AdminName'];
     $email =$_SESSION['UserName'];
     $id = $_SESSION['ID'];
     $query = "SELECT * FROM `adminlogin` where id = $id  ";

    $result = mysqli_query($con,$query);

    if($result){
        $row = mysqli_fetch_assoc($result);

        $pass = $row['Password'];
        $path = $row['image'];
    }
    ?>
        <div class="container">
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
                if(isset($_SESSION['Success_update'])){
                    echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div>
                        '.$_SESSION['Success_update'].'
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                </div>';
                unset($_SESSION['Success_update']);
                }elseif(isset($_SESSION['Failed'])){
                    echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div>
                        '.$_SESSION['Failed'].'
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                </div>';
                unset($_SESSION['Failed']);
                }elseif(isset($_SESSION['ImageError'])){
                    echo '<div class="alert alert-warning d-flex align-items-center alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div>
                        '.$_SESSION['ImageError'].'
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                </div>';
                unset($_SESSION['ImageError']);
                }
            ?>
        </div>

        <div class="container">
            <div class="card">
                <div class="card-header bg-dark">
                    <span class="text-danger fw-bold h5">Update Profile</span>
                </div>
                <div class="card-body">
                    <div class="container">
                        <form action="AdmininfoUpdate.php" method="post" class="row g-1" enctype="multipart/form-data">
                            <div class="col-sm-12">
                                <label for="Name" class="form-label">Name</label>
                            </div>
                            <div class="col-sm-12">
                                <input type="text" name="name" id="Name" value="<?php  echo $name ?>"
                                    class="form-control" required>
                            </div>
                            <div class="col-sm-12">
                                <label for="Email" class="form-label">
                                    Username
                                </label>
                            </div>
                            <div class="col-sm-12">
                                <input type="email" name="Email" id="Email" class="form-control"
                                    value="<?php echo $email  ?>" required>
                            </div>
                            <div class="col-sm-12">
                                <label for="OldPassword" class="form-label">Old Password</label>
                            </div>
                            <div class="col-sm-12">
                                <input type="password" name="OldPassword" id="OldPassword" class="form-control"
                                    value="<?php echo $pass ?>">
                            </div>
                            <div class="sm-12">
                                <label for="password" class="form-label">New Password</label>
                            </div>
                            <div class="sm-12">
                                <input type="password" name="password" id="password" class="form-control" required>
                                <span class="p-viewer2">
                                    <i class="bi bi-eye-slash" aria-hidden="true" id="togglePassword"> </i>
                                </span>
                            </div>
                            <div class="col-sm-12">
                                <label for="AdminImage" class="form-label">Image</label>
                            </div>
                            <div class="col-sm-12">
                                <input type="hidden" name="oldImage" value="<?php echo $path ?>">
                                <input type="file" name="Image" id="AdminImage" class="form-control"
                                    accept=".jpg , .png ,.jpeg">
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-danger" type="submit" name="Admininfo">Submit</button>
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
    </script>

</main>

<?php 
include "./includefile/footer.php";
?>