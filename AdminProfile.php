<?php 
 include "./includefile/header.php";
 include "./includefile/navbar.php";
 include "./includefile/config.php";
?>
<main>
    <style>
    .gradient-custom {
        /* fallback for old browsers */
        background: #f6d365;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
    }
    </style>
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
    <div class="container-fluid">
        <div class="container">
            <section class="vh-100">
                <div class="container  h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col col-lg-6 mb-4 mb-lg-0">
                            <div class="card mb-3" style="border-radius: .5rem;">
                                <div class="row g-0">
                                    <div class="col-md-4 gradient-custom text-center text-white"
                                        style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                        <?php 
                                            if($path == ''){
                                                ?>
                                        <img src="../logo.jpg" alt="Not Set" class="img-fluid my-5"
                                            style="width: 80px;" />
                                        <?php
                                            }else{
                                                ?>
                                        <img src="AdminImage/<?php echo $path ?>" alt="Not Set" class="img-fluid my-5"
                                            style="width: 80px;" />

                                        <?php 
                                            }
                                        ?>
                                        <h5>Name</h5>
                                        <p><?php echo $name ?></p>
                                        <a href="UpdateProfile.php" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"> <i class="bi bi-pencil-square"></i> </a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body p-4">
                                            <h6>Information</h6>
                                            <hr class="mt-0 mb-4">
                                            <div class="row pt-1">
                                                <div class="col-12 mb-3">
                                                    <h6>Email</h6>
                                                    <p class="text-muted"><?php echo $email ?></p>
                                                </div>
                                            </div>
                                            <div class="row pt-1">
                                                <div class="col-12 mb-3">
                                                    <h6>Password</h6>
                                                    <p class="text-muted"><?php echo $pass ?></p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

</main>

<?php include "./includefile/footer.php"; ?>