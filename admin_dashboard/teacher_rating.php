<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard -(Teacher Rating)</title>
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
                        <h3 class=" text-center text-light">Teacher Rating</h3>
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
                        <div class="table-responsive main-table mt-4">
                            <table id="myTable" class="teacher-table table-bordered table data-table text-nowrap text-center my-border-primary-1">
                                <thead class="bg-primary text-white">
                                    <?php
                                    $thead_array = ['Sno', 'Name', 'Email', 'Teacher Name', 'Description', 'Rating', 'Date'];
                                    foreach ($thead_array as $key => $value) {
                                    ?>
                                        <th><?php echo $value; ?></th>
                                    <?php
                                    }
                                    ?>
                                </thead>
                                <?php
                                $rating = "SELECT * FROM `rating` ORDER BY `rating`.`date` Desc";
                                $rating_res = mysqli_query($con, $rating);
                                while ($row = mysqli_fetch_assoc($rating_res)) {
                                    $teacher_id = $row['teacher_name'];
                                    $teacher_name = "SELECT * FROM `teacher` WHERE `teacher_id`='$teacher_id'";
                                    $teacher_name_qry = mysqli_query($con, $teacher_name);
                                    $show_teacher_name = mysqli_fetch_assoc($teacher_name_qry)['teacher_name'];
                                ?>
                                    <tr>
                                        <td class="vertical-align-middle"></td>
                                        <td class="vertical-align-middle"><?php echo $row['name'] ?></td>
                                        <td class="vertical-align-middle"><?php echo $row['email'] ?></td>
                                        <td class="vertical-align-middle"><?php echo $show_teacher_name; ?></td>
                                        <td class="vertical-align-middle" style='white-space: break-spaces;'><?php echo $row['review'] ?></td>
                                        <td class="vertical-align-middle"><?php echo $row['rating']; ?></td>
                                        <td class="vertical-align-middle"><?php echo $row['date'] ?></td>

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