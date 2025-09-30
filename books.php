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

    public function getBookById($id) {
        $sql = "SELECT * FROM books WHERE id = :id LIMIT 1";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $book = $stmt->fetch(PDO::FETCH_ASSOC);
        return $book ? $book : false;
    }

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

    public function viewBook() {
        $sql = "SELECT * FROM books ORDER BY title ASC";
        $query = $this->db->connect()->prepare($sql);
        if ($query->execute()) {
            return $query->fetchAll();
        } else {
            return null;
        }
    }

    public function updateBook($id) {
        $sql = "UPDATE books SET 
                    title = :title, 
                    author = :author, 
                    genre = :genre, 
                    publication_year = :publication_year 
                WHERE id = :id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(":title", $this->title);
        $query->bindParam(":author", $this->author);
        $query->bindParam(":genre", $this->genre);
        $query->bindParam(":publication_year", $this->publication_year);
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        return $query->execute();
    }

    public function deleteBook($id) {
        $sql = "DELETE FROM books WHERE id = :id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        return $query->execute();
    }
}
