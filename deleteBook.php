<?php
require_once "Books.php";

if (isset($_GET['id'])) {
    $book = new Books();
    $bookId = $_GET['id'];

    if ($book->deleteBook($bookId)) {
        echo "Book deleted successfully.";
    } else {
        echo "Failed to delete book.";
    }
} else {
    echo "No book ID provided.";
}
?>
