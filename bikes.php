<?php
$conn = new mysqli('localhost', 'root', '', 'bikes');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM bikes");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Bikes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Bikes List</h2>
        <a href="index.php" class="btn btn-primary mb-3">Add New Bike</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Mileage</th>
                    <th>Top Speed</th>
                    <th>Engine Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><img src="<?= $row['image'] ?>" alt="Bike Image" style="width: 100px;"></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['type'] ?></td>
                    <td><?= $row['mileage'] ?></td>
                    <td><?= $row['top_speed'] ?></td>
                    <td><?= $row['engine_type'] ?></td>
                    <td>
                        <a href="index.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_bike.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>