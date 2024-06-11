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
                <div class="card bg-primary card-bottom-ph my-border-primary-1 my-border-top-1">
                    <div class="card-body">
                        <h3 class=" text-center text-light">Batch Detail</h3>
                    </div>
                </div>
                <div class="card my-border-primary-1 my-border-bottom-1">
                    <div class="card-body table-body">
                        <!-- ======= details ======== -->
                        <div class="card card-shadow-ph my-detail-card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <?php
                                        $get_batch_sno = $_GET['batch_sno'];
                                        $table_detail = get_table_data2('batch', $con, 'batch_id', $get_batch_sno);
                                        while ($row = mysqli_fetch_assoc($table_detail)) {
                                            $batch_sno = $row['batch_id'];
                                            $batch_name = $row['batch_name'];
                                            $batch_code = $row['batch_code'];
                                            $batch_teacher = $row['teacher'];
                                            $course_name = $row['course_id'];
                                            $batch_duration = $row['course_duration'];
                                            $slot = $row['batch_slot'];
                                            $date_of_start = $row['date_of_start'];
                                        }
                                        $show_teacher_name = get_table_data2('teacher', $con, 'teacher_id', $batch_teacher);
                                        while ($show_teacher = mysqli_fetch_assoc($show_teacher_name)) {
                                            $call_teacher_name = $show_teacher['teacher_name'];
                                            $call_teacher_image = $show_teacher['teacher_image'];
                                        }

                                        $show_course_name = get_table_data2('course', $con, 'Id', $course_name);
                                        $call_course_name = mysqli_fetch_assoc($show_course_name)['course_name'];
                                        ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6 text-bold-ph">
                                                        <label>Batch Name:</label>
                                                    </div>
                                                    <div class="col-md-6"><label><?php echo $batch_name ?></label></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6 text-bold-ph">
                                                        <label>Batch Code:</label>
                                                    </div>
                                                    <div class="col-md-6"><label><?php echo $batch_code ?></label></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6 text-bold-ph">
                                                        <label>Teacher Name:</label>
                                                    </div>
                                                    <div class="col-md-6"><label><?php echo $call_teacher_name ?></label></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6 text-bold-ph">
                                                        <label>Slot:</label>
                                                    </div>
                                                    <div class="col-md-6"><label><?php echo $slot ?></label></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6 text-bold-ph">
                                                        <label>Course Name:</label>
                                                    </div>
                                                    <div class="col-md-6"><label><?php echo $call_course_name ?></label></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6 text-bold-ph">
                                                        <label>Duration:</label>
                                                    </div>
                                                    <div class="col-md-6"><label><?php echo $batch_duration . ' ', 'Months'; ?></label></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6 text-bold-ph">
                                                        <label>Batch Start Date:</label>
                                                    </div>
                                                    <div class="col-md-6"><label><?php echo $date_of_start ?></label></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6 text-bold-ph">
                                                        <label>Batch End Date:</label>
                                                    </div>
                                                    <div class="col-md-6"><label><?php echo $date_of_start ?></label></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <img src="../images/<?php echo $call_teacher_image ?>" class="img img-fluid" width="150px" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ====================== -->

                        <div class="row mt-4">
                            <div class="col-md-12 d-flex align-items-center">
                                <label class="w-25">Quick Search</label>

                                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name" class="form-control">
                            </div>
                        </div>
                        <div class="table-responsive main-table mt-4">
                            <table id="myTable" class="teacher-table table-bordered table display data-table text-nowrap text-center my-border-primary-1">
                                <thead class="bg-primary text-white">
                                    <th>Sno</th>
                                    <th>Student Name</th>
                                    <th>Father Name</th>
                                    <th>Student Contact</th>
                                    <th>Date of Birth</th>
                                    <th>Gender</th>
                                    <th>Education</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </thead>
                                <?php
                                $show_all_students = get_table_data('students', $con);

                                while ($show = mysqli_fetch_assoc($show_all_students)) {
                                    $batch_ids = explode(',', $show['batch']);

                                    // Check if the batch_ids array contains the desired batch number (3)
                                    if (in_array($get_batch_sno, $batch_ids)) {
                                        // If the student's batch includes 3, display their details
                                ?>
                                        <tr>
                                            <td></td>
                                            <td><?php echo $show['student_name'] ?></td>
                                            <td><?php echo $show['father_name'] ?></td>
                                            <td><?php echo $show['student_contact'] ?></td>
                                            <td><?php echo $show['date_of_birth'] ?></td>
                                            <td><?php echo $show['gender'] ?></td>
                                            <td><?php echo $show['qualification'] ?></td>
                                            <td><?php echo $show['email'] ?></td>
                                            <td><?php echo $show['address'] ?></td>
                                            <td><img src="../images/<?php echo $show['student_image'] ?>" class="img img-fluid"></td>
                                            <td>

                                                <a href="attendance.php?student_sno=<?php echo $show['sno']; ?>"><button class="btn btn-primary" style="margin-right:5px">Details</button></a>
                                                <a href="edit_student.php?student_sno=<?php echo $show['sno']; ?>"><button class="btn btn-primary" style="margin-right:5px">Edit</button></a>

                                                <!-- <a class="btn btn-primary" onclick="return confirm('Are you sure? You Want to Delete This Product!')" href="delete_flowers.php?sno=<?php echo $show['sno']; ?>">Delete</a> -->

                                            </td>
                                        </tr>
                                <?php
                                    }
                                }

                                ?>
                            </table>
                        </div>
                    </div>
                </div>

                <?php include('include/footer.php'); ?>
            </div>
        </div>
    </div>
    <?php include('include/javascript.php'); ?>

</body>

</html>