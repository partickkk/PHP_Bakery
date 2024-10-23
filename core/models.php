<?php

// Insert a new bakery
function insertBakery($pdo, $bakeryName, $bakeryAddress, $specialty, $b_license) {
    $sql = "INSERT INTO bakery_shop (bakeryName, bakeryAddress, specialty, b_license) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$bakeryName, $bakeryAddress, $specialty, $b_license]);

    return $executeQuery;
}

// Update an existing bakery
function updateBakery($pdo, $bakeryName, $bakeryAddress, $specialty, $b_license, $bakeryID) {
    $sql = "UPDATE bakery_shop
            SET bakeryName = ?, bakeryAddress = ?, specialty = ?, b_license = ?
            WHERE bakeryID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$bakeryName, $bakeryAddress, $specialty, $b_license, $bakeryID]);

    return $executeQuery;
}

// Delete a bakery
function deleteBakery($pdo, $bakeryID) {
    // First, delete all products related to the bakery
    $deleteProductsSQL = "DELETE FROM product WHERE bakeryID = ?";
    $deleteStmt = $pdo->prepare($deleteProductsSQL);
    $executeDeleteProductsQuery = $deleteStmt->execute([$bakeryID]);

    if ($executeDeleteProductsQuery) {
        // Then, delete the bakery
        $sql = "DELETE FROM bakery_shop WHERE bakeryID = ?";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$bakeryID]);

        return $executeQuery;
    }
    return false;
}

// Get all bakeries
function getAllBakeries($pdo) {
    $sql = "SELECT * FROM bakery_shop";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll();
}

// Get a bakery by ID
function getBakeryByID($pdo, $bakeryID) {
    $sql = "SELECT * FROM bakery_shop WHERE bakeryID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$bakeryID]);

    return $stmt->fetch();
}

// Get all products by bakery ID
function getProductsByBakery($pdo, $bakeryID) {
    $sql = "SELECT product.productID, product.productName, product.productType, product.price, product.p_expiryDate, product.date_added,
                   bakery_shop.bakeryName AS Bakery_Owner
            FROM product
            JOIN bakery_shop ON product.bakeryID = bakery_shop.bakeryID
            WHERE product.bakeryID = ?
            ORDER BY product.productName";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$bakeryID]);

    return $stmt->fetchAll();
}

// Insert a new product
function insertProduct($pdo, $productName, $productType, $price, $p_expiryDate, $bakeryID) {
    $sql = "INSERT INTO product (productName, productType, price, p_expiryDate, bakeryID) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$productName, $productType, $price, $p_expiryDate, $bakeryID]);

    return $executeQuery;
}

// Get a product by ID
function getProductByID($pdo, $productID) {
    $sql = "SELECT product.productID, product.productName, product.productType, product.price, product.p_expiryDate, product.date_added,
                   bakery_shop.bakeryName AS Bakery_Owner
            FROM product
            JOIN bakery_shop ON product.bakeryID = bakery_shop.bakeryID
            WHERE product.productID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$productID]);

    return $stmt->fetch();
}

// Update an existing product
function updateProduct($pdo, $productName, $productType, $price, $p_expiryDate, $productID) {
    $sql = "UPDATE product
            SET productName = ?, productType = ?, price = ?, p_expiryDate = ?
            WHERE productID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$productName, $productType, $price, $p_expiryDate, $productID]);

    return $executeQuery;
}

// Delete a product
function deleteProduct($pdo, $productID) {
    $sql = "DELETE FROM product WHERE productID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$productID]);

    return $executeQuery;
}

?>
