<?php
include ('../include/connect.php');

$courseId = $_POST['id'];
$data = [];

if(!empty($courseId)){

    $selectData = mysqli_prepare($con,"SELECT * FROM `batch` WHERE `course_id` = ?");

    mysqli_stmt_bind_param($selectData,'s',$courseId);
    
    mysqli_stmt_execute($selectData);
    
    $results = mysqli_stmt_get_result($selectData);

    if(mysqli_num_rows($results) > 0){
        while($show = mysqli_fetch_assoc($results)){
    
            $data[] = array(
                'id' => $show['batch_id'],
                'name'=> $show['batch_name']
            );
        
        }
    }
    else{
        $data = [];
    }
    
    
    

}
else{
    $data[] = array(
        'id' => '',
        'name'=> ''
    );
}



header("Content-Type:application/json");

echo json_encode($data);
