<div class="container-fluid">
    <?php
        $page = "create.php";

        if (isset($_GET['id'])) {
            $page = "update.php";
        }else
            $page = "create.php";

        include "./category/$page";
        include "./category/selectAll.php";
    ?>
</div>