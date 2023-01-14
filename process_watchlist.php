<?php

include_once "database.php";
session_start();
if (!isset($_POST['functionname']) || !isset($_POST['arguments'])) {
    return;
}

// Extract arguments from the POST variables:
$item_id = (int) $_POST['arguments'][0];
// $item_id_2 = $_SESSION['item_id'];
$user_id = $_SESSION['user_id'];
// echo $item_id;

$res = "fail";
if ($_POST['functionname'] == "add_to_watchlist") {
    // TODO: Update database and return success/failure.
    $sql = "INSERT INTO `watchlist`(`user_id`, `item_id`) VALUES (?,?)";
    try {
        prepare_bind_excecute($sql, 'ii', $user_id, $item_id);
        $res = "success";
    } catch (Exception) {
        $res = 'dupulicate data';
    }
} else if ($_POST['functionname'] == "remove_from_watchlist") {
    // TODO: Update database and return success/failure.
    $sql = "DELETE FROM `watchlist` WHERE item_id = ?";
    try {
        prepare_bind_excecute($sql, 'i', $item_id);
        $res = "success";
    } catch (Exception) {
    }
}
// Note: Echoing from this PHP function will return the value as a string.
// If multiple echo's in this file exist, they will concatenate together,
// so be careful. You can also return JSON objects (in string form) using
// echo json_encode($res).
echo $res;
