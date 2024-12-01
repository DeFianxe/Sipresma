<h2>Login</h2>

<?php if (isset($_GET['message']) && $_GET['message'] == 'session_expired'): ?>
    <p style="color: red;">Sesi Anda telah habis. Silakan login kembali.</p>
<?php endif; ?>

<?php if (isset($_GET['message']) && $_GET['message'] == 'logged_out'): ?>
    <p style="color: green;">Anda telah berhasil logout.</p>
<?php endif; ?>

<form method="POST" action="index.php?action=login">
    <label for="username">NIM/NIDN:</label>
    <input type="text" name="username" required>
    <label for="password">Password:</label>
    <input type="password" name="password" required>
    <button type="submit">Login</button>
</form>