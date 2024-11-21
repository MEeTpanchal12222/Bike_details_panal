<?php
$conn = new mysqli('localhost', 'root', '', 'bikes');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $type = $mileage = $top_speed = $engine_type = $image = '';
$isEdit = false;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM bikes WHERE id=$id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $type = $row['type'];
        $mileage = $row['mileage'];
        $top_speed = $row['top_speed'];
        $engine_type = $row['engine_type'];
        $image = $row['image'];
        $isEdit = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $isEdit ? "Edit Bike Details" : "Add Bike Details" ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2><?= $isEdit ? "Edit Bike Details" : "Add Bike Details" ?></h2>
        <form action="save_bike.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $isEdit ? $id : '' ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Bike Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>" required>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Bike Type</label>
                <input type="text" class="form-control" id="type" name="type" value="<?= $type ?>" required>
            </div>
            <div class="mb-3">
                <label for="mileage" class="form-label">Mileage</label>
                <input type="text" class="form-control" id="mileage" name="mileage" value="<?= $mileage ?>" required>
            </div>
            <div class="mb-3">
                <label for="top_speed" class="form-label">Top Speed</label>
                <input type="text" class="form-control" id="top_speed" name="top_speed" value="<?= $top_speed ?>" required>
            </div>
            <div class="mb-3">
                <label for="engine_type" class="form-label">Engine Type</label>
                <input type="text" class="form-control" id="engine_type" name="engine_type" value="<?= $engine_type ?>" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Bike Image</label>
                <?php if ($isEdit && $image): ?>
                    <div>
                        <img src="<?= $image ?>" alt="Bike Image" class="img-thumbnail mb-3" style="width: 150px;">
                    </div>
                <?php endif; ?>
                <input type="file" class="form-control" id="image" name="image" <?= !$isEdit ? 'required' : '' ?>>
            </div>
            <button type="submit" class="btn btn-primary"><?= $isEdit ? "Update Bike" : "Add Bike" ?></button>
            <a href="bikes.php" class="btn btn-secondary">Back to List</a>
        </form>
    </div>
</body>
</html>
