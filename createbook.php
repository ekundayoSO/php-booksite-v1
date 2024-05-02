<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $author = mysqli_real_escape_string($connection, $_POST['author']);
    $publishing_year = mysqli_real_escape_string($connection, $_POST['publishing_year']);
    $genre = mysqli_real_escape_string($connection, $_POST['genre']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);

    $stmt = $connection->prepare("INSERT INTO books(title, author, publishing_year, genre, description) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $title, $author, $publishing_year, $genre, $description);

    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header('Location: index.php?success_message=Book created successfully.');
    } else {
        header('Location: createbook.php?error_message=Failed to create book.');
    }

    $stmt->close();
}
?>

<?php include 'header.php'; ?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="book.css">
    <title>Create Book</title>
</head>

<body>
    <div>
        <form action="createbook.php" method="post">
            <label>
                Title:<input type="text" name="title"><br>
                Author:<input type="text" name="author"><br>
                Year:<input type="number" name="publishing_year"><br>
                Genre:<input type="text" name="genre"><br>
                Description:<textarea name="description" id="" cols="30" rows="5"></textarea><br>
            </label>
            <input type="submit" name="submit" value="CREATE">
        </form>
    </div>
    <footer class="footer-create-delete">
        <p><small>Copyright&copy; booksite 2024</small></p>
    </footer>
</body>

</html>