<?php
/**
 * Created by PhpStorm.
 * User: tammy
 * Date: 2019-02-23
 * Time: 15:02
 */

$mysql = new mysqli
('phishproof-mysql',
    'root',
    'mysql123',
    'todo')
or die('problem');


function delete_by_id($id)
{
    $query = "DELETE from todo WHERE id =" . $id;
    $result = $mysql->query($query) or die ("There was a problem");

    if ($result) return 'yay!';
}


function update_by_id($id)
{
    $query = "UPDATE todo SET description = '" . $description . "' WHERE id = " . $id;

    $result = $mysql->query($query) or die ("There was a problem");

    if ($result) return "Good Job!";
}


//function done_by_id($id, $done)
//{
//    $query = "UPDATE todo SET done = 1  WHERE id = " . $id;
//
//    $result = $mysql->query($query) or die ("There was a problem");
//
//    if ($result) return "Good Job!";
//
//
//}



?>






