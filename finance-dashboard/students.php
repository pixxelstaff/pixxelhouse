<?php
session_start();
if(!isset($_SESSION['finance_manager_login'])){
  header("location:index.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Finance Dashboard</title>
    <?php include('include/links.php'); ?>

</head>

<body>

    <?php

    //student data query

    $studentsP_count = mysqli_prepare($con, "SELECT * FROM `students`");
    mysqli_stmt_execute($studentsP_count);
    $count_std = mysqli_stmt_get_result($studentsP_count);

    // for getting total rows

    // $result = all_data_func($connect, 'blog_post');
    // $result = all_data_func($connect, 'blog_post');

    // [pagination starts here]

    $active = '';

    $page = isset($_GET['page-id']) ? $_GET['page-id'] : 1;

    // fetching data using 

    $totalResult = mysqli_num_rows($count_std); // using first static then will dynamic it

    $limit = 12;

    $offset = ($page - 1) * $limit;

    $totalpage = ceil($totalResult / $limit);

    $beforePage = $page - 1;

    $afterPage = $page + 1;

    //showing li as after number goes more than 3 we will add 1 and ... anc
    if ($page == 1) {
        $afterPage = $afterPage + 2;
    } elseif ($page == 2) {
        $afterPage = $afterPage + 1;
    }

    if ($page == $totalpage) {
        $beforePage = $beforePage - 2;
    } elseif ($page == $totalpage - 1) {
        $beforePage = $beforePage - 1;
    }


    ?>

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
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h2 class="sel-std">Select Student</h2>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-lg-3 col-md-6 col-sm-12 my-2 ">
                            <div class="col-12 d-flex flex-column gap-2 form-element-div">
                                <label for="">search**</label>
                                <input type="text" name="" id="searchInp" data-offset="<?= $page ?>" placeholder="search students">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 my-2 ">
                            <div class="col-12 d-flex flex-column gap-2 form-element-div">
                                <label for="">sort by course**</label>
                                <select name="" id="selectCourse">
                                    <option value="">select course</option>
                                    <?php
                                    $fetchCourse = fetchAllData($con, 'course');
                                    while ($Cdata = mysqli_fetch_assoc($fetchCourse)) {
                                    ?>
                                        <option value="<?php echo $Cdata['Id']; ?>"><?php echo $Cdata['course_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 my-2 ">
                            <div class="col-12 d-flex flex-column gap-2 form-element-div">
                                <label for="">sort by batch**</label>
                                <select name="" id="selectBatch">
                                    <option value="">select batch</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 my-2 ">
                            <div class="col-12 d-flex flex-column gap-2 form-element-div">
                                <label for="">sort by**</label>
                                <select name="" id="searchBySort">
                                    <option value="">select option</option>
                                    <option value="ASC">Sort by (A-Z)</option>
                                    <option value="DESC">Sort by (Z-A)</option>
                                    <!-- <option value="">Unpaid-student</option> -->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4" id="student-card-div">
                        <?php
                        $students = "SELECT * FROM `students` ORDER BY `sno` DESC LIMIT ? OFFSET ?";
                        $studentsP = mysqli_prepare($con, $students);
                        mysqli_stmt_bind_param($studentsP, 'ss', $limit, $offset);
                        mysqli_stmt_execute($studentsP);
                        $stdResult = mysqli_stmt_get_result($studentsP);
                        while ($display = mysqli_fetch_assoc($stdResult)) {
                            $batch_id = explode(',', $display['batch']);
                            $course_id = explode(',', $display['course']);
                            $actual_b_name = '';
                            $teachers_act_names = '';
                            $course_names = '';
                            foreach ($batch_id as  $b_value) {
                                $data = fetchOtherdetails($con, 'batch', 'batch_id', $b_value);
                                $t_id = '';
                                while ($show = mysqli_fetch_assoc($data)) {
                                    $actual_b_name .= $show['batch_name'] . ",";
                                    $t_id = $show['teacher'];
                                }
                                $data2 = fetchOtherdetails($con, 'teacher', 'teacher_id', $t_id);
                                while ($show2 = mysqli_fetch_assoc($data2)) {
                                    $teachers_act_names .= $show2['teacher_name'] . ",";
                                }
                            }
                            foreach ($course_id as  $c_value) {
                                $data3 = fetchOtherdetails($con, 'course', 'Id', $c_value);
                                while ($show3 = mysqli_fetch_assoc($data3)) {
                                    $course_names .= $show3['course_name'] . ",";
                                }
                            }
                            $cl_b_name = trim($actual_b_name, ',');
                            $cl_t_name = trim($teachers_act_names, ',');
                            $cl_c_name = trim($course_names, ',');

                        ?>
                            <div class="col-lg-3 col-md-6 col-sm-12 p-2">
                                <a href="student-report.php?student-id=<?= $display['sno'] ?>">
                                    <div class="col-12 student-ins-card">
                                        <div class="student-img-div">
                                            <img src="../images/<?php echo $display['student_image'] ?>" alt="">
                                        </div>
                                        <div class="std-data">
                                            <h2 class="stdName text-center"><?php echo $display['student_name'] ?></h2>
                                            <ul>
                                                <li>
                                                    <span class="label-span"> <i>Father :</i> </span>
                                                    <span class="data-span"><?php echo $display['father_name'] ?></span>
                                                </li>
                                                <li>
                                                    <span class="label-span"> <i>Course :</i> </span>
                                                    <span class="data-span"><?= $cl_c_name; ?></span>
                                                </li>
                                                <li>
                                                    <span class="label-span"> <i>Batch :</i> </span>
                                                    <span class="data-span"><?= $cl_b_name; ?></span>
                                                </li>
                                                <li>
                                                    <span class="label-span"> <i>Teacher :</i> </span>
                                                    <span class="data-span"><?= $cl_t_name?></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php
                        }


                        ?>



                    </div>
                    <div class="row mt-4" id="pagination">
                        <div class="col-12 bg-white my-2 rounded p-2">
                            <div class="pagination-div d-flex gap-2 justify-content-center">
                                <?php
                                // condition for prev button
                                if ($page > 1) {
                                ?>
                                    <a href="students.php?page-id=<?php echo $page - 1; ?>" id="p_prev_btn"><i class="fa-solid fa-angles-left"></i></a>
                                <?php
                                }
                                // <!-- append page 1 button when results are more -->
                                if ($page > 2) {
                                    echo "<a class='page-btn' href='students.php?page-id=1'>1</a>";
                                    if ($page > 3) {
                                        echo "<a class='page-btn' href='javasript:void(0)'><i class='fa-solid fa-ellipsis'></i></a>";
                                    }
                                }
                                // ends here loop is starting from -1 from page number and to +1 in page number max button 3
                                for ($buttonLength = $beforePage; $buttonLength <= $afterPage; $buttonLength++) {
                                    // not run loop or append until this condition statisfies
                                    if ($buttonLength > $totalpage || $buttonLength < 1) {
                                        continue;
                                    }
                                    // if button length = 0  add + 1 
                                    $buttonLength = ($buttonLength == 0) ? $buttonLength + 1 : $buttonLength;
                                    // adding active class if buttonlength and pagenumber become same
                                    $buttonLength == $page ? $active = 'active-page' : $active = '';
                                ?>
                                    <a href="students.php?page-id=<?php echo $buttonLength; ?>" class="page-btn <?php echo $active; ?>"><?php echo $buttonLength; ?></a>
                                <?php
                                }
                                // append last page button so any one can easily go to last page
                                if ($page < $totalpage - 1) {

                                    // this codition states that if page is less than totalpage - 1 append last page button
                                    // upcoming condition works until second last page
                                    if ($page < $totalpage - 2) {
                                        echo "<a class='page-btn' href='javasript:void(0)'><i class='fa-solid fa-ellipsis'></i></a>";
                                    }
                                    echo "<a class='page-btn' href='students.php?page-id=" . $totalpage . "'>" . $totalpage . "</a>";
                                }
                                ?>
                                <!-- check if page is not last page -->
                                <?php
                                if ($page < $totalpage) {
                                ?>
                                    <a href="students.php?page-id=<?php echo $page + 1; ?>" id="p_next_btn"><i class="fa-solid fa-angles-right"></i></a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include('include/javascript.php'); ?>
    <script src="../assets/js/circular.js"></script>
    <script src="f-assets/dashboard-chart.js"></script>
    <script src="f-assets/studentsAge.js"></script>                           


</body>

</html>