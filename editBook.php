<?php
require_once "Books.php";

$book = new Books();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $book->title = $_POST['title'];
    $book->author = $_POST['author'];
    $book->genre = $_POST['genre'];
    $book->publication_year = $_POST['publication_year'];

    $bookId = $_POST['id'];

    if ($book->updateBook($bookId)) {
        echo "<p>Book updated successfully!</p>";
    } else {
        echo "<p>Failed to update book.</p>";
    }
}

// Get book by ID for editing
if (isset($_GET['id'])) {
    $bookData = $book->getBookById($_GET['id']);
    if ($bookData) {
        ?>

        <h2>Edit Book</h2>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?= htmlspecialchars($bookData['id']) ?>">

            <label>Title:</label>
            <input type="text" name="title" value="<?= htmlspecialchars($bookData['title']) ?>" required><br>

            <label>Author:</label>
            <input type="text" name="author" value="<?= htmlspecialchars($bookData['author']) ?>" required><br>

            <label>Genre:</label>
            <input type="text" name="genre" value="<?= htmlspecialchars($bookData['genre']) ?>" required><br>

            <label>Publication Year:</label>
            <input type="number" name="publication_year" value="<?= htmlspecialchars($bookData['publication_year']) ?>" required><br>

            <input type="submit" name="update" value="Update Book">
        </form>

        <?php
    } else {
        echo "<p>Book not found.</p>";
    }
} else {
    echo "<p>No book ID provided.</p>";
}
?>
