<?php

require "../lib/database.php";
$db = new Database();

$id =  $_GET['id'];

if ($db->delete("tb_products", "product_id = '$id'"))
    header("location: ../index.php?p=product");

?>