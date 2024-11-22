<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Bikes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Bike Management</a>
            <a class="btn btn-outline-light" href="index.php">Add Bike</a>
        </div>
    </nav>

    <!-- Bikes Section -->
    <div class="container mt-5">
        <div class="row">
            <?php
            $conn = new mysqli("localhost", "root", "", "bikes");
            $result = $conn->query("SELECT * FROM bikes");
            while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow">
                        <img src="<?= $row['image'] ?>" class="card-img-top" alt="<?= $row['name'] ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['name'] ?></h5>
                            <p class="card-text"><strong>Type:</strong> <?= $row['type'] ?></p>
                            <p class="card-text"><strong>Mileage:</strong> <?= $row['mileage'] ?></p>
                            <p class="card-text"><strong>Top Speed:</strong> <?= $row['top_speed'] ?></p>
                            <p class="card-text"><strong>Engine:</strong> <?= $row['engine_type'] ?></p>
                            <a href="edit_bike.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_bike.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php $conn->close(); ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; <?= date('Y') ?> Bike Management Panel. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
