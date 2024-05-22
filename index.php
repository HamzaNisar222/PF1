<?php
session_start();
require_once __DIR__ . '/assets/classes/db.php';
require_once __DIR__ . '/assets/classes/crud.php';

$crud = new crud();

// Check for success message
if (isset($_SESSION['successMessage'])) {
    $successMessage = $_SESSION['successMessage'];
    unset($_SESSION['successMessage']); // Clear the session variable
}

// Check for error message
if (isset($_SESSION['errorMessage'])) {
    $errorMessage = $_SESSION['errorMessage'];
    unset($_SESSION['errorMessage']); // Clear the session variable
}
$books = $crud->ReadBooks();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/CSS/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Books</title>
</head>
<body>
    <div class="wrapper" style="width:100%">
        
<header style="position:fixed; top:0; width:100%;">
        <?php
        
       include './components/header.php';
        ?>
    </header>
  <main>
  <div class="container">
        <h2>Books</h2>
        <a href="add.php"><i class="fa-solid fa-plus"></i></a>
        <?php if (isset($successMessage)): ?>
          <div class="alert alert-success" id="successMessage"><?php echo htmlspecialchars($successMessage); ?></div>
        <?php endif; ?>
          
       <?php if (isset($errorMessage)): ?>
        <div class="alert alert-danger" id="errorMessage"><?php echo htmlspecialchars($errorMessage); ?></div>
       <?php endif; ?>
        <table border="1" id="books">
            <thead>
                <tr>
                    <th>Sr no</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Published Date</th>
                    <th>Genre</th>
                    <th>Price</th>
                    <th>Delete</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $a=0;
                foreach ($books as $book): 
                $a++;    
                ?>
                    <tr>
                     
                        <td><?php echo $a;?></td>
                        <td><?php echo htmlspecialchars($book['title']); ?></td>
                        <td><?php echo htmlspecialchars($book['author']); ?></td>
                        <td><?php echo htmlspecialchars($book['published_date']); ?></td>
                        <td><?php echo htmlspecialchars($book['genre']); ?></td>
                        <td><?php echo htmlspecialchars($book['price']); ?></td>
                        <td>
                            <a href="delete.php?id=<?php echo $book['book_id']; ?>" onclick="return confirm('Are you sure you want to delete this book?');">
                                <i class="fa-solid fa-trash" style="color:red;"></i>
                            </a>
                        </td>
                        <td>
                            <a href="edit.php?id=<?php echo $book['book_id']; ?>" >
                            <i class="fa-solid fa-pen" style="color:blue;"></i>
                            
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
  </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="./assets/Js/main.js">
       
        
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
