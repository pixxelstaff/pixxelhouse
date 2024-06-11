<?php
include('../include/connect.php');
include('../include/custom.php');
$fee__data = [];
$searchDate = date('n-Y');
$feeData = "
SELECT
(SELECT SUM(`feeAmount`)  FROM `students_fees` WHERE `date` LIKE '%$searchDate%') AS `TotalAmount`,
(SELECT SUM(`feeAmount`)  FROM `students_fees` WHERE `fees_status` = '1') AS `paidAmount`,
(SELECT SUM(`feeAmount`)  FROM `students_fees` WHERE `fees_status` = '0') AS `unPaidAmount`,
(SELECT COUNT(`fees_status`)  FROM `students_fees` WHERE `fees_status` = '1') AS `paidStudent`,
(SELECT COUNT(`fees_status`)  FROM `students_fees` WHERE `fees_status` = '0') AS `unPaidStudent`
";
$feeDataQ = mysqli_query($con,$feeData);
while($show = mysqli_fetch_assoc($feeDataQ)){
    $fee__data[] = array(
        'TotalAmount' => !empty($show['TotalAmount']) ? $show['TotalAmount'] : 0,
        'paidAmount' => !empty($show['paidAmount']) ? $show['paidAmount'] : 0,
        'unPaidAmount' => !empty($show['unPaidAmount']) ? $show['unPaidAmount'] : 0,
        'paidStudent' => !empty($show['paidStudent']) ? $show['paidStudent'] : 0,
        'unPaidStudent' => !empty($show['unPaidStudent']) ? $show['unPaidStudent'] : 0,
    );
}
header('Content-Type:application/json');
echo json_encode($fee__data);
