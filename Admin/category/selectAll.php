<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Image</th>
            <th scope="col">Category</th>
            <th scope="col">Description</th>
            <th scope="col">Active</th>
        </tr>
    </thead>
    <tbody>

    <?php
        global $db;
        $categories = $db->read("tb_categories");
        foreach ($categories as $category) {
    ?>

        <tr>
            <th scope="row"><?=$category['category_id']?></th>
            <td><img src="uploads/images/categories/<?=$category['image']?>" width="200px" /></td>
            <td><?=$category['name']?></td>
            <td><?=$category['description']?></td>
            <td>
               <a href="index.php?p=category&id=<?=$category['category_id']?>" class="btn btn-warning m-1">Update</a>
                <a href="./category/delete.php?id=<?=$category['category_id']?>" class="btn btn-danger">Delete</a>
            </td>
        </tr>

    <?php
        }
    ?>
    </tbody>
</table>
