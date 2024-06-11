<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
<link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
<link rel="stylesheet" href="../assets/css/styles.min.css" />
<link rel="stylesheet" href="../assets/css/my-style.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="../assets/css/an_style.css">
<link rel="stylesheet" href="../assets/std_icons/style.css">
<link rel="stylesheet" href="../assets/css/responsive.css">
<script src="../assets/std_icons/demo-files/demo.js" defer></script>
<link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
<link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">
<script src="../assets/js/owl.carousel.min.js"></script>

<?php

session_start();
if (!isset($_SESSION['std_email'])) {
    header('location:index.php');
}
include('connect.php');

include('function.php');

$ses_email = $_SESSION['std_email'];

$std_all_data = "SELECT * FROM `students` WHERE `portal_email` = '$ses_email'";

$std_all_data_query = mysqli_query($con, $std_all_data);

if ($std_all_data_query) {


    while ($show = mysqli_fetch_assoc($std_all_data_query)) {

        $session_student_id = $show['sno'];
        $session_student_name = $show['student_name'];
        $session_father_name =  $show['father_name'];
        $session_father_email =  $show['father_email'];
        $session_home_contact =  $show['home_contact'];
        $session_date_of_birth =  $show['date_of_birth'];
        $session_student_contact =  $show['student_contact'];
        $session_emergency_contact =  $show['emergency_contact'];
        $session_gender =  $show['gender'];
        $session_address =  $show['address'];
        $session_qualification =   $show['qualification'];
        $session_std_country = $show['country'];
        $session_std_city = $show['city'];
        $session_std_country_code = $show['country_code'];
        $session_course =   $show['course'];
        $session_batch =   $show['batch'];
        $session_std_email =   $show['email'];
        $session_email =   $show['portal_email'];
        $session_image =   $show['student_image'];
    }
} else {

?>
    <script>
        alert('script not executed')
    </script>
<?php

}




?>

<div class="wrapper">
    <svg>
        <text x="50%" y="50%" dy=".35em" text-anchor="middle">
            Pixxel House
        </text>
    </svg>
</div>

<script>
    window.addEventListener('load', () => {
        let wrp = document.querySelector('.wrapper');
        wrp.style.opacity = '0';
        setTimeout(() => {
            wrp.style.display = 'none';
        }, 100);
    });
</script>
