<?php
include "db.php";

$id = $_GET['id'];

$query = "DELETE FROM flowers WHERE id='$id'";
mysqli_query($conn, $query);

header("Location: view_flower.php");
?>
