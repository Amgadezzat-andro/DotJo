<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?php
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    if($uri_segments[1]==''){
      echo "Home";
    }
    else if($uri_segments[1]=='article'){
      echo "Article";
    }
    else if($uri_segments[1]=='category'){
      echo "Category";
    }
    else {
      echo "DotJo Task";
    }
    ?>
  </title>