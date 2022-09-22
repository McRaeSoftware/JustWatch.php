<!-- ===================== Top of Sidebar aka Header ===================== -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <!-- image and Justwatch title -->
    <div class="d-flex align-items-center justify-content-between">
      <a href="#" class="logo d-flex align-items-center">
        <img src="../assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">JustWatch</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- Search functionality -->
    <div id="pcSearch" class="search-bar col-6 pt-3">
      <form class="search-form d-flex align-items-center" method="GET" action="#">
        <input class="form-control" type="search" placeholder="Search by Title" name="filterByTitle">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <!-- User -->
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <?php
            if(isset($_SESSION['username'])){
              echo  "<span class='d-none d-md-block dropdown-toggle ps-2'>".$_SESSION['username']."</span>";
            }
           ?>
            <!-- <span class="d-none d-md-block dropdown-toggle ps-2">Test User</span> -->
          </a><!-- End Profile -->

          <!-- User Dropdown -->
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">

             <?php
             if(isset($_SESSION['username']) && $_SESSION['admin'] === false)
             {
                   echo  "<span>".$_SESSION['username']."</span>";
                   echo "<br><span>Standard User</span>";
              }

              if(isset($_SESSION['username']) && $_SESSION['admin'] === true)
              {
                   echo  "<h6>".$_SESSION['username']."</h6>";
                   echo "<span>Admin User</span>";
             }
             ?>

            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="accountManagement.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="../Controller/attemptLogout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>
          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->
  </header><!-- End Header -->

  <!-- =================================== Sidebar ========================================== -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="page-underconstruction.php">
          <i class="bi bi-grid"></i>
          <span>Recently Added</span>
        </a>

      <li class="nav-item">
        <a class="nav-link collapsed" href="page-underconstruction.php">
          <i class="bi bi-bookmark-star"></i>
          <span>Watch List</span>
        </a>
      </li><!-- End Watch List Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="testmovies.php">
          <i class="bi bi-badge-hd"></i>
          <span>Movies</span>
        </a>
      </li><!-- End Movies Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="series.php">
          <i class="bi bi-tv"></i>
          <span>Tv-Shows</span>
        </a>
      </li><!-- End Tv-Shows Page Nav -->

      <!-- Only Admin Users Can see  -->
      <?php
      if(isset($_SESSION['username']) && $_SESSION['admin'] === true)
      {
        echo "
        <li class='nav-heading'>Admin Section</li>

        <li class='nav-item'>
          <a class='nav-link collapsed' href='adminNavigation.php'>
            <i class='bi bi-person'></i>
            <span>Admin Screen</span>
          </a>
        </li><!-- End Admin Page Nav -->

        <li class='nav-item'>
          <a class='nav-link collapsed' href='#'>
            <i class='bi bi-file-person'></i>
            <span>Register User</span>
          </a>
        </li><!-- End Register Page Nav -->
        ";
      }
      ?>
    </ul>
  </aside><!-- End Sidebar-->
