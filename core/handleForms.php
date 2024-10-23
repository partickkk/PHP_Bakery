<?php
require_once 'dbConfig.php';
require_once 'models.php';

// Insert a new bakery
if (isset($_POST['insertBakeryBtn'])) {
    $query = insertBakery($pdo, $_POST['bakeryName'], $_POST['bakeryAddress'], $_POST['specialty'], $_POST['b_license']);

    if ($query) {
        header("Location: ../index.php");
        exit(); // Always use exit after header redirection
    } else {
        echo "Insertion Failed";
    }
}

// Edit an existing bakery
if (isset($_POST['editBakeryBtn'])) {
    $query = updateBakery($pdo, $_POST['bakeryName'], $_POST['bakeryAddress'], $_POST['specialty'], $_POST['b_license'], $_GET['bakeryID']);

    if ($query) {
        header("Location: ../index.php");
        exit(); // Always use exit after header redirection
    } else {
        echo "Edit Failed";
    }
}

// Delete a bakery
if (isset($_POST['deleteBakeryBtn'])) {
    $query = deleteBakery($pdo, $_GET['bakeryID']);

    if ($query) {
        header("Location: ../index.php");
        exit(); // Always use exit after header redirection
    } else {
        echo "Deletion Failed";
    }
}

// Insert a new product
if (isset($_POST['insertProductBtn'])) {
    $query = insertProduct($pdo, $_POST['productName'], $_POST['productType'], $_POST['price'], $_POST['p_expiryDate'], $_GET['bakeryID']);

    if ($query) {
        header("Location: ../viewproduct.php?bakeryID=" . $_GET['bakeryID']);
        exit(); // Always use exit after header redirection
    } else {
        echo "Insertion Failed";
    }
}

// Edit an existing product
if (isset($_POST['editProductBtn'])) {
    // Check if productID is provided
    if (isset($_GET['productID'])) {
        $query = updateProduct($pdo, $_POST['productName'], $_POST['productType'], $_POST['price'], $_POST['p_expiryDate'], $_GET['productID']);

        if ($query) {
            header("Location: ../viewproduct.php?bakeryID=" . $_GET['bakeryID']);
            exit(); // Always use exit after header redirection
        } else {
            echo "Update Failed";
        }
    } else {
        echo "No product ID provided.";
    }
}

// Delete a product
if (isset($_POST['deleteProductBtn'])) {
    $query = deleteProduct($pdo, $_GET['productID']);

    if ($query) {
        header("Location: ../viewproduct.php?bakeryID=" . $_GET['bakeryID']);
        exit(); // Always use exit after header redirection
    } else {
        echo "Deletion Failed";
    }
}
?>
