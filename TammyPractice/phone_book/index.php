<?php
/**
 * Created by PhpStorm.
 * User: tammy
 * Date: 2019-03-11
 * Time: 13:32
 */


$sqlDB = new mysqli ("phishproof-mysql", "root", "mysql123", "phone_book");



if (isset($_POST['operation'])) {

    if ($_POST['operation'] === "add") {


        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $result = $sqlDB->query("select * from contacts where ='" . $firstName . "'");

        if ($result->num_rows === 0) {
            $query = "INSERT INTO contacts (favorite, first_name, last_name, email, mobile) 
                      VALUES (null, '$firstName', '$lastName', '$email', '$mobile')";
            $sqlDB->query($query);
        }
        //header('location: index.php?sortBy=' . $sortBy . '&order=' . $order);
    }


}





?>






<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Contacts List</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/regular.min.css">
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>
</head>


<body class="container">
<h2 style="margin-top: 30px">Add Contacts</h2>

<table class="table table-bordered">
    <thead class="table-success">
    <tr>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Mobile Phone</th>
        <th scope="col">Email Address</th>
        <th scope="col">Action</th>
    </tr>
    </thead>

    <tbody>
    <tr>
        <form action="" method="POST" id="addContact">


        <td >
            <input type="text" name="firstname" id="firstname" value="">
        </td>

        <td>
            <input type="text" name="lastname" id="lastname" value="">
        </td>

        <td>
            <input type="number" name="mobile" id="mobile" value="">
        </td>

        <td>
            <input type="email" name="email" id="email" value="">
        </td>


            <input type="hidden" name="contact">
            <input type="hidden" name="operation" value="add">
        </form>

        <td>
            <button type="submit" form="addContact" value="Submit" class="btn btn-primary">ADD</button>
        </td>
    </tr>
    </tbody>
</table>


<h2>Current Contact List</h2>
<table class="table table-bordered">
    <thead class="table-primary">
    <tr>
        <th scope="col">Favorite</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Mobile Phone</th>
        <th scope="col">Email Address</th>
        <th scope="col">Action</th>
    </tr>
    </thead>

    <tbody>
    <tr>
        <td scope="row"><img src="favicon.ico" style="margin-left: 20px"></td>
        <td scope="row">
            <input>

            <button class="btn btn-primary" style="margin-top: 10px">Save <i class="far fa-save"></i></button>
        </td>
        <td>
            <input>

            <button class="btn btn-primary" style="margin-top: 10px" >Save <i class="far fa-save"></i></button>
        </td>
        <td>
            <input>

            <button class="btn btn-primary" style="margin-top: 10px" >Save <i class="far fa-save"></i></button>
        </td>
        <td>
            <input>

            <button class="btn btn-primary" style="margin-top: 10px">Save <i class="far fa-save"></i></button>
        </td>
        <td>
            <button class="btn btn-info" style="width: 110px;">Favorite <i class="far fa-star"></i>
            <button class="btn btn-danger" style="margin-top: 10px; width: 110px">Delete <i class="far fa-trash-alt"></i></button>
        </td>
    </tr>
    </tbody>
</table>

</body>
</html>