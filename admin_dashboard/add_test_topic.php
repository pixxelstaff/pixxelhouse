<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - (Add Test Topic)</title>
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
                        <h3 class=" text-center text-light">Add Test Topic</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card card-shadow-ph">
                            <div class="card-body">
                                <form method="post">
                                    <div class="row align-items-center">

                                        <div class="col-md-12">
                                            <label for="topic" class="form-label">Test Topic Name<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Test Topic" name="topic" id="topic" class="form-control">
                                        </div>

                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <input type="submit" name="add_btn" value="Add Topic" class="btn btn-primary form-control">
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </form>
                                <?php
                                if (isset($_POST['add_btn'])) {
                                    $topic = mysqli_real_escape_string($con, $_POST['topic']);


                                    $insert_query = "INSERT INTO `test_topic`(`topic_name`) VALUES (?)";
                                    $stmt = mysqli_prepare($con, $insert_query);
                                    mysqli_stmt_bind_param($stmt, "s", $topic);
                                    $update_success = mysqli_stmt_execute($stmt);

                                    if ($update_success) {
                                ?>
                                        <script>
                                            window.location = "alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'Test Topic Added!' ?>&location=<?php echo 'add_test_topic.php' ?>";
                                        </script>
                                    <?php
                                    } else {
                                    ?>
                                        <script>
                                            window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Something Went Wrong!' ?>&location=<?php echo 'add_test_topic.php' ?>";
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