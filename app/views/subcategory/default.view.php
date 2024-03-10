<section class="container">

    <div class="row justify-content-center">
        <div class="col-md-12 text-center">
            <h1> Sub Categories </h1>
            <h2>
                <?php
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                }
                ?>
            </h2>


            <div class="col-auto">
                <a href="/subcategory/add" class="btn btn-success megopad">Add New SubCategory</a>
            </div>



        </div>
    </div>



    <div class="row row-cols-1 row-cols-md-3 g-4">

        <?php

        if (empty($scategories)) {
            echo "<h1>No Data Found</h1>";
        }
        foreach ($scategories as $scategory):

            ?>

            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $scategory->name ?>
                        </h5>
                        <h5 class="card-title text-success">
                             Category : <?= $scategory->category_name ?>
                        </h5>
                        <a href="/subcategory/edit/<?= $scategory->id ?>" class="btn btn-warning">Edit</a>
                        <a onclick="return confirm('Are you sure you want to delete this item?');"
                            href="/subcategory/delete/<?= $scategory->id ?>" class="btn btn-danger">Delete</a>

                    </div>
                </div>
            </div>

            <?php
        endforeach;
        ?>

    </div>


</section>