<?php
session_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';

// Costumers class
require_once BASE_PATH . '/lib/Products/Products.php';
$products = new Products();

// Get Input data from query string
$search_string = filter_input(INPUT_GET, 'search_string');
$filter_col = filter_input(INPUT_GET, 'filter_col');
$order_by = filter_input(INPUT_GET, 'order_by');

// Per page limit for pagination.
$pagelimit = 15;

// Get current page.
$page = filter_input(INPUT_GET, 'page');
if (!$page) {
	$page = 1;
}

// If filter types are not selected we show latest added data first
if (!$filter_col) {
	$filter_col = 'id';
}
if (!$order_by) {
	$order_by = 'Desc';
}

//Get DB instance. i.e instance of MYSQLiDB Library
$pdo = getDbInstance();
$select = array('id', 'name', 'description', 'price', 'stock', 'category_id', 'subcategory_id', 'image_url' , 'created_at');

//Start building query according to input parameters.
// If search string
if ($search_string) {
    $stmt = $pdo->prepare('SELECT * FROM products WHERE name LIKE :search');
    $stmt->bindValue(':search', '%' . $search_string . '%');
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


//If order by option selected
if ($order_by) {
    $stmt = $pdo->prepare("SELECT * FROM products ORDER BY $filter_col $order_by");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Set pagination limit
$offset = ($page - 1) * $pagelimit;
$stmt = $pdo->prepare("SELECT * FROM products LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $pagelimit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Get result of the query.
$offset = ($page - 1) * $pagelimit;
$stmt = $pdo->prepare("SELECT COUNT(*) FROM products");
$stmt->execute();
$total_rows = $stmt->fetchColumn();

$total_pages = ceil($total_rows / $pagelimit);

$stmt = $pdo->prepare("SELECT * FROM products LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $pagelimit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


include BASE_PATH . '/includes/header.php';
?>
<!-- Main container -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Products</h1>
        </div>
        <div class="col-lg-6">
            <div class="page-action-links text-right">
                <a href="add_product.php?operation=create" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Add new</a>
            </div>
        </div>
    </div>
    <?php include BASE_PATH . '/includes/flash_messages.php';?>

    <!-- Filters -->
    <div class="well text-center filter-form">
        <form class="form form-inline" action="">
            <label for="input_search">Search</label>
            <input type="text" class="form-control" id="input_search" name="search_string" value="<?php echo xss_clean($search_string); ?>">
            <label for="input_order">Order By</label>
            <select name="filter_col" class="form-control">
                <?php
foreach ($products->setOrderingValues() as $opt_value => $opt_name):
	($order_by === $opt_value) ? $selected = 'selected' : $selected = '';
	echo ' <option value="' . $opt_value . '" ' . $selected . '>' . $opt_name . '</option>';
endforeach;
?>
            </select>
            <select name="order_by" class="form-control" id="input_order">
                <option value="Asc" <?php
if ($order_by == 'Asc') {
	echo 'selected';
}
?> >Asc</option>
                <option value="Desc" <?php
if ($order_by == 'Desc') {
	echo 'selected';
}
?>>Desc</option>
            </select>
            <input type="submit" value="Go" class="btn btn-primary">
        </form>
    </div>
    <hr>
    <!-- //Filters -->


    <div id="export-section">
        <a href="export_products.php"><button class="btn btn-sm btn-primary">Export to CSV <i class="glyphicon glyphicon-export"></i></button></a>
    </div>

    <!-- Table -->
    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="5%">Image</th>
                <th width="10%">Name</th>
                <th width="40%">Description</th>
                <th width="10%">Price</th>
                <th width="10%">Stock</th>
                <th width="10%">Category Name</th>
                <th width="10%">Subcategory Name</th>
                <th width="10%">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td>
                    <img src="../../assets/images/products/<?php echo $row['image_url']; ?>" width="100%">
                </td>
                <td><?php echo xss_clean($row['name']); ?></td>
                <td><?php echo xss_clean($row['description']); ?></td>
                <td><?php echo xss_clean($row['price']); ?></td>
                <td><?php echo xss_clean($row['stock']); ?></td>
                <?php 
                    $stmt = $pdo->prepare("SELECT * FROM categories WHERE id=:category_id");
                    $stmt->bindParam(':category_id', $row['category_id']);
                    $stmt->execute();
                    $category_name = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>
                <td><?php echo xss_clean($category_name['name']); ?></td>
                <?php 
                    $stmt = $pdo->prepare("SELECT * FROM subcategories WHERE id=:subcategory_id");
                    $stmt->bindParam(':subcategory_id', $row['subcategory_id']);
                    $stmt->execute();
                    $subcategory_name = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>
                <td><?php echo xss_clean($subcategory_name['name']); ?></td>
                <td>
                    <a href="edit_product.php?product_id=<?php echo $row['id']; ?>&operation=edit" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i></a>
                    <a href="#" class="btn btn-danger delete_btn" data-toggle="modal" data-target="#confirm-delete-<?php echo $row['id']; ?>"><i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="confirm-delete-<?php echo $row['id']; ?>" role="dialog">
                <div class="modal-dialog">
                    <form action="delete_product.php" method="POST">
                        <!-- Modal content -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Confirm</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="del_id" id="del_id" value="<?php echo $row['id']; ?>">
                                <p>Are you sure you want to delete this row?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-default pull-left">Yes</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- //Delete Confirmation Modal -->
            <?php endforeach;?>
        </tbody>
    </table>
    <!-- //Table -->

    <!-- Pagination -->
    <div class="text-center">
    <?php echo paginationLinks($page, $total_pages, 'products.php'); ?>
    </div>
    <!-- //Pagination -->
</div>
<!-- //Main container -->
<?php include BASE_PATH . '/includes/footer.php';?>
