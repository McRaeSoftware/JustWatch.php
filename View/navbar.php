<?php
/*
Description: Navigation bar at the top of each page.
Author: David McRae, Oliver Dickens
*/
?>
<nav class="navbar d-flex d-inline no-gutters row">
  <div class ="col" id="top">
      <a class="btn logo">JustWatch <i class="fas fa-angle-double-right"></i></a>
    <div class="sideBar row no-gutters " id="sideBar">

      <ul class="list-group col">

        <li class='list-group-item'>
          <a href='accountManagement.php' class='nav-link'>
            <div class='row fa-secondary fa-lg'>
              <i class='col-3 fas fa-user-circle fa-lg'></i>
              <span class='col-9 link-text'><?php echo $_SESSION['username']; ?></span>
            </div>
          </a>
        </li>

        <?php
        if(isset($_SESSION['username']) && $_SESSION['admin'] === true)
        {
          echo "
          <li class='list-group-item'>
            <a href='adminNavigation.php' class='nav-link'>
              <div class='row fa-secondary fa-lg'>
                <i class='col-3 fas fa-id-card-alt fa-lg'></i>
                <span class='col-9 link-text'>Admin</span>
              </div>
            </a>
          </li>
          ";
        }
        ?>

        <li class="list-group-item">
          <a href="movies.php" class="nav-link">
            <div class="row fa-secondary fa-lg">
              <i class="col-3 fas fa-ticket-alt fa-lg"></i>
              <span class="col-9 link-text">Movies</span>
            </div>
          </a>
        </li>

        <li class="list-group-item">
          <a href="series.php" class="nav-link">
            <div class="row fa-secondary fa-lg">
              <i class="col-3 fas fa-tv fa-lg"></i>
              <span class="col-9 link-text">Series</span>
            </div>
          </a>
        </li>

        <li class="list-group-item">
          <a href="../Controller/attemptLogout.php" class="nav-link">
            <div class="row fa-secondary fa-lg">
              <i class="col-3 fas fa-sign-out-alt fa-lg"></i>
              <span class="col-9 link-text">Logout</span>
            </div>
          </a>
        </li>

      </ul>
    </div>
  </div>

  <div id="pcSearch" class="col-10 row no-gutters justify-content-center">
    <form class="form-inline col-10" method="GET">
      <input class="form-control col-9 mr-1" type="search" placeholder="Search by Title" name="filter">
      <button class="btn btn-danger col-2 " type="submit">Search</button>
    </form>
  </div>

</nav>
