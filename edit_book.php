<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$booksFile = 'books.json';
$books = [];
if (file_exists($booksFile)) {
    $books = json_decode(file_get_contents($booksFile), true);
}

$id = $_GET['id'] ?? null;
if ($id === null || !isset($books[$id])) {
    header('Location: index.php');
    exit();
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];

$book = $books[$id];

// Check access: admin or owner
if ($role !== 'admin' && $book['username'] !== $username) {
    header('Location: index.php');
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $author = trim($_POST['author'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $contact = trim($_POST['contact'] ?? '');

    if ($title === '' || $author === '' || $description === '' || $contact === '' || !filter_var($contact, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please fill all fields correctly.';
    } else {
        $books[$id] = [
            'title' => $title,
            'author' => $author,
            'description' => $description,
            'contact' => $contact,
            'username' => $book['username']
        ];
        file_put_contents($booksFile, json_encode($books, JSON_PRETTY_PRINT));
        header('Location: user.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Book - Free Book Exchange</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-lg">
        <h1 class="text-2xl font-bold mb-6 text-center">Edit Book</h1>
        <?php if ($error): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="POST" action="edit_book.php?id=<?php echo $id; ?>" class="space-y-4">
            <div>
                <label for="title" class="block mb-1 font-semibold">Title</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
                <label for="author" class="block mb-1 font-semibold">Author</label>
                <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
                <label for="description" class="block mb-1 font-semibold">Description</label>
                <textarea id="description" name="description" rows="4" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo htmlspecialchars($book['description']); ?></textarea>
            </div>
            <div>
                <label for="contact" class="block mb-1 font-semibold">Contact Email</label>
                <input type="email" id="contact" name="contact" value="<?php echo htmlspecialchars($book['contact']); ?>" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div class="flex justify-between items-center">
                <a href="user.php" class="text-blue-600 hover:underline">Back to My Account</a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Save Changes</button>
            </div>
        </form>
    </div>
</body>
</html>
