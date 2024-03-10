<section class="container-fluid ">

    <div class="row justify-content-center">
        <div class="col-md-12 text-center">
            <h1>  <?= $article->article_title ?> </h1>
        </div>
    </div>
    <div style="margin: auto;" class="col-md-6 text-center">
        <?php
            ?>
            <div class="col">
                <div class="card h-100">
                    <?php
                    if ($article->article_pic == '') {
                        echo " <img src='https://static.vecteezy.com/system/resources/previews/005/337/799/original/icon-image-not-found-free-vector.jpg' class='card-img-top luja2' alt='...'>";
                    } else {
                        echo "<img src='/upload/article_images/$article->article_pic' class='card-img-top luja2' alt='...'>";
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $article->article_title ?>
                        </h5>
                        <p class="card-text">
                            <?= $article->article_desc ?>
                        </p>
                    </div>
                </div>
            </div>

            <?php

        ?>



    </div>
</section>




