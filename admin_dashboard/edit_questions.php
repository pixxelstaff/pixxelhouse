<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - (Edit Questions)</title>
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
                <div class="card bg-primary">
                    <div class="card-body">
                        <h3 class=" text-center text-light">Edit Questions</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card card-shadow-ph">
                            <div class="card-body">
                                <?php
                                $get_question_id = $_GET['question_sno'];
                                $select_questions = get_table_data2('questions', $con, 'sno', $get_question_id);
                                while ($row = mysqli_fetch_assoc($select_questions)) {
                                    $questions_name = $row['question'];
                                    $option_a = $row['option_a'];
                                    $option_b = $row['option_b'];
                                    $option_c = $row['option_c'];
                                    $option_d = $row['option_d'];
                                    $correct_answer = $row['correct_answer'];
                                    $topic = $row['topic'];
                                }
                                ?>
                                <form method="post">
                                    <div class="row align-items-center mb-3">
                                        <h4 class="text-primary">Question</h4>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-md-12 mb-2">
                                            <label for="question" class="form-label">Question<span class="text-danger">*</span></label>
                                            <textarea name="question" id="question" class="form-control" rows="2" required><?php echo $questions_name; ?></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="test_topic" class="form-label">Test Topic<span class="text-danger">*</span></label>
                                            <select class="form-select" name="test_topic" id="test_topic" required>
                                                <option value=""><?php echo $topic ?></option>
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
                                    </div>

                                    <div class="row align-items-center mt-4">
                                        <h4 class="text-primary">Options</h4>
                                    </div>
                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-6">
                                            <label for="option_1" class="form-label">Option 1<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Option 1" name="option_1" id="option_1" class="form-control" required value="<?php echo $option_a; ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="option_2" class="form-label">Option 2<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Option 2" name="option_2" id="option_2" class="form-control" required value="<?php echo $option_b; ?>">
                                        </div>

                                    </div>
                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-6">
                                            <label for="option_3" class="form-label">Option 3<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Option 3" name="option_3" id="option_3" class="form-control" required value="<?php echo $option_c; ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="option_4" class="form-label">Option 4<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Option 4" name="option_4" id="option_4" class="form-control" required value="<?php echo $option_d; ?>">
                                        </div>

                                    </div>
                                    <div class="row align-items-center mt-4">
                                        <h4 class="text-primary">Correct Answer</h4>
                                    </div>
                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-12">
                                            <label for="correct" class="form-label">Correct Answer<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Correct Answer" name="correct" id="correct" class="form-control" required value="<?php echo $correct_answer; ?>">
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <input type="submit" name="add_btn" value="Add Question" class="btn btn-primary form-control">
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </form>
                                <?php
                                if (isset($_POST['add_btn'])) {

                                    $questions1 = $_POST['question'];
                                    $test_topic1 = $_POST['test_topic'];
                                    $option_1_1 = $_POST['option_1'];
                                    $option_2_1 = $_POST['option_2'];
                                    $option_3_1 = $_POST['option_3'];
                                    $option_4_1 = $_POST['option_4'];
                                    $correct_1 = $_POST['correct'];

                                    $questions = mysqli_real_escape_string($con, str_replace('"', "\'", $questions1));
                                    $test_topic = mysqli_real_escape_string($con, str_replace('"', "\'", $test_topic1));
                                    $option_1 = mysqli_real_escape_string($con, str_replace('"', "\'", $option_1_1));
                                    $option_2 = mysqli_real_escape_string($con, str_replace('"', "\'", $option_2_1));
                                    $option_3 = mysqli_real_escape_string($con, str_replace('"', "\'", $option_3_1));
                                    $option_4 = mysqli_real_escape_string($con, str_replace('"', "\'", $option_4_1));
                                    $correct = mysqli_real_escape_string($con, str_replace('"', "\'", $correct_1));


                                    // $insert_query = "INSERT INTO `questions`(`question`, `option_a`,`option_b`, `option_c`, `option_d`, `correct_answer`,`topic`) VALUES (?,?,?,?,?,?,?)";
                                    $insert_query = "UPDATE `questions` SET `question`=?,`option_a`=?,`option_b`=?,`option_c`=?,`option_d`=?,`correct_answer`=?,`topic`=? WHERE `sno`=?";
                                    $stmt = mysqli_prepare($con, $insert_query);
                                    mysqli_stmt_bind_param($stmt, "ssssssii", $questions, $option_1, $option_2, $option_3, $option_4, $correct, $test_topic, $get_question_id);
                                    $update_success = mysqli_stmt_execute($stmt);

                                    if ($update_success) {
                                ?>
                                        <script>
                                            window.location = "alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'Question Update Successfull!' ?>&location=<?php echo 'add_questions.php' ?>";
                                        </script>
                                    <?php
                                    } else {
                                    ?>
                                        <script>
                                            window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Something Went Wrong!' ?>&location=<?php echo 'add_questions.php' ?>";
                                        </script>
                                <?php
                                    }
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <?php include('include/footer.php'); ?>
            </div>
        </div>
    </div>
    <?php include('include/javascript.php'); ?>

</body>

</html>