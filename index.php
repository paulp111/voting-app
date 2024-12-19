<?php
session_start();
require 'db.php';

$stmt = $pdo->query("SELECT *, (upvotes - downvotes) AS voting_score FROM products ORDER BY voting_score DESC");
$products = $stmt->fetchAll();
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

        <?php if (!isset($_SESSION["username"])): ?>
            <a href="login.php" role="button">Login</a>
        <?php else: ?>
            <p>Willkommen, <?php echo htmlspecialchars($_SESSION["username"]); ?>!
                <a href="logout.php" role="button">Logout</a>
            </p>
            <?php if (isset($_SESSION["admin"])): ?>
                <a href="admin.php" role="button">Admin-Bereich</a>
            <?php endif; ?>
        <?php endif; ?>

        <section>
            <?php foreach ($products as $product): ?>
                <article>
                    <h2><?php echo htmlspecialchars($product['title']); ?></h2>
                    <img src="uploads/<?php echo htmlspecialchars($product['image_filename']); ?>" alt="Bild" style="width: 30%; height: auto;">
                    <p>
                        Upvotes: <?php echo $product['upvotes']; ?> |
                        Downvotes: <?php echo $product['downvotes']; ?> |
                        Voting Score: <?php echo $product['voting_score']; ?>
                    </p>

                    <?php if (isset($_SESSION["username"])): ?>
                        <form method="POST" action="vote.php">
                            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                            <button type="submit" name="vote" value="up">👍 Upvote</button>
                            <button type="submit" name="vote" value="down">👎 Downvote</button>
                        </form>
                    <?php else: ?>
                        <p style="color: red;">Bitte logge dich ein, um abzustimmen!</p>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </section>
    </main>
</body>

</html>