<?php
require_once __DIR__ . '/assets/classes/db.php';
require_once __DIR__ . '/assets/classes/crud.php';

$crud = new crud();
$book = null;
$errorMessage = '';

if (isset($_GET['id'])) {
    $book_id = $_GET['id'];
    $book = $crud->getBookById($book_id);
} else {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'published_date' => $_POST['published_date'],
        'genre' => $_POST['genre'],
        'price' => $_POST['price']
    ];
    $book_id = $_POST['book_id'];

    $crud->updateBook($book_id, $data['title'], $data['author'], $data['published_date'], $data['genre'], $data['price']);
    $successMessage = 'Book updated successfully';
    header("Location: index.php?success=" . urlencode($successMessage));
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Edit Book</title>
</head>
<body>
    <div class="container">
        <h2>Edit Book</h2>
        <?php if ($errorMessage): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($errorMessage); ?></div>
        <?php endif; ?>
        <form action="edit.php?id=<?php echo $book_id; ?>" method="post">
            <input type="hidden" name="book_id" value="<?php echo $book['book_id']; ?>">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required>
            </div>
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required>
            </div>
            <div class="form-group">
                <label for="published_date">Published Date:</label>
                <input type="date" id="published_date" name="published_date" value="<?php echo htmlspecialchars($book['published_date']); ?>" required>
            </div>
            <div class="form-group">
                <label for="genre">Genre:</label>
                <input type="text" id="genre" name="genre" value="<?php echo htmlspecialchars($book['genre']); ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" step="0.01" id="price" name="price" value="<?php echo htmlspecialchars($book['price']); ?>" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Update Book">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
