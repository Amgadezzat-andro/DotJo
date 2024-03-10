<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link <?php
        $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri_segments = explode('/', $uri_path);
        if($uri_segments[1]=='') echo "active";
        ?> " href="/">Home</a>
      </li>     
      <li class="nav-item">
        <a class="nav-link <?php if($uri_segments[1]=='category') echo "active";?>" href="/category">Category</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($uri_segments[1]=='subcategory') echo "active";?>" href="/subcategory">SubCategories</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($uri_segments[1]=='article') echo "active";?>" href="/article">Articles</a>
      </li>
    </ul>
  </div>
</nav>