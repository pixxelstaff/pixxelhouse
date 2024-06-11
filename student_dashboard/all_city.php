<?php
include('include/connect.php');


$rt_arr = [];

$id = $_POST['id'];



$all_col = "SELECT `country_code` FROM `country`  WHERE `country_sno` = '$id'";
$all_col_query = mysqli_query($con, $all_col);


while ($sh_col = mysqli_fetch_assoc($all_col_query)) {

    $country_code = $sh_col['country_code'];
}

$all_cities = "SELECT * FROM `city` WHERE `country_id` = '$id'";

$all_cities_query = mysqli_query($con, $all_cities);

while ($sh_city = mysqli_fetch_assoc($all_cities_query)) {
    $rt_arr[] = array(

        'id' => $sh_city['city_sno'],
        'city_name' => $sh_city['city_name'],
        'country_id' => $sh_city['country_id']
    );
}
$new_array = [
    'country_code' => $country_code,
    'cities' => $rt_arr
];

header('Content-Type: application/json');
echo json_encode($new_array);
