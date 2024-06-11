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

                <div class="card bg-primary">
                    <div class="card-body">
                        <h3 class="text-center text-light">Teacher Detail</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Teacher Name:</label>
                                            </div>
                                            <div class="col-md-6"><?php echo $teacher_name; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Teacher Email:</label>
                                            </div>
                                            <div class="col-md-6"><?php echo $teacher_email; ?></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Teacher Contact:</label>
                                            </div>
                                            <div class="col-md-6"><?php echo $teacher_contact; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Teacher CNIC:</label>
                                            </div>
                                            <div class="col-md-6"><?php echo $cnic; ?></div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Gender:</label>
                                            </div>
                                            <div class="col-md-6"><?php echo $gender; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Qualification:</label>
                                            </div>
                                            <div class="col-md-6"><?php echo $quli; ?></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Experience:</label>
                                            </div>
                                            <div class="col-md-6"><?php echo $exper; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Portal Email:</label>
                                            </div>
                                            <div class="col-md-6"><?php echo $portal_email; ?></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">Address:</label>
                                            </div>
                                            <div class="col-md-9 text-left"><?php echo $address; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="card card-shadow-ph text-center">
                            <div class="card-header bg-primary">
                                <h5 class="text-bg-primary">Profile Image</h5>
                            </div>
                            <div class="card-body">
                                <img src="../images/<?php echo $image ?>" width="180px" class="img img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card bg-primary">
                    <div class="card-body">
                        <h3 class="text-center text-light">Teacher Batches</h3>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body table-responsive p-0 m-0">
                       
                    <table class="teacher-table table-bordered table display data-table text-nowrap text-center my-border-primary-1">
                        <thead class="text-bg-primary">
                            <tr>
                                <th>Batch Id</th>
                                <th>Batch Name</th>
                                <th>Batch Code</th>
                                <th>Batch Slot</th>
                                <th>Batch Time</th>
                                <th>Course Duration</th>
                                <th>Date Of start</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $teacher_batch = get_table_data2('batch', $con, 'teacher', $get_teacher_sno);
                            while ($batch = mysqli_fetch_assoc($teacher_batch)) {
                            ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $batch['batch_name']; ?></td>
                                    <td><?php echo $batch['batch_code']; ?></td>
                                    <td><?php echo $batch['batch_slot']; ?></td>
                                    <td><?php echo $batch['time']; ?></td>
                                    <td><?php echo $batch['course_duration']." Months"; ?></td>
                                    <td><?php echo $batch['date_of_start']; ?></td>
                                    <td>

                                        <a href="view_batch.php?batch_sno=<?php echo $batch['batch_id']; ?>"><button class="btn btn-primary" style="margin-right:5px">Detail</button></a>
                                        <a href="edit_batch.php?batch_sno=<?php echo $batch['batch_id']; ?>"><button class="btn btn-primary" style="margin-right:5px">Edit</button></a>

                                        <a class="btn btn-primary" onclick="return confirm('Are you sure? You Want to Delete This Product!')" href="delete_batch.php?sno=<?php echo $row['sno']; ?>">Delete</a>

                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                </div>

                <?php include('include/footer.php'); ?>
            </div>
        </div>
    </div>
    <?php include('include/javascript.php'); ?>
</body>

</html>