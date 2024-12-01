<?php include 'partials/header.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <?php include 'partials/sidenav.php'; ?>
        </div>
        <div class="col-md-9">
            <h2>Welcome <?php echo $_SESSION['user']['nama_dosen']; ?></h2>
            <p>This is the admin dashboard page.</p>
        </div>
    </div>
</div>
<?php include 'partials/footer.php'; ?>