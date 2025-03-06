<?php

global $db;
$image = $image_name = $category = $description = $file_name = $temp_name = $folder = "";

$id = $_GET['id'];

$row = $db->read("tb_categories", "*", "category_id = $id");
if ($row){
    $image = $row["image"];
    $category = $row["name"];
    $description = $row["description"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["modify"])) {
        $category = $_POST["category"];
        $description = $_POST["description"];
        $file_name = $_FILES["image"]["name"];

        if ($category == "" || $category == null) {
            die("Category cannot be empty");
        }

        if ($description == "" || $description == null) {
            die("Description cannot be empty");
        }

        if ($file_name == "" || $file_name == null) {
            $image_name = $image;
        }else{
            $image_name = $file_name;
            $temp_name = $_FILES["image"]["tmp_name"];
            $folder = "uploads/images/categories/" . $file_name;
            if (!move_uploaded_file($temp_name, $folder)){
                die("Error uploading file");
            }
        }

        $data = [
                'name' => $category,
                'description' => $description,
                'image' => $file_name,
        ];

        try {
            if (!$db->update("tb_categories", $data, "category_id = $id")) {
                die("Error update category");
            }
        }catch (Exception $e){
            echo $e->getMessage();
        }

    }
}

?>


<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Category</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="index.php?p=category&id=<?=$id?>" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Image file</label>
                                <input class="form-control" type="file" name="image" id="formFile" accpet="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Category</label>
                                <input type="text" class="form-control" name="category" value="<?=$category?>" id="" aria-describedby="emailHelp">
                                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="" rows="3"><?=$description?></textarea>
                            </div>
                            <button type="submit" name="modify" class="btn btn-primary">modify</button>
                            <a href="index.php?p=category" class="btn btn-primary m-1">Create new Category</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>