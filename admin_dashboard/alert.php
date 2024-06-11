<!DOCTYPE html>
<html>

<head>
    <title>Message</title>
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        /* Custom styles for SweetAlert */
        @import url('https://fonts.googleapis.com/css2?family=Ysabeau+Infant&display=swap');

        * {
            font-family: 'Ysabeau Infant', sans-serif;
        }

        .swal-modal {
            width: 550px;
            background-color: #ffffff;
        }

        .swal-icon--success__ring {
            border: 4px solid #1176bc !important;
        }

        .swal-icon--success__line {
            background-color: #1176bc;
        }

        .swal-button:not([disabled]) {
            background-color: #1176bc;

        }

        .swal-button:not([disabled]):hover {
            background-color: #0065b0;

        }

        .swal-icon--success:after,
        .swal-icon--success:before {
            background-color: #ffffff;

        }

        .swal-icon--success__hide-corners {
            background-color: #ffffff;

        }

        .swal-title:not(:last-child) {
            color: #1176bc;
        }

        /* ====================================ERROR================================ */
        .swal-icon--error {
            border-color: #1176bc;
        }

        .swal-icon--error__line {
            background-color: #1176bc !important;
        }
    </style>
</head>

<body>
    <?php
    $icon = $_GET['icon'];
    $title = $_GET['message'];
    $location = $_GET['location'];
    ?>
    <script type="text/javascript">
        $(document).ready(function() {
            swal({
                title: '<?php echo $title; ?>',
                icon: '<?php echo $icon; ?>', // success, error
            }).then((result) => {
                if (result) {
                    // Redirect to another page
                    window.location.href = '<?php echo $location; ?>';
                }
            });
        });
    </script>
</body>

</html>