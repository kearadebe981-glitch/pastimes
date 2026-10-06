<?php
require "db.php";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header("Location: index.php?msg=Welcome back, {$user['name']}!");
        exit;
    } else {
        $error = "Incorrect email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Log in — Pastimes</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header><h1>Pastimes</h1><nav><a href="index.php">Back home</a></nav></header>
<div class="wrap">
    <h2>Log in</h2>
    <?php if ($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
    <form class="stack" method="post">
        <label>Email<input type="email" name="email" required></label>
        <label>Password<input type="password" name="password" required></label>
        <button class="btn" type="submit">Log in</button>
    </form>
    <p class="muted-link">No account yet? <a href="register.php">Sign up</a></p>
</div>
</body>
</html>
