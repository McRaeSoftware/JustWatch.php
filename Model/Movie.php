<?php
class Movie
{
  protected $movieID;
  protected $title;
  protected $year;
  protected $description;
  protected $genre;
  protected $rating;
  protected $certification;
  protected $runtime;
  protected $imageLink;
  protected $videoLink;
  protected $director;
  protected $cast;
  protected $quality;

  function __construct($movieID, $title, $year, $description, $genre, $rating, $certification, $runtime, $imageLink, $videoLink, $director, $cast, $quality)
  {
    $this->Movie_ID = $movieID;
    $this->Title = $title;
    $this->Year = $year;
    $this->Description = $description;
    $this->Genre = $genre;
    $this->Rating = $rating;
    $this->Certification = $certification;
    $this->Runtime = $runtime;
    $this->ImageLink = $imageLink;
    $this->VideoLink = $videoLink;
    $this->Director = $director;
    $this->Cast = $cast;
    $this->Quality = $quality;
  }

  function GetMovieID()
  {
    return $this->movieID;
  }
  function GetTitle()
  {
    return $this->title;
  }
  function GetYear()
  {
    return $this->year;
  }
  function GetDescription()
  {
    return $this->Description;
  }
  function GetGenre()
  {
    return $this->Genre;
  }
  function GetRating()
  {
    return $this->Rating;
  }
  function GetCertification()
  {
    return $this->Certification;
  }
  function GetRuntime()
  {
    return $this->Runtime;
  }
  function GetImageLink()
  {
    return $this->imageLink;
  }
  function GetVideoLink()
  {
    return $this->videoLink;
  }
  function GetDirector()
  {
    return $this->director;
  }
  function GetCast()
  {
    return $this->cast;
  }
  function GetQuality()
  {
    return $this->quality;
  }
}
?>
