<?php

global $db;

$image = $old_image = $product_id = $name = $category_id = $category = $price = $stock_quantity = $description = $temp_name = $path = "";
$id = $_GET['id'];

//$row = $db->read("tb_categories AS c INNER JOIN tb_products p ON c.category_id = p.category_id", "p.product_id, p.image, p.name, p.price, p.category_id, p.description, p.stock_quantity, c.name AS category", "product_id='$id'");
$row = $db->read("tb_products", "*", "product_id = $id");
if ($row){
    $old_image = $row["image"];
    $name = $row["name"];
    $category_id = $row["category_id"];
    $price = $row["price"];
    $stock_quantity = $row["stock_quantity"];
    $description = $row["description"];
}

$row1 = $db->read("tb_categories", "*", "category_id = $category_id");
if ($row1){
    $category = $row1["name"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["update"])) {
        $image = $_FILES["image"]["name"];
        $name = $_POST["name"];
        $category_id = $_POST["category_id"];
        $price = $_POST["price"];
        $stock_quantity = $_POST["stock_quantity"];
        $description = $_POST["description"];

        if ($image != "") {
            $temp_name = $_FILES["image"]["tmp_name"];
            $path = "uploads/images/products/" . $image;
            if (!move_uploaded_file($temp_name, $path))
                die("Could not move the file.");
        }else{
            $image = $old_image;
        }

        $data = [
            "name" => $name,
            "category_id" => $category_id,
            "price" => $price,
            "stock_quantity" => $stock_quantity,
            "description" => $description,
            "image" => $image
        ];

        try {
                if (!$db->update("tb_products", $data, "product_id = $id"))
                die("product not created");
        }catch (PDOException $e){
            echo $e->getMessage();
        }

    }
}

?>

<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Forms</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="index.php?p=product&id=<?=$id?>" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="" class="form-label">Product name</label>
                                <input type="text" name="name" value="<?=$name?>" class="form-control" id="" aria-describedby="emailHelp">
                                <!--                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>-->
                            </div>
                            <select class="form-select" name="category_id" aria-label="Default select example">
                                <option selected disabled value="<?=$category_id?>"><?=$category?></option>
                                <?php
                                $categories = $db->read("tb_categories");
                                foreach ($categories as $category) {
                                    ?>
                                    <option value="<?=$category['category_id']?>"><?=$category['name']?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <div class="mb-3">
                                <label for="" class="form-label">Price</label>
                                <input type="number" name="price" value="<?=$price?>" class="form-control" id="">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Stock Quantity</label>
                                <input type="number" name="stock_quantity" value="<?=$stock_quantity?>" class="form-control" id="">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"><?=$description?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Image</label>
                                <input class="form-control" type="file" name="image" id="formFile">
                            </div>
                            <button type="submit" name="update" class="btn btn-primary">Submit</button>
                            <a href="index.php?p=product" class="btn btn-primary m-1">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


