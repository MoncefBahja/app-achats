<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

//Get DB instance. function is defined in config.php
$pdo = getDbInstance();

//Get Dashboard information
$stmt = $pdo->prepare('SELECT COUNT(*) FROM users');
$stmt->execute();
$numCustomers = $stmt->fetchColumn();

$stmt = $pdo->prepare('SELECT COUNT(*) FROM products');
$stmt->execute();
$numProducts = $stmt->fetchColumn();

$stmt = $pdo->prepare('SELECT COUNT(*) FROM categories');
$stmt->execute();
$numCategories = $stmt->fetchColumn();

$stmt = $pdo->prepare('SELECT COUNT(*) FROM orders');
$stmt->execute();
$numOrders = $stmt->fetchColumn();

$stmt = $pdo->prepare('SELECT COUNT(*) FROM suppliers');
$stmt->execute();
$numSuppliers = $stmt->fetchColumn();

include_once('includes/header.php');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-2 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: hsl(353, 100%, 78%);">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $numCustomers; ?></div>
                            <div>Customers</div>
                        </div>
                    </div>
                </div>
                <a href="customers.php">
                    <div class="panel-footer">
                        <span class="pull-left" style="color: black;">View Details</span>
                        <span class="pull-right" style="color: black;"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: hsl(353, 100%, 78%);">
                    <div class="row">
                        <div class="col-xs-3">
                        <i class="fa fa-cubes fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $numProducts; ?></div>
                            <div>Products</div>
                        </div>
                    </div>
                </div>
                <a href="products.php">
                    <div class="panel-footer">
                        <span class="pull-left" style="color: black;">View Details</span>
                        <span class="pull-right" style="color: black;"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: hsl(353, 100%, 78%);">
                    <div class="row">
                        <div class="col-xs-3">
                        <i class="fa-solid fa-bars-progress fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $numCategories; ?></div>
                            <div>Categories</div>
                        </div>
                    </div>
                </div>
                <a href="categories.php">
                    <div class="panel-footer">
                        <span class="pull-left" style="color: black;">View Details</span>
                        <span class="pull-right" style="color: black;"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: hsl(353, 100%, 78%);">
                    <div class="row">
                        <div class="col-xs-3">
                        <i class="fa fa-truck-fast fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $numOrders; ?></div>
                            <div>Orders</div>
                        </div>
                    </div>
                </div>
                <a href="orders.php">
                    <div class="panel-footer">
                        <span class="pull-left" style="color: black;">View Details</span>
                        <span class="pull-right" style="color: black;"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: hsl(353, 100%, 78%);">
                    <div class="row">
                        <div class="col-xs-3">
                        <i class="fa-solid fa-boxes-packing fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $numSuppliers; ?></div>
                            <div>Suppliers</div>
                        </div>
                    </div>
                </div>
                <a href="suppliers.php">
                    <div class="panel-footer">
                        <span class="pull-left" style="color: black;">View Details</span>
                        <span class="pull-right" style="color: black;"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-8">


            <!-- /.panel -->
        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4">

            <!-- /.panel .chat-panel -->
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

<?php include_once('includes/footer.php'); ?>
