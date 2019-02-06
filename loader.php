<html>
<head>
  <title>Penguin Media</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="shortcut icon" type="image/png" href="img/icon.png"/>
</head>
<?php
function clean($base)
{
  $ext = ["txt", "mp4", "avi", "mpk", "mp3", "pdf", "wav", "m4v", ""];
  for ($i = 0; $i < count($ext); $i++)
  {
    $base = str_replace("." . $ext[$i], "", $base);
  }
  return $base;
}
?>
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

    
    <?php
    $m = "";

    if ($_GET['c'] == "music")
    {
      $m = "height='50px'";
    }
    echo "<video width='90%'" . $m . " controls>";
    echo "<source src='" . $_GET['w'] . "' type='video/mp4'>";
    ?>
    Your browser does not support the video tag.
    </video>
    <br><br>
    <h1>
      <?php
      if ($_GET['c'] == "tv")
      {
        $path = $_GET['w'];
        $path = str_replace($_GET['ff'], "", $path);
        $na = scandir($path);

        $ind = 0;
        for ($i = 0; $i < count($na); $i++)
        {
          if ($na[$i] == $_GET['ff'])
          {
            $ind = $i;
            break;
          }
        }
        $back = "loader.php?c=" . $_GET['c'] . "&w=" . $path . $na[$ind-1] . "&ff=" . $na[$ind-1];
        if ($ind+1 < count($na))
        {
          $forw = "loader.php?c=" . $_GET['c'] . "&w=" . $path . $na[$ind+1] . "&ff=" . $na[$ind+1];
        }
        
        if ($ind != 2)
        {
          echo "<a href='" . $back . "'><img src='img/left.png' width='50px'></a> ";
        }
      }

      echo clean($_GET['ff']);

      if ($_GET['c'] == "tv")
      {
        if ($ind != count($na)-1)
        {
          echo " <a href='" . $forw . "'><img src='img/right.png' width='50px'></a> ";
        }
      }

      ?>
    </h1>
  </center>
</div>
</body>
</html>
