<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
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
                <div class="col-12 text-center">
                    <h2 class="pag-head">Add student fee</h2>
                </div>
                <!-- <div class="col-12 d-flex my-1 justify-content-center"> -->
                <form action="" method="post" class="col-12 d-flex my-1 justify-content-center">
                    <div class="fee-form-div">
                        <div class="inp-fee-div col-12">
                            <label for="select_batch" class="cs-label">batch</label>
                            <select name="batch" id="select_batch" class="form-select cs-inp-field">
                                <option value="">select batch</option>
                                <?php
                                $fetchBatch = mysqli_prepare($con, "SELECT * FROM `batch`");
                                mysqli_stmt_execute($fetchBatch);
                                $b__results = mysqli_stmt_get_result($fetchBatch);
                                while ($sh__batch = mysqli_fetch_assoc($b__results)) {
                                    echo "<option value=" . $sh__batch['batch_id'] . ">" . $sh__batch['batch_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="inp-fee-div col-12">
                            <label for="select_std" class="cs-label">student</label>
                            <select name="student" id="select_std" class="form-select cs-inp-field">
                                <option value="">select student</option>
                            </select>
                        </div>
                        <div class="inp-fee-div col-12">
                            <label for="amount" class="cs-label">Amount</label>
                            <input type="text" name="amount" id="amount" value="" placeholder="****" class="cs-inp-field form-control">
                        </div>
                        <div class="inp-fee-div col-12">
                            <label for="mon" class="cs-label">Month</label>
                            <select name="mon" id="mon" class="form-select cs-inp-field">
                                <option value="">select Month</option>
                                <?php
                                $currentMonth = date('F');
                                $months = [
                                    'January', 'February', 'March', 'April',
                                    'May', 'June', 'July', 'August',
                                    'September', 'October', 'November', 'December'
                                ];

                                foreach ($months as $month) {
                                    $selected = ($month === $currentMonth) ? 'selected' : '';
                                    echo "<option value='$month' $selected>$month</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="inp-fee-div col-12">
                            <label for="date" class="cs-label">Date <span class="note">(if you are adding previous month challan)</span></label>
                            <input type="date" value="<?= date('Y-m-d'); ?>" name="date" id="date" class="cs-inp-field form-control">
                        </div>
                        <div class="inp-fee-div col-12">
                            <label for="status" class="cs-label">status</label>
                            <select name="status" id="status" class="form-select cs-inp-field">
                                <option value="">fees status</option>
                                <option value="1">paid</option>
                                <option value="0">unpaid</option>
                            </select>
                        </div>
                        <div class="inp-fee-div col-12">
                            <button type="submit" name="sub" class="add-fee-btn">Add fees</button>
                        </div>
                    </div>
                </form>
                <!-- </div> -->


                <?php include('include/footer.php'); ?>
            </div>
        </div>
    </div>


    <?php include('include/javascript.php'); ?>

    <script>
        $(document).ready(() => {
            $('#select_batch').on('change', function() {
                let batch_id = $(this).val();
                let batchname = $(this).find(':selected').text();
                $.ajax({
                    url: 'ajax/students.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        batch_id: batch_id
                    },
                    success: function(response) {
                        let students = response;
                        $('#select_std').empty()
                        if (students.length > 0) {
                            $('#select_std').append(`<option value="">select students </option>`)
                            Array.from(students).forEach((item) => {
                                $('#select_std').append(`<option value="${item.id}"> ${item.name} </option>`)
                            })
                            $('#select_std').on('change', function() {
                                $('#amount').val('')
                                $.ajax({
                                    url: 'ajax/amount.php',
                                    type: 'POST',
                                    dataType: 'json',
                                    data: {
                                        id: $(this).val(),
                                        batch_id: batch_id
                                    },
                                    success: function(response) {
                                        if (response.status == 'success') {
                                            $('#amount').val(`${response.amount}`)
                                        }
                                    },
                                    error: function(error) {
                                        console.log(error)
                                    }
                                })
                            })

                        } else {
                            $('#select_std').append(`<option value="">select students </option>`)
                        }

                    },
                    error: function(error) {
                        console.log("something went wrong" + error);
                    }
                })
            })
            $('#amount').on('input', function(e) {
                e.target.value = e.target.value.replace(/[^0-9]/g, '');
            })
        })
    </script>

    <!-- php code for adding fee data -->

    <?php
    include('../finance-dashboard/include/custom.php');

    if (isset($_POST['sub'])) {

        $studentId = $_POST['student'];
        $batchId = $_POST['batch'];
        $amount = $_POST['amount'];
        $status = $_POST['status'];
        $month = $_POST['mon'];
        $date = $_POST['date'];
        $sec = strtotime($date);
        $act__date = date('j-n-Y', $sec);
        if (isset($studentId) && isset($batchId) && isset($amount) && isset($status) && isset($month) && isset($date)) {
            $fetch = fetchOtherdetailsCol3($con, 'students_fees', 'std_data', $studentId, 'batch_data', $batchId, 'month', $month);
            if (mysqli_num_rows($fetch) == 0) {

                $insertData = "INSERT INTO `students_fees`(`std_data`,`batch_data`,`feeAmount`,`fees_status`,`month`,`date`) VALUES('$studentId','$batchId','$amount','$status','$month','$act__date')";
                $insertDataQ = mysqli_query($con,$insertData);
                if($insertData){
                    echo "data is inserted successfully";
                }
                else{
                    echo "insertation failed";
                }
            } else {
                echo "data is present";
            }
        }
    }
    ?>

</body>

</html>