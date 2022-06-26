<div class="sidebar">
    <div class="logo-details">
        <i class="fa-solid fa-building-columns"></i>
        <span class="logo_name">Leyte Normal Unversity</span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="../views/index.php">
                <i class="fa-solid fa-chart-simple"></i>
                <span class="link_name">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="../views/student.php">
                <i class="fa-solid fa-person"></i>
                <span class="link_name">Students</span>
            </a>
        </li>
        <li>
            <a href="../views/program.php">
                <i class="fa-solid fa-book"></i>
                <span class="link_name">Programs</span>
            </a>
        </li>
        <li>
            <a href="../views/student.php">
                <i class="fa-solid fa-book-skull"></i>
                <span class="link_name">List of Offenses</span>
            </a>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class="fa-solid fa-person-military-to-person"></i>
                    <span class="link_name">Disciplinary</span>
                </a>
                <i class="fa-solid fa-angle-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Disciplinary</a></li>
                <li><a href="#">Counselling Report</a></li>
                <li><a href="#">Action Report</a></li>
                <li><a href="#">Referral Report</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="fa-solid fa-person"></i>
                <span class="link_name">Lost and Found</span>
            </a>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class="fa-solid fa-handshake"></i>
                    <span class="link_name">Rewards</span>
                </a>
                <i class="fa-solid fa-angle-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Rewards</a></li>
                <li><a href="../php/logout.php">MVP</a></li>
                <li><a href="#">Outstanding Athlete</a></li>
                <li><a href="#">Kindly Act</a></li>
                <li><a href="#">Honors</a></li>
                <li><a href="#">Deans Lister</a></li>
            </ul>
        </li>
        <li>
            <a href="../views/account.php">
                <i class="fa-solid fa-user"></i>
                <span class="link_name">Accounts</span>
            </a>
        </li>
        <li>
            <div class="profile-details">
                <div class="profile-content">
                    <img src="../assets/images/profile.jpg" alt="profileImg">
                </div>
                <div class="name-job">



                    <div class="profile_name"><?= $_SESSION['first_name']; ?></div>
                    <div class="job">User Type: <?= $_SESSION['type']; ?></div>

                </div>
                <a href="../php/authentication/logout.php"><i class="logoutBtn fa-solid fa-arrow-right-from-bracket"></i></a>
            </div>
        </li>
    </ul>
</div>

<section class="home-section">
    <div class="home-content">
        <i class="fa-solid fa-bars bx-menu"></i>
        <!-- <span class="text">Drop Down Sidebar</span> -->