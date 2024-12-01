<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pencatatan Prestasi</title>
</head>

<body>
    <header>
        <nav>
            <a href="index.php?page=home">Home</a>
            <a href="index.php?page=prestasi">Prestasi</a>
            <a href="index.php?page=leaderboard">Leaderboard</a>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="index.php?action=logout">Logout</a>
            <?php endif; ?>
        </nav>
    </header>