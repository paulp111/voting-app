<?php
session_start();
require 'db.php'; 

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

$error = $success = ""; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST["title"];
    $image = $_FILES["image"];

    if ($image["error"] === 0) {
        $target_dir = "uploads/"; 
        $file_name = basename($image["name"]);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($image["tmp_name"], $target_file)) {
            $stmt = $pdo->prepare("INSERT INTO products (title, image_filename) VALUES (?, ?)");
            $stmt->execute([$title, $file_name]);
            $success = "Produkt erfolgreich hinzugefügt!";
        } else {
            $error = "Fehler beim Hochladen des Bildes!";
        }
    } else {
        $error = "Kein gültiges Bild ausgewählt!";
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produkt hinzufügen</title>
    <link rel="stylesheet" href="/css/pico.classless.min.css">
</head>
<body>
    <main class="container">
        <h1>Produkt hinzufügen</h1>

        <?php if ($success): ?>
            <p style="color: green;"><?php echo $success; ?></p>
        <?php elseif ($error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <label for="title">Produktname:</label>
            <input type="text" id="title" name="title" required>

            <label for="image">Produktbild:</label>
            <input type="file" id="image" name="image" accept="image/*" required>

            <button type="submit">Produkt hinzufügen</button>
        </form>

        <p><a href="index.php">Zurück zur Produktliste</a></p>
    </main>
</body>
</html>
