<?php

include('include/connect.php');
include('include/custom.php');

$specificBatch = fetchOtherdetails($con,'students','batch','34');
echo "<pre>";
print_r(mysqli_fetch_assoc($specificBatch));