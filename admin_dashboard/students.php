<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard - (Students)</title>
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
            <h3 class=" text-center text-light">All Students</h3>
          </div>
        </div>
        <div class="card my-border-primary-1 my-border-bottom-1">
          <div class="card-body table-body">
            <div class="row mt-2">
              <div class="col-md-4">
                <div class="form-group">

                  <label for="">Quick Search</label>
                  <input type="text" id="searchInput" placeholder="Search" title="Type in a name" class="form-control">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Select Filter</label>
                  <select class="form-select" id="select">
                    <option value="student_name" selected>Student Name</option>
                    <option value="email">Student Email</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Select Batch</label>
                  <?php
                  if (isset($_GET['slot'])) {
                    if ($_GET['slot'] == "tts") {

                      $select_batch = "SELECT * FROM `batch` WHERE `batch_slot`='TTS'";
                    } else {

                      $select_batch = "SELECT * FROM `batch` WHERE `batch_slot`='TTS'";
                    }
                  } else {
                    $select_batch = "SELECT * FROM `batch`";
                  }

                  ?>
                  <select class="form-select" id="batch_select">
                    <option value="">Select Batch</option>
                    <?php
                    $select_batch_qry = mysqli_query($con, $select_batch);
                    while ($row = mysqli_fetch_assoc($select_batch_qry)) {
                    ?>
                      <option value="<?php echo $row['batch_id'] ?>"><?php echo $row['batch_name'] ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="table-responsive main-table mt-4" style="height:400px;">
              <table id="myTable" class="teacher-table table-bordered table display data-table text-nowrap text-center my-border-primary-1">
                <thead class="bg-primary text-white">
                  <th>Sno</th>
                  <th>Student Name</th>
                  <th>Father Name</th>
                  <th>Student Contact</th>
                  <th>Student Email</th>
                  <th>Batch Name</th>
                  <th>Batch Slot</th>
                  <th>Batch Code</th>
                  <th>Batch Time</th>
                  <th>Date of Birth</th>
                  <th>Gender</th>
                  <th>Education</th>
                  <th>Address</th>
                  <th>Image</th>
                  <th>Actions</th>
                </thead>
                <tr>
                  <!-- dynamic data through ajax -->
                </tr>
              </table>

            </div>
          </div>
        </div>
        <?php include('include/footer.php'); ?>
      </div>
    </div>
  </div>
  <?php include('include/javascript.php'); ?>
  <script>
    $(document).ready(function() {
      // Function to fetch data through AJAX and populate the table
      function fetchData(searchQuery = "", selectQuery, batchQuery) {
        <?php
        if (isset($_GET['slot'])) {
        ?>
          var day_slot = <?php echo $_GET['slot']; ?>;
        <?php
        } else {
        ?>
          var day_slot = '';
        <?php
        }
        ?>
        $.ajax({
          url: 'ajax/students_ajax.php', // Replace with your PHP script URL
          method: 'GET',
          data: {
            search: searchQuery,
            select: selectQuery,
            batch: batchQuery,
            days: day_slot
          }, // Pass search query to PHP script
          dataType: 'json',
          success: function(data) {
            const tableBody = $('#myTable tbody');
            tableBody.empty();

            $.each(data, function(index, item) {


              const row = $('<tr>');
              row.append(`
              <td class='vertical-align-middle'></td>
              <td class='vertical-align-middle'>${item.student_name}</td>
              <td class='vertical-align-middle'>${item.father_name}</td>
              <td class='vertical-align-middle'>${item.student_contact}</td>
              <td class='vertical-align-middle'>${item.email}</td>
              <td class='vertical-align-middle'>${item.batch_name}</td>
              <td class='vertical-align-middle'>${item.batch_codes}</td>
              <td class='vertical-align-middle'>${item.batch_times}</td>
              <td class='vertical-align-middle'>${item.batch_days}</td>
              <td class='vertical-align-middle'>${item.date_of_birth}</td>
              <td class='vertical-align-middle'>${item.gender}</td>
              <td class='vertical-align-middle'>${item.qualification}</td>
              <td style='white-space: break-spaces;vertical-align:middle;'><label style='width:150px'>${item.address}</label></td>
              <td><img src="../images/${item.student_image}" class="img img-fluid"></td>
              <td class='vertical-align-middle'>
              <a href="student_details.php?student_sno=${item.sno}"><button class="btn btn-primary" style="margin-right:5px">Detail</button></a>
                        <a href="edit_student.php?student_sno=${item.sno}"><button class="btn btn-primary" style="margin-right:5px">Edit</button></a>
                        <a class="btn btn-dark" onclick="return confirm('Are you sure? You Want to Delete This Student!')" href="delete.php?student_sno=${item.sno}">Delete</a>
                        <a class="btn btn-dark" onclick="return confirm('Are you sure? You Want to Left this Student!')" href="query/left_query.php?left_student_sno=${item.sno}">Left Student</a>
              </td>
              </tr>`);
              tableBody.append(row);
            });
          },
          error: function(xhr, status, error) {
            console.error('Error: ' + error);
          }
        });
      }

      function displayVals() {
        var selectQuery = $("#select").val();
        var singleValues = $("#batch_select").val();
        var searchQuery = $("#searchInput").val();
        fetchData(searchQuery, selectQuery, singleValues);
      }
      $("#batch_select").on("change", displayVals);
      $("#searchInput").on("keyup", displayVals);
      displayVals();
      fetchData();
    });
  </script>
</body>

</html>