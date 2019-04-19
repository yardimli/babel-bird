<?php
/**
 * Created by PhpStorm.
 * User: tammy
 * Date: 2019-02-26
 * Time: 16:25
 */

require 'db.php';

$response = delete_by_id($_GET['id']);
header("Location: index.php");


?>