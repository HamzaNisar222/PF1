<?php
require_once __DIR__ . '/assets/classes/db.php';
require_once __DIR__ . '/assets/classes/crud.php';

if (isset($_GET['id'])) {
    $book_id = $_GET['id'];
    $crud = new crud();
    if ($crud->deleteBook($book_id)) {
        $successMessage = 'Book deleted successfully';
        header("Location: index.php?success=" . urlencode($successMessage));
        
    } else {
        $errorMessage = 'Failed to delete book';
        header("Location: index.php?error=" . urlencode($errorMessage));
    }
    $crud->close();
    exit();
} else {
    header("Location: index.php");
    exit();
}
