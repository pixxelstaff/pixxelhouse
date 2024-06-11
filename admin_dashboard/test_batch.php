<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard - (Test)</title>
  <?php include('include/links.php');
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  ?>
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
        <div class="card bg-primary">
          <div class="card-body">
            <h3 class=" text-center text-light">Test Batch</h3>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card card-shadow-ph">
              <div class="card-body">
                <form method="post">
                  <div class="row align-items-center">

                    <div class="col-md-4">
                      <label for="batch_name" class="form-label">Batch Name<span class="text-danger">*</span></label>
                      <select class="form-select" name="batch_name" id="batch_select" required>
                        <option value="">Batch Name</option>
                        <?php
                        $course = get_table_data('batch', $con);
                        while ($row = mysqli_fetch_assoc($course)) {
                        ?>
                          <option value="<?php echo $row['batch_id'] ?>"><?php echo $row['batch_name'] . "-" . $row['batch_code'] ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label for="test_topic" class="form-label">Test Topic<span class="text-danger">*</span></label>
                      <select class="form-select" name="test_topic" id="test_topic" required>
                        <option value="">Test Topic</option>
                        <?php
                        $course = get_table_data('test_topic', $con);
                        while ($row = mysqli_fetch_assoc($course)) {
                        ?>
                          <option value="<?php echo $row['sno'] ?>"><?php echo $row['topic_name'] ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label for="questions" class="form-label">Total Question<span class="text-danger">*</span></label>
                      <input type="number" placeholder="Questions" min="0" name="questions" id="questions" class="form-control">
                    </div>
                  </div>
                  <div class="row align-items-center mt-3">
                    <h4 class="text-primary">Time Limit</h4>
                  </div>
                  <div class="row align-items-center">
                    <div class="col-md-6">
                      <label for="hours" class="form-label">Hours<span class="text-danger">*</span></label>
                      <input type="number" placeholder="Hours" min="0" name="hours" id="hours" class="form-control">
                    </div>
                    <div class="col-md-6">
                      <label for="minutes" class="form-label">Minutes<span class="text-danger">*</span></label>
                      <input type="number" placeholder="Minutes" min="0" name="minutes" id="minutes" class="form-control" required>
                    </div>

                  </div>
                  <div class="row">
                    <div class="table-responsive main-table mt-4" style="height:400px;">
                      <table id="myTable" class="teacher-table table-bordered table display data-table text-nowrap text-center my-border-primary-1">
                        <thead class="bg-primary text-white">
                          <th>Sno</th>
                          <th>Student Name</th>
                          <th>Father Name</th>
                          <th>Student Contact</th>
                          <th>Portal Email</th>
                          <th>Test Password</th>
                        </thead>
                        <tr>
                          <!-- dynamic data through ajax -->
                        </tr>
                      </table>

                    </div>
                  </div>
                  <div class="row mt-4">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                      <input type="submit" name="add_btn" value="Start Test" class="btn btn-primary form-control">
                    </div>
                    <div class="col-md-4"></div>
                  </div>
                </form>
                <?php
                if (isset($_POST['add_btn'])) {
                  $batch_name = $_POST['batch_name'];
                  $test_topic = $_POST['test_topic'];
                  $questions = $_POST['questions'];
                  $hours = $_POST['hours'];
                  $minutes = $_POST['minutes'];

                  $student_test_passes = $_POST['student_test_pass'];
                  $student_ids = $_POST['std_id'];
                  $std_email = $_POST['std_email'];

                  $select_query = "SELECT * FROM `test_batch` WHERE `batch_name` = ?";
                  $stmt = mysqli_prepare($con, $select_query);
                  mysqli_stmt_bind_param($stmt, "i", $batch_name);
                  mysqli_stmt_execute($stmt);
                  $result = mysqli_stmt_get_result($stmt);
                  $current_date = date("d-m-y");

                  $update_success = false;

                  if (mysqli_num_rows($result) > 0) {
                    $update_query = "UPDATE `test_batch` SET `on`='$current_date',`total_questions`=?, `test_topic`=?, `hours`=?, `minutes`=? WHERE `batch_name`=?";
                    $stmt = mysqli_prepare($con, $update_query);
                    mysqli_stmt_bind_param($stmt, "iiiii", $questions, $test_topic, $hours, $minutes, $batch_name);
                    $update_success = mysqli_stmt_execute($stmt);
                  } else {
                    $insert_query = "INSERT INTO `test_batch`(`batch_name`, `on`,`total_questions`, `test_topic`, `hours`, `minutes`) VALUES (?,$current_date,?,?, ?, ?)";
                    $stmt = mysqli_prepare($con, $insert_query);
                    mysqli_stmt_bind_param($stmt, "iiiii", $batch_name, $questions, $test_topic, $hours, $minutes);
                    $update_success = mysqli_stmt_execute($stmt);
                  }

                  if ($update_success) {
                    $test_batch_id = mysqli_insert_id($con); // Get the ID of the last inserted test batch (assuming you have inserted it previously)
                    foreach ($student_test_passes as $key => $password) {
                      $std_id = $student_ids[$key];
                      $student_email = $std_email[$key];

                      // Update student password in the database
                      $update_student_password_query = "UPDATE `students` SET `test_password`=? WHERE `sno`=?";
                      $stmt = mysqli_prepare($con, $update_student_password_query);
                      mysqli_stmt_bind_param($stmt, "ss", $password, $std_id);

                      if (!mysqli_stmt_execute($stmt)) {
                        die("Error updating student password: " . mysqli_error($con));
                      } else {

                        $to = $student_email;
                        $subject = "Your Portal Created!";
                        $host_email = 'pixxel@prepwings.com';
                        $head = "From: $host_email" . "\r\n";
                        $head .= "Reply-To: $host_email" . "\r\n";
                        $head .= implode("\r\n", [
                          "MIME-Version: 1.0",
                          "Content-type: text/html; charset=utf-8"
                        ]);
                        ob_start();
                        $html = "<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<style type='text/css'>
/* CSS styles go here */
body {
background-color: #f2f2f2;
font-family: Arial, sans-serif;
font-size: 14px;
line-height: 1.5;
color: #333333;
margin: 0;
padding: 0;
}
.container {
max-width: 600px;
margin: 0 auto;
padding: 20px;
}
h1 {
font-size: 28px;
margin-bottom: 20px;
text-align: center;
}
p {
margin-bottom: 20px;
}
.button {
display: inline-block;
background-color: #007bff;
color: #ffffff;
text-decoration: none;
padding: 10px 20px;
border-radius: 5px;
margin-bottom: 20px;
}
.button:hover {
background-color: #0056b3;
}
</style>
</head>
<body>
<div class='container'>
<img src='http://pixxel.prepwings.com/images/logo-black2.png' width='100%'>

<p>Dear $student_email,</p>
<p>We value your presence as a student at Institute of Pixxel House and are dedicated to ensuring the security and privacy of your account. Please find your login details below:</p>
<p>Your email is the same as the Portal Email that we provided when creating your portal.<br>
Password: $password</p>
<p>These credentials are used for class test system. We urge you to keep them confidential.</p>
<p>**Important Security Information:**</p>
<ol>
<li>Do not share your email and password with anyone, including fellow students.</li>
<li>If you didn't sign up for Institute of Pixxel House, please disregard this email and contact us immediately at pixxel.staff@gmail.com </li>
</ol>
<p>Best Of luck for your test,<br>
Team Pixxel House<br>
Institute of Pixxel House<br>
</div>
</body>
</html>

";

                        ob_end_clean();
                        $mailresult = mail($to, $subject, $html, $head);
                      }
                    }
                ?>
                    <script>
                      window.location = "alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'Test Status Of batch On!' ?>&location=<?php echo 'test_batch.php' ?>";
                    </script>
                  <?php
                  } else {
                  ?>
                    <script>
                      window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Something Went Wrong!' ?>&location=<?php echo 'test_batch.php' ?>";
                    </script>
                <?php
                  }
                }
                ?>

              </div>
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
      function fetchData(batchQuery) {
        $.ajax({
          url: 'ajax/test_students_ajax.php', // Replace with your PHP script URL
          method: 'GET',
          data: {
            batch: batchQuery
          }, // Pass search query to PHP script
          dataType: 'json',
          success: function(data) {
            const tableBody = $('#myTable tbody');
            tableBody.empty();

            $.each(data, function(index, item) {
              const row = $('<tr>');
              row.append(`
            <td class='vertical-align-middle'><input type='hidden' value='${item.sno}' name='std_id[]'><input type='hidden' value='${item.student_email}' name='std_email[]'></td>
            <td class='vertical-align-middle'>${item.student_name}</td>
            <td class='vertical-align-middle'>${item.father_name}</td>
            <td class='vertical-align-middle'>${item.student_contact}</td>
            <td class='vertical-align-middle'>${item.portal_email}</td>
            <td class='vertical-align-middle'><input type='number' value='${item.password}' name='student_test_pass[]' class='form-control'></td>
          `);
              tableBody.append(row);
            });
          },
          error: function(xhr, status, error) {
            console.error('Error: ' + error);
          }
        });
      }

      $("#batch_select").on("change", function() {
        var batch_val = $(this).val();
        fetchData(batch_val);
      });

      // Remove or provide a default batch value depending on your needs
      // fetchData(); // You might want to remove this line
    });
  </script>



</body>

</html>