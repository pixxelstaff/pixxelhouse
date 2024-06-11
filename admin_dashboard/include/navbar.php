<?php
include('include/connect.php');
if (isset($_SESSION['admin_login'])) {
  $admin_session = $_SESSION['admin_login'];
  $admin_details = get_table_data2('main_admin', $con, 'email', $admin_session);
  while ($admin = mysqli_fetch_assoc($admin_details)) {
    $user_name = $admin['user_name'];
    $admin_image = $admin['image'];
  }
}
?>
<nav class="navbar navbar-expand-lg navbar-light apply_shadow-ph">
  <?php
  // checking 
  $circle_anim = '';
  $check_not = "SELECT * FROM `notification` WHERE NOT FIND_IN_SET(?, `notification_reader`)";
  $check_not_p = mysqli_prepare($con, $check_not);

  // Assuming '0' is the value you want to search for in the notification_reader column
  $valueToSearch = '0';

  mysqli_stmt_bind_param($check_not_p, 's', $valueToSearch);
  mysqli_stmt_execute($check_not_p);

  $notification_result = mysqli_stmt_get_result($check_not_p);

  if (mysqli_num_rows($notification_result) > 0) {
    // Your alert or any other code goes here
    $circle_anim = 'scale-up-circe';
  }


  ?>
  <ul class="navbar-nav notification-parent" data-admin-id='0' requestFetch='true'>
    <li class="nav-item d-block d-xl-none">
      <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
        <i class="ti ti-menu-2"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link nav-icon-hover " id='not-bell' href="javascript:void(0)">
        <i class="ti ti-bell-ringing"></i>
        <div class="notification bg-primary rounded-circle  <?php echo $circle_anim; ?>" id="not-cir"></div>
      </a>
    </li>
    <div class="notification-div">
      <?php
      $sel_birthday_data = "SELECT * FROM `notification` ORDER BY `notification`.`Id` DESC LIMIT 20";
      $sel_birthday_data_p = mysqli_prepare($con, $sel_birthday_data);
      if (mysqli_stmt_execute($sel_birthday_data_p)) {
        $result = mysqli_stmt_get_result($sel_birthday_data_p);
        if (mysqli_num_rows($result) > 0) {

          while ($show_not = mysqli_fetch_assoc($result)) {
            $not_provider = $show_not['notification_provider'];
            $notifications_ids = $show_not['notification_provider_id'];
            $n_title = $show_not['notification_title'];
            $n_des = $show_not['notification_des'];
            $n_date = $show_not['notification_date'];
            $n_time = $show_not['notification_time'];
            if ($not_provider == 'student') {
              $exploded_ids = explode(',', $notifications_ids);
              foreach ($exploded_ids as  $s_id) {
                $std_img_q = mysqli_query($con, "SELECT * FROM `students` WHERE `sno` = '$s_id'");
                while ($ft_student = mysqli_fetch_assoc($std_img_q)) {
                  $student_name = $ft_student['student_name'];
                  $act_image = $ft_student['student_image'];
                }

      ?>
                <div class="notification-row col-12 d-flex align-items-center">
                  <div class="not-img col-3 text-center">
                    <img src="<?php echo  '../images/' . $act_image; ?>" alt="">
                  </div>
                  <div class="notification-data  col-9">
                    <a href="<?php echo isset($_SESSION['admin_login']) ? 'birthday_card.php?id=' . $s_id : 'javascript:void(0)'; ?>">
                      <?php echo $n_title . " " . $student_name; ?>
                    </a>
                    <div class="not-message">
                      <p><?php echo $n_des; ?> </p>
                      <span><?php echo timeAgo("$n_date", "$n_time");  ?></span>
                    </div>
                  </div>
                </div>
      <?php
                # code...
              }
            }
          }
        } else {
          echo "<h2>no data found</h2>";
        }
      }
      ?>

    </div>
  </ul>
  <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
      <li class="nav-item dropdown">
        <a><?php echo strtoupper($user_name) ?></a>
      </li> &nbsp &nbsp
      <li class="nav-item dropdown rounded-circle">
        <!-- <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false"> -->
        <img src="../<?php echo $admin_image ?>" alt="" width="40" class="img img-fluid">
        <!-- <i class="fas fa-angle-down"></i> -->
        <!-- </a> -->
        <!-- <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
                    <a href="logout.php?log=logout" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div> -->
      </li>
    </ul>
  </div>
</nav>