<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - (Teachers)</title>
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
                        <h3 class=" text-center text-light">All Teachers</h3>
                    </div>
                </div>
                <div class="card my-border-primary-1 my-border-bottom-1">
                    <div class="card-body table-body">
                        <div class="row mt-2">
                            <div class="col-md-12 d-flex align-items-center">
                                <label class="w-25">Quick Search</label>

                                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name" class="form-control">
                            </div>
                        </div>
                        <div class="table-responsive main-table mt-4 ">
                            <table id="myTable" class="teacher-table table-bordered table display data-table text-nowrap text-center my-border-primary-1">
                                <thead class="bg-primary text-white">
                                    <th>Sno</th>
                                    <th>Teacher Name</th>
                                    <th>Teacher Email</th>
                                    <th>Teacher Contact</th>
                                    <th>Gender</th>
                                    <th>Teacher CNIC</th>
                                    <th>Qualification</th>
                                    <th>Experience</th>
                                    <th>Address</th>
                                    <th>Portal Email</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </thead>
                                <?php
                                $show_teacher = get_table_data('teacher', $con);
                                while ($row = mysqli_fetch_assoc($show_teacher)) {
                                    $check_sno = $row['teacher_id'];
                                ?>

                                    <tr>
                                        <td></td>
                                        <td><?php echo $row['teacher_name'] ?></td>
                                        <td><?php echo $row['teacher_email'] ?></td>
                                        <td><?php echo $row['teacher_contact'] ?></td>
                                        <td><?php echo $row['gender'] ?></td>
                                        <td><?php echo $row['cnic'] ?></td>
                                        <td><?php echo $row['quli'] ?></td>
                                        <td><?php echo $row['exper'] ?></td>
                                        <td><label style="white-space: break-spaces;height:25px;overflow:hidden;"><?php echo $row['address'] ?></label></td>
                                        <td><?php echo $row['portal_email'] ?></td>
                                        <td><img src="../images/<?php echo $row['teacher_image'] ?>" class="img img-fluid"></td>
                                        <td>

                                            <a href="teacher_detail.php?teacher_sno=<?php echo $row['teacher_id']; ?>"><button class="btn btn-primary" style="margin-right:5px">Detail</button></a>
                                            <a href="edit_teacher.php?teacher_sno=<?php echo $row['teacher_id']; ?>"><button class="btn btn-primary" style="margin-right:5px">Edit</button></a>



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