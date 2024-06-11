<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mark Fees || Admin Dashboard</title>
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
                    <h2 class="pag-head">Mark student fee</h2>
                </div>
                <div class="col-12 d-flex my-1 justify-content-center">
                    <div class="fee-form-div">
                        <div class="inp-fee-div col-12">
                            <label for="select_batch" class="cs-label">batch</label>
                            <select name="" id="select_batch" class="form-select cs-inp-field">
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
                            <select name="" id="select_std" class="form-select cs-inp-field">
                                <option value="">select student</option>
                            </select>
                        </div>
                        <div class="inp-fee-div col-12">
                            <label for="mon" class="cs-label">Month</label>
                            <select name="" id="mon" class="form-select cs-inp-field">
                                <option value="">select Month</option>
                                
                            </select>
                        </div>
                        <div class="inp-fee-div col-12">
                            <label for="fee_status" class="cs-label">Fees status</label>
                            <select name="" id="fee_status" class="form-select cs-inp-field">
                                <option value="">Select options</option>
                                <option value="1"> paid</option>
                                <option value="0">unpaid</option>
                            </select>
                        </div>
                        <div class="inp-fee-div col-12">
                            <button type="submit" name="sub" class="add-fee-btn">Mark fees</button>
                        </div>
                    </div>
                </div>


                <?php include('include/footer.php'); ?>
            </div>
        </div>
    </div>


    <?php include('include/javascript.php'); ?>

    <script>
         
        $(document).ready(() => {
            $('#select_batch').on('change', function() {
                $('#mon').empty();
                let batch_id = $(this).val();
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
                                $('#mon').empty();
                                $.ajax({
                                    url: 'ajax/month.php',
                                    type: 'POST',
                                    dataType: 'json',
                                    data: {
                                        id: $(this).val(),
                                        batch_id: batch_id
                                    },
                                    success: function(response) {
                                        $('#mon').empty();
                                        $('#mon').append(`<option value="">select month</option>`)
                                        // if (response.status == 'success') {
                                           Array.from(response).forEach((item)=>{
                                            $('#mon').append(`<option value="${item.month}">${item.month}</option>`)
                                           })
                                        // }
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
           
        })
    </script>
  


</body>

</html>