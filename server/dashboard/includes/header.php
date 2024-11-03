<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Administrator</title>

        <!-- Bootstrap Core CSS -->
        <link  rel="stylesheet" href="assets/css/bootstrap.min.css"/>

        <!-- MetisMenu CSS -->
        <link href="assets/js/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="assets/css/sb-admin-2.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="assets/fonts/fa/css/all.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="assets/js/jquery.min.js" type="text/javascript"></script>

    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <?php if (isset($_SESSION['admin_id']) && $_SESSION['admin_id'] == true): ?>
                <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php">Administrator</a>
                    </div>
                    <!-- /.navbar-header -->

                    <ul class="nav navbar-top-links navbar-right">
                        <!-- /.dropdown -->

                        <!-- /.dropdown -->
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-user fa-fw" style="color: black;"></i> <i class="fa fa-caret-down" style="color: black;"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#"><i class="fa fa-user fa-fw"></i> Profile</a>
                                </li>
                                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                                </li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <!-- /.dropdown -->
                    </ul>
                    <!-- /.navbar-top-links -->

                    <div class="navbar-default sidebar" role="navigation">
                        <div class="sidebar-nav navbar-collapse">
                            <ul class="nav" id="side-menu">
                                <li>
                                    <a href="index.php" style="color: black;"><i class="fa fa-dashboard fa-fw" style="color: black;"></i> Dashboard</a>
                                </li>

                                <li <?php echo (CURRENT_PAGE == "customers.php" || CURRENT_PAGE == "add_customer.php") ? 'class="active"' : ''; ?>>
                                    <a href="#" style="color: black;"><i class="fa fa-user-circle fa-fw" style="color: black;"></i> Customers<span class="fa arrow" style="color: black;"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="customers.php" style="color: hsl(353, 100%, 78%);"><i class="fa fa-list fa-fw"></i>List all</a>
                                        </li>
                                    <li>
                                        <a href="add_customer.php" style="color: hsl(353, 100%, 78%);"><i class="fa fa-plus fa-fw"></i>Add New</a>
                                    </li>
                                    </ul>
                                </li>
                                <li <?php echo (CURRENT_PAGE == "products.php" || CURRENT_PAGE == "add_product.php") ? 'class="active"' : ''; ?>>
                                    <a href="#" style="color: black;"><i class="fa fa-cubes" style="color: black;"> </i>  Products<span class="fa arrow" style="color: black;"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="products.php" style="color: hsl(353, 100%, 78%);"><i class="fa fa-list fa-fw"></i>List all</a>
                                        </li>
                                    <li>
                                        <a href="add_product.php" style="color: hsl(353, 100%, 78%);"><i class="fa fa-plus fa-fw"></i>Add New</a>
                                    </li>
                                    </ul>
                                </li>
                                <li <?php echo (CURRENT_PAGE == "categories.php" || CURRENT_PAGE == "add_category.php") ? 'class="active"' : ''; ?>>
                                    <a href="#" style="color: black;"><i class="fa-solid fa-bars-progress" style="color: black;"> </i>  Categories<span class="fa arrow" style="color: black;"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="categories.php" style="color: hsl(353, 100%, 78%);"><i class="fa fa-list fa-fw"></i>List all</a>
                                        </li>
                                    <li>
                                        <a href="add_category.php" style="color: hsl(353, 100%, 78%);"><i class="fa fa-plus fa-fw"></i>Add New</a>
                                    </li>
                                    </ul>
                                </li>
                                <li <?php echo (CURRENT_PAGE == "subcategories.php" || CURRENT_PAGE == "add_subcategory.php") ? 'class="active"' : ''; ?>>
                                    <a href="#" style="color: black;"><i class="fa-solid fa-bars-progress" style="color: black;"> </i>  Subcategories<span class="fa arrow" style="color: black;"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="subcategories.php" style="color: hsl(353, 100%, 78%);"><i class="fa fa-list fa-fw"></i>List all</a>
                                        </li>
                                    <li>
                                        <a href="add_subcategory.php" style="color: hsl(353, 100%, 78%);"><i class="fa fa-plus fa-fw"></i>Add New</a>
                                    </li>
                                    </ul>
                                </li>
                                <li <?php echo (CURRENT_PAGE == "suppliers.php" || CURRENT_PAGE == "add_supplier.php") ? 'class="active"' : ''; ?>>
                                    <a href="#" style="color: black;"><i class="fa-solid fa-bars-progress" style="color: black;"> </i>  Suppliers<span class="fa arrow" style="color: black;"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="suppliers.php" style="color: hsl(353, 100%, 78%);"><i class="fa fa-list fa-fw"></i>List all</a>
                                        </li>
                                    <li>
                                        <a href="add_supplier.php" style="color: hsl(353, 100%, 78%);"><i class="fa fa-plus fa-fw"></i>Add New</a>
                                    </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="orders.php" style="color: black;"><i class="fa fa-light fa-truck-fast" style="color: black;"> </i>  Orders</a>
                                </li>
                                <li>
                                    <a href="admin_users.php" style="color: black;"><i class="fa fa-users fa-fw" style="color: black;"></i> Manage Admins</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.sidebar-collapse -->
                    </div>
                    <!-- /.navbar-static-side -->
                </nav>
            <?php endif;?>
            <!-- The End of the Header -->