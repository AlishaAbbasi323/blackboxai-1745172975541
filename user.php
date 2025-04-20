<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];

$booksFile = 'books.json';
$books = [];
if (file_exists($booksFile)) {
    $books = json_decode(file_get_contents($booksFile), true);
}

$userBooks = array_filter($books, function($book) use ($username) {
    return $book['username'] === $username;
});
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Account - Free Book Exchange</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-blue-600 text-white p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">Free Book Exchange</h1>
        <div>
            <a href="index.php" class="mr-4 hover:underline">Home</a>
            <a href="add_book.php" class="mr-4 hover:underline">Add Book</a>
            <a href="logout.php" class="hover:underline">Logout (<?php echo htmlspecialchars($username); ?>)</a>
        </div>
    </nav>
    <main class="p-6 max-w-4xl mx-auto">
        <h2 class="text-2xl font-semibold mb-4">My Book Listings</h2>
        <?php if (empty($userBooks)): ?>
            <p class="text-gray-700">You have not added any books yet.</p>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach ($userBooks as $index => $book): ?>
                    <div class="bg-white p-4 rounded shadow">
                        <h3 class="text-xl font-bold mb-1"><?php echo htmlspecialchars($book['title']); ?></h3>
                        <p class="text-gray-700 mb-1"><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
                        <p class="text-gray-600 mb-2"><?php echo nl2br(htmlspecialchars($book['description'])); ?></p>
                        <p class="text-sm text-gray-500 mb-2"><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($book['contact']); ?></p>
                        <div class="flex space-x-2">
                            <a href="edit_book.php?id=<?php echo $index; ?>" class="text-blue-600 hover:underline">Edit</a>
                            <a href="delete_book.php?id=<?php echo $index; ?>" class="text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete this book?');">Delete</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
