<?php
session_start();
require_once __DIR__ . '/assets/classes/db.php';
require_once __DIR__ . '/assets/classes/crud.php';
require_once __DIR__ . '/assets/classes/validator.php';

$crud = new crud();
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'published_date' => $_POST['published_date'],
        'genre' => $_POST['genre'],
        'price' => $_POST['price']
    ];

    $errors = Validator::validateFormData($data);
    if (empty($errors)) {
        if ($crud->addBook($data['title'], $data['author'], $data['published_date'], $data['genre'], $data['price'])) {
            $_SESSION['successMessage'] = 'Book added successfully';
        } else {
            $_SESSION['errorMessage'] = 'Book not added successfully';
        }
        $crud->close();
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['errorMessage'] = implode('<br>', $errors);
        header("Location: add.php");
        exit();
    }
}

$crud->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/CSS/style.css">
    <title>Add Book</title>
</head>
<body>
    <div class="wrapper" style="width:100%;">
    <header style="position:fixed; top:0; width:100%;">
        <?php include './components/header.php'; ?>
    </header>
    <main>
    <div class="container">
        <h2>Add a New Book</h2>
        <?php if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<span style='color:red;'>$error</span>";
            }
        } ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" required>
            </div>
            <div class="form-group">
                <label for="published_date">Published Date:</label>
                <input type="date" id="published_date" name="published_date" required>
            </div>
            <div class="form-group">
                <label for="genre">Genre:</label>
                <input type="text" id="genre" name="genre" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" step="0.01" id="price" name="price" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Add Book">
            </div>
        </form>
    </div>
    </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
