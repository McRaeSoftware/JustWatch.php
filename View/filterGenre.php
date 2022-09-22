<!-- Movedthis out of movies page -->




<!-- filter movies  -->
  <div class="row col-12 no-gutters" style="display:inline-block;">
        <button id="filterByGenreButton" class="btn btn-info col-2 m-2 float-right">Filter</button>
  </div>

  <div style="display:none;" id="filterDiv" class="container mt-2 row col-12 no-gutters">
  <form class="m-2 row text-center justify-content-center" method="POST">
      <div class="btn-group-toggle" data-toggle="buttons">

        <label class="btn btn-outline-info m-2">
          <input type="checkbox" name="genre[]" checked="">Action
        </label>
        <label class="btn btn-outline-info m-2">
          <input type="checkbox" name="genre[]" checked="">Adventure
        </label>
        <label class="btn btn-outline-info m-2">
          <input type="checkbox" name="genre[]" checked="">Animation
        </label>
        <label class="btn btn-outline-info m-2">
          <input type="checkbox" name="genre[]" checked="">Comedy
        </label>
        <label class="btn btn-outline-info m-2">
          <input type="checkbox" name="genre[]" checked="">Crime
        </label>
        <label class="btn btn-outline-info m-2">
          <input type="checkbox" name="genre[]" checked="">DC
        </label>
        <label class="btn btn-outline-info m-2">
          <input type="checkbox" name="genre[]" checked="">Drama
        </label>
        <label class="btn btn-outline-info m-2">
          <input type="checkbox" name="genre[]" checked="">Fantasy
        </label>
        <label class="btn btn-outline-info m-2">
          <input type="checkbox" name="genre[]" checked="">Family
        </label>
        <label class="btn btn-outline-info m-2">
          <input type="checkbox" name="genre[]" checked="">Marvel
        </label>
        <label class="btn btn-outline-info m-2">
          <input type="checkbox" name="genre[]" checked="">Romance
        </label>
        <label class="btn btn-outline-info m-2">
          <input type="checkbox" name="genre[]" checked="">Sci-Fi
        </label>
        <label class="btn btn-outline-info m-2">
          <input type="checkbox" name="genre[]" checked="">Thriller
        </label>
        <label class="btn btn-outline-info m-2">
          <input type="checkbox" name="genre[]" checked="">History
        </label>
        <label class="btn btn-outline-info m-2">
          <input type="checkbox" name="genre[]" checked="">Documentary
        </label>
        <label class="btn btn-outline-info m-2">
          <input type="checkbox" name="genre[]" checked="">Mystery
        </label>
        <label class="btn btn-outline-info m-2">
          <input type="checkbox" name="genre[]" checked="">Horror
        </label>
        <label class="btn btn-outline-info m-2">
          <input type="checkbox" name="genre[]" checked="">Biography
        </label>
        <label class="btn btn-outline-info m-2">
          <input type="checkbox" name="genre[]" checked="">Music
        </label>
        <label class="btn btn-outline-info m-2">
          <input type="checkbox" name="genre[]" checked="">Sport
        </label>
        <label class="btn btn-outline-info m-2">
          <input type="checkbox" name="genre[]" checked="">War
        </label>
        <label class="btn btn-outline-info m-2">
          <input type="checkbox" name="genre[]" checked="">Western
        </label>

      </div>
      <button class="btn btn-info m-2" type="submit">Search By Genre</button>
    </form>
  </div>
