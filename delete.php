<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM books WHERE id = $id ";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query failed" . mysqli_error($connection));
    } else {
        $row = mysqli_fetch_assoc($result);
    }
}

if (isset($_POST['delete_book'])) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    // Check if the delete confirmation was sent from JavaScript
    if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] === 'true') {
        $stmt = $connection->prepare("DELETE FROM books WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if (!$stmt) {
            die("Query failed" . mysqli_error($connection));
        } else {
            header('location:index.php?delete message=You have deleted the data successfully.');
        }
        $stmt->close();
    } else {
        header('location:index.php');
        exit();
    }
}
mysqli_close($connection);
?>

<?php include 'header.php'; ?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="delete.php?id=<?php echo $id ?>" method="post" id="deleteForm">
        <h2 class="animation">Welcome to bin section!</h2>
        <div class="delete-p">
            <p><b>Title</b>: <?php echo htmlspecialchars($row['title']) ?></p>
            <p><b>Author</b>: <?php echo htmlspecialchars($row['author']) ?></p>
            <p><b>Publishing_year</b>: <?php echo htmlspecialchars($row['publishing_year']) ?></p>
            <p><b>Genre</b>: <?php echo htmlspecialchars($row['genre']) ?></p>
            <p><b>Description</b>: <?php echo htmlspecialchars($row['description']) ?></p>
            <input type="submit" class="btn-danger" name="delete_book" value="DELETE">
            <input type="hidden" name="confirm_delete" id="confirmDeleteInput">
        </div>
    </form>
    <footer class="footer-create-delete">
        <p><small>Copyright&copy; booksite 2024</small></p>
    </footer>
    <script src="delete.js"></script>
</body>

</html>