<?php
/**
 * Created by PhpStorm.
 * User: tammy
 * Date: 2019-02-26
 * Time: 15:13
 */


require 'db.php';

// adds new item
if(isset($_POST['addEntry'])) {
    $query = "INSERT INTO todo (title,description) VALUES ('" . $_POST['title']. "','" . $_POST['description'] ."')";

//    echo $query;

    if ($mysql->query($query) ) {
        header("location: index.php");
    } else die($mysql->error);
}

?>