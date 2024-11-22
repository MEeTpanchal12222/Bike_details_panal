<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "bikes");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get bike ID from URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the bike details
    $result = $conn->query("SELECT * FROM bikes WHERE id = $id");
    if ($result->num_rows > 0) {
        $bike = $result->fetch_assoc();
    } else {
        echo "Bike not found!";
        exit();
    }
} else {
    echo "No bike ID provided!";
    exit();
}

// Update bike details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $mileage = $_POST['mileage'];
    $top_speed = $_POST['top_speed'];
    $engine_type = $_POST['engine_type'];
    $image_path = $bike['image']; // Default to the current image

    // Handle file upload if a new image is provided
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        $image_path = $target_file; // Update image path
    }

    // Update query
    $sql = "UPDATE bikes SET 
                name = '$name', 
                type = '$type', 
                mileage = '$mileage', 
                top_speed = '$top_speed', 
                engine_type = '$engine_type', 
                image = '$image_path' 
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: bikes.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Bike</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="bikes.php">Bike Management</a>
            <button class="btn btn-outline-light ms-auto" onclick="bikes.php">Back</button>
        </div>
    </nav>

    <!-- Edit Form -->
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3>Edit Bike</h3>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Bike Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $bike['name'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" class="form-control" id="type" name="type" value="<?= $bike['type'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="mileage" class="form-label">Mileage</label>
                        <input type="text" class="form-control" id="mileage" name="mileage" value="<?= $bike['mileage'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="top_speed" class="form-label">Top Speed</label>
                        <input type="text" class="form-control" id="top_speed" name="top_speed" value="<?= $bike['top_speed'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="engine_type" class="form-label">Engine Type</label>
                        <input type="text" class="form-control" id="engine_type" name="engine_type" value="<?= $bike['engine_type'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <p class="mt-2">Current Image: <img src="<?= $bike['image'] ?>" alt="Current Image" style="width: 100px;"></p>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Bike</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
