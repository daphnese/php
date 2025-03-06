<?php

    require "../lib/database.php";
    $id = $_GET['id'];
    $db = new Database();

try {
    if ($db->delete("tb_categories", "category_id = '$id'")){
        header("Location: ../index.php?p=category");
    }
}catch (PDOException $e){
    echo $e->getMessage();
}

?>