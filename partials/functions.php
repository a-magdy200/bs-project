<?php
function checkDB($table,$col,$item) {
    global $con;
    $query = $con->prepare("SELECT * FROM $table WHERE $col=?");
    $query->execute(array($item));
    return $query->rowCount() > 0;
}
function onVideoRating($video_id, $user_id, $user_rating) {

    global $con;
    //Get Current Video Data
    $query2 = $con->prepare("SELECT * FROM `user_rating_videos` WHERE `user_id`=? AND `video_id`=?");
    $query2->execute(array($user_id, $video_id));

    if ($query2->rowCount() == 0) {

        $query = $con->prepare("SELECT * FROM `videos` WHERE id=?");
        $query->execute(array($video_id));
        $video_data = $query->fetchAll(PDO::FETCH_ASSOC)[0];
        //Calculate New Values
        $total_rating_count = $video_data['total_rating_count'] + 1;
        $total_rating = $video_data['total_rating'] + $user_rating;
        $new_average_rating = $total_rating / $total_rating_count;
        //Update Video Data
        $query = $con->prepare("UPDATE `videos` SET `total_rating_count`=?, `total_rating`=?, `average_rating`=? WHERE `id`=?");
        $query->execute(array($total_rating_count, $total_rating, $new_average_rating, $video_id));

        $query3 = $con->prepare("INSERT INTO `user_rating_videos` (`user_id`,`video_id`,`rating`) VALUES (?,?,?)");
        $query3->execute(array($user_id, $video_id, $user_rating));
        return array("success" => $query->rowCount() > 0 && $query3->rowCount() > 0);
    } else {
        return array("success" => false, "error" => "Already Exists.");
    }

}
function upload_files($file, $type) {
    if ($type == "image") {

        $target_dir = "images/uploads/profile/";
        $max_size = 500000;

    } else if ($type == "video") {
        $target_dir = "uploads/videos/";
        $max_size = 100000000;
    }
    $target_file = $target_dir ."_". time() ."_". basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($file["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    // Never True statement
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($file["size"] > $max_size) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($type == "image") {
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
    } else if ($type == "video") {
        if ($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "ogg") {
            echo "Sorry, only MP4, AVI & OGG files are allowed.";
            $uploadOk = 0;
        }
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            echo "The file ". basename( $file["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    return $uploadOk ? $target_file : false;
}
function get_categories_info()
{


    /**/
    $categoriesUrl = "https://www.googleapis.com/youtube/v3/videoCategories?part=snippet&regionCode=US&key=" . $DEVELOPER_KEY;
    /*
     * Send Request and receive data
     * */
    $ch = curl_init();  // prepare the url

//Set the URL that you want to GET by using the CURLOPT_URL option.
    curl_setopt($ch, CURLOPT_URL, $categoriesUrl);

//Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

//Execute the request.
    $data = curl_exec($ch);

//Close the cURL handle.
    curl_close($ch);
    $dataArray = json_decode($data);
    return json_encode($dataArray);
}
function includeFileWithVariables($fileName, $variables) {
    extract($variables);
    include($fileName);
}
function sortVideos($array) {
/*Method 1*/
    $rating = array();
    foreach ($array as $key => $video) {
        $rating[$key] = $video['rating'];
    }
    array_multisort($rating, SORT_DESC, $array);
/*Method 2*/
    usort($array, function ($a, $b) {
        if ($a['rating'] == $b['rating']) {
            return 0;
        } else if ($a['rating'] > $b['rating']) {
            return -1;
        } else {
            return 1;
        }
    });
    return $array;
}