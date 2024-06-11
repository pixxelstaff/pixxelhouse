<?php
session_start();
if(isset($_SESSION['teacher_id'])){
include('../connect.php');
include('../functions/function.php');
$teacher_session = $_SESSION['portal_email'];
$teacher_sno = $_SESSION['teacher_id'];
$teacher_details = get_table_data2('teacher', $con, 'portal_email', $teacher_session);
while ($teacher = mysqli_fetch_assoc($teacher_details)) {
  $teacher_name_get_session = $teacher['teacher_name'];
  $teacher_image = $teacher['teacher_image'];
}
$teacher_batch_details = get_table_data2('batch', $con, 'teacher', $teacher_sno);
while ($teacher2 = mysqli_fetch_assoc($teacher_batch_details)) {
  $teacher_batch_id = $teacher2['batch_id'];
}
}else{
    header("location:index.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - (batch Detail)</title>
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
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <input onclick="history.back()" type="button" value="Back" class="btn btn-primary">
                            </div>
                        </div>
                        <!-- ======= details ======== -->
                        <div class="card card-shadow-ph my-detail-card">
                            <div class="card-body">
                                <?php
                                $get_batch_sno = $_GET['batch_sno'];
                                $table_detail = get_table_data2('batch', $con, 'batch_id', $get_batch_sno);
                                
                                while ($row = mysqli_fetch_assoc($table_detail)) {
                                    $batch_sno = $row['batch_id'];
                                    $batch_name = $row['batch_name'];
                                    $batch_code = $row['batch_code'];
                                    $batch_teacher = $row['teacher'];
                                    $course_id = $row['course_id'];
                                    $batch_duration = $row['course_duration'];
                                    $lab_number = $row['lab_number'];
                                    $slot = $row['batch_slot'];
                                    $date_of_start = $row['date_of_start'];
                                }
                                $show_teacher_name = get_table_data2('teacher', $con, 'teacher_id', $batch_teacher);
                                $call_teacher_name = mysqli_fetch_assoc($show_teacher_name)['teacher_name'];
                                $show_course_name = get_table_data2('course', $con, 'Id', $course_id);
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
                                                <label>Course Name:</label>
                                            </div>
                                            <div class="col-md-6"><label><?php echo $call_course_name ?></label></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6 text-bold-ph">
                                                <label>Lab Number:</label>
                                            </div>
                                            <div class="col-md-6"><label><?php echo '0' . $lab_number ?></label></div>
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
                                                <label>Duration:</label>
                                            </div>
                                            <div class="col-md-6"><label><?php echo $batch_duration . " " . "Months" ?></label></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6 text-bold-ph">
                                                <label>Start Date:</label>
                                            </div>
                                            <div class="col-md-6"><label><?php echo $date_of_start ?></label></div>
                                        </div>
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
                            <table id="myTable" class="teacher-table table-bordered table data-table text-nowrap text-center my-border-primary-1">
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
                                $show_batches = get_table_data('students', $con);
                                while ($row = mysqli_fetch_assoc($show_batches)) {
                                    $batch_id=$row['batch'];
                                    $batch_array_id=explode(',',$batch_id);
                                    if(in_array($get_batch_sno,$batch_array_id)){
                                ?>

                                    <tr>
                                        <td></td>
                                        <td><?php echo $row['student_name'] ?></td>
                                        <td><?php echo $row['father_name'] ?></td>
                                        <td><?php echo $row['student_contact'] ?></td>
                                        <td><?php echo $row['date_of_birth'] ?></td>
                                        <td><?php echo $row['gender'] ?></td>
                                        <td><?php echo $row['qualification'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td><?php echo $row['address'] ?></td>
                                        <td><img src="../images/<?php echo $row['student_image'] ?>" class="img img-fluid"></td>
                                        <td>

                                            <a href="student_attendance.php?student_sno=<?php echo $row['sno']; ?>"><button class="btn btn-primary" style="margin-right:5px">Detail</button></a>
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
                <script>
                    function myFunction() {
                        var input, filter, table, tr, td, i, txtValue;
                        input = document.getElementById("myInput");
                        filter = input.value.toUpperCase();
                        table = document.getElementById("myTable");
                        tr = table.getElementsByTagName("tr");
                        for (i = 0; i < tr.length; i++) {
                            td = tr[i].getElementsByTagName("td")[2];
                            if (td) {
                                txtValue = td.textContent || td.innerText;
                                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                    tr[i].style.display = "";
                                } else {
                                    tr[i].style.display = "none";
                                }
                            }
                        }
                    }
                </script>
                <?php include('include/footer.php'); ?>
            </div>
        </div>
    </div>
    <?php include('include/javascript.php'); ?>

</body>

</html>