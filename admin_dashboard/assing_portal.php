<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <?php include('include/links.php'); ?>
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
                <div class="card bg-primary card-bottom-ph">
                    <div class="card-body">
                        <h3 class=" text-center text-light">Assing Student Portal</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card card-shadow-ph">
                            <div class="card-body">
                                <form method="post">

                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <label for="student_name" class="form-label">Student Name*</label>
                                            <select class="form-select" name="student_sno" id="student_name">
                                                <option value="" selected disabled>Select Student</option>
                                                <?php
                                                $slelect_all_student = get_table_data('students', $con);
                                                while ($fetch = mysqli_fetch_assoc($slelect_all_student)) {
                                                ?>
                                                    <option value="<?php echo $fetch['sno']; ?>"><?php echo $fetch['student_name']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <div id="student_image_container" class="card-shadow-ph">
                                                <img src="../images/picture.png" alt="" width="150px">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Father Name</label>
                                            <div id="father_name_container">
                                                <input type="text" placeholder="Don't Type" readonly class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="student_name" class="form-label">Student Course</label>
                                            <div id="course_name_container">
                                                <input type="text" placeholder="Don't Type" readonly class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label for="portal_email" class="form-label">Portal Email*</label>
                                            <input type="email" name="portal_email" placeholder="Portal Email" id="portal_email" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="portal_password" class="form-label">Portal Password*</label>
                                            <div class="password-container">
                                                <input type="password" name="portal_password" placeholder="Portal Password" id="portal_password" class="form-control">
                                                <button id="toggleButton" class="eye-icon">
                                                    <i id="eyeIcon" class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <input type="submit" name="add_btn" value="Add" class="btn btn-primary form-control">
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </form>
                                <?php
                                if (isset($_POST['add_btn'])) {

                                    $student_sno = $_POST['student_sno'];
                                    $portal_email = $_POST['portal_email'];
                                    $password = $_POST['portal_password'];

                                    $update_student = "UPDATE `students` SET `portal_email`='$portal_email',`password`='$password' WHERE `sno`='$student_sno'";
                                    $update_student_qry = mysqli_query($con, $update_student);
                                    if ($update_student_qry) {
                                ?>
                                        <script>
                                            window.location = "alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'Portal Assinged Successfully!' ?>&location=<?php echo 'assing_portal.php' ?>";
                                        </script>
                                    <?php
                                    } else {
                                    ?>
                                        <script>
                                            window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Something Went Wrong!' ?>&location=<?php echo 'assing_portal.php' ?>";
                                        </script>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <?php include('include/footer.php'); ?>
            </div>
        </div>
    </div>
    <?php include('include/javascript.php'); ?>
    <script>
        // Function to handle the Ajax request
        function getStudentDetails() {
            var selectedStudent = $("#student_name").val();

            $.ajax({
                url: "ajax/get_student_image.php",
                type: "GET",
                data: {
                    student_name: selectedStudent
                },
                dataType: "json",
                success: function(response) {
                    var imageUrl = response.image;
                    var fatherName = response.father_name;
                    var courseName = response.batch_name;


                    // Display the image, father name, and course name in their respective containers
                    var imageContainer = $("#student_image_container");
                    imageContainer.html('<img src="../images/' + imageUrl + '" alt="Student Image" width="150px">');

                    fatherNameContainer.html('<input type="text" readonly  value="' + fatherName +
                        '" class="form-control">');

                    var courseNameContainer = $("#course_name_container");
                    courseNameContainer.html('<input type="text" readonly  value="' + courseName +
                        '" class="form-control">');
                },
                error: function(xhr, status, error) {
                    console.error('Error: ' + status);
                }
            });
        }

        // Attach the event listener to the dropdown
        $(document).ready(function() {
            $("#student_name").change(getStudentDetails);
        });
    </script>


</body>

</html>