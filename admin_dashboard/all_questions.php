<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - (All Questions)</title>
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
                        <h3 class=" text-center text-light">All Questions</h3>
                    </div>
                </div>
                <div class="card my-border-primary-1 my-border-bottom-1">
                    <div class="card-body table-body">
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="">Quick Search</label>
                                    <input type="text" id="searchInput" placeholder="Search" title="Type in a name" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Select Batch</label>
                                    <select class="form-select" id="topic_select">
                                        <option value="">Select Topic</option>
                                        <?php
                                        $select_topic = get_table_data('test_topic', $con);
                                        while ($row = mysqli_fetch_assoc($select_topic)) {
                                        ?>
                                            <option value="<?php echo $row['sno'] ?>"><?php echo $row['topic_name'] ?></option>
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
                                    <th>Questions</th>
                                    <th>Options 1</th>
                                    <th>Options 2</th>
                                    <th>Options 3</th>
                                    <th>Options 4</th>
                                    <th>Correct Answer</th>
                                    <th>Test Topic</th>
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
            function fetchData(searchQuery = "", topicQuery) {

                $.ajax({
                    url: 'ajax/questions_ajax.php', // Replace with your PHP script URL
                    method: 'GET',
                    data: {
                        search: searchQuery,
                        topic: topicQuery,
                    }, // Pass search query to PHP script
                    dataType: 'json',
                    success: function(data) {
                        const tableBody = $('#myTable tbody');
                        tableBody.empty();

                        $.each(data, function(index, item) {


                            const row = $('<tr>');
                            row.append(`
              <td class='vertical-align-middle'></td>
              <td class='vertical-align-middle' style='white-space: break-spaces'><label style=';width:150px'>${item.question}</label></td>
              <td class='vertical-align-middle' style='white-space: break-spaces'><label style=';width:150px'>${item.option_1}</label></td>
              <td class='vertical-align-middle' style='white-space: break-spaces'>${item.option_2}</td>
              <td class='vertical-align-middle' style='white-space: break-spaces'>${item.option_3}</td>
              <td class='vertical-align-middle' style='white-space: break-spaces'>${item.option_4}</td>
              <td class='vertical-align-middle' style='white-space: break-spaces'>${item.correct_answer}</td>
              <td class='vertical-align-middle' style='white-space: break-spaces'>${item.topic_name}</td>
              <td class='vertical-align-middle'>
                        <a href="edit_questions.php?question_sno=${item.sno}"><button class="btn btn-primary" style="margin-right:5px">Edit</button></a>
                        <a class="btn btn-dark" onclick="return confirm('Are you sure? You Want to Delete This Student!')" href="delete.php?question_sno=${item.sno}">Delete</a>
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
                var singleValues = $("#topic_select").val();
                var searchQuery = $("#searchInput").val();
                fetchData(searchQuery, singleValues);
            }
            $("#topic_select").on("change", displayVals);
            $("#searchInput").on("keyup", displayVals);
            displayVals();
            fetchData();
        });
    </script>
</body>

</html>