<?php
include('../../connect.php');
include('../../functions/function.php');
// Search query from the client-side (if provided)
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$topicQuery = isset($_GET['topic']) ? $_GET['topic'] : '';

$sql = "SELECT * FROM `questions`";

// Add a WHERE clause for name filtering if a search query is provided
if (empty($topicQuery) && !empty($selectQuery)) {
    $sql .= "WHERE question LIKE '%" . mysqli_real_escape_string($con, $searchQuery) . "%'";
} elseif (!empty($topicQuery) && !empty($searchQuery)) {
    $sql .= "WHERE topic='$topicQuery' AND question LIKE '%" . mysqli_real_escape_string($con, $searchQuery) . "%'";
} elseif (!empty($topicQuery) && empty($searchQuery)) {
    $sql .= " WHERE topic='$topicQuery'";
} else {
}

$result = mysqli_query($con, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

// Fetch data and store it in an array
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $test_topic_number = $row['topic'];
    $select_topic = "SELECT * FROM `test_topic` WHERE `sno`='$test_topic_number'";
    $select_topic_qry = mysqli_query($con, $select_topic);
    $topic_name = mysqli_fetch_assoc($select_topic_qry)['topic_name'];
    $data[] = array(
        'sno' => $row['sno'],
        'question' => htmlspecialchars($row['question']),
        'option_1' => htmlspecialchars($row['option_a']),
        'option_2' => htmlspecialchars($row['option_b']),
        'option_3' => htmlspecialchars($row['option_c']),
        'option_4' => htmlspecialchars($row['option_d']),
        'correct_answer' => htmlspecialchars($row['correct_answer']),
        'topic_name' => $topic_name
    );
}


// Send the data as JSON response
header("Content-type: application/json");
echo json_encode($data);
// echo ($data);
