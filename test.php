<?php
$data = array(
    array(
        "id" =>1,
        "key"=> 3
    ),array(
        "id" =>2,
        "key"=> 2.7
    ),array(
        "id" =>3,
        "key"=> 4.3
    ),array(
        "id" =>4,
        "key"=> 2
    ),array(
        "id" =>5,
        "key"=> 3.5
    ),array(
        "id" =>6,
        "key"=> 5
    ),array(
        "id" =>7,
        "key"=> 4
    ),array(
        "id" =>8,
        "key"=> 2
    )
);
echo "<pre>";
var_dump($data);
$data2 = $data;
usort($data2, function ($a, $b) {return $a['key'] > $b['key'];});
var_dump($data2);
echo "</pre>";
require_once "partials/init.php";
for ($i = 0; $i < 18; $i++) {
    $query = $con->prepare("UPDATE videos SET average_rating=? WHERE id=?");
    $rating = rand(1, 100) * 0.05;
    $query->execute(array($rating,$i));
}