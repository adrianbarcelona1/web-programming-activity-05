<?php
require_once '../classes/books.php'; // adjust path as needed

// Check if book ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Invalid book ID.');
}

$bookId = $_GET['id'];

// Create object
$bookObj = new Books();

// Fetch book by ID
$book = $bookObj->getBookById($bookId);

if (!$book) {
    die('Book not found.');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>View Book</title>
    <link rel="stylesheet" href="style.css"> <!-- optional -->
</head>
<body>
    <div class="container">
        <h1>Book Details</h1>
        <table>
            <tr><th>Title</th><td><?= htmlspecialchars($book['title']) ?></td></tr>
            <tr><th>Author</th><td><?= htmlspecialchars($book['author']) ?></td></tr>
            <tr><th>Genre</th><td><?= htmlspecialchars($book['genre']) ?></td></tr>
            <tr><th>Publication Year</th><td><?= (int)$book['publication_year'] ?></td></tr>
        </table>
        <a href="../index.php">Back to List</a>
    </div>
</body>
</html>
