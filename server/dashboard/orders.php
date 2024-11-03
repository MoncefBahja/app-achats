<?php
session_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';

// Orders class
require_once BASE_PATH . '/lib/Orders/Orders.php';
$orders = new Orders();

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
$select = array('id', 'user_id', 'status', 'total', 'created_at');

//Start building query according to input parameters.
// If search string
if ($search_string) {
    $stmt = $pdo->prepare('SELECT * FROM orders WHERE name LIKE :search');
    $stmt->bindValue(':search', '%' . $search_string . '%');
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


//If order by option selected
if ($order_by) {
    $stmt = $pdo->prepare("SELECT * FROM orders ORDER BY $filter_col $order_by");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Set pagination limit
$offset = ($page - 1) * $pagelimit;
$stmt = $pdo->prepare("SELECT * FROM orders LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $pagelimit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Get result of the query.
$offset = ($page - 1) * $pagelimit;
$stmt = $pdo->prepare("SELECT COUNT(*) FROM orders");
$stmt->execute();
$total_rows = $stmt->fetchColumn();

$total_pages = ceil($total_rows / $pagelimit);

$stmt = $pdo->prepare("SELECT * FROM orders LIMIT :limit OFFSET :offset");
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
            <h1 class="page-header">Orders</h1>
        </div>
    </div>
    <?php include BASE_PATH . '/includes/flash_messages.php'; ?>

    <!-- Filters -->
    <div class="well text-center filter-form">
        <form class="form form-inline" action="">
            <label for="input_search">Search</label>
            <input type="text" class="form-control" id="input_search" name="search_string" value="<?php echo xss_clean($search_string); ?>">
            <label for="input_order">Order By</label>
            <select name="filter_col" class="form-control">
                <?php
                foreach ($orders->setOrderingValues() as $opt_value => $opt_name) : ($order_by === $opt_value) ? $selected = 'selected' : $selected = '';
                    echo ' <option value="' . $opt_value . '" ' . $selected . '>' . $opt_name . '</option>';
                endforeach;
                ?>
            </select>
            <select name="order_by" class="form-control" id="input_order">
                <option value="Asc" <?php
                                    if ($order_by == 'Asc') {
                                        echo 'selected';
                                    }
                                    ?>>Asc</option>
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
        <a href="export_orders.php"><button class="btn btn-sm btn-primary">Export to CSV <i class="glyphicon glyphicon-export"></i></button></a>
    </div>

    <!-- Table -->
    <table class="table table-striped table-bordered table-condensed text-center">
        <thead>
            <tr>
                <th width="2%" class="text-center">ID</th>
                <th width="15%" class="text-center">User</th>
                <th width="5%" class="text-center">Status</th>
                <th width="10%" class="text-center">Total</th>
                <th width="5%" class="text-center">Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row) : ?>
                <tr>
                    <td style="vertical-align: middle;"><?php echo $row['id']; ?></td>
                    <?php
                    $stmt = $pdo->prepare("SELECT * FROM users WHERE id=:user_id");
                    $stmt->bindParam(':user_id', $row['user_id']);
                    $stmt->execute();
                    $order_user_name = $stmt->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <td style="vertical-align: middle;"><?php echo xss_clean($order_user_name['fullname']); ?></td>
                    <td style="vertical-align: middle;"><?php echo xss_clean($row['status']); ?></td>
                    <td style="vertical-align: middle;"><?php echo xss_clean($row['total']); ?></td>
                    <td style="vertical-align: middle;"><?php echo xss_clean($row['created_at']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- //Table -->

    <!-- Pagination -->
    <div class="text-center">
        <?php echo paginationLinks($page, $total_pages, 'orders.php'); ?>
    </div>
    <!-- //Pagination -->
</div>
<!-- //Main container -->
<?php include BASE_PATH . '/includes/footer.php'; ?>