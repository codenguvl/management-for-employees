<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3 pt-4" href="./">
        <img src="images/logo.png" width="100px" alt="">
    </a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <span class="ms-auto" style="padding-right: 10px">
        <?php if (isset($_SESSION['username'])): ?>
            <span class="badge bg-primary">Xin chào, <?php echo $_SESSION['username']; ?></span>
        <?php else: ?>
            <span class="badge bg-secondary">Xin chào, Khách</span>
        <?php endif; ?>
    </span>

</nav>