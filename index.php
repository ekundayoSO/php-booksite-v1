<?php
include 'db.php';
include 'header.php';

$query = "SELECT * FROM books";
$result = mysqli_query($connection, $query);

if (!$result) {
    die("Query failed" . mysqli_error($connection));
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="book.css">
    <title>Reading database</title>
</head>

<body>
    <a id="createbook" href="createbook.php">CREATE BOOK</a>
    <div class="container">
        <!--<h1>Books from Booksite</h1>-->
        <table>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Author</th>
                <th>Year</th>
                <th>Genre</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['author']; ?></td>
                    <td><?php echo $row['publishing_year']; ?></td>
                    <td><?php echo $row['genre']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><a id="edit" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a></td>
                    <td><a id="delete" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>