<?php
session_start(); // Start session

require_once __DIR__ . '/assets/classes/db.php';
require_once __DIR__ . '/assets/classes/crud.php';

if (isset($_GET['id'])) {
    $book_id = $_GET['id'];
    $crud = new crud();
    if ($crud->deleteBook($book_id)) {
        $_SESSION['successMessage'] = 'Book deleted successfully';
    } else {
        $_SESSION['errorMessage'] = 'Failed to delete book';
    }
    $crud->close();
}

header("Location: index.php");
exit();
?>
