<?php require "db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Pastimes</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Pastimes</h1>
    <nav>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="add_activity.php">Add an activity</a>
            <a href="logout.php">Log out (<?= htmlspecialchars($_SESSION['user_name']) ?>)</a>
        <?php else: ?>
            <a href="login.php">Log in</a>
            <a href="register.php">Sign up</a>
        <?php endif; ?>
    </nav>
</header>

<div class="wrap">
    <?php if (isset($_GET['msg'])): ?>
        <div class="flash"><?= htmlspecialchars($_GET['msg']) ?></div>
    <?php endif; ?>

    <form class="filter-bar" method="get">
        <input type="text" name="q" placeholder="Search activities..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
        <select name="category">
            <option value="">All categories</option>
            <?php
            $categories = $pdo->query("SELECT DISTINCT category FROM activities ORDER BY category")->fetchAll(PDO::FETCH_COLUMN);
            foreach ($categories as $cat):
                $selected = (($_GET['category'] ?? '') === $cat) ? 'selected' : '';
            ?>
                <option value="<?= htmlspecialchars($cat) ?>" <?= $selected ?>><?= htmlspecialchars($cat) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Filter</button>
    </form>

    <?php
    $sql = "SELECT * FROM activities WHERE 1=1";
    $params = [];

    if (!empty($_GET['q'])) {
        $sql .= " AND (name LIKE :q OR description LIKE :q)";
        $params['q'] = '%' . $_GET['q'] . '%';
    }
    if (!empty($_GET['category'])) {
        $sql .= " AND category = :category";
        $params['category'] = $_GET['category'];
    }
    $sql .= " ORDER BY created_at DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $activities = $stmt->fetchAll();
    ?>

    <?php if (count($activities) === 0): ?>
        <p class="muted-link">No activities match your search. Try clearing the filters.</p>
    <?php endif; ?>

    <?php foreach ($activities as $a): ?>
        <div class="card">
            <span class="tag"><?= htmlspecialchars($a['category']) ?></span>
            <h3><?= htmlspecialchars($a['name']) ?></h3>
            <p><?= htmlspecialchars($a['description']) ?></p>
            <div class="meta">📍 <?= htmlspecialchars($a['location']) ?></div>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
