<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <?php include('include/links.php'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <?php include('include/sidebar.php'); ?>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <?php include('include/navbar.php'); ?>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                <!--  Row 1 -->
                <div class="card bg-primary">
                    <div class="card-body">
                        <h3 class=" text-center text-light">Edit Teacher Details</h3>
                    </div>
                </div>

                <div class="row flex-column-reverse flex-md-row">
                    <div class="col-md-8" id="first_coloumn">
                        <div class="card card-shadow-ph">
                            <div class="card-body">

                                <?php
                                $get_teacher_sno = $_GET['teacher_sno'];
                                $teacher_detail = get_table_data2('teacher', $con, 'teacher_id', $get_teacher_sno);
                                while ($row = mysqli_fetch_assoc($teacher_detail)) {
                                    $teacher_name = $row['teacher_name'];
                                    $teacher_email = $row['teacher_email'];
                                    $teacher_contact = $row['teacher_contact'];
                                    $gender = $row['gender'];
                                    $cnic = $row['cnic'];
                                    $quli = $row['quli'];
                                    $exper = $row['exper'];
                                    $address = $row['address'];
                                    $portal_email = $row['portal_email'];
                                    $portal_password = $row['portal_password'];
                                    $image = $row['teacher_image'];
                                }
                                ?>
                                <form method="post">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <label for="teacher_name" class="form-label">Teacher Name*</label>
                                            <input type="text" name="teacher_name" id="teacher_name" placeholder="Teacher Name" value="<?php echo $teacher_name ?>" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="teacher_email" class="form-label">Email*</label>
                                            <input type="email" placeholder="Teacher Email" min="1" name="teacher_email" id="teacher_email" class="form-control" required onkeydown="type_email()" value="<?php echo $teacher_email ?>">
                                        </div>
                                    </div>

                                    <div class="row align-items-center mt-3">

                                        <div class="col-md-6">
                                            <label for="teacher_contact" class="form-label">Teacher Contact*</label>
                                            <input type="number" name="teacher_contact" placeholder="Teacher Contact" value="<?php echo $teacher_contact ?>" id="teacher_contact" class="form-control" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="cnic" class="form-label">CNIC*</label>
                                            <input type="text" name="cnic" placeholder="Course Duration" id="cnic" class="form-control" value="<?php echo $cnic ?>">
                                        </div>
                                    </div>

                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-6">
                                            <label for="gender" class="form-label">Gender*</label>
                                            <select class="form-select" name="gender" id="gender">
                                                <option value="<?php echo $gender ?>" selected><?php echo $gender ?></option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">

                                            <label for="quli" class="form-label">Qualification*</label>
                                            <input type="text" name="quli" placeholder="Qualification" id="quli" class="form-control" value="<?php echo $quli ?>">
                                        </div>
                                    </div>
                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-12">
                                            <label for="exper" class="form-label">Experience</label>
                                            <input type="text" name="exper" placeholder="Experience" id="exper" class="form-control" value="<?php echo $exper ?>">
                                        </div>

                                    </div>
                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-12">
                                            <label for="address" class="form-label">Address*</label>
                                            <textarea name="address" id="address" rows="2" class="form-control" placeholder="Address"><?php echo $address ?></textarea>
                                        </div>
                                    </div>
                                    <!-- <div class="row mt-3 mb-3">
                                        <h5 class="text-primary">Portal Detail</h5>
                                    </div> -->
                                    <!-- <div class="row">
                                        <div class="col-md-6">
                                            <label for="portal_email" class="form-label">Portal Email*</label>
                                            <input type="email" name="portal_email" placeholder="Portal Email" id="portal_email" class="form-control" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="portal_password" class="form-label">Portal Password*</label>
                                            <div class="password-container">
                                                <input type="password" name="portal_password" placeholder="Portal Password" id="portal_password" class="form-control" value="">
                                                <button id="toggleButton" class="eye-icon">
                                                    <i id="eyeIcon" class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="row mt-4">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6 mt-2">
                                                    <input type="submit" name="update_btn" value="Update" class="btn btn-primary form-control">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <input onclick="history.back()" type="button" value="Back" class="btn btn-dark form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3"></div>
                                    </div>
                                </form>
                                <?php
                                if (isset($_POST['update_btn'])) {
                                    $teacher_name1 = $_POST['teacher_name'];
                                    $teacher_email1  = $_POST['teacher_email'];
                                    $teacher_contact1 = $_POST['teacher_contact'];
                                    $gender1 = $_POST['gender'];
                                    $cnic1 = $_POST['cnic'];
                                    $quli1 = $_POST['quli'];
                                    $exper1 = $_POST['exper'];
                                    $address1 = $_POST['address'];
                                    $portal_email1 = $_POST['portal_email'];
                                    // $user_input_password = $_POST['portal_password'];
                                    // $portal_password1 = password_hash($user_input_password, PASSWORD_DEFAULT);

                                    $update_teacher_detail = "UPDATE `teacher` SET `teacher_name`='$teacher_name1',`teacher_email`='$teacher_email1',`teacher_contact`='$teacher_contact1',`gender`='$gender1',`cnic`='$cnic1',`quli`='$quli1',`exper`='$exper1',`address`='$address1' WHERE `teacher_id`='$get_teacher_sno'";
                                    $update_teacher_detail_qry = mysqli_query($con, $update_teacher_detail);
                                    if ($update_teacher_detail_qry) {

                                ?>
                                        <script>
                                            window.location = "alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'Details Updated Success!' ?>&location=<?php echo 'teachers.php' ?>";
                                        </script>
                                    <?php
                                    } else {
                                    ?>
                                        <script>
                                            window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Something Went Wrong!' ?>&location=<?php echo 'teachers.php' ?>";
                                        </script>
                                <?php
                                    }
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                    <!-- ==== col-md-8 ===== -->
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Change Image</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <div id="upload-demo">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row text-center">

                                        <div class="col-md-12">
                                            <strong>Select image:</strong>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="file" id="image" class="form-control-file">
                                        </div>

                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-primary btn-block btn-upload-image">Upload Image</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--========-->

                    <div class="col-md-4">
                        <div class="card card-shadow-ph">
                            <div class="card-header text-bg-primary text-center">
                                <h5 class="text-bg-primary">Profile Image</h5>
                            </div>
                            <div class="card-body text-center">
                                <img src="../images/<?php echo $image ?>" class="img img-fluid">
                                <button type="button" class="btn btn-primary mt-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Upload Image
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- ==== col-md-4 ===== -->

                </div>
                <?php include('include/footer.php'); ?>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var resize = $('#upload-demo').croppie({
            enableExif: true,
            enableOrientation: true,
            viewport: { // Default { width: 100, height: 100, type: 'square' } 
                width: 300,
                height: 300,
                type: 'circle' //square
            },
            boundary: {
                width: 300,
                height: 300
            }
        });


        $('#image').on('change', function() {
            console.log('working');
            var reader = new FileReader();
            reader.onload = function(e) {
                resize.croppie('bind', {
                    url: e.target.result
                }).then(function() {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });


        $('.btn-upload-image').on('click', function(ev) {
            resize.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(img) {
                var teacherSno = <?php echo $get_teacher_sno; ?>;
                $.ajax({
                    url: "ajax/upload.php",
                    type: "POST",
                    data: {
                        "image": img,
                        "teacher_sno": teacherSno
                    },
                    success: function(data) {
                        alert(data);
                        var btn_close = $('.btn-close');
                        $(btn_close).click();
                        window.location = 'edit_teacher.php?teacher_sno=<?php echo $get_teacher_sno ?>';
                    }
                });
            });
        });
    </script>
    <?php include('include/javascript.php'); ?>
</body>

</html>