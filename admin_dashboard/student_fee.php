<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Fee || Admin Dashboard</title>
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
                    <h2 class="pag-head"> student fee</h2>
                </div>
                <div class="col-12 d-flex my-1 justify-content-center">
                    <div class="fee-form-div">
                        <div class="inp-fee-div col-12">
                            <label for="batch_sel" class="cs-label">batch</label>
                            <select name="" id="batch_sel" class="form-select cs-inp-field">
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
                            <label for="std_select" class="cs-label">student</label>
                            <select name="" id="std_select" class="form-select cs-inp-field">
                                <option value="">select student</option>
                            </select>
                        </div>



                    </div>
                </div>
                <div class="row my-4" id="table-row">
                    <div class="col-12 table-responsive py-2">
                        <table class="custom-table activity-data-table w-100">
                            <thead>
                                <tr>
                                    <th scope="col">Sno</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Course</th>
                                    <th scope="col">Batch</th>
                                    <th scope="col">Month</th>
                                    <th scope="col">Fees</th>
                                    <th scope="col">Status</th>

                                </tr>
                            </thead>
                            <tbody id="dynamic_table_body">
                                <!-- <tr>
                                    <td>1</td>
                                    <td>Sir Usman</td>
                                    <td colspan="100">this student has no data</td>
                                    <td>4</td>
                                    <td>7</td>
                                    <td>2</td>
                                    <td>5</td>
                                    <td>February</td>


                                </tr> -->


                            </tbody>
                        </table>
                    </div>
                </div>

                <?php include('include/footer.php'); ?>
            </div>
        </div>
    </div>


    <?php include('include/javascript.php'); ?>


    <script>
        $(document).ready(() => {
            $('#batch_sel').on('change', function() {
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
                        $('#std_select').empty()
                        if (students.length > 0) {
                            $('#std_select').append(`<option value="">select (${batchname}) students </option>`)
                            Array.from(students).forEach((item) => {
                                $('#std_select').append(`<option value="${item.id}"> ${item.name} </option>`)
                            })
                            $('#std_select').on('change', function() {
                                //empty the table
                                $('#dynamic_table_body').empty()
                                let std_id = $(this).val();
                                $.ajax({
                                    url: 'ajax/fetch_student_fees.php',
                                    type: 'POST',
                                    dataType: 'json',
                                    data: {
                                        std_id: std_id,
                                        batch_id: batch_id
                                    },
                                    success: function(res) {
                                        $('#dynamic_table_body').empty()
                                        let tr = document.createElement('tr');
                                        if (res.length > 0 && !res.status) {
                                            Array.from(res).forEach((elem) => {
                                                tr.innerHTML = `
                                            <td>1</td>
                                            <td>${elem.name}</td>
                                            <td>${elem.course}</td>
                                            <td>${elem.batch}</td>
                                            <td>${elem.month}</td>
                                            <td>${elem.amount}</td>
                                            <td>${elem.fee_status == '1' ? 'paid' : 'unpaid'}</td>
                                            `
                                                $('#dynamic_table_body').append(tr);
                                            })
                                        } else {

                                            tr.innerHTML = `
                                            <td>1</td>
                                            <td>${res.name}</td>
                                            <td colspan="100">${res.message}</td>
                                            `
                                            $('#dynamic_table_body').append(tr);
                                        }


                                    },
                                    error: function(error) {
                                        console.log("error ocuurs" + error)
                                    }
                                })
                            })
                        } else {
                            $('#std_select').append(`<option value="">select students </option>`)
                        }

                    },
                    error: function(error) {
                        console.log("something went wrong" + error);
                    }
                })
            })
        })
    </script>

</body>

</html>