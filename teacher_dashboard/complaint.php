<?php
session_start();
if(isset($_SESSION['teacher_id'])){
include('../connect.php');
include('../functions/function.php');
$teacher_session = $_SESSION['portal_email'];
$teacher_sno = $_SESSION['teacher_id'];
$teacher_batch_ids_arr = [];
$teacher_details = get_table_data2('teacher', $con, 'portal_email', $teacher_session);
while ($teacher = mysqli_fetch_assoc($teacher_details)) {
  $teacher_name_get_session = $teacher['teacher_name'];
  $teacher_image = $teacher['teacher_image'];
}
$teacher_batch_details = get_table_data2('batch', $con, 'teacher', $teacher_sno);
while ($teacher2 = mysqli_fetch_assoc($teacher_batch_details)) {
  $teacher_batch_id = $teacher2['batch_id'];
  $teacher_batch_ids_arr[] = $teacher2['batch_id'];
}
}else{
    header("location:index.php");
}

// $select = "SELECT * FROM `query` WHERE `batch` IN ('9, 10, 18, 30','31') AND `message_status` != 'Admin'";
$batch_str_ids =  implode(',', $teacher_batch_ids_arr);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teacher Dashboard -(Batches)</title>
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
                        <h3 class=" text-center text-light">Complaints</h3>
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
                                    $thead_array = ['Sno', 'Name', 'Email','Batch','Subject', 'Message Description','Date','action'];
                                    foreach ($thead_array as $key => $value) {
                                    ?>
                                        <th><?php echo $value; ?></th>
                                    <?php
                                    }
                                    ?>
                                </thead>
                                <?php
                                $show_complain_qry = "SELECT * FROM `query` WHERE `batch` IN ('$batch_str_ids') AND `message_status` != 'Admin'";
                                $show_complain=mysqli_query($con,$show_complain_qry);
                                while ($row = mysqli_fetch_assoc($show_complain)) {
                                ?>
                                    <tr>
                                        <td class="vertical-align-middle"></td>
                                        <td class="vertical-align-middle"><?php  echo $row['name'] ?></td>
                                        <td class="vertical-align-middle"><?php  echo $row['email'] ?></td>
                                        <td class="vertical-align-middle"><?php  echo $row['batch'] ?></td>
                                        <td class="vertical-align-middle"><?php  echo $row['subject'] ?></td>
                                        <td class="vertical-align-middle"><?php  echo $row['msg'] ?></td>
                                        <td class="vertical-align-middle"><?php  echo $row['date'] ?></td>
                                        <td class="vertical-align-middle"> <button view-id='<?php  echo $row['date'] ?>' class="btn btn-primary">view</button> </td>
                                        
                                        
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