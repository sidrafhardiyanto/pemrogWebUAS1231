<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: index.php");
        exit();
    }

    include 'config.php';
    $marital_id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['marry'])) {
        $marry = $_POST['marry'];

        $query = "UPDATE `marital` SET 
            `marital_name`='$marry'
            WHERE `marital_id`='$marital_id'";

        $result = mysqli_query($conn, $query);

        if ($result) {
            header("Location: marital.php");
            exit();
        } else {
            echo "Error updating user: " . mysqli_error($conn);
        }
    } else {
        $query = "SELECT * FROM marital WHERE marital_id = '$marital_id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        if (!$row) {
            header("Location: marital.php");
            exit();
        }

        $marry = $row['marital_name'];
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Home</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <style>
            body {
                background-color: #f8f9fa;
            }

            .container {
                margin-top: 50px;
            }
        </style>
    </head>
    <body>
        <?php include 'menu.php'; ?>
        <div class="container">
            <form method="post" action="edit_marital.php?id=<?= $marital_id; ?>">
                <div class="form-group">
                    <label>Status Perkawinan:</label>
                    <input type="text" class="form-control" name="marry" value="<?= $marry; ?>" placeholder="Status Perkawinan" required>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Tambah</button>
                <a href="marital.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
