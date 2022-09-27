<?php
/*
Description: this is the video player for movies and tv shows
*/
Include '../Controller/session.php';
Include 'header.php';
Include 'sidebar.php';
// Include 'testnavbar.php';
Include '../Controller/getMovieByID.php';
require '../Controller/StringManipulation.php';
?>
<body>
    <main id="main" class="main">
      <div class="pagetitle">
        <h1>Movies</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item "><a href="movies.php">Movies</a></li>
            <?php
            echo "<li class='breadcrumb-item active'><a href='#'>".$movieArray->Title."</a></li>";
            ?>
          </ol>
        </nav>
      </div><!-- End Page Title -->

      <section class="section">
        <div class="row">
          <div class='col-md-4 pl-5'>
            <div class='card-body '>
              <?php
              echo " <form class='form-group needs-validation' method='POST' action='../Controller/attemptUpdateMovie.php?movieid=".$movieid."' enctype='multipart/form-data' novalidate>
                  <img src='".$movieArray->Image_link."' class='card-img-viewMovie' alt='Movie Poster' onerror=this.src='images/film.placeholder.poster.jpg'>
                  </form>";
                ?>
              </div>
            </div>

          <div class="col-lg">
              <div class="card-body ">
                <!-- Movie Description and Extras -->
                <?php
                echo "<h5 class='card-title'>".$movieArray->Title."</h5>";
                $UKCertification = string_between_two_string($movieArray->Certification, 'United Kingdom:', '/');
                ?>

                <div class="row">

                  <div class="col-lg">
                    <!-- TODO: code up buttons -->
                    <button type="button" href= "playMovie.php" class="btn btn-primary"><i class="bi bi-play-circle mr-1"></i>Play Movie</button>
                    <button type="button" class="btn btn-success"><i class="bi bi-bookmark-star mr-1"></i>Watch List</button>
                    <?php
                  //echo "<button type='button' href='playMovie.php' class='btn btn-primary'><i class='bi bi-play-circle mr-1'></i> Play Movie</button>";
                //  echo '<button type="button" class="btn btn-success"><i class="bi bi-star me-1"></i>Add To Watch List</button>';
                  echo "<h5 class='movieTitle pt-3'><b>Year: </b>".$movieArray->Year."";
                  echo "<h5 class='movieTitle'><b>Runtime: </b>".$movieArray->Runtime."";
                  echo "<h5 class='movieTitle'><b>Quality: </b>".$movieArray->Quality."";
                  ?>
              </div><!-- End Col -->

              <div class="col-lg-6">
                <?php
                echo "<h5 class='movieTitle'><b>Genre: </b>".$movieArray->Genre."";
                echo "<h5 class='movieTitle'><b>Director: </b>".$movieArray->Director."";
                echo "<br><h5 class='movieTitle'><b>Rating: </b>".$movieArray->Rating."/10";
                echo "<h5 class='movieTitle'><b>Certification: </b>".$UKCertification."";
                ?>
              </div> <!-- End Col -->

              </div><!-- End Row -->
            <?php
            echo "<h5 class='movieTitle text-muted'>".nl2br($movieArray->Description)."</h5>";
            ?>
          </div><!-- End Card Body -->

      </div><!-- End Col -->
    </div><!-- End Row -->
        <div class="row">
          <div class="card-body">
            <?php

              echo "<h1 class='card-title'>Cast</h1>";
            echo "<h5 class='movieTitle'><text class='show-read-more'>".$movieArray->Cast."</text>";
            ?>
          </div>
        </div> <!-- End Row -->

      </section>
  </main>
      <?php
        include 'footer.php';
        include '../Controller/bootstrapScript.php';
        include '../Controller/ajaxScript.php';
        include '../Controller/navControl.js';
      ?>
</body>
