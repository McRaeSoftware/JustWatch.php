<!DOCTYPE html>
<html>
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
      <section class="section">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <!-- Movie Description and Extras -->
                <?php
                echo "<h5 class='card-title'>".$movieArray->Title."</h5>";
                $UKCertification = string_between_two_string($movieArray->Certification, 'United Kingdom:', '/');
                echo "<div class='card-body'>";
                // echo "<h2 class='movieTitle'>".$movieArray->Title."";
                echo "<h5 class='movieTitle text-muted'>".nl2br($movieArray->Description)."</h5>";
                echo "<h6 class='movieTitle'><b>Year: </b>".$movieArray->Year."";
                echo "<h6 class='movieTitle'><b>Genre: </b>".$movieArray->Genre."";
                echo "<h6 class='movieTitle'><b>Rating: </b>".$movieArray->Rating."/10";
                echo "<h6 class='movieTitle'><b>Certification: </b>".$UKCertification."";
                echo "<h6 class='movieTitle'><b>Runtime: </b>".$movieArray->Runtime."";
                echo "<h6 class='movieTitle'><b>Director: </b>".$movieArray->Director."";
                echo "<h6 class='movieTitle'><b>Cast: </b><text class='show-read-more'>".$movieArray->Cast."</text>";
                echo "<h6 class='movieTitle'><b>Quality: </b>".$movieArray->Quality."";
                echo "</div>";
                ?>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <!-- Movie Poster -->
                <?php
                echo "<img src='".$movieArray->Image_link."' class='card-img-bottom' style='width: 28rem; height: 32rem;'' onerror=this.src='Images/film.placeholder.poster.jpg'></a>";
                ?>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="embed-responsive embed-responsive-16by9">

            <?php
            echo "<video src='".$movieArray->Video_link."' type='video/mp4' autoplay controls>";
            echo "<track src='".substr($movieArray->Video_link, 0, -4).".vtt' kind='subtitles' srclang='en' label='default' default>";
            echo "<track src='".substr($movieArray->Video_link, 0, -4).".vtt' kind='subtitles' srclang='en' label='English'>";
            echo "</video>"
            ?>
          </div>
        </div>
      </section>
    <main>
</body>
<?php
  include 'footer.php';
  include '../Controller/bootstrapScript.php';
  include '../Controller/ajaxScript.php';
  include '../Controller/navControl.js';
?>
</html>
