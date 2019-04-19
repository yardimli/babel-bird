
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="default.css" />
    <title>To-Do List Practice 1</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
</head>

<body>

<div id="container">

<h1>My to-Do List</h1>

<ul id="tabs">
    <li id="todo_tab" class="selected"><a href="#">To-Do</a></li>
</ul>

<div id="main">

<div id="todo">

<?php
require 'db.php';//This require_once is used to link to the file we need for this page-
$query = "SELECT * FROM todo ORDER BY id asc";
$results = $mysql->query($query);

if($results->num_rows) {
    while($row = $results->fetch_object()) {
        $title = $row->title;
        $description = $row->description;
        $id = $row->id;
        $done = $row->done;

        echo '<div class="item">';

        $data = <<<EOD
<h4> $title </h4> 
<p> $description </p> 
  
<input type="hidden" name="id" id="id" value="$id" /> 
<input type="hidden" name="done" id="done" value="$done" /> 
  
<div class="options"> 
    <a class="editEntry" href="#">Edit</a> 
    <a  name ='completedTask' class="completedTask" href="updateEntry.php?id=$id">Done</a> 
    <a class="deleteEntryAnchor" href="delete.php?id=$id">Delete</a> 
</div> 

EOD;

        echo $data;
        echo '</div>';
    } // end while
} else {
    echo "<p>There are zero items. Add one now!</p>";
}
?>
</div><!--end todo wrap-->


<div id="addNewEntry">
    <hr />
    <h2>Add New Entry</h2>
    <form action="addItem.php" method="post">
        <p>
            <label for="title"> Title</label>
            <input type="text" name="title" id="title" class="input"/>
        </p>

        <p>
            <label for="description"> Description</label>
            <textarea name="description" id="description" rows="10" cols="35"></textarea>
        </p>

        <p>
            <input type="submit" name="addEntry" id="addEntry" value="Add New Entry" />
        </p>
    </form>
</div><!-- end add new entry -->

</div><!-- end main-->
</div><!--end container-->

</body>
</html>



