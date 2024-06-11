<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - (Change Students)</title>
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
                        <h3 class=" text-center text-light">Change Batch Students</h3>
                    </div>
                </div>
                <div class="card my-border-primary-1 my-border-bottom-1">
                    <div class="card-body table-body">

                        <div class="table-responsive main-table mt-4" style="height:400px;">
                            <table id="myTable" class="teacher-table table-bordered table display data-table text-nowrap text-center my-border-primary-1">
                                <thead class="bg-primary text-white">
                                    <th>Sno</th>
                                    <th>Student Name</th>
                                    <th>Father Name</th>
                                    <th>Student Contact</th>
                                    <th>Student Email</th>
                                    <th>Batch Name</th>
                                    <th>Attendance Dates</th>
                                    <th>Attendance Status</th>
                                    <th>Reason Of Change</th>
                                    <th>Image</th>
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
            function fetchData(batchQuery) {

                $.ajax({
                    url: 'ajax/change_students_ajax.php', // Replace with your PHP script URL
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
              <td class='vertical-align-middle'></td>
              <td class='vertical-align-middle'>${item.student_name}</td>
              <td class='vertical-align-middle'>${item.father_name}</td>
              <td class='vertical-align-middle'>${item.student_contact}</td>
              <td class='vertical-align-middle'>${item.email}</td>
              <td class='vertical-align-middle'>${item.batch_name}</td>
              <td style='white-space: break-spaces;vertical-align:middle;'><label style='width:150px'>${item.attendance_dates}</label></td>
              <td style='white-space: break-spaces;vertical-align:middle;'><label style='width:150px'>${item.attendance_status}</label></td>
              <td style='white-space: break-spaces;vertical-align:middle;'><label style='width:150px'>${item.change_reason}</label></td>
              <td><img src="../images/${item.student_image}" class="img img-fluid"></td>
              <td class='vertical-align-middle'>
                        <a class="btn btn-dark" onclick="return confirm('Are you sure? You Want to Delete This Student!')" href="delete.php?student_sno=${item.sno}">Delete</a>
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

            fetchData();
        });
    </script>
</body>

</html>