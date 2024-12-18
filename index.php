<?php
session_start();
require 'db.php';

// laden & sortieren
$stmt = $pdo->query("SELECT * FROM products ORDER BY (upvotes - downvotes) DESC");
$products = $stmt->fetchAll();

// Voting logik
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $vote = $_POST["vote"];

    if ($vote === "up") {
        $pdo->query("UPDATE products SET upvotes = upvotes + 1 WHERE id = $id");
    } elseif ($vote === "down") {
        $pdo->query("UPDATE products SET downvotes = downvotes + 1 WHERE id = $id");
    }
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>Voting App</title>
    <link rel="stylesheet" href="/css/pico.classless.min.css">
</head>
<body>


    <main class="container">
        <h1>Voting App</h1>
        <h3>To vote please log in</h3>
        <h3>To upload please log in as Admin</h3>
        <a href="login.php" role="button">Login</a>
        <a href="logout.php" role="button">Logout</a>
        
        <?php if (isset($_SESSION["admin"])): ?>
            <a href="admin.php" role="button">Admin-Bereich</a>
            <a href="logout.php" role="button">Logout</a>
        <?php endif; ?>

        <section>
            <?php foreach ($products as $product): ?>
                <article>
                    <h2><?php echo htmlspecialchars($product['title']); ?></h2>
                    <img src="uploads/<?php echo htmlspecialchars($product['image_filename']); ?>" alt="Bild" style="width: 30%; height: auto;">
                    <p>Upvotes: <?php echo $product['upvotes']; ?> | Downvotes: <?php echo $product['downvotes']; ?></p>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                        <button type="submit" name="vote" value="up">👍 Upvote</button>
                        <button type="submit" name="vote" value="down">👎 Downvote</button>
                    </form>
                </article>
            <?php endforeach; ?>
        </section>
    </main>
</body>
</html>
