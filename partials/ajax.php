<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["type"] == "ajax") {
    require_once "connect.php";
    require_once "functions.php";
    if ($_POST['action'] == 'rating') {
        $video_id = $_POST['video_id'];
        $user_id = $_POST['user_id'];
        $rating = intval($_POST['rating']);
        $result = onVideoRating($video_id, $user_id, $rating);
        echo json_encode($result);
    }
}