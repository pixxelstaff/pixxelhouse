<?php
session_start();
include('../connect.php');

if (!isset($_SESSION['student_test_id'])) {
   header('location:index.php');
} elseif (isset($_SESSION['student_result'])) {
   header('location:result.php');
}
$question_ids = $_SESSION['questions'];
include('ajax/select_students.php');

?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pixxel Test</title>
   <!-- fevi icon -->
   <link rel="apple-touch-icon" sizes="180x180" href="../assets/fevi/apple-touch-icon.png">
   <link rel="icon" type="image/png" sizes="32x32" href="../assets/fevi/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="16x16" href="../assets/fevi/favicon-16x16.png">
   <link rel="manifest" href="../assets/fevi/site.webmanifest">
   <link rel="mask-icon" href="../assets/fevi/safari-pinned-tab.svg" color="#5bbad5">
   <meta name="msapplication-TileColor" content="#da532c">
   <meta name="theme-color" content="#ffffff">
   <!--===============================================================================================-->
   <!-- FontAwesome-cdn include -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   <!-- Google fonts include -->
   <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700;800;900&amp;family=Poppins:wght@700;800&amp;display=swap" rel="stylesheet">
   <!-- Bootstrap-css include -->
   <link rel="stylesheet" href="css/css-bootstrap.min.css">
   <!-- Animate-css include -->
   <link rel="stylesheet" href="css/css-animate.min.css">
   <!-- Main-StyleSheet include -->
   <link rel="stylesheet" href="css/css-style.css">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
   <div class="wrapper overflow-hidden">
      <!-- Top content -->
      <div class="container-fluid">
         <div class="row mt-3 mb-3 align-items-center">
            <div class="col-md-3 d-flex justify-content-center">
               <div class="logo_area">
                  <a href="index.html">
                     <img src="images/logo-logo.png" width="200px" alt="image-not-found">
                  </a>
               </div>
            </div>
            <div class="col-md-6">
               <div class="card">
                  <div class="card-body">
                     <div class="row text-center align-items-center">
                        <div class="col-md-9">
                           <div class="row">
                              <div class="col-md-6">
                                 <h5>Student Name:</h5>
                              </div>
                              <div class="col-md-6">
                                 <h5><?php echo $student_name; ?></h5>
                              </div>
                           </div>
                           <div class="row text-center">
                              <div class="col-md-6">
                                 <h5>Batch Name:</h5>
                              </div>
                              <div class="col-md-6">
                                 <h5><?php echo $batch_name; ?></h5>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <img src="../images/<?php echo $student_image ?>" style="width: 80px;height:95px">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-3 d-flex justify-content-center">
               <div class="count_progress">
                  <div class="progress-value">
                     <div id="timer"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container">
         <form class="multisteps_form bg-white position-relative overflow-hidden" id="wizard" method="POST">
            <?php
            $total_questions = count($question_ids);

            // Fetch all questions in one query
            $question_ids_str = implode(',', $question_ids);
            $select_questions = "SELECT * FROM `questions` WHERE `sno` IN ($question_ids_str)";
            $select_questions_qry = mysqli_query($con, $select_questions);
            $while_counter = 0;
            $user_questions = [];

            while ($question = mysqli_fetch_assoc($select_questions_qry)) {
               $while_counter++;
               $user_questions[] = $question['sno'];
               $encodedValue1 = htmlspecialchars($question['option_a']);
               $encodedValue2 = htmlspecialchars($question['option_b']);
               $encodedValue3 = htmlspecialchars($question['option_c']);
               $encodedValue4 = htmlspecialchars($question['option_d']);
            ?>

               <!------------------------- Step-1 ----------------------------->
               <div class="multisteps_form_panel step">
                  <div class="question_title text-center text-uppercase">
                     <h1 class="animate__animated animate__fadeInRight animate_25ms"><?php echo $question['question'] ?>
                     </h1>
                  </div>
                  <div class="question_number text-center text-uppercase text-white">
                     <span class="rounded-pill">Question <?php echo $while_counter ?> to <?php echo ($total_questions) ?></span>
                     <input type="hidden" name="questions[<?php echo $while_counter ?>]" value="<?php echo $question['sno'] ?>">
                  </div>

                  <div class="row pt-3 mt-4 form_items w-100 p-5">
                     <div class="col-6">
                        <ul class="list-unstyled">
                           <li class="d-flex step_1 animate__animated animate__fadeInRight animate_50ms">
                              <input id="opt_0" type="hidden" name="ques_answer[<?php echo $while_counter ?>]" value="">
                              <label for="opt_1">
                                 <input id="opt_1" style="flex-shrink: 0;" type="radio" name="ques_answer[<?php echo $while_counter ?>]" value="<?php echo $encodedValue1; ?>">
                                 <label for="opt_1">
                                    <?php echo $encodedValue1; ?>
                                 </label>
                           </li>
                        </ul>
                     </div>
                     <div class="col-6">
                        <ul class="list-unstyled p-0">
                           <li class="d-flex step_1 animate__animated animate__fadeInRight animate_100ms">
                              <input id="opt_2" type="radio" style="flex-shrink: 0;" name="ques_answer[<?php echo $while_counter ?>]" value="<?php echo $encodedValue2; ?>">
                              <label for="opt_2">
                                 <?php echo $encodedValue2; ?>
                              </label>
                           </li>
                        </ul>
                     </div>
                     <div class="col-6">
                        <ul class="list-unstyled p-0">
                           <li class="d-flex step_1 animate__animated animate__fadeInRight animate_150ms">
                              <input id="opt_3" type="radio" style="flex-shrink: 0;" name="ques_answer[<?php echo $while_counter ?>]" value="<?php echo $encodedValue3; ?>">
                              <label for="opt_3">
                                 <?php echo $encodedValue3; ?>
                              </label>
                           </li>
                        </ul>
                     </div>
                     <div class="col-6">
                        <ul class="list-unstyled p-0">
                           <li class="d-flex step_1 animate__animated animate__fadeInRight animate_200ms">
                              <input id="opt_4" type="radio" style="flex-shrink: 0;" name="ques_answer[<?php echo $while_counter ?>]" value="<?php echo $encodedValue4; ?>">
                              <label for="opt_4">
                                 <?php echo $encodedValue4; ?>
                              </label>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            <?php }
            ?>
            <!---------- Form Button ---------->
            <div class="form_btn" id="form_btn">
               <button type="button" class="prev_btn position-absolute text-uppercase border-0" id="prevBtn" onclick="nextPrev(-1)"> <span><i class="fas fa-arrow-left"></i></span> Back</button>
               <button type="button" class="next_btn rounded-pill position-absolute text-uppercase text-white" id="nextBtn" onclick="nextPrev(1)">Next</button>
               <button type="submit" class="next_btn rounded-pill position-absolute text-uppercase text-white" id="sub_btn" name="sub_btn">Submit</button>
            </div>
         </form>
        <?php

         if (isset($_POST['sub_btn'])) {
            $questions = $_POST['questions'];
            $options = $_POST['ques_answer'];
            $real_answer = [];

            foreach ($questions as $key => $values) {
               $sql = "SELECT sno, correct_answer FROM questions WHERE sno='$values'";
               $result = mysqli_query($con, $sql);
               $answer_value = mysqli_fetch_assoc($result)['correct_answer'];
               $oneBasedIndex = $key + 0;
               $real_answer[$oneBasedIndex] = $answer_value;
            }

            $correct_answer_counter = 0;
            foreach ($options as $questionId => $userAnswer) {
               $new_answer = $real_answer[$questionId];
               if ($userAnswer === $new_answer) {
                  $correct_answer_counter++;
               }
            }

            $questions_string = implode(',', $questions);
            $answers_string1 = implode(',', $options);
            $answers_string = mysqli_real_escape_string($con, $answers_string1);
            $percentage_result = ($correct_answer_counter * 100) / $total_questions;

           $insert_result = "UPDATE `students_test` SET `question_ids`='$questions_string',`answers`='$answers_string',`result`='$correct_answer_counter',`percentage`='$percentage_result',`total_questions`='$total_questions' WHERE `students_id`='$student_test_id' AND `batch_id`='$test_batch_id'";
            $insert_result_qry = mysqli_query($con, $insert_result);
            if ($insert_result_qry) {
               $_SESSION['student_result'] = $percentage_result;
               unset($_SESSION['questions']);


               echo "<script>
               sessionStorage.removeItem('remainingTime');
               sessionStorage.removeItem('selectedOptions');
               window.location='result.php'</script>";
            }
         }
         ?>
      </div>
   </div>
   <?php
   $select_time = "SELECT * FROM `test_batch` WHERE `batch_name`=$test_batch_id";
   $select_time_qry = mysqli_query($con, $select_time);
   if ($select_time_qry) {
      while ($row = mysqli_fetch_assoc($select_time_qry)) {
         $timer_hours = $row['hours'];
         $timer_minutes = $row['minutes'];
      }
   }
   ?>

   <script src="js/js-bootstrap.min.js"></script>
   <script src="js/js-script.js"></script>
   <script src="js/my_javascript.js"></script>
   <script>
      var countdownDuration = <?php echo ($timer_hours * 3600 + $timer_minutes * 60); ?>;

      function updateTimer() {
         var hours = Math.floor(countdownDuration / 3600);
         var minutes = Math.floor((countdownDuration % 3600) / 60);
         var seconds = countdownDuration % 60;
         var timerDisplay = `${hours}:${minutes < 10 ? '0' : ''}${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
         $('#timer').text(timerDisplay);
      }

      function performAction() {
         var sub_btn = document.getElementById('sub_btn');
         sub_btn.click();
      }

      var remainingTime = sessionStorage.getItem('remainingTime');
      if (remainingTime && parseInt(remainingTime) > 0) {
         countdownDuration = parseInt(remainingTime);
      }

      updateTimer();

      var timerInterval = setInterval(function() {
         countdownDuration--;
         sessionStorage.setItem('remainingTime', countdownDuration);
         if (countdownDuration <= 0) {
            clearInterval(timerInterval);
            performAction();
         }
         updateTimer();
      }, 1000);
   </script>

</body>

</html>