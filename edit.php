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

if (isset($_POST['update_book'])) {
    if (isset($_GET['id_new'])) {
        $id_new = $_GET['id_new'];
    }
    $title = $_POST["title"];
    $author = $_POST["author"];
    $publishing_year = $_POST["publishing_year"];
    $genre = $_POST["genre"];
    $description = $_POST["description"];

    $stmt = $connection->prepare("UPDATE books SET title=?, description=?, author=?, publishing_year=?, genre=? WHERE id=?");
    $stmt->bind_param("sssisi", $title, $description, $author, $publishing_year, $genre, $id_new);

    $title = $_POST["title"];
    $author = $_POST["author"];
    $publishing_year = $_POST["publishing_year"];
    $genre = $_POST["genre"];
    $description = $_POST["description"];
    $id_new = $_GET['id_new'];
    $stmt->execute();

    if (!$stmt) {
        die("Query failed" . mysqli_error($connection));
    } else {
        header('location:index.php?edit message=You have edited the data successfully.');
    }
    $stmt->close();
}
mysqli_close($connection);
?>

<?php include 'header.php'; ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="book.css">
    <title>Document</title>
</head>
<body>
    <form action="edit.php?id_new=<?php echo $id ?>" method="post">
        <label>
            Title: <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($row['title']) ?>"><br>
            Author: <input type="text" name="author" id="author" value="<?php echo htmlspecialchars($row['author']) ?>"><br>
            Publishing year: <input type="text" name="publishing_year" id="publishing_year" value="<?php echo htmlspecialchars($row['publishing_year']) ?>"><br>
            Genre: <input type="text" name="genre" id="genre" value="<?php echo htmlspecialchars($row['genre']) ?>"><br>
            Description: <textarea type="text" name="description" id="description" rows="5" cols="10"><?php echo htmlspecialchars($row['description']) ?></textarea><br>
        </label>
        <input type="submit" name="update_book" value="UPDATE">
    </form>
    <footer class="footer-create-delete">
        <p><small>Copyright&COPY;Booksite 2024</small></p>
    </footer>
</body>

</html>