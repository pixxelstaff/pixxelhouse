<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard - (Pending Students)</title>
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
            <h3 class=" text-center text-light">Pending Students</h3>
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
              <table id="myTable" class="teacher-table table-bordered table display data-table text-nowrap text-center my-border-primary-1">
                <thead class="bg-primary text-white">
                  <th>Sno</th>
                  <th>Student Name</th>
                  <th>Father Name</th>
                  <th>Father Email</th>
                  <th>Student Contact</th>
                  <th>Course</th>
                  <th>Date of Birth</th>
                  <th>Gender</th>
                  <th>Education</th>
                  <th>Student Email</th>
                  <th>Address</th>
                  <th>Image</th>
                  <th>Actions</th>
                </thead>
                <?php
                $show_batches = get_table_data('pending_students', $con);
                while ($row = mysqli_fetch_assoc($show_batches)) {
                  $course_id = $row['course'];
                  $show_batches2 = get_table_data2('course', $con, 'Id', $course_id);
                  while ($row2 = mysqli_fetch_assoc($show_batches2)) {
                    $course_name = $row2['course_name'];
                  }
                ?>
                  <tr>
                    <td class="vertical-align-middle"></td>
                    <td class="vertical-align-middle"><?php echo $row['student_name']; ?></td>
                    <td class="vertical-align-middle"><?php echo $row['father_name']; ?></td>
                    <td class="vertical-align-middle"><?php echo $row['father_email']; ?></td>
                    <td class="vertical-align-middle"><?php echo $row['student_contact']; ?></td>
                    <td class="vertical-align-middle"><?php echo $course_name; ?></td>
                    <td class="vertical-align-middle"><?php echo $row['date_of_birth']; ?></td>
                    <td class="vertical-align-middle"><?php echo $row['gender']; ?></td>
                    <td class="vertical-align-middle"><?php echo $row['qualification']; ?></td>
                    <td class="vertical-align-middle"><?php echo $row['email']; ?></td>
                    <td class="vertical-align-middle" style='white-space:break-spaces;'><?php echo $row['address']; ?></td>
                    <td class="vertical-align-middle"><img src="../images/<?php echo $row['image']; ?>" width='100px' height='100px'></td>
                    <td class="vertical-align-middle">

                      <a href="pending_detail.php?student_sno=<?php echo $row['sno']; ?>"><button class="btn btn-primary" style="margin-right:5px">Detail</button></a>
                      <a href="approve_student.php?student_sno=<?php echo $row['sno']; ?>&student_email=<?php echo $row['email']; ?>"><button class="btn btn-primary" style="margin-right:5px">Approve</button></a>

                      <a class="btn btn-primary" onclick="return confirm('Are you sure? You Want to Delete This Student!')" href="delete.php?pending_sno=<?php echo $row['sno']; ?>">Delete</a>

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