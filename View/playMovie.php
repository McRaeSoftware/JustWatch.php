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
          <?php
          echo "<h5 class='card-title'>".$movieArray->Title."</h5>";
          ?>
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
</main>
      <?php
        include 'footer.php';
        include '../Controller/bootstrapScript.php';
        include '../Controller/ajaxScript.php';
        include '../Controller/navControl.js';
      ?>
</body>
</html>
