<!DOCTYPE html>
<html>
<?php
/*
    Description: this is the video player for movies and tv shows
*/
  Include '../Controller/session.php';
  Include 'header.php';
  Include 'navbar.php';
  Include '../Controller/getEpisode.php';
?>
<body>
      <div class="playVideo">
        <?php
        echo "<video src='".$seriesArray->Video_link."' type='video/mp4' autoplay controls/>";
        ?>
      </div>

      <div class="container mt-5 mb-5 pt-3">
        <div class="row">
          <div class="videoPoster col-3">
      <?php
        echo "<img src='".$seriesArray->Image_link."' onerror=this.src='Images/film.placeholder.poster.jpg'></a>"; // card image
      ?>
    </div>
    <div class="videoDescription col-6">
      <?php
        echo "<div class='card-body'>";
          echo "<h1 class='movieTitle'>".$seriesArray->Episode_Name."</h1><br>";
        echo "</div>";
      ?>
    </div>
  </div>
</div>
</body>
<footer>
      <?php

      include '../Controller/bootstrapScript.php';
      include '../Controller/ajaxScript.php';
      include '../Controller/navControl.js';
        ?>
</footer>
</html>
