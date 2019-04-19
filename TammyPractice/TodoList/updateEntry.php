<?php
/**
 * Created by PhpStorm.
 * User: tammy
 * Date: 2019-02-26
 * Time: 16:31
 */

require 'db.php';

$response = update_by_id($_POST['id'], $_POST['description']);


//if(isset($_POST['completedTask'])){
//    $query = "SELECT * FROM todo WHERE id =". $id;
//    $result = $mysql->query($query);
//    $query2 = "UPDATE todo SET done = '" . 1 . "' WHERE id=" . $id . "AND done=". 0;
//    $result2 = $mysql->query($query2);
//    if($result2){
//        header('location: index.php');
//    }
//
//}




?>