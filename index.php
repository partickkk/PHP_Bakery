<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
    <body>
        <h1>Welcome to the Bakery Management System.</h1>
        <form action="core/handleForms.php" method="POST">
            <p>
                <label for="bakeryName">Bakery Name: </label>
                <input type="text" name="bakeryName" required>
            </p>
            <p>
                <label for="bakeryAddress">Bakery Address: </label>
                <input type="text" name="bakeryAddress" required>
            </p>
            <p>
                <label for="specialty">Specialty: </label>
                <input type="text" name="specialty" required>
            </p>
            <p>
                <label for="b_license">License Number: </label>
                <input type="number" name="b_license" required>
            </p>
            <p><input type="submit" name="insertBakeryBtn" value="Add Bakery"></p>
        </form>

        <?php $getAllBakeries = getAllBakeries($pdo); ?>
        <?php foreach ($getAllBakeries as $row) { ?>
            <h3>Bakery Name: <?php echo $row['bakeryName']; ?></h3>
            <h3>Bakery Address: <?php echo $row['bakeryAddress']; ?></h3>
            <h3>Specialty: <?php echo $row['specialty']; ?></h3>
            <h3>License Number: <?php echo $row['b_license']; ?></h3>

            <a href="viewproduct.php?bakeryID=<?php echo $row['bakeryID']; ?>">View Products</a>
            <a href="editbakery.php?bakeryID=<?php echo $row['bakeryID']; ?>">Edit Bakery</a>
            <a href="deletebakery.php?bakeryID=<?php echo $row['bakeryID']; ?>">Delete Bakery</a>
        <?php } ?>
    </body>
</html>
