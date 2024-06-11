<?php
session_start();
require('../functions/function.php');
if (!isset($_SESSION['test_login'])) {
   header("location:index.php");
} else {
   if (isset($_SESSION['student_test_id'])) {
      header("location:test.php");
   }
}

?>
<!doctype html>
<html lang="en">

<head>
   <title>A-Testing System</title>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!-- fevi icon -->
   <link rel="apple-touch-icon" sizes="180x180" href="../assets/fevi/apple-touch-icon.png">
   <link rel="icon" type="image/png" sizes="32x32" href="../assets/fevi/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="16x16" href="../assets/fevi/favicon-16x16.png">
   <link rel="manifest" href="../assets/fevi/site.webmanifest">
   <link rel="mask-icon" href="../assets/fevi/safari-pinned-tab.svg" color="#5bbad5">
   <meta name="msapplication-TileColor" content="#da532c">
   <meta name="theme-color" content="#ffffff">
   <!--===============================================================================================-->
   <!-- Bootstrap CSS v5.2.1 -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   <style>
      .card-boarder {
         border: 1px solid #1176bc;
         box-shadow: 0px 0px 5px #000;
      }

      body {
         background-image: linear-gradient(to right, #2E3192, #02AABD);
      }

      /* ================  input select style ============ */

      input,
      select,
      textarea {
         border: 1px solid #1176bc !important;
         height: 45px
      }
   </style>
</head>

<body>

   <div class="d-flex w-100 align-items-center justify-content-center" style="height: 100vh;">
      <div class="col-lg-4 col-md-4"></div>
      <div class="col-lg-4 col-md-4 col-12">
         <form method="post">
            <div class="card card-boarder">
               <div class="card-body">
                  <div class="row text-center">
                     <div class="col-md-12">
                        <img src="images/logo-black.png" width="190px" alt="">
                     </div>
                  </div>
                  <div class="row p-2">
                     <div class="col-md-12">
                        <label for="" class="form-label">Batch Names/Codes</label>
                        <select class="form-select form-select-lg" name="batch_id" id="batchSelect">
                           <option value="" disabled selected>Select Batch</option>
                           <?php
                           include('../connect.php');
                           $current_date = date("d-m-y");
                           $select_batch = get_table_data2('test_batch', $con, 'on', $current_date);
                           while ($row = mysqli_fetch_assoc($select_batch)) {
                              $batch_id = $row['batch_name'];
                              $select_batch_name_qry = get_table_data2('batch', $con, 'batch_id', $batch_id);

                              while ($row2 = mysqli_fetch_assoc($select_batch_name_qry)) {
                                 $real_batch_name = $row2['batch_name'];
                                 $real_batch_code = $row2['batch_code'];
                              }
                           ?>
                              <option value="<?php echo $batch_id; ?>"><?php echo $real_batch_name . " - " . $real_batch_code; ?></option>
                           <?php
                           }
                           ?>
                        </select>
                     </div>
                  </div>
                  <div class="row p-2 pt-2">
                     <div class="col-md-12">
                        <label for="student_email" class="form-label">Student Portal Email</label>
                        <input type="email" class="form-control" name="student_email" id="student_email">
                     </div>
                  </div>
                  <div class="row p-2 pt-2">
                     <div class="col-md-12">
                        <label for="password" class="form-label">Student Test Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                     </div>
                  </div>
                  <div class="row mt-4 mb-5">
                     <div class="col-md-3"></div>
                     <div class="col-md-6">
                        <input type="submit" value="Start Test" name="start" class="btn btn-primary form-control">
                     </div>
                     <div class="col-md-3"></div>
                  </div>
               </div>
            </div>
         </form>
         <?php
         if (isset($_POST['start'])) {
            $batch_id = filter_input(INPUT_POST, 'batch_id', FILTER_VALIDATE_INT);
            $student_email = filter_input(INPUT_POST, 'student_email', FILTER_VALIDATE_EMAIL);
            $password1 = $_POST['password'];
            $password = mysqli_real_escape_string($con, $password1);

            $select_student = "SELECT * FROM `students` WHERE `portal_email`='$student_email' AND `test_password`='$password'";
            $select_student_qry = mysqli_query($con, $select_student);
            if (mysqli_num_rows($select_student_qry) > 0) {
               if ($batch_id && $student_email) {

                  $test_topic_qry = get_table_data2('test_batch', $con, 'batch_name', $batch_id);
                  $row = mysqli_fetch_assoc($test_topic_qry);
                  $test_topic = $row['test_topic'];
                  $total_questions = $row['total_questions'];

                  $insert_data = "INSERT INTO `students_test`(`students_id`, `batch_id`,`topic`) VALUES ('$student_email', '$batch_id','$test_topic')";
                  $insert_result = mysqli_query($con, $insert_data);

                  if ($insert_result) {

                     $_SESSION['student_test_id'] = $student_email;
                     $_SESSION['student_test_batch'] = $batch_id;

                     $select_questions = "SELECT sno FROM `questions` WHERE `topic`='$test_topic' ORDER BY RAND() LIMIT $total_questions";

                     $select_questions_qry = mysqli_query($con, $select_questions);
                     $user_questions = mysqli_fetch_all($select_questions_qry, MYSQLI_ASSOC);
                     $_SESSION['questions'] = array_column($user_questions, 'sno');

                     header('Location: test.php');
                  }
               }
            } else {

               $error_message = 'Select the correct values!';
               header("Location: alert.php?icon=error&message=$error_message&location=index.php");
               exit;
            }
         }

         ?>
      </div>
      <div class="col-lg-4 col-md-4"></div>
   </div>

   <!-- Bootstrap JavaScript Libraries -->
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
   </script>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
   </script>


</body>

</html>
?>
<!doctype html>
<html lang="en">

<head>
   <title>A-Testing System</title>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!-- fevi icon -->
   <link rel="apple-touch-icon" sizes="180x180" href="../assets/fevi/apple-touch-icon.png">
   <link rel="icon" type="image/png" sizes="32x32" href="../assets/fevi/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="16x16" href="../assets/fevi/favicon-16x16.png">
   <link rel="manifest" href="../assets/fevi/site.webmanifest">
   <link rel="mask-icon" href="../assets/fevi/safari-pinned-tab.svg" color="#5bbad5">
   <meta name="msapplication-TileColor" content="#da532c">
   <meta name="theme-color" content="#ffffff">
   <!--===============================================================================================-->
   <!-- Bootstrap CSS v5.2.1 -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   <style>
      .card-boarder {
         border: 1px solid #1176bc;
         box-shadow: 0px 0px 5px #000;
      }

      body {
         background-image: linear-gradient(to right, #2E3192, #02AABD);
      }

      /* ================  input select style ============ */

      input,
      select,
      textarea {
         border: 1px solid #1176bc !important;
         height: 45px
      }
   </style>
</head>

<body>

   <div class="d-flex w-100 align-items-center justify-content-center" style="height: 100vh;">
      <div class="col-lg-4 col-md-4"></div>
      <div class="col-lg-4 col-md-4 col-12">
         <form method="post">
            <div class="card card-boarder">
               <div class="card-body">
                  <div class="row text-center">
                     <div class="col-md-12">
                        <img src="images/logo-black.png" width="190px" alt="">
                     </div>
                  </div>
                  <div class="row p-2">
                     <div class="col-md-12">
                        <label for="" class="form-label">Batch Names/Codes</label>
                        <select class="form-select form-select-lg" name="batch_id" id="batchSelect">
                           <option value="" disabled selected>Select Batch</option>
                           <?php
                           include('../connect.php');
                           $current_date = date("d-m-y");
                           $select_batch = get_table_data2('test_batch', $con, 'on', $current_date);
                           while ($row = mysqli_fetch_assoc($select_batch)) {
                              $batch_id = $row['batch_name'];
                              $select_batch_name_qry = get_table_data2('batch', $con, 'batch_id', $batch_id);

                              while ($row2 = mysqli_fetch_assoc($select_batch_name_qry)) {
                                 $real_batch_name = $row2['batch_name'];
                                 $real_batch_code = $row2['batch_code'];
                              }
                           ?>
                              <option value="<?php echo $batch_id; ?>"><?php echo $real_batch_name . " - " . $real_batch_code; ?></option>
                           <?php
                           }
                           ?>
                        </select>
                     </div>
                  </div>
                  <div class="row p-2 pt-2">
                     <div class="col-md-12">
                        <label for="student_email" class="form-label">Student Portal Email</label>
                        <input type="email" class="form-control" name="student_email" id="student_email">
                     </div>
                  </div>
                  <div class="row p-2 pt-2">
                     <div class="col-md-12">
                        <label for="password" class="form-label">Student Test Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                     </div>
                  </div>
                  <div class="row mt-4 mb-5">
                     <div class="col-md-3"></div>
                     <div class="col-md-6">
                        <input type="submit" value="Start Test" name="start" class="btn btn-primary form-control">
                     </div>
                     <div class="col-md-3"></div>
                  </div>
               </div>
            </div>
         </form>
         <?php
         if (isset($_POST['start'])) {
          $batch_id = filter_input(INPUT_POST, 'batch_id', FILTER_VALIDATE_INT);
            $student_email = filter_input(INPUT_POST, 'student_email', FILTER_VALIDATE_EMAIL);
            $password1 = $_POST['password'];
            $password = mysqli_real_escape_string($con, $password1);

            $select_student = "SELECT * FROM `students` WHERE `portal_email`='$student_email' AND `test_password`='$password'";
            $select_student_qry = mysqli_query($con, $select_student);
            if (mysqli_num_rows($select_student_qry) > 0) {
               if ($batch_id && $student_email) {

                  $test_topic_qry = get_table_data2('test_batch', $con, 'batch_name', $batch_id);
                  $row = mysqli_fetch_assoc($test_topic_qry);
                  $test_topic = $row['test_topic'];
                  $total_questions = $row['total_questions'];

                  $insert_data = "INSERT INTO `students_test`(`students_id`, `batch_id`,`topic`) VALUES ('$student_email', '$batch_id','$test_topic')";
                  $insert_result = mysqli_query($con, $insert_data);

                  if ($insert_result) {

                     $_SESSION['student_test_id'] = $student_email;
                     $_SESSION['student_test_batch'] = $batch_id;

                     $select_questions = "SELECT sno FROM `questions` WHERE `topic`='$test_topic' ORDER BY RAND() LIMIT $total_questions";

                     $select_questions_qry = mysqli_query($con, $select_questions);
                     $user_questions = mysqli_fetch_all($select_questions_qry, MYSQLI_ASSOC);
                     $_SESSION['questions'] = array_column($user_questions, 'sno');

                     header('Location: test.php');
                  }
               }
            } else {

               $error_message = 'Select the correct values!';
               header("Location: alert.php?icon=error&message=$error_message&location=index.php");
               exit;
            }
         }

         ?>
      </div>
      <div class="col-lg-4 col-md-4"></div>
   </div>

   <!-- Bootstrap JavaScript Libraries -->
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
   </script>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
   </script>


</body>

</html>