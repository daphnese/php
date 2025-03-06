<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Image</th>
            <th scope="col">Product</th>
            <th scope="col">Category</th>
            <th scope="col">Price</th>
            <th scope="col">Stock Quantity</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
    global $db;
    $products = $db->read("tb_products");
    foreach ($products as $product) {
    ?>
        <tr>
            <th scope="row"><?=$product['product_id']?></th>
            <td><img src="uploads/images/products/<?=$product['image']?>" alt="<?=$product['image']?>" width="200px" /></td>
            <td><?=$product['name']?></td>
            <td><?=$product['category_id']?></td>
            <td><?=$product['price']?></td>
            <td><?=$product['stock_quantity']?></td>
            <td><?=$product['description']?></td>
            <td>
                <a href="index.php?p=product&id=<?=$product['product_id']?>" class="btn btn-warning m-1">Update</a>
                <a href="./product/delete.php?id=<?=$product['product_id']?>" class="btn btn-danger m-1">Delete</a>
            </td>
        </tr>
    <?php
        }
    ?>
    </tbody>
</table>