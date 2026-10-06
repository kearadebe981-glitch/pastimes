<?php
require "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);
    $location = trim($_POST['location']);

    if ($name === '' || $category === '' || $description === '' || $location === '') {
        $error = "Please fill in every field.";
    } else {
        $insert = $pdo->prepare(
            "INSERT INTO activities (name, category, description, location, created_by) VALUES (?, ?, ?, ?, ?)"
        );
        $insert->execute([$name, $category, $description, $location, $_SESSION['user_id']]);
        header("Location: index.php?msg=Activity added successfully.");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Add an activity — Pastimes</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header><h1>Pastimes</h1><nav><a href="index.php">Back home</a></nav></header>
<div class="wrap">
    <h2>Add a new activity</h2>
    <?php if ($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
    <form class="stack" method="post">
        <label>Activity name<input type="text" name="name" required></label>
        <label>Category<input type="text" name="category" placeholder="e.g. Sport, Arts & Crafts, Social" required></label>
        <label>Description<textarea name="description" rows="4" required></textarea></label>
        <label>Location<input type="text" name="location" required></label>
        <button class="btn" type="submit">Add activity</button>
    </form>
</div>
</body>
</html>
