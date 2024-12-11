<?php
include "connect.php";

    $id = $_GET['id'];

    echo $id;

    $sql = "DELETE FROM table_Students WHERE id = $id";

    mysqLi_query($conn, $sql);

    header ('location: index.php');
?>