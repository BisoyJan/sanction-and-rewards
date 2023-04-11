<div class="sidebar">
    <div class="logo-details">
        <i class="fa-solid fa-building-columns"></i>
        <span class="logo_name">LNU VPSDAS</span>
    </div>

    <?php
    if ($_SESSION['type'] == "Admin") { ?>
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
                <a href="../views/offense.php">
                    <i class="fa-solid fa-book-skull"></i>
                    <span class="link_name">List of Offenses</span>
                </a>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class="fa-solid fa-person-military-to-person"></i>
                        <span class="link_name">Sanction Reports</span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="../views/sanction-referral.php">Referral</a></li>
                    <li><a href="../views/sanction-action.php">Disciplinary Action</a></li>
                    <li><a href="../views/sanction-counselling.php">Counseling</a></li>
                </ul>
            </li>
            <!-- <li>
                <a href="../views/student-status.php">
                    <i class="fa-solid fa-check"></i>
                    <span class="link_name">Student Status</span>
                </a>
            </li> -->
            <li>
                <a href="../views/analytics.php">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span class="link_name">Analytics</span>
                </a>
            </li>
            <li>
                <a href="../views/lost-found.php">
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
                    <li><a href="../views/reward-leadership.php">Leadership</a></li>
                    <li><a href="../views/reward-outstanding_athlete.php">Outstanding Athlete</a></li>
                    <li><a href="../views/reward-mvp_athlete.php">MVP Athlete</a></li>
                    <li><a href="../views/reward-good_deeds.php">Kindly Act</a></li>
                </ul>
            </li>
            <li>
                <a href="../views/account.php">
                    <i class="fa-solid fa-user"></i>
                    <span class="link_name">Accounts</span>
                </a>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class="fa-solid fa-gear"></i>
                        <span class="link_name">Settings</span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Disciplinary</a></li>
                    <li><a href="../views/semester.php">Semester</a></li>
                    <li><a href="../views/logs.php">Logs</a></li>
                </ul>
            </li>
            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <img src="../../assets/images/user_90px.png" alt="profileImg">
                    </div>
                    <div class="name-job">

                        <div class="profile_name"><?= $_SESSION['first_name']; ?></div>
                        <div class="job">User Type: <?= $_SESSION['type']; ?></div>

                    </div>
                    <a href="../../php/authentication/logout.php"><i class="logoutBtn fa-solid fa-arrow-right-from-bracket"></i></a>
                </div>
            </li>
        </ul>
    <?php } elseif ($_SESSION['type'] == "MIS") { ?>
        <ul class="nav-links">
            <li>
                <a href="../views/account.php">
                    <i class="fa-solid fa-user"></i>
                    <span class="link_name">Accounts</span>
                </a>
            </li>
            <li>
                <a href="../../pages/forms/databasebackup.php">
                    <i class="fa-solid fa-database"></i>
                    <span class="link_name">Database</span>
                </a>
            </li>
            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <img src="../../assets/images/user_90px.png" alt="profileImg">
                    </div>
                    <div class="name-job">

                        <div class="profile_name"><?= $_SESSION['first_name']; ?></div>
                        <div class="job">User Type: <?= $_SESSION['type']; ?></div>

                    </div>
                    <a href="../../php/authentication/logout.php"><i class="logoutBtn fa-solid fa-arrow-right-from-bracket"></i></a>
                </div>
            </li>
        </ul>
    <?php  } elseif ($_SESSION['type'] == "User") { ?>
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
                <div class="iocn-link">
                    <a href="#">
                        <i class="fa-solid fa-person-military-to-person"></i>
                        <span class="link_name">Sanctioning</span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="../views/sanction-referral.php">Referral</a></li>
                    <li><a href="../views/sanction-action.php">Disciplinary Action</a></li>
                </ul>
            </li>
            <!-- <li>
                <a href="../views/student-status.php">
                    <i class="fa-solid fa-check"></i>
                    <span class="link_name">Student Status</span>
                </a>
            </li> -->
            <li>
                <a href="../views/analytics.php">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span class="link_name">Analytics</span>
                </a>
            </li>
            <li>
                <a href="../views/lost-found.php">
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
                    <li><a href="../views/reward-leadership.php">Leadership</a></li>
                    <li><a href="../views/reward-outstanding_athlete.php">Outstanding Athlete</a></li>
                    <li><a href="../views/reward-mvp_athlete.php">MVP Athlete</a></li>
                    <li><a href="../views/reward-good_deeds.php">Kindly Act</a></li>
                </ul>
            </li>
            <li>
                <a href="../views/account.php">
                    <i class="fa-solid fa-user"></i>
                    <span class="link_name">Accounts</span>
                </a>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class="fa-solid fa-gear"></i>
                        <span class="link_name">Settings</span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Disciplinary</a></li>
                    <li><a href="../views/semester.php">Semester</a></li>

                </ul>
            </li>
            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <img src="../../assets/images/user_90px.png" alt="profileImg">
                    </div>
                    <div class="name-job">

                        <div class="profile_name"><?= $_SESSION['first_name']; ?></div>
                        <div class="job">User Type: <?= $_SESSION['type']; ?></div>

                    </div>
                    <a href="../../php/authentication/logout.php"><i class="logoutBtn fa-solid fa-arrow-right-from-bracket"></i></a>
                </div>
            </li>
        </ul>
    <?php } else { ?>
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
                <div class="iocn-link">
                    <a href="#">
                        <i class="fa-solid fa-person-military-to-person"></i>
                        <span class="link_name">Sanctioning</span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Disciplinary</a></li>
                    <li><a href="../views/sanction-referral.php">Referral</a></li>
                </ul>
            </li>
            <li>
                <a href="../views/lost-found.php">
                    <i class="fa-solid fa-person"></i>
                    <span class="link_name">Lost and Found</span>
                </a>
            </li>
            <li>
                <div class="iocn-link ">
                    <a href="#">
                        <i class="fa-solid fa-gear"></i>
                        <span class="link_name">Settings</span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Disciplinary</a></li>
                    <li><a href="../views/semester.php">Semester</a></li>
                    <li><a href="../views/logs.php">Logs</a></li>
                </ul>
            </li>
            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <img src="../../assets/images/user_90px.png" alt="profileImg">
                    </div>
                    <div class="name-job">

                        <div class="profile_name"><?= $_SESSION['first_name']; ?></div>
                        <div class="job">User Type: <?= $_SESSION['type']; ?></div>

                    </div>
                    <a href="../../php/authentication/logout.php"><i class="logoutBtn fa-solid fa-arrow-right-from-bracket"></i></a>
                </div>
            </li>
        </ul>
    <?php } ?>

</div>

<section class="home-section">
    <div class="home-content">
        <i class="fa-solid fa-bars bx-menu"></i>


        <!-- <span class="text">Drop Down Sidebar</span> -->