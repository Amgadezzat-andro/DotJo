<section class="container">

    <div class="row justify-content-center">
        <div class="col-md-12 text-center">
            <h1> Articles </h1>
            <h2>
                <?php
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                }
                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
                ?>

            </h2>
            <form action="/article">
                <div class="row g-3 my-4">
                    <div class="col-auto">                        
                            <select name="category_name" class="form-select" aria-label="Default select example">
                                <option value="">Select Category</option>
                                <?php
                                foreach ($categories as $category):
                                    echo "<option value='$category->id'>$category->category_name</option>";
                                endforeach;
                                ?>
                            </select>
                        
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a href="/article" class="btn btn-warning ">Clear</a>
                        <a class="btn btn-success" href="/article/add">Add New Article </a>
                    </div>

                </div>

            </form>


        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4">

        <?php
        if (empty($articles)) {
            echo "<h1>No Data Found</h1>";
        }
        foreach ($articles as $article):
            ?>

            <div class="col">
                <div class="card h-100">
                    <?php
                    if ($article->article_pic == '') {
                        echo " <img src='https://static.vecteezy.com/system/resources/previews/005/337/799/original/icon-image-not-found-free-vector.jpg' class='card-img-top luja' alt='...'>";
                    } else {
                        echo "<img src='/upload/article_images/$article->article_pic' class='card-img-top luja' alt='...'>";
                    }
                    ?>

                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $article->article_title ?>
                        </h5>
                        <h5 class="card-subtitle text-danger ">
                        <?= $article->category_name ?>
                        </h5>
                        <p class="card-text pmego">
                            <?= $article->article_desc ?>
                        </p>
                        <a href="/article/view/<?= $article->id ?>" class="btn btn-primary">View</a>
                        <a href="/article/edit/<?= $article->id ?>" class="btn btn-warning ">Edit</a>
                        <a onclick="return confirm('Are you sure you want to delete this item?');"
                            href="/article/delete/<?= $article->id ?>" class="btn btn-danger ">Delete</a>
                    </div>
                </div>
            </div>

            <?php
        endforeach;
        ?>



    </div>
</section>


<!-- //! Pagination -->

<nav aria-label="Page navigation example mt-5">
    <ul class="pagination justify-content-center mt-5">
        <?php
        if (!empty($articles)) {
            // ** Article Numbers In Single Page 
            $article_num = count($articles);
            // ** Get Request URL
            $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            // ** Make Segements
            $uri_segments = explode('/', $uri_path);
            ?>
            <!-- //** Previous Button -->
            <li class="page-item <?php if (empty($uri_segments[2]) || $uri_segments[3] == 0) {echo "disabled";} ?>">
                <a class="page-link" href="/article/default/<?php echo $uri_segments[3] - 1 ?>" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
    
            <li class="page-item <?php if (empty($uri_segments[2]) || $uri_segments[3] == 0) echo "disabled"; ?>">
                <a href="/article/" class="page-link">0</a>
            </li>
            <?php
            // ** Get All Records Count
            $rowsCount = $rows_count->count;
            // **  $frac -> 3.3
            $frac = $rowsCount / 3; 
            // ** Two Conditions
            // ! if Integer
            if (is_int($frac)) {
                $helper = 0;
                for ($x = 0; $x < $frac - 1; $x++) {
                    $helper = $x+1;
                    ?>
                    <li class="page-item<?php if ($uri_segments[3] == $x + 1)
                        echo " disabled" ?>"><a href="/article/default/<?php echo 1 + $x; ?>" class="page-link">
                            <?php echo 1 + $x; ?>
                        </a>
                    </li>
                    <?php
                }
            } else {
            // ! if Fraction
                $frac = (int) $frac; // 2
                $helper = 0;
                for ($x = 0; $x <= $frac - 1; $x++) {
                    $helper = $x+1;
                    ?>
                    <li class="page-item <?php if ($uri_segments[3] == $x + 1) echo " disabled" ?> ">
                        <a href="/article/default/<?php echo 1 + $x; ?>" class="page-link"> <?php echo 1 + $x; ?> </a>
                    </li>

                    <?php
                }
            }

            ?>
            <!-- //! Next Button -->
            <li class="page-item <?php
            if ($article_num <3 || $uri_segments[3] == $helper) {echo "disabled";} ?>">
                <a class="page-link" href="/article/default/<?php 
                    if(empty($uri_segments[3])){echo 1; }
                    else{ echo $uri_segments[3] + 1 ;}?>">Next</a>
            </li>

            <?php
        }
        ?>


    </ul>
</nav>

