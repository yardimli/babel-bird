<!--/**-->
<!-- * Created by PhpStorm.-->
<!-- * User: tammy-->
<!-- * Date: 2019-02-27-->
<!-- * Time: 18:52-->
<!-- */-->
<?php

$mysqlDB = mysqli_connect("phishproof-mysql", "root", "mysql123", "todo");

//$mysqlDB = new mysqli ("phishproof-mysql", "root", "mysql123", "todo");


if (isset($_POST['operation'])) {

    if ($_POST['operation'] === "addtask") {

        $name = $_POST['name'];
        $result = $mysqlDB->query("select * from todo2 where description='" . $name . "'");

        if ($result->num_rows === 0) {
            $query = "INSERT INTO todo2 (description) VALUES ('$name')";
            $mysqlDB->query($query);
        }
        header('location: index.php');
    }


//   $query = "INSERT INTO todo2  VALUES (null, \"$_POST[name]\")";
//    $mysqlDB->query("INSERT INTO todo2  VALUES (null, \"$_POST[name]\")");
//    $mysqlDB->query("INSERT INTO todo2 (description) VALUES ($_POST[name])");


    if ($_POST['operation'] === "delete") {
        $id = $_POST['id'];
        $query = "DELETE FROM todo2 where id =" . $id;
        $mysqlDB->query($query);
//    mysqli_query($mysqlDB, "DELETE FROM task WHERE id=".$id);
        header('location:index.php');


    }

    if ($_POST['operation'] === "urgent") {
        $id = $_POST['id'];


        $query1 = "SELECT * FROM todo2 WHERE id =" . $id;
        $result = $mysqlDB->query($query1);
        $row_urgent = $result->fetch_assoc();

        if ($row_urgent["urgent"] === "0"){
        $query = "UPDATE todo2 SET urgent = '1' where id =" . $id;
        $mysqlDB->query($query);
        } else{
        $query = "UPDATE todo2 SET urgent = '0' where id =" . $id;
        $mysqlDB->query($query);
        }



        header('location:index.php');
    }

    if ($_POST['operation'] === "edit") {
        $id = $_POST['id'];
        $description = $_POST['task'];
        $query = "UPDATE todo2 SET description ='" . $description . "' where id =" . $id;
//      echo $query;
        $mysqlDB->query($query);
        header('location:index.php');
    }


    if ($_POST['operation'] === "done") {
        $id = $_POST['id'];

        $doneValue = "SELECT * FROM todo2 WHERE id =" . $id . " AND done=0";
        $query_result = $mysqlDB->query($doneValue);


        if($query_result->num_rows===1){
        $query = "UPDATE todo2 SET done = '1' where id =" . $id;
        $mysqlDB->query($query);
        }
        else {
        $query = "UPDATE todo2 SET done = '0' where id =" . $id;
        $mysqlDB->query($query);
        }
        header('location:index.php');
    }


}

//if($_GET['ID'])
//{
//
//    $asc_ID = "SELECT * FROM todo2 ORDER BY id ASC";
//    $desc_ID = "SELECT * FROM todo2 ORDER BY id DESC ";

//    if(){
//    $result = $mysqlDB->query($asc_ID);
//    }else{
//    $result = $mysqlDB->query($desc_ID);
//    }
//}else
//    if(isset($_POST['TASK']))
//    {
//        $asc_task = "SELECT * FROM todo2 ORDER by description DESC ";
//        $desc_task = "SELECT * FROM todo2 ORDER by description DESC ";
//
//        if(){
//        $result = $mysqlDB->query($asc_task);
//        $result = $mysqlDB->query($desc_task);
//        }
//    }

?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Todo List Practice 2</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/regular.min.css">
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>
</head>

<style type="text/css">

    .strikethrough {
        text-decoration: line-through;
        background-color: gray;
        color: darkgray;
    }


    .important {
        color: red;

    }

</style>

<script type="text/javascript">

    //function click (){
    //
    //    <?php
    //     if($_POST['ID']===""){ ?>
    //        document.getElementsByName("ID").value = "0";
    //    <?php //}else
    //        if($_POST['ID']==="0"){ ?>
    //            document.getElementsByName("ID").value = "1";
    //        <?php}//else
    //            if($_POST['ID'] !== "" && $_POST['ID'] !== "0"){ ?>
    //            document.getElementsByName("ID").value = "0";
    <?php}// ?>
    //
    //}

</script>

<body class="container">
<h1>Todo List</h1>

<form action="" method="POST" id="nameform" class="form-inline">
    <div class="form-group">
        <input type="hidden" name="operation" value="addtask">
        <input type="text" name="name" class="form-control mr-3">
    </div>
    <button type="submit" form="nameform" value="Submit" class="btn btn-primary">Submit</button>
</form>

<h2>Current Todos</h2>
<table class="table" id="myToDoTable">
    <form action="index.php" method="POST">
    <therad>
        <th class="bg-info text-white">ID
            <button onclick="click()" type="submit" name="ID" value="" class="btn ID"><i class="far fa-arrow-alt-circle-up text-white"></i></button>
        </th>
        <th class="bg-info text-white">Task
            <button onclick="" type="submit" name="TASK" value="" class="btn Task"><i class="far fa-arrow-alt-circle-up text-white"></i></button>
        </th>
        <th class="bg-info text-white">
        </th>
    </therad>
    </form>
    <tbody>
    <?php



//    if($_POST["ID"]==="0" || $_POST["ID"]===""){
//    $query = "SELECT * FROM todo2 ORDER BY id ASC";
//    }else{
//    $query = "SELECT * FROM todo2 ORDER BY id DESC";
//    }

//    $sort_query = "";
//    $Id_asc = "SELECT * FROM todo2 ORDER BY id ASC";
//    $Id_desc = "SELECT * FROM todo2 ORDER BY id DESC ";
//    $Des_asc = "SELECT * FROM todo2 ORDER BY description ASC ";
//    $Des_desc = "SELECT * FROM todo2 ORDER BY description DESC ";

    $query = "SELECT * FROM todo2 ORDER BY id ASC";

    if ($result = $mysqlDB->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $isDone = $row['done'];
            $isUrgent = $row['urgent'];
            ?>
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td>
                    <form id="nameform<?php echo $row['id']; ?>" method="POST" class="form-inline">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="operation" value="edit">
                            <input class="form-control mr-3
                            <?php
                            if ($isDone === "1") { ?>
                                strikethrough
                                <?php
                            } if ($isUrgent === "1"){?>
                                important
                                <?php
                            }?>" type="text" name="task"
                                   value="<?php echo $row['description']; ?>"
                                <?php
                                if ($isDone === "1") {
                                echo 'readonly';
                            } ?>
                            >
                        </div>
                        <button type="submit" form="nameform<?php echo $row['id']; ?>" class="btn btn-primary" <?php if ($isDone === "1") {
                            echo "style=\"visibility: hidden\"";
                        }?>>Save <i
                                    class="far fa-save"></i>
                        </button>
                    </form>

                </td>

                <td>
                    <form method="POST" style="display: inline-block">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="operation" value="urgent">
                        <button type="submit" class="btn btn-warning"
                        <?php if ($isDone === "1") {
                            echo "style=\"visibility: hidden\"";
                        }?>>Mark Urgent</i></button>
                    </form>

                    <form method="POST" style="display: inline-block">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="operation" value="done">
                        <button type="submit" class="btn btn-info done">Done <i class="far fa-check-circle"></i></button>
                    </form>


                    <form method="POST" style="display: inline-block">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="operation" value="delete">
                        <button type="submit" class="btn btn-danger">Delete <i class="far fa-trash-alt"></i></button>
                    </form>

                </td>
            </tr>
            <?php
        }

    }


    ?>

    </tbody>
</table>
</body>
</html>




