<!DOCTYPE html>
<html>
<?php
/*
Description: this is the video player for movies and tv shows
*/
Include '../Controller/session.php';
Include 'header.php';
Include 'navbar.php';
Include '../Controller/getMovieByID.php';
?>
<body>
  <div class="container text-center mt-5 mb-3 pt-3">
    <?php
    echo "<h1 class='movieTitle'>".$movieArray->Title."</h1><br>";
    ?>
  </div>
  <div class="playVideo">
    <?php
    echo "<video src='".$movieArray->Video_link."' type='video/mp4' autoplay controls/>";
    ?>
  </div>
  <div class="container mt-5 mb-5 pt-3">
    <div class="row">
      <div class="videoPoster col-3">
        <?php
          echo "<img src='".$movieArray->Image_link."' onerror=this.src='Images/film.placeholder.poster.jpg'></a>"; // card image
        ?>
      </div>
      <div class="videoDescription col-6">
        <?php
          echo "<div class='card-body'>";
          echo "<h2 class='movieTitle'>".$movieArray->Title."";
          echo "<h6 class='movieTitle text-muted'>".nl2br($movieArray->Description)."</h5>";
          echo "<h6 class='movieTitle'><b>Year: </b>".$movieArray->Year."";
          echo "<h6 class='movieTitle'><b>Genre: </b>".$movieArray->Genre."";
          echo "</div>";
        ?>
      </div>
    </div>
  </div>
</body>
<?php
  include 'footer.php';
  include '../Controller/bootstrapScript.php';
  include '../Controller/ajaxScript.php';
  include '../Controller/navControl.js';
?>
</html>
