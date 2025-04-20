<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Add Book - Free Book Exchange</title>
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
        <h1 class="text-2xl font-bold mb-6 text-center">Add a New Book</h1>
        <form action="save_book.php" method="POST" class="space-y-4">
            <div>
                <label for="title" class="block mb-1 font-semibold">Title</label>
                <input type="text" id="title" name="title" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
                <label for="author" class="block mb-1 font-semibold">Author</label>
                <input type="text" id="author" name="author" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
                <label for="description" class="block mb-1 font-semibold">Description</label>
                <textarea id="description" name="description" rows="4" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>
            <div>
                <label for="contact" class="block mb-1 font-semibold">Contact Email</label>
                <input type="email" id="contact" name="contact" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div class="flex justify-between items-center">
                <a href="index.php" class="text-blue-600 hover:underline">Back to Home</a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Add Book</button>
            </div>
        </form>
    </div>
</body>
</html>
