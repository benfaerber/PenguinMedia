<?php
function clean($base)
{
  $ext = ["txt", "mp4", "avi", "mpk", "mp3", "pdf", "wav", "m4v", ""];
  for ($i = 0; $i < count($ext); $i++)
  {
    $base = str_replace("." . $ext[$i], "", $base);
  }
  $base = str_replace("111_", "", $base);
  return $base;
}

function ls($dir, $rex)
{
    $ffs = scandir($dir);

    if ($rex)
    {
      sort($ffs);
    }

    unset($ffs[array_search('.', $ffs, true)]);
    unset($ffs[array_search('..', $ffs, true)]);

    if (count($ffs) < 1)
        return;

    echo '<ul class="dir">';

    foreach($ffs as $ff)
    {
        echo "<li>";

        if(is_dir($dir.'/'.$ff))
        {
          echo "<details><summary>" . clean($ff) . "</summary>";
          if ($rex)
          {
            ls($dir.'/'.$ff, $rex);
          }
          echo "</details>";
        }
        else
        {
          //Im a file
          echo "<a href='loader.php?c=" . $_GET['c'] . "&w=" . $dir. "/" . $ff . "&ff=" . $ff . "'>" . clean($ff) . "</a>";
        }

        echo '</li>';
    }
    echo '</ul>';
}

function books($dir, $rex)
{
    $ffs = scandir($dir);

    if ($rex)
    {
      sort($ffs);
    }

    unset($ffs[array_search('.', $ffs, true)]);
    unset($ffs[array_search('..', $ffs, true)]);

    if (count($ffs) < 1)
        return;

    echo '<ul class="dir">';

    foreach($ffs as $ff)
    {
        echo "<li>";

        if(is_dir($dir.'/'.$ff))
        {
          echo "<details><summary>" . clean($ff) . "</summary>";
          if ($rex)
          {
            books($dir.'/'.$ff, $rex);
          }
          echo "</details>";
        }
        else
        {
          echo "<a href='" . $dir. "/" . $ff . "'>" . clean($ff) . "</a>";
        }

        echo '</li>';
    }
    echo '</ul>';
}
?>

<html>
<head>
  <title>Penguin Media</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="shortcut icon" type="image/png" href="img/icon.png"/>
</head>

<body>
  <div class="container">
      <nav class="ccsticky-nav">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="index.php?c=movies">Movies</a></li>
          <li><a href="index.php?c=tv">TV</a></li>
          <li><a href="index.php?c=music">Music</a></li>
          <li><a href="index.php?c=books">Books</a></li>
        </ul>
      </nav>
  </div>
  <br><br><br><br>

  <center>
    <img src="img/logo.png" width="1000px">
  </center>

<div class="content">
<?php
$cat = $_GET['c'];

if ($cat == "tv")
{
  ls("media/tv", true);
}
else if ($cat == "movies")
{
  ls("media/movies", true);
}
else if ($cat == "music")
{
  ls("media/music", true);
}
else if ($cat == "books")
{
  books("media/books", true);
}
?>

<?php if (!isset($_GET['c'])) : ?>
<center><h3>
Penguin Media is a media streaming service, compatible with mobile phones, computers, Wii Us and probably some other devices. I made it so I can watch movies on my TV without the hassle.
</h3></center>
</h2>
   <h2>Useful links</h2>
    <ul class="cata">
      <li><a href="index.php?c=movies">Movies</a></li>
      <li><a href="index.php?c=tv">TV</a></li>
      <li><a href="index.php?c=music">Music</a></li>
      <li><a href="index.php?c=books">Books</a></li>
    </ul>
<?php endif; ?>
 
</div>
</body>
</html>