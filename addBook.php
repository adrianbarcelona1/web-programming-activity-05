<?php

require_once '../classes/books.php';
$bookObj = new Books();

$books = [
    "title" => "",
    "author" => "",
    "genre" => "",
    "publication_year" => ""
];

$errors = [
    "title" => "",
    "author" => "",
    "genre" => "",
    "publication_year" => ""
];

$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $books["title"] = trim(htmlspecialchars($_POST["title"]));
    $books["author"] = trim(htmlspecialchars($_POST["author"]));
    $books["genre"] = trim(htmlspecialchars($_POST["genre"]));
    $books["publication_year"] = trim(htmlspecialchars($_POST["publication_year"]));

    // Validation
    if (empty($books["title"])) {
        $errors["title"] = "Title is required";
    }

    if (empty($books["author"])) {
        $errors["author"] = "Author is required";
    }

    if (empty($books["genre"])) {
        $errors["genre"] = "Genre is required";
    }

    if ($books["publication_year"] === "") {
        $errors["publication_year"] = "Publication year is required";
    } elseif (!is_numeric($books["publication_year"]) || $books["publication_year"] < 0) {
        $errors["publication_year"] = "Publication year must be a valid number";
    }

    // If no validation errors
    if (!array_filter($errors)) {
        // Set book object properties
        $bookObj->title = $books["title"];
        $bookObj->author = $books["author"];
        $bookObj->genre = $books["genre"];
        $bookObj->publication_year = $books["publication_year"];

        // Add book
        if ($bookObj->addBook()) {
            $success = "Book added successfully!";
            $books = [ "title" => "", "author" => "", "genre" => "", "publication_year" => "" ]; // Clear form
        } else {
            $success = "Error adding book.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add a Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2>Add a Book</h2>

        <?php if ($success): ?>
            <p style="color: green; font-weight: bold;"><?php echo $success; ?></p>
        <?php endif; ?>

        <form action="addbook.php" method="POST">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($books["title"]); ?>" required>
            <small style="color:red"><?php echo $errors["title"]; ?></small>

            <label for="author">Author:</label>
            <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($books["author"]); ?>" required>
            <small style="color:red"><?php echo $errors["author"]; ?></small>

            <label for="genre">Genre:</label>
            <input type="text" id="genre" name="genre" value="<?php echo htmlspecialchars($books["genre"]); ?>" required>
            <small style="color:red"><?php echo $errors["genre"]; ?></small>

            <label for="publication_year">Publication Year:</label>
            <input type="text" id="publication_year" name="publication_year" maxlength="4" pattern="\d{4}" placeholder="e.g., 2021" required>
            <small style="color:red"><?php echo $errors["publication_year"]; ?></small>

            <button type="submit">Add Book</button>
        </form>
    </div>
</body>
</html>
