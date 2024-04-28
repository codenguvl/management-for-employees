<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {

    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.4/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.4/dist/quill.js"></script>
    <link rel="stylesheet" href="./static/css/main.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="./static/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="./static/js/datatables-simple-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<style>

</style>

<body class="sb-nav-fixed">
    <?php include ('includes/navbar.php') ?>
    <div id="layoutSidenav">
        <?php include ('includes/sidebar.php') ?>
        <div id="layoutSidenav_content">
            <main class="p-2">
                <?php
                include 'config/mysql_connection.php';


                $current_page = isset($_GET['page']) ? $_GET['page'] : '';
                if (isset($_SESSION['current_page'])) {
                    $current_page = $_SESSION['current_page'];
                }

                switch ($current_page) {
                    case 'home':
                        include 'views/home.php';
                        break;
                    case 'view-customer':
                        include 'views/view-customer.php';
                        break;
                    case 'add-customer':
                        include 'views/add-customer.php';
                        break;
                    case 'edit-customer':
                        include 'views/edit-customer.php';
                        break;
                    case 'view-products':
                        include 'views/view-products.php';
                        break;
                    case 'add-product':
                        include 'views/add-product.php';
                        break;
                    case 'edit-product':
                        include 'views/edit-product.php';
                        break;
                    case 'view-orders':
                        include 'views/view-orders.php';
                        break;
                    case 'add-order':
                        include 'views/add-order.php';
                        break;
                    case 'view-promotions':
                        include 'views/view-promotions.php';
                        break;
                    case 'add-promotion':
                        include 'views/add-promotion.php';
                        break;
                    case 'edit-promotion':
                        include 'views/edit-promotion.php';
                        break;
                    case 'view-reviews':
                        include 'views/view-reviews.php';
                        break;
                    case 'add-review':
                        include 'views/add-review.php';
                        break;
                    case 'view-order-detail':
                        include 'views/view-order-detail.php';
                        break;
                    default:
                        include 'views/home.php';
                }
                ?>

            </main>
        </div>
    </div>
</body>

</html>