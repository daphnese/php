<?php

global $db;

$image = $product_id = $name = $category_id = $price = $stock_quantity = $description = $temp_name = $path = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["create"])) {
        $image = $_FILES["image"]["name"];
        $name = $_POST["name"];
        $category_id = $_POST["category_id"];
        $price = $_POST["price"];
        $stock_quantity = $_POST["stock_quantity"];
        $description = $_POST["description"];
        $temp_name = $_FILES["image"]["tmp_name"];
        $path = "uploads/images/products/" . $image;

        $data = [
            "name" => $name,
            "category_id" => $category_id,
            "price" => $price,
            "stock_quantity" => $stock_quantity,
            "description" => $description,
            "image" => $image
        ];

        try {
            if (!$db->create("tb_products", $data))
                die("product not created");
            if (!move_uploaded_file($temp_name, $path)) {
                die("failed to upload image");
            }
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
                        <form action="index.php?p=product" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="" class="form-label">Product name</label>
                                <input type="text" name="name" class="form-control" id="" aria-describedby="emailHelp">
<!--                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>-->
                            </div>
                            <select class="form-select" name="category_id" aria-label="Default select example">
                                <option selected disabled>Category</option>
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
                                <input type="number" name="price" class="form-control" id="">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Stock Quantity</label>
                                <input type="number" name="stock_quantity" class="form-control" id="">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Image</label>
                                <input class="form-control" type="file" name="image" id="formFile">
                            </div>
                            <button type="submit" name="create" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


