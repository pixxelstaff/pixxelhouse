<?php

include('include/connect.php');

// $feeStatics = "SELECT COUNT(*) AS 'unpaidStd' FROM `students_fees` WHERE `fees_status` = '0'
// UNION
// SELECT  COUNT(*) AS 'paidStd' FROM `students_fees` WHERE `fees_status` = '1'
// UNION
// SELECT SUM(`feeAmount`) AS 'paidRevenue' FROM `students_fees` WHERE `fees_status` = '1'
// ";
// $feeStatics = "SELECT COUNT(*) AS 'unpaidStd', NULL AS 'paidStd', NULL AS 'paidRevenue' FROM `students_fees` WHERE `fees_status` = '0'
// UNION
// SELECT NULL, COUNT(*), NULL FROM `students_fees` WHERE `fees_status` = '1'
// UNION
// SELECT NULL, NULL, SUM(`feeAmount`) FROM `students_fees` WHERE `fees_status` = '1'
// ";

// $feeStaticsQ = mysqli_query($con, $feeStatics);

// while ($statics =  mysqli_fetch_assoc($feeStaticsQ)) {
//     echo "Unpaid student : " . $statics['unpaidStd'] . "<br>";
//     echo "paid student : " . $statics['paidStd'] . "<br>";
//     echo "student who have paid fee : " . $statics['paidRevenue'] . "<br>";
// }

