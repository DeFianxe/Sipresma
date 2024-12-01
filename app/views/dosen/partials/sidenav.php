<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 250px;">
    <h4 class="text-center">Menu</h4>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="index.php?page=dosen_dashboard" class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'dosen_dashboard') ? 'active' : ''; ?>" aria-current="page">
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="index.php?page=dosen_prestasi" class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'dosen_prestasi') ? 'active' : ''; ?>">
                Prestasi
            </a>
        </li>
        <li class="nav-item">
            <a href="index.php?page=dosen_leaderboard" class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'dosen_leaderboard') ? 'active' : ''; ?>">
                Leaderboard
            </a>
        </li>
    </ul>
</div>