<?php

require_once('db.php');

class crud extends Database
{

    public function __construct()
    {

        $this->connect();
    }


    public function addBook($title, $author, $published_date, $genre, $price)
    {
        // Prepare the SQL query with placeholders
        $query = "INSERT INTO books (title, author, published_date, genre, price) VALUES ($1, $2, $3, $4, $5)";

        // Use pg_query_params for parameterized query to prevent SQL injection
        $result = pg_query_params($this->con, $query, array($title, $author, $published_date, $genre, $price));

        if (!$result) {
            // Return false if the query fails
            return false;
        } else {
            // Return true if the query succeeds
            return true;
        }
    }

    public function readBooks()
    {
        $query = "SELECT * FROM books";
        $result = pg_query($this->con, $query);
        if (!$result) {
            die("Error fetching books: " . pg_last_error($this->con));
        } else {
            return pg_fetch_all($result);
        }
    }

    // Deletion of books
    public function deleteBook($book_id)
    {
        $query = "DELETE FROM books WHERE book_id = $1";
        $result = pg_query_params($this->con, $query, array($book_id));
        if (!$result) {
            die("Error deleting book: " . pg_last_error($this->con));
        } else {
            return true;
        }
    }

    // UPDATION
    public function updateBook($book_id, $title, $author, $published_date, $genre, $price)
    {
        $query = "UPDATE books SET title = $1, author = $2, published_date = $3, genre = $4, price = $5 WHERE book_id = $6";
        $result = pg_query_params($this->con, $query, array($title, $author, $published_date, $genre, $price, $book_id));
        if (!$result) {
            die("Error updating book: " . pg_last_error($this->con));
        } else {
            return true;
        }
    }

    public function getBookById($book_id)
    {
        $query = "SELECT * FROM books WHERE book_id = $1";
        $result = pg_query_params($this->con, $query, array($book_id));
        if (!$result) {
            die("Error fetching book: " . pg_last_error($this->con));
        } else {
            return pg_fetch_assoc($result);
        }
    }
}
