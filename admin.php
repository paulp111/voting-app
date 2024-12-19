<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["image"])) {
    $title = $_POST["title"];
    $image = $_FILES["image"];

    if ($image["error"] === 0) {
        $target_dir = "uploads/";
        $file_name = basename($image["name"]);
        move_uploaded_file($image["tmp_name"], $target_dir . $file_name);

        $stmt = $pdo->prepare("INSERT INTO products (title, image_filename) VALUES (?, ?)");
        $stmt->execute([$title, $file_name]);
    }
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <title>Admin Bereich</title>
    <link rel="stylesheet" href="/css/pico.classless.min.css">
</head>

<body>
    <main class="container">
        <h2>Admin-Bereich</h2>
        <form method="POST" enctype="multipart/form-data">
            <label>Titel</label>
            <input type="text" name="title" required>
            <label>Bild</label>
            <input type="file" name="image" required>
            <button type="submit">Produkt hinzufügen</button>
        </form>
        <a href="index.php" role="button">Zurück zur Startseite</a>
        <a href="logout.php" role="button">Logout</a>
    </main>
</body>

</html>