
<!-- Navbar Brand-->
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand ps-3" href="admin_index.php">

        <?php
        $user_name = $_SESSION['user_name'];
        $sql = "SELECT * FROM user_account WHERE user_name= '$user_name'";
        $result = mysqlexec($sql);
        if (mysqli_num_rows($result) > 0) {
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $first_name = ucwords($row['first name']);
                $last_name = ucwords($row['father name']);
                echo " $first_name $last_name";
            } else {
                echo "Admin";
            }
        }
        ?>
    </a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" style="visibility: hidden !important;">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">Profile</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>

</nav>