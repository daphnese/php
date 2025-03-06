<div class="container-fluid">
    <?php
        $page = "create.php";
        if (isset($_GET['id']))
            $page = "update.php";
        else
            $page = "create.php";

    include "./product/$page";
    include "./product/selectAll.php";
    ?>
</div>