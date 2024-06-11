<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - (Teacher Portal)</title>
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
                        <h3 class=" text-center text-light">Portal Teacher</h3>
                    </div>
                </div>
                <div class="card my-border-primary-1 my-border-bottom-1">
                    <div class="card-body table-body">
                        <!-- row -->
                        <div class="row">
                            <div class="col-md-9"></div>
                            <div class="col-md-3">
                                <!-- <a href="assing_portal.php"><button type="button" class="btn btn-primary form-control"><i class="fa fa-plus"></i> Add Teacher Portal</button></a> -->
                            </div>
                        </div>
                        <!-- row -->
                        <div class="row mt-3">
                            <div class="col-md-12 d-flex align-items-center">
                                <label class="w-25">Quick Search</label>

                                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name" class="form-control">
                            </div>
                        </div>
                        <div class="table-responsive main-table mt-4">
                            <table id="myTable" class="teacher-table table-bordered table display data-table text-nowrap text-center my-border-primary-1">
                                <thead class="bg-primary text-white">
                                    <th>Sno</th>
                                    <th>Teacher Name</th>
                                    <th>Teacher CNIC</th>
                                    <th>Email</th>
                                    <th>Teacher contact</th>
                                    <th>Portal Email</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </thead>
                                <?php
                                $show_batches = get_table_data('teacher', $con);
                                while ($row = mysqli_fetch_assoc($show_batches)) {
                                ?>
                                    <tr>
                                        <td></td>
                                        <td><?php echo $row['teacher_name'] ?></td>
                                        <td><?php echo $row['cnic'] ?></td>
                                        <td><?php echo $row['teacher_email'] ?></td>
                                        <td><?php echo $row['teacher_contact'] ?></td>
                                        <td><?php echo $row['portal_email'] ?></td>
                                        <td><img src="../images/<?php echo $row['teacher_image'] ?>" class="img img-fluid"></td>
                                        <td>

                                            <a href="edit_teacher_portal.php?teacher_sno=<?php echo $row['teacher_id']; ?>"><button class="btn btn-primary" style="margin-right:5px">Edit</button></a>

                                            <a class="btn btn-primary" onclick="return confirm('Are you sure? You Want to Delete This Teacher!')" href="detele_student.php?sno=<?php echo $row['teacher_id']; ?>">Delete</a>

                                        </td>
                                    </tr>
                                <?php
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