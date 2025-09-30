<?php

require_once "database.php";

class Books {
    public $id = "";
    public $title = "";
    public $author = "";
    public $genre = "";
    public $publication_year = "";

    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Fetch a single book by its ID
    public function getBookById($id) {
        $sql = "SELECT * FROM books WHERE id = :id LIMIT 1";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $book = $stmt->fetch(PDO::FETCH_ASSOC);
        return $book ? $book : false;
    }

    // Add a new book using the class properties
    public function addBook() {
        $sql = "INSERT INTO books (title, author, genre, publication_year) 
                VALUES (:title, :author, :genre, :publication_year)";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(":title", $this->title);
        $query->bindParam(":author", $this->author);
        $query->bindParam(":genre", $this->genre);
        $query->bindParam(":publication_year", $this->publication_year);
        return $query->execute();
    }

    // Get all books ordered by title ascending
    public function viewBook() {
        $sql = "SELECT * FROM books ORDER BY title ASC";
        $query = $this->db->connect()->prepare($sql);
        if ($query->execute()) {
            return $query->fetchAll();
        } else {
            return null;
        }
    }
}
